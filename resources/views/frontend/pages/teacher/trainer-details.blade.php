@php
    $meta = [
        'seo' => [
            'title' => 'Professional Trainers — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ===== Hero ===== */
.trainers-hero { background: linear-gradient(135deg, #001830 0%, #002147 60%, #003b7a 100%); padding: 60px 0 50px; position: relative; overflow: hidden; }
.trainers-hero::before { content:''; position:absolute; top:-80px; right:-60px; width:350px; height:350px; background:rgba(250,176,5,0.06); border-radius:50%; }

/* ===== Trainer Card ===== */
.trainer-pro-card {
    background: #fff; border-radius: 20px; overflow: hidden;
    box-shadow: 0 4px 24px rgba(0,33,71,0.07); transition: all 0.35s ease;
    border: 1px solid #eef2f8; height: 100%;
}
.trainer-pro-card:hover { transform: translateY(-8px); box-shadow: 0 20px 55px rgba(0,33,71,0.13); border-color: transparent; }
.trainer-pro-img { position: relative; overflow: hidden; }
.trainer-pro-img img { width: 100%; height: 300px; object-fit: cover; display: block; transition: transform 0.45s; }
.trainer-pro-card:hover .trainer-pro-img img { transform: scale(1.05); }
.trainer-pro-overlay {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: linear-gradient(transparent, rgba(0,24,56,0.92));
    padding: 30px 18px 16px; opacity: 0; transform: translateY(8px); transition: all 0.3s;
}
.trainer-pro-card:hover .trainer-pro-overlay { opacity: 1; transform: translateY(0); }
.trainer-overlay-links { display: flex; justify-content: center; gap: 8px; }
.trainer-overlay-links a {
    width: 34px; height: 34px; background: rgba(255,255,255,0.15); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 0.82rem; text-decoration: none; transition: background 0.2s;
}
.trainer-overlay-links a:hover { background: #fab005; }
.trainer-pro-body { padding: 22px; }
.trainer-pro-name { font-weight: 800; color: #002147; font-size: 1.05rem; margin-bottom: 4px; }
.trainer-pro-desig { color: #fab005; font-size: 0.78rem; font-weight: 700; margin-bottom: 12px; display: block; }
.trainer-pro-desc { font-size: 0.82rem; color: #666; line-height: 1.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 16px; }
.trainer-pro-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: linear-gradient(135deg, #002147, #003b7a); color: #fff !important;
    padding: 9px 20px; border-radius: 50px; font-weight: 700; font-size: 0.8rem;
    text-decoration: none; transition: all 0.3s;
}
.trainer-pro-btn:hover { background: linear-gradient(135deg, #fab005, #e09600); box-shadow: 0 6px 18px rgba(250,176,5,0.35); }
</style>
@endpush

@section('contents')

{{-- Hero --}}
<section class="trainers-hero">
    <div class="container position-relative" style="z-index:1;">
        @if(isset($heading))
        <div class="text-center">
            <span style="background:rgba(250,176,5,0.18); border:1px solid rgba(250,176,5,0.5); color:#fab005; font-size:0.75rem; font-weight:700; padding:6px 18px; border-radius:50px; display:inline-block; margin-bottom:14px; letter-spacing:0.8px; text-transform:uppercase;"><i class="fa-solid fa-chalkboard-user me-1"></i> আমাদের প্রশিক্ষক</span>
            <h1 class="fw-bold text-white mb-3" style="font-size:2.2rem;">{{ $heading->title }}</h1>
            @if($heading->description)
                <div style="color:rgba(255,255,255,0.65); font-size:0.95rem; max-width:600px; margin:0 auto;">{!! $heading->description !!}</div>
            @endif
        </div>
        @else
        <div class="text-center">
            <span style="background:rgba(250,176,5,0.18); border:1px solid rgba(250,176,5,0.5); color:#fab005; font-size:0.75rem; font-weight:700; padding:6px 18px; border-radius:50px; display:inline-block; margin-bottom:14px; letter-spacing:0.8px; text-transform:uppercase;"><i class="fa-solid fa-chalkboard-user me-1"></i> আমাদের প্রশিক্ষক</span>
            <h1 class="fw-bold text-white mb-3" style="font-size:2.2rem;">আমাদের প্রফেশনাল ট্রেইনারস</h1>
            <p style="color:rgba(255,255,255,0.65); font-size:0.95rem; max-width:540px; margin:0 auto;">অভিজ্ঞ ও দক্ষ প্রশিক্ষকদের তত্ত্বাবধানে ইংরেজি দক্ষতা বিকাশ করুন।</p>
        </div>
        @endif
    </div>
</section>

{{-- Trainers Grid --}}
<section class="py-5" style="background:#f4f7fb;">
    <div class="container py-3">
        <div class="row g-4 justify-content-center">
            @foreach($trainers as $trainer)
            <div class="col-lg-4 col-md-6">
                <div class="trainer-pro-card">
                    <div class="trainer-pro-img">
                        <img src="{{ assetHelper(optional($trainer)->image) }}" alt="{{ $trainer->full_name }}" loading="lazy">
                        <div class="trainer-pro-overlay">
                            <div class="trainer-overlay-links">
                                @if($trainer->facebook)  <a href="{{ $trainer->facebook }}" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>  @endif
                                @if($trainer->linkedin)  <a href="{{ $trainer->linkedin }}" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>  @endif
                                @if($trainer->twitter)   <a href="{{ $trainer->twitter }}"  target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>       @endif
                                @if($trainer->instagram) <a href="{{ $trainer->instagram }}" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a> @endif
                            </div>
                        </div>
                    </div>
                    <div class="trainer-pro-body">
                        <div class="trainer-pro-name">{{ $trainer->full_name }}</div>
                        <span class="trainer-pro-desig">{!! $trainer->designation !!}</span>
                        @if($trainer->short_description)
                            <div class="trainer-pro-desc">{!! strip_tags($trainer->short_description) !!}</div>
                        @endif
                        <a href="{{ route('teacher.details', ['teacher_name' => str_replace(' ', '-', $trainer->full_name), 'slug' => $trainer->slug]) }}"
                           class="trainer-pro-btn">
                            বিস্তারিত দেখুন <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($trainers->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $trainers->links() }}
        </div>
        @endif
    </div>
</section>

@endsection
