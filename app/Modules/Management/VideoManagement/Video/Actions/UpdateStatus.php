<?php

namespace App\Modules\Management\VideoManagement\Video\Actions;

class UpdateStatus
{
    static $model = \App\Modules\Management\VideoManagement\Video\Models\Model::class;

    public static function execute()
    {
        try {
            $data = self::$model::where('slug', request('slug'))->first();
            if (!$data) return messageResponse('Data not found', $data, 404, 'error');
            $data->status = $data->status === 'active' ? 'inactive' : 'active';
            $data->update();
            return messageResponse('Status updated', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
