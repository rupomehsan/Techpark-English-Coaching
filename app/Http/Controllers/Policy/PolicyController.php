<?php

namespace App\Http\Controllers\Policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Management\WebsiteManagement\CookiePolicy\Models\Model as CookiePolicy;
use App\Modules\Management\WebsiteManagement\RefundPolicy\Models\Model as RefundPolicy;
use App\Modules\Management\WebsiteManagement\TermConditionPolicy\Models\Model as TermConditionPolicy;
use App\Modules\Management\WebsiteManagement\PrivacyPolicy\Models\Model as PrivacyPolicy;
use App\Modules\Management\CourseManagement\Course\Models\Model as Course;
use App\Modules\Management\CourseManagement\CourseCategory\Models\Model as CourseCategory;
use App\Modules\Management\LiveCourseManagement\LiveCourse\Models\Model as LiveCourse;
use App\Modules\Management\BlogManagement\Blog\Models\Model as Blog;
use App\Modules\Management\BlogManagement\BlogCategory\Models\Model as BlogCategory;
use App\Modules\Management\SeminerManagement\Seminer\Models\Model as Seminar;

class PolicyController extends Controller
{
    public function privacy_policy()
    {
        $website_about = PrivacyPolicy::where('status', 1)->first();
        return view('frontend.pages.extra.privacy_policy', compact('website_about'));
    }

    public function refund_policy()
    {
        $website_about = RefundPolicy::where('status', 1)->first();
        return view('frontend.pages.extra.refund_policy', compact('website_about'));
    }

    public function terms_policy()
    {
        $website_about = TermConditionPolicy::where('status', 1)->first();
        return view('frontend.pages.extra.terms_policy', compact('website_about'));
    }

    public function cookies_policy()
    {
        $website_about = CookiePolicy::where('status', 1)->first();
        return view('frontend.pages.extra.cookies_policy', compact('website_about'));
    }

    public function sitemap()
    {
        $courses         = Course::where('status', 'active')->get(['id', 'title', 'slug']);
        $course_cats     = CourseCategory::where('status', 'active')->get(['id', 'title', 'slug']);
        $live_courses    = LiveCourse::where('status', 'active')->get(['id', 'title', 'slug']);
        $blogs           = Blog::where('status', 'active')->latest()->get(['id', 'title', 'slug']);
        $blog_cats       = BlogCategory::get(['id', 'title', 'slug']);
        $seminars        = Seminar::latest()->get(['id', 'title']);

        return view('frontend.pages.extra.sitemap', compact(
            'courses', 'course_cats', 'live_courses', 'blogs', 'blog_cats', 'seminars'
        ));
    }
}
