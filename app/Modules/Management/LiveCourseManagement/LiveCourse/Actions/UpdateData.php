<?php

namespace App\Modules\Management\LiveCourseManagement\LiveCourse\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\LiveCourseManagement\LiveCourse\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();
                if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $requestData['thumbnail'] = uploader($thumbnail, 'uploads/live_course_management/live_course/thumbnails/');
            }
            $data->update($requestData);
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
