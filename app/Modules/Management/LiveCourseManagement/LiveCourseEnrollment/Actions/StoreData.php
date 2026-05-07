<?php

namespace App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Actions;

class StoreData
{
    static $model = \App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();




                if ($request->hasFile('payment_photo')) {
                    $payment_photo = $request->file('payment_photo');
                    $requestData['payment_photo'] = uploader($payment_photo, 'uploads/payment_photos');
                }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}
