@php
    $meta = [
        'seo' => [
            'title' => $teacher->full_name . ' — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ===== Cover Photo ===== */
.td-cover { position: relative; height: clamp(220px, 28vw, 400px); overflow: hidden; background: linear-gradient(135deg, #001830, #003b7a); }
.td-cover img { width: 100%; height: 100%; object-fit: cover; display: block; opacity: 0.75; }
.td-cover-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.15) 0%, rgba(0,24,56,0.6) 100%); }

/* ===== Profile Header ===== */
.td-profile-wrap { background: #fff; border-bottom: 1px solid #eef2f8; padding-bottom: 28px; }
.td-profile-inner { display: flex; align-items: flex-end; gap: 24px; flex-wrap: wrap; padding-top: 0; margin-top: -60px; }
.td-avatar { width: 130px; height: 130px; border-radius: 16px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 8px 30px rgba(0,0,0,0.15); flex-shrink: 0; }
.td-profile-info { flex: 1; padding-top: 68px; }
.td-name { font-size: clamp(1.4rem, 3vw, 2rem); font-weight: 800; color: #002147; margin-bottom: 4px; }
.td-desig { color: #fab005; font-size: 0.88rem; font-weight: 700; margin-bottom: 12px; display: block; }
.td-social { display: flex; gap: 8px; flex-wrap: wrap; }
.td-social a {
    width: 36px; height: 36px; border-radius: 8px; background: #f0f4f8;
    display: flex; align-items: center; justify-content: center;
    color: #002147; font-size: 0.85rem; text-decoration: none; transition: all 0.2s;
}
.td-social a:hover { background: #002147; color: #fab005; transform: translateY(-2px); }

/* ===== Info Grid ===== */
.td-meta-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 14px; margin-bottom: 30px; }
.td-meta-item { background: #fff; border-radius: 12px; padding: 16px 18px; display: flex; align-items: flex-start; gap: 12px; box-shadow: 0 2px 10px rgba(0,33,71,0.05); border: 1px solid #eef2f8; }
.td-meta-icon { width: 38px; height: 38px; background: rgba(250,176,5,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fab005; font-size: 0.9rem; flex-shrink: 0; }
.td-meta-label { font-size: 0.68rem; font-weight: 700; color: #aaa; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 2px; }
.td-meta-value { font-size: 0.88rem; font-weight: 600; color: #2d3748; }

/* ===== Description ===== */
.td-desc-card { background: #fff; border-radius: 16px; padding: 28px 30px; margin-bottom: 24px; box-shadow: 0 2px 14px rgba(0,33,71,0.05); border: 1px solid #eef2f8; }
.td-section-label { font-size: 0.68rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #fab005; background: rgba(250,176,5,0.1); border: 1px solid rgba(250,176,5,0.2); padding: 4px 12px; border-radius: 50px; display: inline-block; margin-bottom: 14px; }
.td-desc-body { color: #4a5568; line-height: 1.85; font-size: 0.92rem; }

/* ===== Course Cards ===== */
.td-course-card { background: #fff; border-radius: 14px; overflow: hidden; box-shadow: 0 2px 14px rgba(0,33,71,0.06); border: 1px solid #eef2f8; transition: all 0.3s; }
.td-course-card:hover { transform: translateY(-5px); box-shadow: 0 12px 35px rgba(0,33,71,0.1); }
.td-course-card img { width: 100%; height: 150px; object-fit: cover; display: block; }
.td-course-body { padding: 14px 16px; }
.td-course-title { font-weight: 700; color: #002147; font-size: 0.9rem; margin-bottom: 4px; }
.td-course-type { font-size: 0.75rem; color: #888; }
</style>
@endpush

@section('contents')

{{-- Cover --}}
<div class="td-cover">
    @if($teacher->cover_photo)
        <img src="{{ assetHelper(optional($teacher)->cover_photo) }}" alt="{{ $teacher->full_name }}" loading="lazy">
    @endif
    <div class="td-cover-overlay"></div>
</div>

{{-- Profile Header --}}
<div class="td-profile-wrap">
    <div class="container">
        <div class="td-profile-inner">
            <img class="td-avatar"
                 src="{{ assetHelper(optional($teacher)->image) }}"
                 alt="{{ $teacher->full_name }}" loading="lazy">
            <div class="td-profile-info">
                <h1 class="td-name">{{ $teacher->full_name }}</h1>
                <span class="td-desig">{{ $teacher->designation }}</span>
                <div class="td-social">
                    @if($teacher->facebook)  <a href="{{ $teacher->facebook }}" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>  @endif
                    @if($teacher->linkedin)  <a href="{{ $teacher->linkedin }}" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>  @endif
                    @if($teacher->twitter)   <a href="{{ $teacher->twitter }}"  target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>       @endif
                    @if($teacher->instagram) <a href="{{ $teacher->instagram }}" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a> @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Body --}}
<section class="py-5" style="background:#f4f7fb;">
    <div class="container py-2">

        {{-- Meta info --}}
        <div class="td-meta-grid mb-4">
            @if($teacher->designation)
            <div class="td-meta-item">
                <div class="td-meta-icon"><i class="fa-solid fa-briefcase"></i></div>
                <div>
                    <div class="td-meta-label">Designation</div>
                    <div class="td-meta-value">{{ $teacher->designation }}</div>
                </div>
            </div>
            @endif
            @if($teacher->email)
            <div class="td-meta-item">
                <div class="td-meta-icon"><i class="fa-regular fa-envelope"></i></div>
                <div>
                    <div class="td-meta-label">Email</div>
                    <div class="td-meta-value">{{ $teacher->email }}</div>
                </div>
            </div>
            @endif
            @if($teacher->phone)
            <div class="td-meta-item">
                <div class="td-meta-icon"><i class="fa-solid fa-phone"></i></div>
                <div>
                    <div class="td-meta-label">Phone</div>
                    <div class="td-meta-value">{{ $teacher->phone }}</div>
                </div>
            </div>
            @endif
        </div>

        {{-- Description --}}
        @if($teacher->description)
        <div class="td-desc-card">
            <span class="td-section-label"><i class="fa-solid fa-user me-1"></i> পরিচিতি</span>
            <div class="td-desc-body">{!! $teacher->description !!}</div>
        </div>
        @endif

        {{-- Courses --}}
        @if($teacher->courses && $teacher->courses->count() > 0)
        <div class="td-desc-card">
            <span class="td-section-label"><i class="fa-solid fa-graduation-cap me-1"></i> যে কোর্সগুলো পরিচালনা করেন</span>
            <div class="row g-3 mt-1">
                @foreach($teacher->courses as $course)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="td-course-card">
                        <img src="/{{ $course->image }}" alt="{{ $course->title }}" loading="lazy">
                        <div class="td-course-body">
                            <div class="td-course-title">{{ $course->title }}</div>
                            <div class="td-course-type">{{ $course->type }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection
