<?php

namespace App\Modules\Management\VideoManagement\Video\Actions;

class SoftDelete
{
    static $model = \App\Modules\Management\VideoManagement\Video\Models\Model::class;

    public static function execute()
    {
        try {
            $data = self::$model::where('slug', request()->slug)->first();
            if (!$data) return messageResponse('Data not found', $data, 404, 'error');
            $data->delete();
            return messageResponse('Item soft deleted', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
