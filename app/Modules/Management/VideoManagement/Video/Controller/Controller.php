<?php

namespace App\Modules\Management\VideoManagement\Video\Controller;

use App\Http\Controllers\Controller as BaseController;
use App\Modules\Management\VideoManagement\Video\Actions\GetAllData;
use App\Modules\Management\VideoManagement\Video\Actions\GetSingleData;
use App\Modules\Management\VideoManagement\Video\Actions\StoreData;
use App\Modules\Management\VideoManagement\Video\Actions\UpdateData;
use App\Modules\Management\VideoManagement\Video\Actions\UpdateStatus;
use App\Modules\Management\VideoManagement\Video\Actions\SoftDelete;
use App\Modules\Management\VideoManagement\Video\Actions\DestroyData;
use App\Modules\Management\VideoManagement\Video\Actions\RestoreData;
use App\Modules\Management\VideoManagement\Video\Validations\DataStoreValidation;

class Controller extends BaseController
{
    public function index()        { return GetAllData::execute(); }
    public function store(DataStoreValidation $request) { return StoreData::execute($request); }
    public function show($slug)    { return GetSingleData::execute($slug); }
    public function update(DataStoreValidation $request, $slug) { return UpdateData::execute($request, $slug); }
    public function updateStatus() { return UpdateStatus::execute(); }
    public function softDelete()   { return SoftDelete::execute(); }
    public function destroy($slug) { return DestroyData::execute($slug); }
    public function restore()      { return RestoreData::execute(); }
}
