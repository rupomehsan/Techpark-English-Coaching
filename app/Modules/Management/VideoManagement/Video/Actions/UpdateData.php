<?php

namespace App\Modules\Management\VideoManagement\Video\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\VideoManagement\Video\Models\Model::class;

    public static function execute($request, $slug)
    {
        try {
            $data = self::$model::where('slug', $slug)->first();
            if (!$data) return messageResponse('Data not found', $data, 404, 'error');

            $d = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $d['thumbnail'] = uploader($request->file('thumbnail'), 'uploads/Videos');
            }

            $data->update($d);
            return messageResponse('Video updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
