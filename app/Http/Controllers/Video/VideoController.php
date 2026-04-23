<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Modules\Management\VideoManagement\Video\Models\Model as Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::active()
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.pages.video.index', compact('videos'));
    }
}
