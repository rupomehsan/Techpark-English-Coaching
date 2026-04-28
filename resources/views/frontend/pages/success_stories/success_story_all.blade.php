@php
    $meta = [
        'seo' => [
            'title' => 'সফল শিক্ষার্থীদের গল্প — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
    .stories-hero { background: linear-gradient(135deg, #002147 0%, #003b7a 100%); padding: 70px 0 50px; }
    .stories-hero h1 { color: #fff; font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 800; }
    .stories-hero p  { color: rgba(255,255,255,0.7); font-size: 1rem; }

    .story-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.07); transition: all 0.35s ease; border: 1px solid #f0f4f8; }
    .story-card:hover { transform: translateY(-6px); box-shadow: 0 18px 50px rgba(0,33,71,0.12); border-color: #e2eaf5; }

    .story-thumb { position: relative; cursor: pointer; overflow: hidden; }
    .story-thumb img { width: 100%; height: 210px; object-fit: cover; display: block; transition: transform 0.4s ease; }
    .story-card:hover .story-thumb img { transform: scale(1.05); }
    .story-play-btn { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 52px; height: 52px; background: rgba(255,0,0,0.92); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 18px rgba(255,0,0,0.4); transition: transform 0.3s; }
    .story-card:hover .story-play-btn { transform: translate(-50%,-50%) scale(1.12); }
    .story-play-btn i { color: #fff; font-size: 1.1rem; margin-left: 4px; }

    .story-body { padding: 20px; }
    .story-body h5 { font-weight: 700; color: #002147; font-size: 0.95rem; margin-bottom: 6px; }
    .story-body .role { font-size: 0.78rem; color: #fab005; font-weight: 600; }
    .story-stars { color: #fab005; font-size: 0.75rem; margin-top: 8px; }

    .btn-tpe-fill { background: linear-gradient(135deg,#fab005,#e09600); color:#fff; padding:11px 30px; border-radius:50px; border:none; font-weight:700; font-size:0.9rem; transition:all 0.3s; text-decoration:none; display:inline-block; }
    .btn-tpe-fill:hover { color:#fff; transform:translateY(-2px); }

    /* YouTube modal */
    .yt-modal { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.88); z-index:9999; align-items:center; justify-content:center; }
    .yt-modal.open { display:flex; }
    .yt-modal-inner { position:relative; width:90%; max-width:820px; aspect-ratio:16/9; }
    .yt-modal-inner iframe { width:100%; height:100%; border:none; border-radius:10px; }
    .yt-modal-close { position:absolute; top:-46px; right:0; color:#fff; font-size:1.6rem; cursor:pointer; background:none; border:none; padding:4px 8px; line-height:1; opacity:0.85; }
    .yt-modal-close:hover { opacity:1; }
</style>
@endpush

@section('contents')

    {{-- Hero --}}
    <section class="stories-hero">
        <div class="container text-center">
            <h1 class="mb-3">সফল শিক্ষার্থীদের গল্প</h1>
            <p class="mb-0">TechPark English-এর হাজার হাজার শিক্ষার্থী তাদের জীবন বদলে দিয়েছে — তাদের গল্প দেখুন</p>
        </div>
    </section>

    {{-- Stories Grid --}}
    <section class="py-5" style="background:#f4f7fb;">
        <div class="container py-3">

            @if($success_stories->count() > 0)
            <div class="row g-4 justify-content-center">
                @foreach($success_stories as $story)
                @php
                    preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $story->video_link ?? '', $sm);
                    $s_vid = $sm[1] ?? null;
                    $s_img = $s_vid
                        ? "https://img.youtube.com/vi/{$s_vid}/mqdefault.jpg"
                        : ($story->thumbnail_image
                            ? asset($story->thumbnail_image)
                            : 'https://dummyimage.com/600x400/002147/fff&text='.urlencode(strtoupper(substr($story->title ?? 'S', 0, 2))));
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="story-card h-100">
                        @if($s_vid)
                        <div class="story-thumb" onclick="openYtModal('{{ $s_vid }}')">
                            <img src="{{ $s_img }}" alt="{{ $story->title }}"
                                 onerror="this.src='https://img.youtube.com/vi/{{ $s_vid }}/hqdefault.jpg'">
                            <div class="story-play-btn"><i class="fa-solid fa-play"></i></div>
                        </div>
                        @else
                        <div class="story-thumb">
                            <img src="{{ $s_img }}" alt="{{ $story->title }}">
                        </div>
                        @endif
                        <div class="story-body">
                            <h5>{{ $story->title }}</h5>
                            <span class="role">TechPark English Graduate</span>
                            <div class="story-stars">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $success_stories->links() }}
            </div>

            @else
            <div class="text-center py-5">
                <i class="fa-regular fa-face-smile" style="font-size:3rem; color:#ccc;"></i>
                <p class="text-muted mt-3">এখনো কোনো সফলতার গল্প যোগ করা হয়নি।</p>
                <a href="{{ route('website') }}" class="btn-tpe-fill mt-2">হোমপেজে ফিরুন</a>
            </div>
            @endif

        </div>
    </section>

    {{-- YouTube Modal --}}
    <div class="yt-modal" id="ytModal" onclick="if(event.target===this)closeYtModal()">
        <div class="yt-modal-inner">
            <button class="yt-modal-close" onclick="closeYtModal()"><i class="fa-solid fa-xmark"></i></button>
            <iframe id="ytIframe" src="" allowfullscreen allow="autoplay; encrypted-media; picture-in-picture"></iframe>
        </div>
    </div>

@endsection

@push('scripts')
<script>
function openYtModal(id) {
    document.getElementById('ytIframe').src = 'https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0';
    document.getElementById('ytModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeYtModal() {
    document.getElementById('ytIframe').src = '';
    document.getElementById('ytModal').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeYtModal();
});
</script>
@endpush
