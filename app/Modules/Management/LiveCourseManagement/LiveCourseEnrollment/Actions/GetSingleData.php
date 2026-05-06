<?php

namespace App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Actions;



class GetSingleData
{
    static $model = \App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Models\Model::class;

    public static function execute($slug)
    {
        try {
                             $with = ['student_id', 'batch_id', 'live_course_id'];

            $fields = request()->input('fields') ?? ['*'];
            if (!$data = self::$model::query()->with($with)->select($fields)->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
