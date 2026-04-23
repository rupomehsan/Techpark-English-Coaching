<?php

namespace App\Modules\Management\VideoManagement\Video\Actions;

class GetAllData
{
    static $model = \App\Modules\Management\VideoManagement\Video\Models\Model::class;

    public static function execute()
    {
        try {
            $pageLimit    = request()->input('limit') ?? 20;
            $orderByCol   = request()->input('sort_by_col') ?? 'sort_order';
            $orderByType  = request()->input('sort_type') ?? 'asc';
            $status       = request()->input('status') ?? 'active';

            $data = self::$model::query();

            if (request()->has('search') && request()->input('search')) {
                $s = request()->input('search');
                $data->where(function ($q) use ($s) {
                    $q->where('title', 'like', "%$s%")
                      ->orWhere('description', 'like', "%$s%");
                });
            }

            if ($status === 'trased') {
                $data = $data->trased()->orderBy($orderByCol, $orderByType)->paginate($pageLimit);
            } elseif (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                $data = $data->where('status', $status)->orderBy($orderByCol, $orderByType)->get();
                return entityResponse($data);
            } else {
                $data = $data->where('status', $status)->orderBy($orderByCol, $orderByType)->paginate($pageLimit);
            }

            return entityResponse([
                ...$data->toArray(),
                'active_data_count'   => self::$model::active()->count(),
                'inactive_data_count' => self::$model::inactive()->count(),
                'trased_data_count'   => self::$model::trased()->count(),
            ]);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
