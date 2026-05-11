@php $meta = ['seo' => ['title' => 'My Wishlist — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
:root { --navy:#001e3c; --navy2:#002d5c; --gold:#fab005; --bg:#f0f4f9; --card:#fff; --border:#e4ecf5; --radius:16px; --shadow:0 4px 24px rgba(0,30,60,0.07); }
.wl-wrap { background:var(--bg); min-height:80vh; padding:0 0 64px; }
.wl-hero { background:linear-gradient(135deg,var(--navy),var(--navy2),#003b7a); padding:38px 0 30px; }
.wl-hero h1 { font-size:clamp(1.3rem,3vw,1.9rem); font-weight:800; color:#fff; margin-bottom:5px; }
.wl-hero p { color:rgba(255,255,255,0.55); font-size:0.88rem; }
.wl-count-pill { display:inline-flex; align-items:center; gap:6px; background:rgba(250,176,5,0.15); border:1px solid rgba(250,176,5,0.35); color:var(--gold); font-size:0.72rem; font-weight:700; padding:4px 14px; border-radius:50px; margin-bottom:14px; }
.wl-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:18px; }
.wl-card { background:var(--card); border-radius:var(--radius); border:1px solid var(--border); box-shadow:var(--shadow); overflow:hidden; display:flex; flex-direction:column; transition:all 0.3s; }
.wl-card:hover { transform:translateY(-5px); box-shadow:0 16px 48px rgba(0,30,60,0.12); border-color:transparent; }
.wl-img-wrap { position:relative; height:180px; overflow:hidden; }
.wl-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform 0.45s; }
.wl-card:hover .wl-img-wrap img { transform:scale(1.05); }
.wl-remove-btn { position:absolute; top:10px; right:10px; width:32px; height:32px; border-radius:50%; background:rgba(220,53,69,0.9); border:none; color:#fff; font-size:0.72rem; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.25s; box-shadow:0 2px 8px rgba(0,0,0,0.2); }
.wl-remove-btn:hover { background:#dc3545; transform:scale(1.1); }
.wl-cat-badge { position:absolute; bottom:10px; left:10px; font-size:0.62rem; font-weight:700; background:rgba(0,30,60,0.75); color:#fff; padding:3px 10px; border-radius:50px; backdrop-filter:blur(4px); }
.wl-body { padding:18px; flex:1; display:flex; flex-direction:column; }
.wl-title { font-weight:700; color:var(--navy); font-size:0.92rem; line-height:1.4; margin-bottom:10px; flex:1; }
.wl-title a { color:inherit; text-decoration:none; }
.wl-title a:hover { color:var(--gold); }
.wl-desc { font-size:0.8rem; color:#6b7a90; line-height:1.6; margin-bottom:14px; }
.wl-footer { display:flex; gap:8px; margin-top:auto; }
.wl-btn-view { flex:1; display:inline-flex; align-items:center; justify-content:center; gap:6px; padding:10px 14px; border-radius:50px; background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; font-weight:700; font-size:0.78rem; text-decoration:none; transition:all 0.25s; }
.wl-btn-view:hover { background:linear-gradient(135deg,var(--gold),#e09600); color:#fff; box-shadow:0 5px 16px rgba(250,176,5,0.35); }
.wl-empty { text-align:center; padding:80px 20px; background:var(--card); border-radius:var(--radius); border:1px solid var(--border); max-width:480px; margin:0 auto; }
.wl-empty i { font-size:3.5rem; color:#d1dce9; margin-bottom:18px; }
</style>
@endpush

@section('contents')
<div class="wl-wrap">
    <div class="wl-hero">
        <div class="container position-relative" style="z-index:1;">
            <div class="wl-count-pill"><i class="fa-solid fa-heart"></i> {{ $wishlist->total() }} টি কোর্স</div>
            <h1>আমার উইশলিস্ট</h1>
            <p>পরে দেখতে সেভ করা কোর্সসমূহ।</p>
        </div>
    </div>

    <div class="container" style="padding-top:36px;">
        <div class="row g-4">
            <div class="col-lg-3">
                @include('frontend.components.student_sidebar')
            </div>
            <div class="col-lg-9">
        @if($wishlist->count())
            <div class="wl-grid">
                @foreach($wishlist as $item)
                    @php
                        $course = $item->course;
                        $wlIsEnrolled = $course
                            ? \App\Modules\Management\EnrollInformation\Models\Model::where('student_id', auth()->id())
                                ->where('course_id', $course->id)->exists()
                            : false;
                    @endphp
                    @if($course)
                    <div class="wl-card">
                        <div class="wl-img-wrap">
                            <a href="{{ route('course_details', $course->slug) }}">
                                <img src="{{ assetHelper(optional($course)->image) }}" alt="{{ $course->title }}" loading="lazy">
                            </a>
                            <form action="{{ route('wishlist.remove', $course->id) }}" method="POST" style="display:contents;">
                                @csrf
                                <button type="submit" class="wl-remove-btn" title="Remove from wishlist">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>
                            @if($course->course_category)
                                <span class="wl-cat-badge">{{ $course->course_category->title }}</span>
                            @endif
                        </div>
                        <div class="wl-body">
                            <div class="wl-title">
                                <a href="{{ route('course_details', $course->slug) }}">{{ $course->title }}</a>
                            </div>
                            @if($course->what_is_this_course)
                                <div class="wl-desc">{{ Str::limit(strip_tags($course->what_is_this_course), 110) }}</div>
                            @endif
                            <div class="wl-footer">
                                <a href="{{ route('course_details', $course->slug) }}" class="wl-btn-view">
                                    <i class="fa-solid fa-eye"></i> View Course
                                </a>
                                @auth
                                @if($wlIsEnrolled)
                                    <span style="flex:1;padding:10px 14px;border-radius:50px;background:linear-gradient(135deg,#00a651,#007a3d);color:#fff;font-weight:700;font-size:0.78rem;display:inline-flex;align-items:center;justify-content:center;gap:6px;opacity:0.75;cursor:not-allowed;">
                                        <i class="fa-solid fa-circle-check"></i> Enrolled
                                    </span>
                                @else
                                <form method="POST" action="{{ route('course.checkout', $course->slug) }}" style="display:contents;">
                                    @csrf
                                    <button type="submit" style="flex:1;border:none;cursor:pointer;padding:10px 14px;border-radius:50px;background:linear-gradient(135deg,#fab005,#e09600);color:#fff;font-weight:700;font-size:0.78rem;display:inline-flex;align-items:center;justify-content:center;gap:6px;transition:all 0.25s;">
                                        <i class="fa-solid fa-lock-open"></i> Enroll
                                    </button>
                                </form>
                                @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            @if($wishlist->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $wishlist->links() }}
            </div>
            @endif
        @else
            <div class="wl-empty">
                <i class="fa-regular fa-heart d-block"></i>
                <h4 class="fw-bold mb-2" style="color:var(--navy);">উইশলিস্ট খালি</h4>
                <p class="text-muted mb-4" style="font-size:0.88rem;">পছন্দের কোর্সগুলো হার্ট আইকনে ক্লিক করে সেভ করুন।</p>
                <a href="{{ route('courses') }}" style="background:linear-gradient(135deg,var(--navy),var(--navy2));color:#fff;padding:12px 28px;border-radius:50px;font-weight:700;text-decoration:none;font-size:0.88rem;display:inline-flex;align-items:center;gap:8px;">
                    <i class="fa-solid fa-book-open"></i> সকল কোর্স দেখুন
                </a>
            </div>
        @endif
            </div>{{-- /col-lg-9 --}}
        </div>{{-- /row --}}
    </div>
</div>
@endsection
