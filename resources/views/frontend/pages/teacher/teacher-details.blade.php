@php
    $meta = [
        'seo' => [
            'title' => ($teacher->full_name ?? 'Trainer') . ' — TechPark English',
            'image' => $teacher->image ? assetHelper($teacher->image) : asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ── Banner ── */
.td-banner {
    position: relative;
    height: clamp(200px, 26vw, 380px);
    overflow: hidden;
    background: linear-gradient(135deg, #001830 0%, #002e62 60%, #003b7a 100%);
}
.td-banner img {
    width: 100%; height: 100%; object-fit: cover; display: block;
    opacity: 0.55; transition: transform 8s ease;
}
.td-banner:hover img { transform: scale(1.04); }
.td-banner-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,24,56,0.1) 0%, rgba(0,24,56,0.65) 100%);
}

/* ── Profile card ── */
.td-profile-band {
    background: #fff;
    border-bottom: 1px solid #eef2f8;
    box-shadow: 0 4px 24px rgba(0,33,71,0.07);
}
.td-profile-inner {
    display: flex; align-items: flex-end; gap: 26px; flex-wrap: wrap;
    padding-bottom: 28px;
}
.td-has-banner .td-profile-inner { margin-top: -70px; }
.td-no-banner  .td-profile-inner { padding-top: 36px; }
.td-avatar {
    width: 140px; height: 140px; border-radius: 18px;
    object-fit: cover; flex-shrink: 0;
    border: 4px solid #fff;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
}
.td-no-banner .td-avatar { border-radius: 50%; }

