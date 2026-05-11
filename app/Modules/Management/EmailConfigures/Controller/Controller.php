<?php

namespace App\Modules\Management\EmailConfigures\Controller;
use App\Modules\Management\EmailConfigures\Actions\GetAllData;
use App\Modules\Management\EmailConfigures\Actions\DestroyData;
use App\Modules\Management\EmailConfigures\Actions\GetSingleData;
use App\Modules\Management\EmailConfigures\Actions\StoreData;
use App\Modules\Management\EmailConfigures\Actions\UpdateData;
use App\Modules\Management\EmailConfigures\Actions\UpdateStatus;
use App\Modules\Management\EmailConfigures\Actions\SoftDelete;
use App\Modules\Management\EmailConfigures\Actions\RestoreData;
use App\Modules\Management\EmailConfigures\Actions\ImportData;
use App\Modules\Management\EmailConfigures\Validations\BulkActionsValidation;
use App\Modules\Management\EmailConfigures\Validations\DataStoreValidation;
use App\Modules\Management\EmailConfigures\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class Controller extends ControllersController
{

    public function index( ){

        $data = GetAllData::execute();
        return $data;
    }

    public function store(DataStoreValidation $request)
    {
        $data = StoreData::execute($request);
        return $data;
    }

    public function show($slug)
    {
        $data = GetSingleData::execute($slug);
        return $data;
    }

    public function update(DataStoreValidation $request, $slug)
    {
        $data = UpdateData::execute($request, $slug);
        return $data;
    }
         public function updateStatus()
    {
        $data = UpdateStatus::execute();
        return $data;
    }

    public function softDelete()
    {
        $data = SoftDelete::execute();
        return $data;
    }
    public function destroy($slug)
    {
        $data = DestroyData::execute($slug);
        return $data;
    }
    public function restore()
    {
        $data = RestoreData::execute();
        return $data;
    }
    public function import()
    {
        $data = ImportData::execute();
        return $data;
    }
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }

    public function testEmail(Request $request)
    {
        $to = $request->input('to');
        if (!$to) {
            return messageResponse('Recipient email is required.', [], 422, 'error');
        }
        try {
            Mail::raw('This is a test email from TechPark English. Your SMTP configuration is working correctly.', function ($msg) use ($to) {
                $msg->to($to)->subject('TechPark English — SMTP Test');
            });
            return messageResponse('Test email sent successfully! Check your inbox.', [], 200);
        } catch (\Exception $e) {
            return messageResponse('Failed to send: ' . $e->getMessage(), [], 500, 'error');
        }
    }

}