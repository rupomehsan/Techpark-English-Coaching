@php
    $meta = [
        'seo' => [
            'title' => 'Gallery — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ===== Page Hero ===== */
.gallery-hero { background: linear-gradient(135deg, #001830 0%, #002147 60%, #003b7a 100%); padding: 55px 0 45px; position: relative; overflow: hidden; }
.gallery-hero::before { content: ''; position: absolute; top: -80px; right: -60px; width: 350px; height: 350px; background: rgba(250,176,5,0.06); border-radius: 50%; }

/* ===== Filter Bar ===== */
.gallery-filter-bar { background: #fff; border-bottom: 1px solid #eef2f8; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
.gallery-filter-inner { display: flex; align-items: center; overflow-x: auto; scrollbar-width: none; gap: 0; }
.gallery-filter-inner::-webkit-scrollbar { display: none; }
.gallery-filter-btn { padding: 15px 22px; font-size: 0.85rem; font-weight: 600; color: #555; text-decoration: none; white-space: nowrap; border: none; background: none; cursor: pointer; display: inline-block; transition: all 0.25s; border-bottom: 3px solid transparent; }
.gallery-filter-btn:hover { color: #002147; }
.gallery-filter-btn.active { color: #002147; border-bottom-color: #fab005; }

/* ===== Gallery Grid ===== */
.gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
@media(max-width:991px) { .gallery-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width:575px)  { .gallery-grid { grid-template-columns: repeat(1, 1fr); } }

.gal-item { border-radius: 14px; overflow: hidden; cursor: pointer; position: relative; box-shadow: 0 4px 18px rgba(0,0,0,0.08); height: 280px; }
.gal-item img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.45s ease; }
.gal-item:hover img { transform: scale(1.08); }
.gal-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(0,33,71,0.65), rgba(250,176,5,0.45)); display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.35s; padding: 20px; }
.gal-item:hover .gal-overlay { opacity: 1; }
.gal-overlay i { color: #fff; font-size: 2.5rem; margin-bottom: 10px; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.4)); }
.gal-overlay .gal-title { color: #fff; font-size: 0.88rem; font-weight: 700; text-align: center; line-height: 1.4; text-shadow: 0 2px 6px rgba(0,0,0,0.5); }

/* ===== Lightbox ===== */
.lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.94); z-index: 9999; align-items: center; justify-content: center; }
.lightbox.open { display: flex; }
.lightbox-wrap { position: relative; max-width: 92vw; max-height: 92vh; }
.lightbox-wrap img { max-width: 90vw; max-height: 85vh; border-radius: 10px; object-fit: contain; box-shadow: 0 30px 80px rgba(0,0,0,0.7); display: block; }
.lb-close { position: absolute; top: -50px; right: 0; background: none; border: none; color: #fff; font-size: 2rem; cursor: pointer; opacity: 0.8; transition: opacity 0.2s, transform 0.2s; line-height: 1; }
.lb-close:hover { opacity: 1; transform: rotate(90deg); }
.lb-nav { position: absolute; top: 50%; transform: translateY(-50%); width: 48px; height: 48px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 1.1rem; transition: background 0.25s; backdrop-filter: blur(5px); }
.lb-nav:hover { background: rgba(255,255,255,0.28); }
.lb-prev { left: -66px; }
.lb-next { right: -66px; }
.lb-counter { position: absolute; bottom: -38px; left: 50%; transform: translateX(-50%); color: rgba(255,255,255,0.6); font-size: 0.82rem; white-space: nowrap; }
@media(max-width:768px) { .lb-prev { left: 8px; } .lb-next { right: 8px; } }

/* ===== Pagination ===== */
.gallery-pagination { margin-top: 50px; }
.gallery-pagination .pagination .page-link { border-radius: 8px; margin: 0 3px; border: 1px solid #e2e8f0; color: #002147; font-weight: 600; padding: 8px 14px; transition: all 0.2s; }
.gallery-pagination .pagination .page-link:hover { background: #002147; color: #fff; border-color: #002147; }
.gallery-pagination .pagination .page-item.active .page-link { background: linear-gradient(135deg, #002147, #003b7a); border-color: transparent; color: #fff; }

/* ===== Empty State ===== */
.gallery-empty { text-align: center; padding: 80px 20px; }
.gallery-empty i { font-size: 4rem; color: #dde3ea; margin-bottom: 20px; display: block; }
</style>
@endpush

@section('contents')

    {{-- Page Hero --}}
    <section class="gallery-hero">
        <div class="container position-relative" style="z-index:1;">
            <div class="text-center">
                <span style="background:rgba(250,176,5,0.18); border:1px solid rgba(250,176,5,0.5); color:#fab005; font-size:0.75rem; font-weight:700; padding:6px 18px; border-radius:50px; display:inline-block; margin-bottom:14px; letter-spacing:0.8px; text-transform:uppercase;">Photo Gallery</span>
                <h1 class="fw-bold text-white mb-3" style="font-size:2.2rem;">আমাদের একাডেমির ছবি</h1>
                <p style="color:rgba(255,255,255,0.65); font-size:0.95rem; max-width:500px; margin:0 auto;">ক্যাম্পাস জীবন, ক্লাসরুম এবং শিক্ষার্থীদের বিশেষ মুহূর্তের সংগ্রহ।</p>
            </div>
        </div>
    </section>

    {{-- Filter Bar --}}
    <div class="gallery-filter-bar">
        <div class="container">
            <div class="gallery-filter-inner">
                <a href="?page=1" class="gallery-filter-btn {{ !request()->has('gallery_category_id') ? 'active' : '' }}">
                    <i class="fa-solid fa-grid-2 me-1"></i> সকল
                </a>
                @php
                    $galleryCategories = \App\Modules\Management\GalleryManagement\GalleryCategory\Models\Model::where('status', 'active')->get();
                @endphp
                @foreach($galleryCategories as $gcat)
                    <a href="?gallery_category_id={{ $gcat->id }}&page=1"
                       class="gallery-filter-btn {{ request('gallery_category_id') == $gcat->id ? 'active' : '' }}">
                        {{ $gcat->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Gallery Grid --}}
    <section class="py-5" style="background:#f4f7fb;">
        <div class="container py-3">
            @if($galleryImages->count() > 0)
                @php
                    $imgUrls = $galleryImages->pluck('image')->toArray();
                    $imgTitles = $galleryImages->pluck('title')->toArray();
                @endphp
                <div class="gallery-grid">
                    @foreach($galleryImages as $idx => $gmat)
                    <div class="gal-item" onclick="openLb({{ $idx }})">
                        <img src="{{ $gmat->image }}" alt="{{ $gmat->title }}" loading="lazy">
                        <div class="gal-overlay">
                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                            @if($gmat->title)
                                <div class="gal-title">{{ $gmat->title }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="gallery-pagination d-flex justify-content-center">
                    {!! $galleryImages->links() !!}
                </div>
            @else
                <div class="gallery-empty">
                    <i class="fa-regular fa-images"></i>
                    <h4 class="fw-bold mb-2" style="color:#002147;">কোনো ছবি পাওয়া যায়নি</h4>
                    <p class="text-muted">অন্য ক্যাটাগরি দেখুন অথবা পরে আবার চেষ্টা করুন।</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Lightbox --}}
    <div class="lightbox" id="lightbox" onclick="lbBgClose(event)">
        <div class="lightbox-wrap">
            <button class="lb-close" onclick="closeLb()"><i class="fa-solid fa-xmark"></i></button>
            <button class="lb-nav lb-prev" onclick="lbNav(-1)"><i class="fa-solid fa-chevron-left"></i></button>
            <img id="lbImg" src="" alt="Gallery Preview">
            <button class="lb-nav lb-next" onclick="lbNav(1)"><i class="fa-solid fa-chevron-right"></i></button>
            <div class="lb-counter" id="lbCounter"></div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
var lbImages = {!! json_encode($imgUrls ?? []) !!};
var lbTitles = {!! json_encode($imgTitles ?? []) !!};
var lbCurrent = 0;

function openLb(idx) {
    lbCurrent = idx;
    document.getElementById('lbImg').src = lbImages[idx];
    document.getElementById('lbImg').alt = lbTitles[idx] || '';
    document.getElementById('lbCounter').textContent = (idx + 1) + ' / ' + lbImages.length;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLb() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
function lbBgClose(e) {
    if (e.target === document.getElementById('lightbox')) closeLb();
}
function lbNav(dir) {
    lbCurrent = (lbCurrent + dir + lbImages.length) % lbImages.length;
    document.getElementById('lbImg').src = lbImages[lbCurrent];
    document.getElementById('lbImg').alt = lbTitles[lbCurrent] || '';
    document.getElementById('lbCounter').textContent = (lbCurrent + 1) + ' / ' + lbImages.length;
}
document.addEventListener('keydown', function(e) {
    if (!document.getElementById('lightbox').classList.contains('open')) return;
    if (e.key === 'Escape')      closeLb();
    if (e.key === 'ArrowLeft')   lbNav(-1);
    if (e.key === 'ArrowRight')  lbNav(1);
});
</script>
@endpush
