<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Modules\Management\VideoManagement\OurVideo\Models\Model as OurVideo;
use App\Modules\Management\VideoManagement\OurVideoCategory\Models\Model as OurVideoCategory;

class VideoController extends Controller
{
    public function index()
    {
        $categories = OurVideoCategory::active()
            ->orderBy('id', 'asc')
            ->get();

        $videos_by_category = [];
        foreach ($categories as $cat) {
            $videos_by_category[$cat->id] = OurVideo::active()
                ->where('video_category_id', $cat->id)
                ->orderBy('id', 'desc')
                ->get();
        }

        // Uncategorized / all
        $all_videos = OurVideo::active()->orderBy('id', 'desc')->get();

        return view('frontend.pages.video.index', compact('categories', 'videos_by_category', 'all_videos'));
    }
}
