<?php

namespace App\Modules\Management\VideoManagement\Video\Actions;

class GetSingleData
{
    static $model = \App\Modules\Management\VideoManagement\Video\Models\Model::class;

    public static function execute($slug)
    {
        try {
            $fields = request()->input('fields') ?? ['*'];
            $data = self::$model::query()->select($fields)->where('slug', $slug)->first();
            if (!$data) return messageResponse('Data not found', $data, 404, 'error');
            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
