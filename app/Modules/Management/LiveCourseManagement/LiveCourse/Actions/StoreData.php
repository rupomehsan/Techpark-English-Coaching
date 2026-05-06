<?php

namespace App\Modules\Management\LiveCourseManagement\LiveCourse\Actions;

class StoreData
{
    static $model = \App\Modules\Management\LiveCourseManagement\LiveCourse\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $requestData['thumbnail'] = uploader($thumbnail, 'uploads/live_course_management/live_course/thumbnails/');
            }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
