<?php

namespace App\Http\Controllers\LiveCourse;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Gateways\SSLCommerz\SSLCommerz;
use App\Modules\Management\LiveCourseManagement\LiveCourse\Models\Model as LiveCourse;
use App\Modules\Management\LiveCourseManagement\LiveCourseBatch\Models\Model as LiveCourseBatch;
use App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Models\Model as LiveCourseEnrollment;

class LiveCourseController extends Controller
{
    public function index()
    {
        $live_courses = LiveCourse::active()
            ->orderBy('sort_order', 'asc')
            ->orderBy('is_popular', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.pages.live_courses.index', compact('live_courses'));
    }

    public function details($slug)
    {
        $course = LiveCourse::active()->where('slug', $slug)->firstOrFail();

        $batches = LiveCourseBatch::active()
            ->where('live_course_id', $course->id)
            ->orderBy('course_start_date', 'asc')
            ->get();

        $other_courses = LiveCourse::active()
            ->where('id', '!=', $course->id)
            ->orderBy('sort_order', 'asc')
            ->limit(3)
            ->get();

        return view('frontend.pages.live_courses.details', compact('course', 'batches', 'other_courses'));
    }

    public function enroll($slug)
    {
        $course = LiveCourse::active()->where('slug', $slug)->firstOrFail();

        $batches = LiveCourseBatch::active()
            ->where('live_course_id', $course->id)
            ->orderBy('course_start_date', 'asc')
            ->get();

        return view('frontend.pages.live_courses.enroll', compact('course', 'batches'));
    }

    public function enroll_submit(Request $request, $slug)
    {
        $request->validate([
            'batch_id'      => 'required|integer',
            'name'          => 'required|string|max:200',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string|max:500',
            'gender'        => 'required|in:পুরুষ,মহিলা,অন্যান্য',
            'payment_type'  => 'required|in:online,offline',
            'payment_photo' => 'nullable|image|max:2048',
        ]);

        $course = LiveCourse::active()->where('slug', $slug)->firstOrFail();
        $batch  = LiveCourseBatch::active()
                    ->where('id', $request->batch_id)
                    ->where('live_course_id', $course->id)
                    ->firstOrFail();

        $amount = (float)($course->sale_price ?: $course->regular_price ?: 0);

        $photo_path = null;
        if ($request->hasFile('payment_photo')) {
            $photo_path = uploader($request->file('payment_photo'), 'uploads/payment_photos');
        }

        $enrollment = LiveCourseEnrollment::create([
            'live_course_id' => $course->id,
            'batch_id'       => $batch->id,
            'student_info'   => [
                'name'    => $request->name,
                'phone'   => $request->phone,
                'address' => $request->address,
                'gender'  => $request->gender,
            ],
            'amount'         => $amount,
            'amount_paid'    => 0,
            'payment_status' => 'pending',
            'method'         => $request->payment_type,
            'transaction_id' => $request->transaction_id ?: null,
            'payment_photo'  => $photo_path,
            'enrolled_at'    => now(),
        ]);

        if ($request->payment_type === 'online') {
            $sslc = new SSLCommerz();
            $sslc->amount($amount)
                ->trxid(time() . Str::random(5))
                ->product('Live Course — ' . $course->title)
                ->customer(
                    $request->name,
                    auth()->user()->email ?? ($request->phone . '@guest.com'),
                    $request->phone,
                    $request->address
                );

            $sslc->value_a = $enrollment->slug;
            $sslc->value_b = $course->slug;

            $sslc->setUrl([
                route('live_course_ssl_success'),
                route('live_course_ssl_failure'),
                route('live_course_ssl_cancel'),
                route('live_course_ssl_ipn'),
            ]);

            return $sslc->make_payment();
        }

        // Offline: flash session and redirect to success page (WA button there)
        $raw_wa    = preg_replace('/\D/', '', setting('whatsapp') ?: setting('phone_numbers') ?: '');
        if ($raw_wa) {
            $wa_number = str_starts_with($raw_wa, '880') ? $raw_wa : ('880' . ltrim($raw_wa, '0'));
        } else {
            $wa_number = '';
        }

        $msg = 'ভর্তির আবেদন:' . "\n"
             . 'কোর্স: ' . $course->title . "\n"
             . 'ব্যাচ: ' . $batch->batch_number . ($batch->shift_name ? ' (' . $batch->shift_name . ')' : '') . "\n"
             . 'নাম: ' . $request->name . "\n"
             . 'মোবাইল: ' . $request->phone . "\n"
             . 'ঠিকানা: ' . $request->address . "\n"
             . 'লিঙ্গ: ' . $request->gender;

        if ($request->transaction_id) {
            $msg .= "\nট্রানজেকশন আইডি: " . $request->transaction_id;
        }

        session([
            'lce_success' => [
                'course_title' => $course->title,
                'batch_label'  => 'ব্যাচঃ ' . $batch->batch_number . ($batch->shift_name ? ' (' . $batch->shift_name . ')' : ''),
                'name'         => $request->name,
                'wa_url'       => 'https://api.whatsapp.com/send/?phone=' . $wa_number . '&text=' . urlencode($msg) . '&type=phone_number&app_absent=0',
                'paid_online'  => false,
            ],
        ]);

        return redirect()->route('live_course_enroll_success', $course->slug);
    }

    public function enroll_success($slug)
    {
        $course  = LiveCourse::active()->where('slug', $slug)->firstOrFail();
        $success = session('lce_success');

        if (!$success) {
            return redirect()->route('live_course_enroll', $slug);
        }

        return view('frontend.pages.live_courses.enroll_success', compact('course', 'success'));
    }

    // ── SSLCommerz callbacks for live course payments ──────────────────────

    public function ssl_success(Request $request)
    {
        $enrollment = LiveCourseEnrollment::where('slug', $request->value_a)->first();

        if (!$enrollment) {
            return redirect()->route('live_courses')->with('error', 'Enrollment not found.');
        }

        $course_slug = $request->value_b;

        if (SSLCommerz::validate_payment($request)) {
            $enrollment->update([
                'payment_status'  => 'paid',
                'amount_paid'     => $request->amount,
                'transaction_id'  => $request->tran_id,
                'payment_details' => $request->except('_token'),
            ]);

            $course = LiveCourse::where('slug', $course_slug)->first();
            $info   = $enrollment->student_info ?? [];

            session([
                'lce_success' => [
                    'course_title' => $course->title ?? '',
                    'batch_label'  => '',
                    'name'         => $info['name'] ?? '',
                    'wa_url'       => null,
                    'paid_online'  => true,
                    'tran_id'      => $request->tran_id,
                ],
            ]);

            return redirect()->route('live_course_enroll_success', $course_slug);
        }

        return redirect()->route('live_course_enroll', $course_slug)
            ->with('error', 'পেমেন্ট যাচাই ব্যর্থ হয়েছে। আবার চেষ্টা করুন।');
    }

    public function ssl_failure(Request $request)
    {
        return redirect()->route('live_course_enroll', $request->value_b ?? '')
            ->with('error', 'পেমেন্ট ব্যর্থ হয়েছে। আবার চেষ্টা করুন।');
    }

    public function ssl_cancel(Request $request)
    {
        return redirect()->route('live_course_enroll', $request->value_b ?? '')
            ->with('error', 'পেমেন্ট বাতিল হয়েছে।');
    }

    public function ssl_ipn(Request $request)
    {
        if ($request->tran_id && $request->value_a) {
            LiveCourseEnrollment::where('slug', $request->value_a)
                ->update([
                    'payment_status' => 'paid',
                    'amount_paid'    => $request->amount,
                    'transaction_id' => $request->tran_id,
                ]);
        }
    }
}
