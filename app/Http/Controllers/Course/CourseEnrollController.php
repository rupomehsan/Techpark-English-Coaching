<?php

namespace App\Http\Controllers\Course;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Gateways\SSLCommerz\SSLCommerz;
use App\Modules\Management\CourseManagement\Course\Models\Model as Course;
use App\Modules\Management\EnrollInformation\Models\Model as EnrollInformation;

class CourseEnrollController extends Controller
{
    /**
     * Directly initiate SSL payment for a course — no intermediate form.
     * Route must be protected by auth middleware.
     */
    public function checkout($slug)
    {
        $course = Course::active()
            ->where('slug', $slug)
            ->select('id', 'slug', 'title', 'regular_price', 'sales_price')
            ->firstOrFail();

        // Already enrolled → send to my-course
        $alreadyEnrolled = EnrollInformation::where('student_id', auth()->id())
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->route('mycourse_details', $slug)
                ->with('info', 'You are already enrolled in this course!');
        }

        $user  = auth()->user();
        $orig  = $course->regular_price ?? 0;
        $disc  = $course->sales_price ?? 0;
        $total = round($disc > 0 && $disc < $orig ? $disc : $orig);

        $sslc = new SSLCommerz();
        $sslc->amount($total)
             ->trxid(time() . Str::random(6))
             ->product($course->title)
             ->customer(
                 trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')),
                 $user->email ?? ''
             );

        // value_a = course slug (read back in PaymentController::success)
        $sslc->value_a = $course->slug;

        return $sslc->make_payment();
    }

    // Legacy enroll page — kept for backward compat, now just redirects to course detail
    public function course_enroll($slug)
    {
        return redirect()->route('course_details', $slug);
    }
}
