@php
    $meta = [
        'seo' => [
            'title' => 'Videos — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ===== Hero ===== */
.video-hero { background: linear-gradient(135deg, #001830 0%, #002147 60%, #003b7a 100%); padding: 60px 0 50px; position: relative; overflow: hidden; }
.video-hero::before { content:''; position:absolute; top:-80px; right:-60px; width:350px; height:350px; background:rgba(250,176,5,0.06); border-radius:50%; }
.video-hero::after  { content:''; position:absolute; bottom:-120px; left:-80px; width:400px; height:400px; background:rgba(255,255,255,0.02); border-radius:50%; }

/* ===== Category Tabs ===== */
.video-tabs-wrap {
    background: #fff; border-bottom: 2px solid #eef2f8;
    position: sticky; top: 0; z-index: 100;
    box-shadow: 0 2px 16px rgba(0,33,71,0.06);
}
.video-tabs {
    display: flex; gap: 0; overflow-x: auto;
    scrollbar-width: none; list-style: none;
    margin: 0; padding: 0;
}
.video-tabs::-webkit-scrollbar { display: none; }
.video-tab-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 16px 22px; font-size: 0.88rem; font-weight: 700;
    color: #6c757d; white-space: nowrap; cursor: pointer;
    border: none; background: none; border-bottom: 3px solid transparent;
    transition: all 0.25s; position: relative; bottom: -2px;
}
.video-tab-btn:hover { color: #002147; }
.video-tab-btn.active { color: #002147; border-bottom-color: #fab005; }
.video-tab-count {
    background: #f0f4ff; color: #003d82;
    font-size: 0.7rem; font-weight: 800; border-radius: 50px;
    padding: 2px 8px; min-width: 22px; text-align: center;
}
.video-tab-btn.active .video-tab-count { background: #fab005; color: #fff; }

/* ===== Video Card ===== */
.video-section { background: #f4f7fb; padding: 48px 0 72px; }
.video-tab-panel { display: none; }
.video-tab-panel.active { display: block; }

.video-card {
    background: #fff; border-radius: 16px; overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,33,71,0.08); border: 1px solid #eef2f8;
    transition: all 0.35s ease; cursor: pointer; height: 100%;
}
.video-card:hover { transform: translateY(-6px); box-shadow: 0 16px 45px rgba(0,33,71,0.13); border-color: transparent; }
.video-thumb-wrap { position: relative; overflow: hidden; }
.video-thumb-wrap img { width: 100%; height: 210px; object-fit: cover; display: block; transition: transform 0.45s; }
.video-card:hover .video-thumb-wrap img { transform: scale(1.05); }
.video-play-btn {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    width: 58px; height: 58px; background: rgba(250,176,5,0.92); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 0 0 10px rgba(250,176,5,0.2); transition: all 0.3s;
}
.video-card:hover .video-play-btn { background: #fab005; box-shadow: 0 0 0 14px rgba(250,176,5,0.25); transform: translate(-50%, -50%) scale(1.1); }
.video-play-btn i { color: #fff; font-size: 1.3rem; margin-left: 4px; }
.video-body { padding: 16px 18px 18px; }
.video-title { font-weight: 700; color: #002147; font-size: 0.92rem; line-height: 1.45; margin-bottom: 6px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.video-desc { font-size: 0.78rem; color: #888; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

/* ===== Lightbox Modal ===== */
.video-modal-overlay {
    display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.92);
    z-index: 9999; align-items: center; justify-content: center;
}
.video-modal-overlay.open { display: flex; }
.video-modal-inner { position: relative; width: 90vw; max-width: 900px; }
.video-modal-inner iframe { width: 100%; aspect-ratio: 16/9; border-radius: 12px; border: none; display: block; }
.video-modal-close {
    position: absolute; top: -48px; right: 0; background: none; border: none;
    color: #fff; font-size: 2rem; cursor: pointer; line-height: 1; opacity: 0.8; transition: all 0.2s;
}
.video-modal-close:hover { opacity: 1; transform: rotate(90deg); }

/* ===== Empty state ===== */
.video-empty { text-align: center; padding: 60px 20px; }
.video-empty i { font-size: 3.5rem; color: #dde3ea; margin-bottom: 16px; display: block; }

@media(max-width:576px) {
    .video-tab-btn { padding: 14px 16px; font-size: 0.82rem; }
}
</style>
@endpush

@section('contents')

{{-- Hero --}}
<section class="video-hero">
    <div class="container position-relative" style="z-index:1;">
        <div class="text-center">
            <span style="background:rgba(250,176,5,0.18); border:1px solid rgba(250,176,5,0.5); color:#fab005; font-size:0.75rem; font-weight:700; padding:6px 18px; border-radius:50px; display:inline-block; margin-bottom:14px; letter-spacing:0.8px; text-transform:uppercase;"><i class="fa-solid fa-video me-1"></i> আমাদের ভিডিও</span>
            <h1 class="fw-bold text-white mb-3" style="font-size:2.2rem;">ভিডিও গ্যালারি</h1>
            <p style="color:rgba(255,255,255,0.65); font-size:0.95rem; max-width:520px; margin:0 auto;">TechPark English-এর ক্লাস, ইভেন্ট ও শিক্ষার্থীদের অভিজ্ঞতার ভিডিও।</p>
        </div>
    </div>
</section>

{{-- Category Tabs --}}
<div class="video-tabs-wrap">
    <div class="container">
        <ul class="video-tabs">
            <li>
                <button class="video-tab-btn active" data-target="tab-all">
                    <i class="fa-solid fa-border-all"></i> সব ভিডিও
                    <span class="video-tab-count">{{ $all_videos->count() }}</span>
                </button>
            </li>
            @foreach($categories as $cat)
            <li>
                <button class="video-tab-btn" data-target="tab-cat-{{ $cat->id }}">
                    {{ $cat->title }}
                    <span class="video-tab-count">{{ isset($videos_by_category[$cat->id]) ? $videos_by_category[$cat->id]->count() : 0 }}</span>
                </button>
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- Videos --}}
<section class="video-section">
    <div class="container">

        {{-- All Videos Tab --}}
        <div class="video-tab-panel active" id="tab-all">
            @if($all_videos->count() > 0)
            <div class="row g-4">
                @foreach($all_videos as $video)
                @php
                    preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->video_link ?? '', $vm);
                    $yt_id = $vm[1] ?? null;
                    $embed = $yt_id ? "https://www.youtube.com/embed/{$yt_id}?autoplay=1&rel=0" : '';
                    $thumb = $yt_id ? "https://img.youtube.com/vi/{$yt_id}/mqdefault.jpg" : 'https://dummyimage.com/600x340/002147/fab005&text=Video';
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="video-card" onclick="openVideoModal('{{ addslashes($embed) }}', '{{ addslashes($video->title) }}')">
                        <div class="video-thumb-wrap">
                            <img src="{{ $thumb }}" alt="{{ $video->title }}" loading="lazy" onerror="this.src='https://dummyimage.com/600x340/002147/fab005&text=Video'">
                            <div class="video-play-btn"><i class="fa-solid fa-play"></i></div>
                        </div>
                        <div class="video-body">
                            <div class="video-title">{{ $video->title }}</div>
                            @if($video->description)
                                <div class="video-desc">{{ $video->description }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="video-empty">
                <i class="fa-solid fa-video-slash"></i>
                <h4 class="fw-bold mb-2" style="color:#002147;">কোনো ভিডিও পাওয়া যায়নি</h4>
                <p class="text-muted">শীঘ্রই ভিডিও যুক্ত করা হবে।</p>
            </div>
            @endif
        </div>

        {{-- Per-category Tabs --}}
        @foreach($categories as $cat)
        <div class="video-tab-panel" id="tab-cat-{{ $cat->id }}">
            @php $cat_videos = $videos_by_category[$cat->id] ?? collect(); @endphp
            @if($cat_videos->count() > 0)
            <div class="row g-4">
                @foreach($cat_videos as $video)
                @php
                    preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->video_link ?? '', $vm2);
                    $yt2 = $vm2[1] ?? null;
                    $em2 = $yt2 ? "https://www.youtube.com/embed/{$yt2}?autoplay=1&rel=0" : '';
                    $th2 = $yt2 ? "https://img.youtube.com/vi/{$yt2}/mqdefault.jpg" : 'https://dummyimage.com/600x340/002147/fab005&text=Video';
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="video-card" onclick="openVideoModal('{{ addslashes($em2) }}', '{{ addslashes($video->title) }}')">
                        <div class="video-thumb-wrap">
                            <img src="{{ $th2 }}" alt="{{ $video->title }}" loading="lazy" onerror="this.src='https://dummyimage.com/600x340/002147/fab005&text=Video'">
                            <div class="video-play-btn"><i class="fa-solid fa-play"></i></div>
                        </div>
                        <div class="video-body">
                            <div class="video-title">{{ $video->title }}</div>
                            @if($video->description)
                                <div class="video-desc">{{ $video->description }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="video-empty">
                <i class="fa-solid fa-video-slash"></i>
                <h4 class="fw-bold mb-2" style="color:#002147;">এই ক্যাটাগরিতে কোনো ভিডিও নেই</h4>
            </div>
            @endif
        </div>
        @endforeach

    </div>
</section>

{{-- Video Modal --}}
<div class="video-modal-overlay" id="videoModal" onclick="closeVideoModal(event)">
    <div class="video-modal-inner" id="videoModalInner">
        <button class="video-modal-close" onclick="closeVideoModalBtn()"><i class="fa-solid fa-xmark"></i></button>
        <iframe id="videoIframe" src="" allowfullscreen allow="autoplay; encrypted-media"></iframe>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Tab switching
document.querySelectorAll('.video-tab-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.video-tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.video-tab-panel').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        var target = btn.getAttribute('data-target');
        var panel = document.getElementById(target);
        if (panel) panel.classList.add('active');
    });
});

function openVideoModal(embedUrl, title) {
    if (!embedUrl) return;
    document.getElementById('videoIframe').src = embedUrl;
    document.getElementById('videoModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeVideoModalBtn() {
    document.getElementById('videoIframe').src = '';
    document.getElementById('videoModal').classList.remove('open');
    document.body.style.overflow = '';
}
function closeVideoModal(e) {
    if (e.target === document.getElementById('videoModal')) closeVideoModalBtn();
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeVideoModalBtn();
});
</script>
@endpush
