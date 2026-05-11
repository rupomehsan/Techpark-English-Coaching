@php
    $meta = [
        'seo' => [
            'title' => 'Sitemap — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)
@push('styles')
<style>
    .sm-hero {
        background: linear-gradient(135deg, #001830, #002147, #003b7a);
        padding: 60px 0 50px;
        position: relative; overflow: hidden;
    }
    .sm-hero::after {
        content: ''; position: absolute;
        top: -100px; right: -80px;
        width: 400px; height: 400px;
        background: rgba(250,176,5,0.06); border-radius: 50%;
        pointer-events: none;
    }
    .sm-badge {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(250,176,5,0.12); border: 1px solid rgba(250,176,5,0.3);
        color: #fab005; font-size: 0.72rem; font-weight: 800;
        padding: 5px 16px; border-radius: 50px; letter-spacing: 1px;
        text-transform: uppercase; margin-bottom: 16px;
    }
    .sm-badge span { width: 7px; height: 7px; background: #fab005; border-radius: 50%; }
    .sm-hero h1 { color: #fff; font-size: clamp(1.8rem, 3vw, 2.6rem); font-weight: 800; margin-bottom: 10px; }
    .sm-hero p  { color: rgba(255,255,255,0.55); font-size: 0.92rem; margin: 0; }

    .sm-section { padding: 70px 0 80px; background: #f8faff; }
    .sm-group-label {
        display: flex; align-items: center; gap: 10px;
        font-size: 0.7rem; font-weight: 800; letter-spacing: 1.5px;
        text-transform: uppercase; color: #002147; margin-bottom: 24px;
    }
    .sm-group-label::after {
        content: ''; flex: 1; height: 1px;
        background: linear-gradient(90deg, #d4dff5, transparent);
    }
    .sm-card {
        background: #fff; border-radius: 16px;
        border: 1px solid #e8eef8;
        box-shadow: 0 2px 16px rgba(0,31,80,0.05);
        padding: 26px 26px 22px;
        height: 100%;
    }
    .sm-card-title {
        display: flex; align-items: center; gap: 10px;
        font-size: 0.88rem; font-weight: 800; color: #002147;
        margin-bottom: 16px; padding-bottom: 12px;
        border-bottom: 2px solid #f0f4fb;
    }
    .sm-card-title .sm-icon {
        width: 34px; height: 34px; border-radius: 9px;
        background: linear-gradient(135deg, #002147, #003b7a);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sm-card-title .sm-icon i { color: #fab005; font-size: 0.78rem; }
    .sm-card ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 2px; }
    .sm-card ul li a {
        display: flex; align-items: center; gap: 8px;
        font-size: 0.82rem; color: #4a5a7a; text-decoration: none;
        padding: 7px 10px; border-radius: 8px;
        transition: background 0.2s, color 0.2s, padding-left 0.2s;
    }
    .sm-card ul li a:hover {
        background: #f0f5ff; color: #002147; padding-left: 14px;
    }
    .sm-card ul li a i {
        color: #fab005; font-size: 0.6rem; flex-shrink: 0;
    }
    .sm-card ul li.empty {
        font-size: 0.78rem; color: #aab0bc; padding: 6px 10px; font-style: italic;
    }

    .sm-student {
        background: linear-gradient(135deg, #001830, #002147);
        border-radius: 20px; padding: 36px 32px; margin-top: 50px;
    }
    .sm-student-title {
        color: #fff; font-size: 1rem; font-weight: 800; margin-bottom: 24px;
        display: flex; align-items: center; gap: 10px;
    }
    .sm-student-title i { color: #fab005; }
    .sm-student .sm-card {
        background: rgba(255,255,255,0.05);
        border-color: rgba(255,255,255,0.08);
        box-shadow: none;
    }
    .sm-student .sm-card-title { color: #e2e8f0; border-bottom-color: rgba(255,255,255,0.08); }
    .sm-student .sm-card-title .sm-icon { background: rgba(250,176,5,0.2); }
    .sm-student .sm-card ul li a { color: rgba(255,255,255,0.6); }
    .sm-student .sm-card ul li a:hover { background: rgba(255,255,255,0.07); color: #fff; }
    .sm-student .sm-card ul li.empty { color: rgba(255,255,255,0.3); }
</style>
@endpush
@section('contents')

{{-- Hero --}}
<section class="sm-hero">
    <div class="container" style="position:relative;z-index:1;">
        <div class="sm-badge"><span></span> Navigation</div>
        <h1>সাইটম্যাপ</h1>
        <p>TechPark English-এর সকল পেজের তালিকা</p>
    </div>
</section>

<section class="sm-section">
    <div class="container">

        {{-- Main Site --}}
        <div class="sm-group-label"><i class="fa-solid fa-globe"></i> মূল সাইট</div>
        <div class="row g-4 mb-4">

            {{-- Main Pages --}}
            <div class="col-lg-3 col-md-6">
                <div class="sm-card">
                    <div class="sm-card-title">
                        <div class="sm-icon"><i class="fa-solid fa-house"></i></div>
                        প্রধান পেজ
                    </div>
                    <ul>
                        <li><a href="{{ route('website') }}"><i class="fa-solid fa-chevron-right"></i> হোম</a></li>
                        <li><a href="{{ route('about') }}"><i class="fa-solid fa-chevron-right"></i> আমাদের সম্পর্কে</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fa-solid fa-chevron-right"></i> যোগাযোগ</a></li>
                        <li><a href="{{ route('gallery') }}"><i class="fa-solid fa-chevron-right"></i> গ্যালারি</a></li>
                        <li><a href="{{ route('videos') }}"><i class="fa-solid fa-chevron-right"></i> ভিডিও গ্যালারি</a></li>
                        <li><a href="{{ route('trainer.details') }}"><i class="fa-solid fa-chevron-right"></i> ট্রেইনারস</a></li>
                        <li><a href="{{ route('stories') }}"><i class="fa-solid fa-chevron-right"></i> সাফল্যের গল্প</a></li>
                        <li><a href="{{ route('seminar') }}"><i class="fa-solid fa-chevron-right"></i> ফ্রি সেমিনার</a></li>
                    </ul>
                </div>
            </div>

            {{-- Recorded Courses --}}
            <div class="col-lg-3 col-md-6">
                <div class="sm-card">
                    <div class="sm-card-title">
                        <div class="sm-icon"><i class="fa-solid fa-video"></i></div>
                        রেকর্ডেড কোর্স
                    </div>
                    <ul>
                        <li><a href="{{ route('courses') }}"><i class="fa-solid fa-chevron-right"></i> সকল কোর্স</a></li>
                        @foreach($course_cats as $cat)
                        <li><a href="{{ route('courses') }}?slug={{ $cat->slug }}"><i class="fa-solid fa-chevron-right"></i> {{ $cat->title }}</a></li>
                        @endforeach
                        @forelse($courses as $course)
                        <li><a href="{{ route('course_details', $course->slug) }}"><i class="fa-solid fa-chevron-right"></i> {{ $course->title }}</a></li>
                        @empty
                        <li class="empty">কোনো কোর্স নেই</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Live Courses --}}
            <div class="col-lg-3 col-md-6">
                <div class="sm-card">
                    <div class="sm-card-title">
                        <div class="sm-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        লাইভ কোর্স
                    </div>
                    <ul>
                        <li><a href="{{ route('live_courses') }}"><i class="fa-solid fa-chevron-right"></i> সকল লাইভ কোর্স</a></li>
                        @forelse($live_courses as $lc)
                        <li><a href="{{ route('live_course_details', $lc->slug) }}"><i class="fa-solid fa-chevron-right"></i> {{ $lc->title }}</a></li>
                        @empty
                        <li class="empty">কোনো লাইভ কোর্স নেই</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Blog --}}
            <div class="col-lg-3 col-md-6">
                <div class="sm-card">
                    <div class="sm-card-title">
                        <div class="sm-icon"><i class="fa-solid fa-blog"></i></div>
                        ব্লগ
                    </div>
                    <ul>
                        <li><a href="{{ route('blog') }}"><i class="fa-solid fa-chevron-right"></i> সকল ব্লগ</a></li>
                        @foreach($blog_cats as $cat)
                        <li><a href="{{ route('blog') }}?category={{ $cat->slug }}"><i class="fa-solid fa-chevron-right"></i> {{ $cat->title }}</a></li>
                        @endforeach
                        @forelse($blogs->take(6) as $blog)
                        <li><a href="{{ route('blog_details', $blog->slug) }}"><i class="fa-solid fa-chevron-right"></i> {{ \Illuminate\Support\Str::limit($blog->title, 40) }}</a></li>
                        @empty
                        <li class="empty">কোনো ব্লগ নেই</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>

        {{-- Policy / Seminar row --}}
        <div class="row g-4 mb-4">
            {{-- Seminars --}}
            <div class="col-lg-3 col-md-6">
                <div class="sm-card">
                    <div class="sm-card-title">
                        <div class="sm-icon"><i class="fa-solid fa-calendar-days"></i></div>
                        সেমিনার
                    </div>
                    <ul>
                        <li><a href="{{ route('seminar') }}"><i class="fa-solid fa-chevron-right"></i> সকল সেমিনার</a></li>
                        @forelse($seminars->take(5) as $sem)
                        <li><a href="{{ route('seminar.details', $sem->id) }}"><i class="fa-solid fa-chevron-right"></i> {{ \Illuminate\Support\Str::limit($sem->title, 40) }}</a></li>
                        @empty
                        <li class="empty">কোনো সেমিনার নেই</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Policies --}}
            <div class="col-lg-3 col-md-6">
                <div class="sm-card">
                    <div class="sm-card-title">
                        <div class="sm-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        পলিসি
                    </div>
                    <ul>
                        <li><a href="{{ route('privacy.policy') }}"><i class="fa-solid fa-chevron-right"></i> প্রাইভেসি পলিসি</a></li>
                        <li><a href="{{ route('refund.policy') }}"><i class="fa-solid fa-chevron-right"></i> রিফান্ড পলিসি</a></li>
                        <li><a href="{{ route('terms.policy') }}"><i class="fa-solid fa-chevron-right"></i> টার্মস এন্ড কন্ডিশন</a></li>
                        <li><a href="{{ route('cookies.policy') }}"><i class="fa-solid fa-chevron-right"></i> কুকিস পলিসি</a></li>
                    </ul>
                </div>
            </div>

            {{-- Auth --}}
            <div class="col-lg-3 col-md-6">
                <div class="sm-card">
                    <div class="sm-card-title">
                        <div class="sm-icon"><i class="fa-solid fa-user-lock"></i></div>
                        অ্যাকাউন্ট
                    </div>
                    <ul>
                        <li><a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right"></i> লগইন</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa-solid fa-chevron-right"></i> রেজিস্ট্রেশন</a></li>
                        <li><a href="{{ route('forgot.password') }}"><i class="fa-solid fa-chevron-right"></i> পাসওয়ার্ড ভুলে গেছেন</a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Student Panel --}}
        <div class="sm-student">
            <div class="sm-student-title">
                <i class="fa-solid fa-graduation-cap"></i> স্টুডেন্ট প্যানেল
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="sm-card">
                        <div class="sm-card-title">
                            <div class="sm-icon"><i class="fa-solid fa-house"></i></div>
                            ড্যাশবোর্ড
                        </div>
                        <ul>
                            <li><a href="{{ route('myCourse') }}"><i class="fa-solid fa-chevron-right"></i> আমার কোর্সসমূহ</a></li>
                            <li><a href="{{ route('myLiveCourses') }}"><i class="fa-solid fa-chevron-right"></i> লাইভ কোর্সসমূহ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="sm-card">
                        <div class="sm-card-title">
                            <div class="sm-icon"><i class="fa-solid fa-user-gear"></i></div>
                            প্রোফাইল সেটিংস
                        </div>
                        <ul>
                            <li><a href="{{ route('profile') }}"><i class="fa-solid fa-chevron-right"></i> প্রোফাইল সম্পাদনা</a></li>
                            <li><a href="{{ route('profile') }}"><i class="fa-solid fa-chevron-right"></i> পাসওয়ার্ড পরিবর্তন</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
