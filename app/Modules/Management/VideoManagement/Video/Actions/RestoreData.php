<?php

namespace App\Modules\Management\VideoManagement\Video\Actions;

class RestoreData
{
    static $model = \App\Modules\Management\VideoManagement\Video\Models\Model::class;

    public static function execute()
    {
        try {
            $data = self::$model::onlyTrashed()->where('slug', request()->slug)->first();
            if (!$data) return messageResponse('Data not found', $data, 404, 'error');
            $data->restore();
            return messageResponse('Item restored', $data, 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
