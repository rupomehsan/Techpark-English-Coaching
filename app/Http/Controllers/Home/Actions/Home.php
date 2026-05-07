<?php

namespace App\Http\Controllers\Home\Actions;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Modules\Management\SeminerManagement\Seminer\Models\Model as Seminars;
use App\Modules\Management\WebsiteManagement\WebsiteBrand\Models\Model as Brand;
use App\Modules\Management\WebsiteManagement\SubBanner\Models\Model as SubBanner;
use App\Modules\Management\WebsiteManagement\WebsiteBanner\Models\Model as Banner;
use App\Modules\Management\WebsiteManagement\OurTrainer\Models\Model as OurTrainer;
use App\Modules\Management\CourseManagement\CourseBatch\Models\Model as CourseBatches;
use App\Modules\Management\WebsiteManagement\SuccssStories\Models\Model as SuccessStory;
use App\Modules\Management\WebsiteManagement\OurSpeciality\Models\Model as OurSpeciality;
use App\Modules\Management\WebsiteManagement\AtAGlance\Models\Model as AtAGlance;
use App\Modules\Management\WebsiteManagement\WhyUs\Models\Model as WhyUs;
use App\Modules\Management\WebsiteManagement\OurService\Models\Model as OurService;
use App\Modules\Management\VideoManagement\OurVideo\Models\Model as OurVideo;
use App\Modules\Management\CourseManagement\CourseInstructors\Models\Model as CourseInstructor;
use App\Modules\Management\LiveCourseManagement\LiveCourse\Models\Model as LiveCourse;


class Home
{
    static $model = \App\Modules\Management\CommunicationManagement\ContactMessage\Models\Model::class;

    public static function execute($course)
    {
        $cacheKey = 'home_page_html_v1';
        // $ttlMinutes = 60; // cache time-to-live

        // if (Cache::has($cacheKey)) {
        //     $html = Cache::get($cacheKey);
        //     return response($html)->header('X-Cache-Status', 'HIT');
        // }

        $banners = Banner::where('is_featured', 1)->where('status', 1)->orderBy('id', 'desc')->get();
        $subBanners = SubBanner::where('status', 1)->orderBy('id', 'desc')->get();
        $our_speciality = OurSpeciality::where('status', 1)->orderBy('id', 'desc')->get();
        $success_stories = SuccessStory::active()->limit(6)->orderBy('id', 'desc')->get();
        $our_trainers = OurTrainer::where('status', 1)->orderBy('id', 'desc')->first();
        $seminars = Seminars::where('date_time', '>', Carbon::today())->where('status', 'active')->get();
        $brands = Brand::where('status', 1)->get();
        $courseBatch = CourseBatches::active()->orderBy('id', 'DESC')->get();

        // Task 1: At a Glance stats
        $at_a_glances = AtAGlance::active()->orderBy('id', 'asc')->get();

        // Task 2: Why Us (singleton record)
        $why_us = WhyUs::active()->first();

        // Task 3: Our Services
        $our_services = OurService::active()->orderBy('id', 'asc')->get();

        // Task 4: Our Videos (latest 4)
        $our_videos = OurVideo::active()->orderBy('id', 'desc')->take(4)->get();

        // Trainers from CourseInstructors
        $course_instructors = CourseInstructor::active()->orderBy('id', 'asc')->get();

        // Task 5: Featured seminar — today's first, else next upcoming
        $featured_seminar = Seminars::active()
            ->whereDate('date_time', Carbon::today())
            ->orderBy('date_time', 'asc')
            ->first();
        if (!$featured_seminar) {
            $featured_seminar = Seminars::active()
                ->where('date_time', '>', Carbon::now())
                ->orderBy('date_time', 'asc')
                ->first();
        }

        // Live Courses (home section)
        $live_courses = LiveCourse::active()
            ->orderBy('sort_order', 'asc')
            ->orderBy('is_popular', 'desc')
            ->limit(6)
            ->get();

        $courses = $course['courses'];
        $course_types = $course['course_types'];

        $data = [
            'banners' => $banners,
            'subBanners' => $subBanners,
            'our_speciality' => $our_speciality,
            'success_stories' => $success_stories,
            'our_trainers' => $our_trainers,
            'seminars' => $seminars,
            'featured_seminar' => $featured_seminar,
            'brands' => $brands,
            'courseBatches' => $courseBatch,
            'courses' => $courses,
            'course_types' => $course_types,
            'at_a_glances' => $at_a_glances,
            'why_us' => $why_us,
            'our_services' => $our_services,
            'our_videos' => $our_videos,
            'course_instructors' => $course_instructors,
            'live_courses' => $live_courses,
        ];


        // $html = view('frontend.pages.home.home', $data)->render();
        // Cache::put($cacheKey, $html, now()->addMinutes($ttlMinutes));

        // return response($html)->header('X-Cache-Status', 'MISS');
        Cache::forget($cacheKey);

        return view('frontend.pages.home.home', $data);
    }
}