.td-profile-meta { flex: 1; min-width: 200px; }
.td-has-banner .td-profile-meta { padding-top: 76px; }
.td-name {
    font-size: clamp(1.5rem, 3vw, 2.1rem);
    font-weight: 800; color: #002147; line-height: 1.2; margin-bottom: 6px;
}
.td-desig {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(250,176,5,0.12); color: #b87800;
    border: 1px solid rgba(250,176,5,0.3);
    border-radius: 50px; padding: 5px 14px;
    font-size: 0.82rem; font-weight: 700; margin-bottom: 14px;
}
.td-social { display: flex; gap: 8px; flex-wrap: wrap; }
.td-social a {
    width: 38px; height: 38px; border-radius: 10px;
    background: #f0f4f8; display: flex; align-items: center; justify-content: center;
    color: #002147; font-size: 0.88rem; text-decoration: none; transition: all 0.22s;
    border: 1.5px solid #e4eaf4;
}
.td-social a:hover { background: #002147; color: #fab005; border-color: #002147; transform: translateY(-2px); }

/* ── Body layout ── */
.td-body { background: #f4f7fb; padding: 40px 0 64px; }

/* ── Stat pills ── */
.td-stats-row {
    display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 28px;
}
.td-stat-pill {
    display: flex; align-items: center; gap: 10px;
    background: #fff; border-radius: 12px; padding: 13px 18px;
    box-shadow: 0 2px 12px rgba(0,33,71,0.05); border: 1px solid #eef2f8;
    flex: 1; min-width: 160px;
}
.td-stat-pill-icon {
    width: 40px; height: 40px; border-radius: 10px;
    background: rgba(0,33,71,0.07); display: flex; align-items: center; justify-content: center;
    color: #002147; font-size: 1rem; flex-shrink: 0;
}
.td-stat-pill-label { font-size: 0.67rem; font-weight: 700; color: #aaa; text-transform: uppercase; letter-spacing: 0.8px; }
.td-stat-pill-value { font-size: 0.9rem; font-weight: 700; color: #2d3748; }

/* ── Cards ── */
.td-card {
    background: #fff; border-radius: 18px; padding: 28px 30px; margin-bottom: 22px;
    box-shadow: 0 2px 16px rgba(0,33,71,0.05); border: 1px solid #eef2f8;
}
.td-card-label {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
    color: #003d82; background: rgba(0,61,130,0.07);
    border: 1px solid rgba(0,61,130,0.15);
    padding: 5px 14px; border-radius: 50px; margin-bottom: 18px;
}
.td-desc-body { color: #4a5568; line-height: 1.88; font-size: 0.93rem; }

/* ── Course cards ── */
.td-course-card {
    background: #fff; border-radius: 14px; overflow: hidden;
    box-shadow: 0 2px 14px rgba(0,33,71,0.06); border: 1px solid #eef2f8;
    transition: all 0.3s;
}
.td-course-card:hover { transform: translateY(-5px); box-shadow: 0 14px 38px rgba(0,33,71,0.11); border-color: transparent; }
.td-course-card img { width: 100%; height: 155px; object-fit: cover; display: block; }
.td-course-body { padding: 14px 16px 18px; }
.td-course-title { font-weight: 700; color: #002147; font-size: 0.9rem; margin-bottom: 4px; line-height: 1.4; }
.td-course-meta { font-size: 0.75rem; color: #999; display: flex; align-items: center; gap: 5px; }

/* ── Sidebar ── */
.td-sidebar-card {
    background: #fff; border-radius: 18px; overflow: hidden;
    box-shadow: 0 2px 16px rgba(0,33,71,0.05); border: 1px solid #eef2f8;
    margin-bottom: 22px;
}
.td-sidebar-header {
    background: linear-gradient(135deg, #002147, #003d82);
    color: #fff; padding: 16px 22px;
    font-weight: 800; font-size: 0.92rem;
    display: flex; align-items: center; gap: 8px;
}
.td-sidebar-body { padding: 20px 22px; }
.td-contact-row {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 0; border-bottom: 1px solid #f0f4f8;
}
.td-contact-row:last-child { border-bottom: none; padding-bottom: 0; }
.td-contact-icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: rgba(250,176,5,0.1); display: flex; align-items: center; justify-content: center;
    color: #fab005; font-size: 0.88rem; flex-shrink: 0;
}
.td-contact-label { font-size: 0.68rem; color: #aaa; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; }
.td-contact-value { font-size: 0.86rem; font-weight: 600; color: #2d3748; word-break: break-all; }

/* ── Back btn ── */
.btn-td-back {
    display: inline-flex; align-items: center; gap: 7px;
    background: transparent; color: #6c757d;
    border: 1.5px solid #dee2e9; border-radius: 50px;
    padding: 9px 20px; font-size: 0.82rem; font-weight: 600;
    text-decoration: none; transition: all 0.25s; margin-bottom: 24px;
}
.btn-td-back:hover { border-color: #002147; color: #002147; background: #f4f7fb; }

@media (max-width: 575px) {
    .td-avatar { width: 100px; height: 100px; }
    .td-card { padding: 20px; }
    .td-stats-row { gap: 8px; }
    .td-stat-pill { min-width: 130px; }
}
</style>
@endpush

@section('contents')

@php $hasBanner = !empty($teacher->cover_photo); @endphp

{{-- Banner — only if cover_photo exists --}}
@if($hasBanner)
<div class="td-banner">
    <img src="{{ assetHelper($teacher->cover_photo) }}" alt="{{ $teacher->full_name }}" loading="lazy">
    <div class="td-banner-overlay"></div>
</div>
@endif

{{-- Profile Band --}}
<div class="td-profile-band {{ $hasBanner ? 'td-has-banner' : 'td-no-banner' }}">
    <div class="container">
        <div class="td-profile-inner">
            <img class="td-avatar"
                 src="{{ assetHelper(optional($teacher)->image) }}"
                 alt="{{ $teacher->full_name }}"
                 loading="lazy"
                 onerror="this.src='/avatar.png'">

            <div class="td-profile-meta">
                <h1 class="td-name">{{ $teacher->full_name }}</h1>
                @if($teacher->designation)
                    <div class="td-desig"><i class="fa-solid fa-award"></i>{{ $teacher->designation }}</div>
                @endif
                <div class="td-social">
                    @if($teacher->facebook)  <a href="{{ $teacher->facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>  @endif
                    @if($teacher->linkedin)  <a href="{{ $teacher->linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>  @endif
                    @if($teacher->twitter)   <a href="{{ $teacher->twitter }}"  target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>       @endif
                    @if($teacher->instagram) <a href="{{ $teacher->instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a> @endif
                </div>
            </div>

            {{-- Stats pills in profile band --}}
            @php $courseCount = $teacher->courses ? $teacher->courses->count() : 0; @endphp
            <div class="ms-auto d-none d-lg-flex gap-3">
                @if($courseCount > 0)
                <div style="text-align:center; background:#f8fbff; border-radius:16px; padding:14px 24px; border:1.5px solid #eaf0fa;">
                    <div style="font-size:1.8rem; font-weight:800; color:#002147; line-height:1;">{{ $courseCount }}</div>
                    <div style="font-size:0.72rem; color:#aaa; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; margin-top:3px;">কোর্স</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Body --}}
<div class="td-body">
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn-td-back">
            <i class="fa-solid fa-arrow-left"></i> ফিরে যান
        </a>

        <div class="row g-4">
            {{-- Main --}}
            <div class="col-lg-8">

                {{-- Contact / meta stat pills --}}
                <div class="td-stats-row">
                    @if($teacher->designation)
                    <div class="td-stat-pill">
                        <div class="td-stat-pill-icon"><i class="fa-solid fa-briefcase"></i></div>
                        <div>
                            <div class="td-stat-pill-label">পদবি</div>
                            <div class="td-stat-pill-value">{{ $teacher->designation }}</div>
                        </div>
                    </div>
                    @endif
                    @if($teacher->email)
                    <div class="td-stat-pill">
                        <div class="td-stat-pill-icon"><i class="fa-regular fa-envelope"></i></div>
                        <div>
                            <div class="td-stat-pill-label">ইমেইল</div>
                            <div class="td-stat-pill-value">{{ $teacher->email }}</div>
                        </div>
                    </div>
                    @endif
                    @if($teacher->phone)
                    <div class="td-stat-pill">
                        <div class="td-stat-pill-icon"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <div class="td-stat-pill-label">ফোন</div>
                            <div class="td-stat-pill-value">{{ $teacher->phone }}</div>
                        </div>
                    </div>
                    @endif
                    @if($courseCount > 0)
                    <div class="td-stat-pill">
                        <div class="td-stat-pill-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div>
                            <div class="td-stat-pill-label">কোর্স</div>
                            <div class="td-stat-pill-value">{{ $courseCount }}টি কোর্স</div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Short description --}}
                @if($teacher->short_description)
                <div class="td-card">
                    <div class="td-card-label"><i class="fa-solid fa-user"></i> সংক্ষিপ্ত পরিচিতি</div>
                    <div class="td-desc-body">{!! $teacher->short_description !!}</div>
                </div>
                @endif

                {{-- Full description --}}
                @if($teacher->description)
                <div class="td-card">
                    <div class="td-card-label"><i class="fa-solid fa-book-open"></i> বিস্তারিত পরিচিতি</div>
                    <div class="td-desc-body">{!! $teacher->description !!}</div>
                </div>
                @endif

                {{-- Courses --}}
                @if($teacher->courses && $teacher->courses->count() > 0)
                <div class="td-card">
                    <div class="td-card-label"><i class="fa-solid fa-graduation-cap"></i> যে কোর্সগুলো পরিচালনা করেন</div>
                    <div class="row g-3">
                        @foreach($teacher->courses as $course)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <a href="{{ route('course_details', $course->slug ?? '#') }}" class="text-decoration-none">
                                <div class="td-course-card">
                                    @if($course->image)
                                        <img src="/{{ $course->image }}" alt="{{ $course->title }}" loading="lazy">
                                    @else
                                        <div style="height:155px;background:linear-gradient(135deg,#002147,#003d82);display:flex;align-items:center;justify-content:center;">
                                            <i class="fa-solid fa-book" style="color:rgba(255,255,255,0.3);font-size:2rem;"></i>
                                        </div>
                                    @endif
                                    <div class="td-course-body">
                                        <div class="td-course-title">{{ $course->title }}</div>
                                        @if($course->type)
                                        <div class="td-course-meta"><i class="fa-solid fa-tag"></i> {{ $course->type }}</div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Profile picture card --}}
                <div class="td-sidebar-card mb-4">
                    <img src="{{ assetHelper(optional($teacher)->image) }}"
                         alt="{{ $teacher->full_name }}"
                         style="width:100%; height:260px; object-fit:cover; display:block;"
                         onerror="this.src='/avatar.png'">
                    <div style="padding:18px 20px; text-align:center;">
                        <div style="font-weight:800; color:#002147; font-size:1.05rem;">{{ $teacher->full_name }}</div>
                        @if($teacher->designation)
                            <div style="color:#fab005; font-size:0.8rem; font-weight:700; margin-top:4px;">{{ $teacher->designation }}</div>
                        @endif
                        <div class="td-social justify-content-center mt-3">
                            @if($teacher->facebook)  <a href="{{ $teacher->facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>  @endif
                            @if($teacher->linkedin)  <a href="{{ $teacher->linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>  @endif
                            @if($teacher->twitter)   <a href="{{ $teacher->twitter }}"  target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>       @endif
                            @if($teacher->instagram) <a href="{{ $teacher->instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a> @endif
                        </div>
                    </div>
                </div>

                {{-- Contact info --}}
                @if($teacher->email || $teacher->phone)
                <div class="td-sidebar-card">
                    <div class="td-sidebar-header"><i class="fa-solid fa-address-card"></i> যোগাযোগ</div>
                    <div class="td-sidebar-body">
                        @if($teacher->email)
                        <div class="td-contact-row">
                            <div class="td-contact-icon"><i class="fa-regular fa-envelope"></i></div>
                            <div>
                                <div class="td-contact-label">ইমেইল</div>
                                <div class="td-contact-value">{{ $teacher->email }}</div>
                            </div>
                        </div>
                        @endif
                        @if($teacher->phone)
                        <div class="td-contact-row">
                            <div class="td-contact-icon"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <div class="td-contact-label">ফোন</div>
                                <div class="td-contact-value">{{ $teacher->phone }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- CTA --}}
                <div style="background:linear-gradient(135deg,#002147,#003d82); border-radius:18px; padding:28px 24px; text-align:center; margin-top:8px;">
                    <i class="fa-solid fa-graduation-cap" style="font-size:2rem; color:#fab005; margin-bottom:14px; display:block;"></i>
                    <h6 style="color:#fff; font-weight:800; margin-bottom:8px;">এই ট্রেইনারের কোর্সে ভর্তি হন</h6>
                    <p style="color:rgba(255,255,255,0.65); font-size:0.82rem; margin-bottom:18px;">অভিজ্ঞ প্রশিক্ষকের তত্ত্বাবধানে ইংরেজি শিখুন</p>
                    <a href="/courses" style="display:inline-flex; align-items:center; gap:7px; background:linear-gradient(135deg,#fab005,#e09600); color:#fff; font-weight:700; padding:11px 24px; border-radius:50px; font-size:0.85rem; text-decoration:none; transition:all 0.3s;">
                        <i class="fa-solid fa-arrow-right"></i> কোর্স দেখুন
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
