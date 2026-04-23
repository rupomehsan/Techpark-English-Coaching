<?php

namespace App\Modules\Management\VideoManagement\Video\Actions;

class DestroyData
{
    static $model = \App\Modules\Management\VideoManagement\Video\Models\Model::class;

    public static function execute($slug)
    {
        try {
            $data = self::$model::where('slug', $slug)->first();
            if (!$data) return messageResponse('Data not found', $data, 404, 'error');
            $data->forceDelete();
            return messageResponse('Item deleted', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
