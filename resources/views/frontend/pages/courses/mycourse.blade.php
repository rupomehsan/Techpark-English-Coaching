@php $meta = ['seo' => ['title' => 'My Courses — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
:root { --navy:#001e3c; --navy2:#002d5c; --gold:#fab005; --bg:#f0f4f9; --card:#fff; --border:#e4ecf5; --radius:16px; --shadow:0 4px 24px rgba(0,30,60,0.07); }
.lms-wrap { background:var(--bg); min-height:80vh; padding:0 0 60px; }

/* Hero bar */
.lms-hero { background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 60%,#003b7a 100%); padding:40px 0 32px; }
.lms-hero h1 { font-size:clamp(1.4rem,3vw,2rem); font-weight:800; color:#fff; margin-bottom:6px; }
.lms-hero p { color:rgba(255,255,255,0.6); font-size:0.88rem; }

/* Stat cards */
.lms-stats { display:flex; gap:14px; flex-wrap:wrap; margin-top:0; margin-bottom:24px; }
.lms-stat { flex:1; min-width:140px; background:var(--card); border-radius:14px; border:1px solid var(--border); box-shadow:var(--shadow); padding:18px 20px; display:flex; align-items:center; gap:14px; }
.lms-stat-ico { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; }
.lms-stat-num { font-size:1.6rem; font-weight:800; color:var(--navy); line-height:1; }
.lms-stat-lbl { font-size:0.7rem; font-weight:600; color:#6b7a90; text-transform:uppercase; letter-spacing:0.5px; margin-top:2px; }

/* Section head */
.lms-section-head { display:flex; align-items:center; gap:10px; margin-bottom:18px; }
.lms-section-head h2 { font-size:1rem; font-weight:800; color:var(--navy); margin:0; }
.lms-section-head .cnt { background:rgba(0,30,60,0.08); color:var(--navy); font-size:0.7rem; font-weight:700; padding:2px 10px; border-radius:50px; }

/* Course card */
.lms-course-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:18px; margin-bottom:36px; }
.lms-ccard { background:var(--card); border-radius:var(--radius); border:1px solid var(--border); box-shadow:var(--shadow); overflow:hidden; display:flex; flex-direction:column; transition:all 0.3s; }
.lms-ccard:hover { transform:translateY(-5px); box-shadow:0 16px 48px rgba(0,30,60,0.12); border-color:transparent; }
.lms-ccard-img { position:relative; height:170px; overflow:hidden; }
.lms-ccard-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.45s; }
.lms-ccard:hover .lms-ccard-img img { transform:scale(1.05); }
.lms-ccard-status { position:absolute; top:10px; left:10px; font-size:0.62rem; font-weight:700; padding:3px 10px; border-radius:50px; letter-spacing:0.4px; text-transform:uppercase; }
.status-progress { background:rgba(250,176,5,0.9); color:#fff; }
.status-complete { background:rgba(0,166,81,0.9); color:#fff; }
.lms-ccard-pct { position:absolute; top:10px; right:10px; background:rgba(0,0,0,0.65); color:#fff; font-size:0.72rem; font-weight:700; padding:3px 10px; border-radius:50px; }
.lms-ccard-body { padding:18px; flex:1; display:flex; flex-direction:column; }
.lms-ccard-batch { font-size:0.68rem; font-weight:700; color:var(--gold); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:5px; }
.lms-ccard-title { font-weight:700; color:var(--navy); font-size:0.92rem; line-height:1.4; margin-bottom:12px; }
.lms-progress-wrap { margin-bottom:14px; }
.lms-progress-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:5px; }
.lms-progress-lbl { font-size:0.68rem; font-weight:600; color:#6b7a90; }
.lms-progress-val { font-size:0.68rem; font-weight:800; color:var(--navy); }
.lms-progress-bar { height:6px; background:#e8edf5; border-radius:50px; overflow:hidden; }
.lms-progress-fill { height:100%; border-radius:50px; transition:width 0.8s ease; }
.fill-progress { background:linear-gradient(90deg,var(--gold),#e09600); }
.fill-complete { background:linear-gradient(90deg,#00a651,#00c85a); }
.lms-ccard-btn { display:flex; align-items:center; justify-content:center; gap:7px; padding:10px 16px; border-radius:50px; font-weight:700; font-size:0.8rem; text-decoration:none; transition:all 0.25s; margin-top:auto; }
.btn-continue { background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; }
.btn-continue:hover { background:linear-gradient(135deg,var(--gold),#e09600); color:#fff; box-shadow:0 6px 18px rgba(250,176,5,0.35); }
.btn-cert { background:linear-gradient(135deg,#00a651,#007a3d); color:#fff; }
.btn-cert:hover { box-shadow:0 6px 18px rgba(0,166,81,0.35); color:#fff; }

/* Empty state */
.lms-empty { text-align:center; padding:60px 20px; background:var(--card); border-radius:var(--radius); border:1px solid var(--border); }
.lms-empty i { font-size:3rem; color:#d1dce9; margin-bottom:16px; }
</style>
@endpush

@section('contents')
<div class="lms-wrap">
    {{-- Hero --}}
    <div class="lms-hero">
        <div class="container position-relative" style="z-index:1;">
            <h1><i class="fa-solid fa-book-open me-2" style="color:var(--gold);"></i>আমার কোর্সসমূহ</h1>
            <p>আপনার সকল এনরোল্ড কোর্স এখানে পাবেন।</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-4 pt-4">
            <div class="col-lg-3">
                @include('frontend.components.student_sidebar')
            </div>
            <div class="col-lg-9">
        {{-- Stats --}}
        <div class="lms-stats">
            <div class="lms-stat">
                <div class="lms-stat-ico" style="background:#eef5ff; color:var(--navy2);"><i class="fa-solid fa-layer-group"></i></div>
                <div>
                    <div class="lms-stat-num">{{ $user_course->count() }}</div>
                    <div class="lms-stat-lbl">Total Courses</div>
                </div>
            </div>
            <div class="lms-stat">
                <div class="lms-stat-ico" style="background:#fff9e6; color:#c07800;"><i class="fa-solid fa-spinner"></i></div>
                <div>
                    <div class="lms-stat-num">{{ $incomplete_courses->count() }}</div>
                    <div class="lms-stat-lbl">In Progress</div>
                </div>
            </div>
            <div class="lms-stat">
                <div class="lms-stat-ico" style="background:#e8fff2; color:#00a651;"><i class="fa-solid fa-circle-check"></i></div>
                <div>
                    <div class="lms-stat-num">{{ $complete_courses->count() }}</div>
                    <div class="lms-stat-lbl">Completed</div>
                </div>
            </div>
        </div>

        {{-- In Progress --}}
        @if($incomplete_courses->count() > 0)
        <div class="lms-section-head">
            <i class="fa-solid fa-play" style="color:var(--gold);"></i>
            <h2>চলমান কোর্স</h2>
            <span class="cnt">{{ $incomplete_courses->count() }}</span>
        </div>
        <div class="lms-course-grid">
            @foreach($incomplete_courses as $item)
            @php $url = route('mycourse_details', $item->course->slug) . '?batch_id=' . $item->batch->id; @endphp
            <div class="lms-ccard">
                <div class="lms-ccard-img">
                    <a href="{{ $url }}"><img src="{{ assetHelper(optional($item->course)->image) }}" alt="{{ $item->course->title }}" loading="lazy"></a>
                    <span class="lms-ccard-status status-progress">In Progress</span>
                    <span class="lms-ccard-pct">{{ $item->course_percent }}%</span>
                </div>
                <div class="lms-ccard-body">
                    <div class="lms-ccard-batch"><i class="fa-solid fa-layer-group me-1"></i>{{ $item->batch->batch_name }}</div>
                    <div class="lms-ccard-title">{{ $item->course->title }}</div>
                    <div class="lms-progress-wrap">
                        <div class="lms-progress-row">
                            <span class="lms-progress-lbl">Progress</span>
                            <span class="lms-progress-val">{{ $item->course_percent }}%</span>
                        </div>
                        <div class="lms-progress-bar">
                            <div class="lms-progress-fill fill-progress" style="width:{{ $item->course_percent }}%"></div>
                        </div>
                    </div>
                    <a href="{{ $url }}" class="lms-ccard-btn btn-continue">
                        <i class="fa-solid fa-play"></i> Continue Learning
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Completed --}}
        @if($complete_courses->count() > 0)
        <div class="lms-section-head">
            <i class="fa-solid fa-trophy" style="color:#00a651;"></i>
            <h2>সম্পন্ন কোর্স</h2>
            <span class="cnt">{{ $complete_courses->count() }}</span>
        </div>
        <div class="lms-course-grid">
            @foreach($complete_courses as $item)
            @php $url = route('mycourse_details', $item->course->slug) . '?batch_id=' . $item->batch->id; @endphp
            <div class="lms-ccard">
                <div class="lms-ccard-img">
                    <a href="{{ $url }}"><img src="{{ assetHelper(optional($item->course)->image) }}" alt="{{ $item->course->title }}" loading="lazy"></a>
                    <span class="lms-ccard-status status-complete">Completed</span>
                    <span class="lms-ccard-pct">100%</span>
                </div>
                <div class="lms-ccard-body">
                    <div class="lms-ccard-batch"><i class="fa-solid fa-layer-group me-1"></i>{{ $item->batch->batch_name }}</div>
                    <div class="lms-ccard-title">{{ $item->course->title }}</div>
                    <div class="lms-progress-wrap">
                        <div class="lms-progress-row">
                            <span class="lms-progress-lbl">Progress</span>
                            <span class="lms-progress-val" style="color:#00a651;">100%</span>
                        </div>
                        <div class="lms-progress-bar">
                            <div class="lms-progress-fill fill-complete" style="width:100%"></div>
                        </div>
                    </div>
                    <a href="{{ $url }}" class="lms-ccard-btn btn-cert">
                        <i class="fa-solid fa-certificate"></i> View Certificate
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($user_course->count() === 0)
        <div class="lms-empty">
            <i class="fa-solid fa-book-open d-block"></i>
            <h4 class="fw-bold" style="color:var(--navy);">কোনো কোর্স নেই</h4>
            <p class="text-muted mb-4">আপনি এখনো কোনো কোর্সে এনরোল্ড হননি।</p>
            <a href="{{ route('courses') }}" style="background:linear-gradient(135deg,var(--navy),var(--navy2));color:#fff;padding:12px 28px;border-radius:50px;font-weight:700;text-decoration:none;font-size:0.88rem;">কোর্স দেখুন</a>
        </div>
        @endif
            </div>{{-- /col-lg-9 --}}
        </div>{{-- /row --}}
    </div>
</div>
@endsection
