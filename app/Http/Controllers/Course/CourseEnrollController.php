<?php

namespace App\Http\Controllers\Course;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Gateways\SSLCommerz\SSLCommerz;
use App\Modules\Management\CourseManagement\Course\Models\Model as Course;
use App\Modules\Management\CourseManagement\CourseBatchStudent\Models\Model as CourseBatchStudent;

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
            ->select('id', 'slug', 'title')
            ->firstOrFail();

        $controller   = new CourseController();
        $data         = $controller->course_batch_details($course->id);
        $batch        = $data['batch'] ?? null;

        if (!$batch) {
            return redirect()->route('course_details', $slug)
                ->with('error', 'No active batch available for this course.');
        }

        // Already enrolled → send to my-course
        $alreadyEnrolled = CourseBatchStudent::where('student_id', auth()->id())
            ->where('batch_id', $batch->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->route('mycourse_details', $slug)
                ->with('info', 'You are already enrolled in this course!');
        }

        $user  = auth()->user();
        $total = round($batch->after_discount_price ?: ($batch->course_price ?? 0));

        $sslc = new SSLCommerz();
        $sslc->amount($total)
             ->trxid(time() . Str::random(6))
             ->product($course->title)
             ->customer(
                 trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')),
                 $user->email ?? ''
             );

        // value_a = course slug, value_b = batch id (read back in PaymentController::success)
        $sslc->value_a = $course->slug;
        $sslc->value_b = $batch->id;

        return $sslc->make_payment();
    }

    // Legacy enroll page — kept for backward compat, now just redirects to course detail
    public function course_enroll($slug)
    {
        return redirect()->route('course_details', $slug);
    }
}
