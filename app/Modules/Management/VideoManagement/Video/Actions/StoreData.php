<?php

namespace App\Modules\Management\VideoManagement\Video\Actions;

class StoreData
{
    static $model = \App\Modules\Management\VideoManagement\Video\Models\Model::class;

    public static function execute($request)
    {
        try {
            $d = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $d['thumbnail'] = uploader($request->file('thumbnail'), 'uploads/Videos');
            }

            $item = self::$model::create([
                'title'       => $d['title'],
                'description' => $d['description'] ?? null,
                'youtube_url' => $d['youtube_url'],
                'thumbnail'   => $d['thumbnail'] ?? null,
                'sort_order'  => $d['sort_order'] ?? 0,
            ]);

            return messageResponse('Video added successfully', $item, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
