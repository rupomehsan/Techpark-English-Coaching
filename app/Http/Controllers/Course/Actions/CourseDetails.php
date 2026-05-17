<?php

namespace App\Http\Controllers\Course\Actions;


use App\Modules\Management\CourseManagement\Course\Models\Model as Course;
use  App\Modules\Management\EnrollInformation\Models\Model as EnrollInformation;
use App\Modules\Management\CourseManagement\Course\Models\WishlistModel;


class CourseDetails
{
    public static function execute($slug)
    {
        $data = Course::active()->where('slug', $slug)->withCount(['milestones', 'modules', 'classes', 'quizzes'])->first();
        $data->is_in_wishlist = self::is_in_wishlist($data->id);

        $instructors = $data->course_instructors()->get();

        $batch_details = $data->course_batch()
            ->where('course_id', $data->id)
            ->select(['*'])
            ->active()
            ->orderBy('id', 'DESC')
            ->first();

        $check_enrolled = false;
        if (auth()->check()) {
            $check_enrolled = EnrollInformation::where('student_id', auth()->user()->id)
                ->where('course_id', $data->id)->exists();
        }

        return view(
            'frontend.pages.courses.course_details',
            [
                'batch_details' => $batch_details,
                'data' => $data,
                'check_enrolled' => $check_enrolled,
                'instructors' => $instructors,
            ]
        );
    }

    public static function is_in_wishlist($courseId)
    {
        if (auth()->check()) {
            return WishlistModel::where('user_id', auth()->user()->id)->where('course_id', $courseId)->exists();
        }
        return false;
    }
}
