@php
    $meta = [
        'seo' => [
            'title' => 'Blog — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
    $active_category = request()->get('category');
@endphp

@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ════════════════════════════════
   HERO
════════════════════════════════ */
.blg-hero {
    background: linear-gradient(135deg,#001225 0%,#001f40 55%,#002f65 100%);
    padding: 72px 0 64px;
    position: relative;
    overflow: hidden;
}
.blg-hero::before {
    content:'';
    position:absolute; top:-100px; right:-80px;
    width:500px; height:500px;
    background:radial-gradient(circle,rgba(250,176,5,0.08) 0%,transparent 70%);
    border-radius:50%;
}
.blg-hero::after {
    content:'';
    position:absolute; bottom:-140px; left:-100px;
    width:440px; height:440px;
    background:radial-gradient(circle,rgba(255,255,255,0.03) 0%,transparent 70%);
    border-radius:50%;
}
.blg-hero-dots {
    position:absolute; inset:0;
    background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events:none;
}
.blg-badge {
    display:inline-flex; align-items:center; gap:8px;
    background:rgba(250,176,5,0.12); border:1px solid rgba(250,176,5,0.35);
    color:#fab005; font-size:0.7rem; font-weight:800;
    padding:6px 18px; border-radius:50px; margin-bottom:20px;
    letter-spacing:1px; text-transform:uppercase;
}
.blg-hero-title {
    font-size: clamp(2.2rem,4.5vw,3.4rem);
    font-weight:900; color:#fff; line-height:1.18; margin-bottom:16px;
}
.blg-hero-title span { color:#fab005; }
.blg-hero-desc {
    color:rgba(255,255,255,0.58); font-size:0.95rem; line-height:1.75;
    max-width:480px; margin-bottom:32px;
}
.blg-hero-stats {
    display:flex; align-items:center; gap:28px; flex-wrap:wrap;
}
.blg-stat {
    text-align:center;
    padding:0 20px 0 0;
    border-right:1px solid rgba(255,255,255,0.12);
}
.blg-stat:last-child { border-right:none; padding-right:0; }
.blg-stat-num { font-size:1.7rem; font-weight:900; color:#fab005; line-height:1; }
.blg-stat-lbl { font-size:0.72rem; color:rgba(255,255,255,0.45); margin-top:4px; font-weight:600; letter-spacing:0.4px; }

/* ── Featured article card ── */
.blg-feat-wrap { position:relative; z-index:1; }
.blg-feat-card {
    border-radius:20px; overflow:hidden; display:block;
    text-decoration:none; position:relative;
    box-shadow:0 32px 80px rgba(0,0,0,0.55);
    background:#000;
}
.blg-feat-card img {
    width:100%; height:380px; object-fit:cover; display:block;
    transition:transform 0.55s ease, opacity 0.4s ease;
    opacity:0.78;
}
.blg-feat-card:hover img { transform:scale(1.05); opacity:0.65; }
.blg-feat-overlay {
    position:absolute; inset:0;
    background:linear-gradient(to top,rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.45) 48%,transparent 100%);
    display:flex; flex-direction:column; justify-content:flex-end;
    padding:28px 28px 26px;
}
.blg-feat-cat {
    align-self:flex-start;
    background:#fab005; color:#001225;
    font-size:0.66rem; font-weight:800; padding:5px 13px;
    border-radius:5px; margin-bottom:11px;
    letter-spacing:0.5px; text-transform:uppercase;
}
.blg-feat-title {
    font-size:clamp(1.1rem,2.2vw,1.5rem); font-weight:800; color:#fff;
    line-height:1.35; margin-bottom:14px;
}
.blg-feat-meta {
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;
}
.blg-feat-meta-left {
    display:flex; align-items:center; gap:14px;
}
.blg-feat-meta-left span {
    color:rgba(255,255,255,0.55); font-size:0.78rem;
    display:flex; align-items:center; gap:5px;
}
.blg-feat-meta-left span i { color:#fab005; font-size:0.7rem; }
.blg-feat-readbtn {
    background:rgba(250,176,5,0.92); color:#001225;
    font-size:0.78rem; font-weight:800; padding:9px 20px;
    border-radius:8px; text-decoration:none; display:inline-flex;
    align-items:center; gap:7px; transition:background 0.2s, transform 0.2s;
    white-space:nowrap;
}
.blg-feat-readbtn:hover { background:#fab005; color:#001225; transform:translateY(-1px); }
.blg-feat-badge {
    position:absolute; top:16px; right:16px;
    background:rgba(0,18,37,0.75); backdrop-filter:blur(8px);
    border:1px solid rgba(250,176,5,0.3); color:#fab005;
    font-size:0.68rem; font-weight:800; padding:5px 13px; border-radius:50px;
    letter-spacing:0.5px;
}

/* ════════════════════════════════
   FILTER BAR
════════════════════════════════ */
.blg-filter {
    background:#fff;
    border-bottom:2px solid #e5ecf7;
    position:sticky; top:0; z-index:200;
    box-shadow:0 2px 12px rgba(0,33,71,0.06);
}
.blg-filter .container {
    display:flex; align-items:center; gap:0;
    overflow-x:auto; scrollbar-width:none;
    -webkit-overflow-scrolling:touch;
}
.blg-filter .container::-webkit-scrollbar { display:none; }
.blg-ftab {
    flex-shrink:0; padding:16px 26px;
    font-size:0.86rem; font-weight:700;
    color:#64748b; text-decoration:none;
    border-bottom:3px solid transparent; margin-bottom:-2px;
    transition:all 0.22s; white-space:nowrap;
    display:inline-flex; align-items:center; gap:7px;
}
.blg-ftab:hover { color:#001f40; }
.blg-ftab.active { color:#001f40; border-bottom-color:#fab005; font-weight:800; }
.blg-ftab-count {
    font-size:0.65rem; background:#f1f5f9; color:#94a3b8;
    padding:2px 8px; border-radius:50px; font-weight:700;
}
.blg-ftab.active .blg-ftab-count { background:rgba(250,176,5,0.15); color:#e09600; }

/* ════════════════════════════════
   CONTENT SECTION
════════════════════════════════ */
.blg-content { background:#f0f4fb; padding:56px 0 80px; }

.blg-sec-header { margin-bottom:36px; }
.blg-sec-label {
    font-size:0.65rem; font-weight:800; letter-spacing:1.2px;
    text-transform:uppercase; color:#fab005;
    background:rgba(250,176,5,0.1); border:1px solid rgba(250,176,5,0.25);
    padding:4px 14px; border-radius:50px; display:inline-block; margin-bottom:10px;
}
.blg-sec-title { font-size:1.5rem; font-weight:900; color:#001f40; margin:0; }
.blg-sec-sub { color:#7a8aa8; font-size:0.88rem; margin-top:5px; }

/* ── Blog card ── */
.blg-card {
    background:#fff; border-radius:18px; overflow:hidden;
    box-shadow:0 3px 20px rgba(0,31,64,0.06);
    border:1px solid #e8eef8;
    transition:all 0.32s ease;
    height:100%; display:flex; flex-direction:column;
}
.blg-card:hover {
    transform:translateY(-9px);
    box-shadow:0 22px 55px rgba(0,31,64,0.13);
    border-color:#d8e4f5;
}
.blg-card-img { position:relative; overflow:hidden; flex-shrink:0; }
.blg-card-img img {
    width:100%; height:218px; object-fit:cover; display:block;
    transition:transform 0.42s ease;
}
.blg-card:hover .blg-card-img img { transform:scale(1.07); }
.blg-card-cat {
    position:absolute; top:14px; left:14px;
    background:#001f40; color:#fff;
    font-size:0.64rem; font-weight:800; padding:5px 12px;
    border-radius:5px; letter-spacing:0.4px; text-transform:uppercase;
    box-shadow:0 3px 10px rgba(0,0,0,0.25);
}
.blg-card-readtime {
    position:absolute; top:14px; right:14px;
    background:rgba(0,0,0,0.55); backdrop-filter:blur(6px);
    color:#fff; font-size:0.67rem; font-weight:700;
    padding:4px 10px; border-radius:5px; display:flex; align-items:center; gap:5px;
}
.blg-card-body { padding:22px 22px 18px; flex:1; display:flex; flex-direction:column; }
.blg-card-date {
    font-size:0.74rem; color:#94a3b8; margin-bottom:10px;
    display:flex; align-items:center; gap:6px;
}
.blg-card-date i { color:#fab005; font-size:0.7rem; }
.blg-card-title {
    font-size:1rem; font-weight:800; color:#1a2845; line-height:1.45;
    text-decoration:none; display:block; flex:1; margin-bottom:18px;
}
.blg-card-title:hover { color:#001f40; }
.blg-card-footer {
    display:flex; align-items:center; justify-content:space-between;
    padding-top:14px; border-top:1px solid #eef2fa;
}
.blg-card-author {
    display:flex; align-items:center; gap:8px;
    font-size:0.76rem; color:#7a8aa8;
}
.blg-card-author i { color:#fab005; }
.blg-readmore {
    font-size:0.78rem; font-weight:800; color:#001f40;
    text-decoration:none; display:flex; align-items:center; gap:5px;
    transition:color 0.2s, gap 0.2s;
    background:#f0f4fb; border:1px solid #dde8f5;
    padding:6px 14px; border-radius:7px;
}
.blg-readmore:hover { color:#fab005; gap:8px; background:#fff; border-color:#fab005; }

/* ── Horizontal card (wide) ── */
.blg-card-h {
    background:#fff; border-radius:18px; overflow:hidden;
    box-shadow:0 3px 20px rgba(0,31,64,0.06); border:1px solid #e8eef8;
    transition:all 0.32s ease; display:flex; flex-direction:row;
    text-decoration:none; height:100%;
}
.blg-card-h:hover {
    transform:translateY(-6px);
    box-shadow:0 20px 50px rgba(0,31,64,0.12);
    border-color:#d8e4f5;
}
.blg-card-h-img { width:46%; flex-shrink:0; position:relative; overflow:hidden; }
.blg-card-h-img img {
    width:100%; height:100%; min-height:220px; object-fit:cover; display:block;
    transition:transform 0.42s ease;
}
.blg-card-h:hover .blg-card-h-img img { transform:scale(1.06); }
.blg-card-h-cat {
    position:absolute; top:14px; left:14px;
    background:#001f40; color:#fff;
    font-size:0.63rem; font-weight:800; padding:4px 11px;
    border-radius:4px; letter-spacing:0.4px; text-transform:uppercase;
}
.blg-card-h-body { padding:24px 24px 20px; display:flex; flex-direction:column; flex:1; }
.blg-card-h-date {
    font-size:0.74rem; color:#94a3b8; margin-bottom:10px;
    display:flex; align-items:center; gap:6px;
}
.blg-card-h-date i { color:#fab005; font-size:0.7rem; }
.blg-card-h-title {
    font-size:1.05rem; font-weight:800; color:#1a2845; line-height:1.45;
    margin-bottom:10px; flex:1; text-decoration:none; display:block;
}
.blg-card-h-title:hover { color:#001f40; }
.blg-card-h-excerpt {
    font-size:0.82rem; color:#7a8aa8; line-height:1.65;
    margin-bottom:16px; display:-webkit-box;
    -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
}
.blg-card-h-footer {
    display:flex; align-items:center; justify-content:space-between;
    padding-top:12px; border-top:1px solid #eef2fa;
}
@media(max-width:640px) { .blg-card-h { flex-direction:column; } .blg-card-h-img { width:100%; } }

/* ── Pagination ── */
.blg-pager { margin-top:52px; display:flex; justify-content:center; }
.blg-pager .pagination { gap:6px; flex-wrap:wrap; justify-content:center; }
.blg-pager .page-link {
    border-radius:9px !important; border:1px solid #dde8f5;
    color:#001f40; padding:9px 17px; font-weight:700; font-size:0.83rem;
    transition:all 0.2s; background:#fff;
}
.blg-pager .page-link:hover { background:#001f40; color:#fff; border-color:#001f40; }
.blg-pager .page-item.active .page-link { background:#001f40; border-color:#001f40; color:#fff; }

/* ── Empty ── */
.blg-empty { text-align:center; padding:80px 20px; }
.blg-empty-icon {
    width:80px; height:80px; background:#f0f4fb; border-radius:20px;
    display:flex; align-items:center; justify-content:center;
    font-size:2.2rem; color:#bfccdf; margin:0 auto 22px;
}
.blg-empty h3 { font-size:1.25rem; font-weight:800; color:#3a4a6b; margin-bottom:8px; }
.blg-empty p { color:#7a8aa8; font-size:0.9rem; }

/* ════════════════════════════════
   SUBSCRIBE
════════════════════════════════ */
.blg-sub-section {
    background:linear-gradient(135deg,#001225 0%,#001f40 100%);
    padding:80px 0; position:relative; overflow:hidden;
}
.blg-sub-section::before {
    content:''; position:absolute;
    top:-80px; right:-60px; width:420px; height:420px;
    background:radial-gradient(circle,rgba(250,176,5,0.07) 0%,transparent 70%);
    border-radius:50%;
}
.blg-sub-section::after {
    content:''; position:absolute;
    bottom:-100px; left:-80px; width:360px; height:360px;
    background:radial-gradient(circle,rgba(255,255,255,0.03) 0%,transparent 70%);
    border-radius:50%;
}
.blg-sub-wrap { max-width:560px; margin:0 auto; text-align:center; position:relative; z-index:1; }
.blg-sub-icon {
    width:64px; height:64px;
    background:linear-gradient(135deg,rgba(250,176,5,0.2),rgba(250,176,5,0.08));
    border:1px solid rgba(250,176,5,0.3); border-radius:18px;
    display:flex; align-items:center; justify-content:center;
    font-size:1.6rem; color:#fab005; margin:0 auto 24px;
}
.blg-sub-wrap h2 { font-size:1.9rem; font-weight:900; color:#fff; margin-bottom:10px; }
.blg-sub-wrap p { color:rgba(255,255,255,0.52); font-size:0.92rem; margin-bottom:32px; line-height:1.7; }
.blg-sub-form { display:flex; gap:10px; max-width:460px; margin:0 auto; }
.blg-sub-form input {
    flex:1; border:1px solid rgba(255,255,255,0.13);
    background:rgba(255,255,255,0.07); color:#fff;
    border-radius:12px; padding:14px 18px; font-size:0.88rem;
    outline:none; transition:border-color 0.2s;
}
.blg-sub-form input::placeholder { color:rgba(255,255,255,0.3); }
.blg-sub-form input:focus { border-color:rgba(250,176,5,0.5); background:rgba(255,255,255,0.1); }
.blg-sub-btn {
    background:linear-gradient(135deg,#fab005,#e09600); color:#fff;
    border:none; border-radius:12px; padding:14px 26px; font-weight:800;
    font-size:0.88rem; cursor:pointer; white-space:nowrap;
    transition:all 0.25s; box-shadow:0 6px 20px rgba(250,176,5,0.35);
}
.blg-sub-btn:hover { background:linear-gradient(135deg,#e09600,#c07800); transform:translateY(-2px); box-shadow:0 10px 28px rgba(250,176,5,0.45); }
@media(max-width:540px) { .blg-sub-form { flex-direction:column; } }
</style>
@endpush

@section('contents')

{{-- ════════ HERO ════════ --}}
<section class="blg-hero">
    <div class="blg-hero-dots"></div>
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center g-5">

            {{-- Left: heading --}}
            <div class="col-lg-5">
                <div class="blg-badge">
                    <i class="fa-solid fa-feather-pointed"></i> TechPark Blog
                </div>
                <h1 class="blg-hero-title">
                    শিখুন, বাড়ুন,<br><span>সফল হোন</span>
                </h1>
                <p class="blg-hero-desc">
                    ইংরেজি শেখার টিপস, পরীক্ষার গাইড, সাফল্যের গল্প এবং ক্যারিয়ার টিপস — সব এক জায়গায়।
                </p>
                <div class="blg-hero-stats">
                    <div class="blg-stat">
                        <div class="blg-stat-num">{{ $blogs->total() + ($blog_single ? 1 : 0) }}</div>
                        <div class="blg-stat-lbl">মোট পোস্ট</div>
                    </div>
                    <div class="blg-stat">
                        <div class="blg-stat-num">{{ $blog_categories->count() }}</div>
                        <div class="blg-stat-lbl">ক্যাটাগরি</div>
                    </div>
                    <div class="blg-stat">
                        <div class="blg-stat-num">5K+</div>
                        <div class="blg-stat-lbl">পাঠক</div>
                    </div>
                </div>
            </div>

            {{-- Right: featured article --}}
            <div class="col-lg-7">
                @if($blog_single)
                <div class="blg-feat-wrap">
                    <span class="blg-feat-badge"><i class="fa-solid fa-star" style="font-size:0.6rem;"></i> Featured</span>
                    <a href="{{ route('blog_details', $blog_single->slug) }}" class="blg-feat-card">
                        <img src="{{ assetHelper(optional($blog_single)->images) }}" alt="{{ $blog_single->title }}" loading="lazy">
                        <div class="blg-feat-overlay">
                            @if($blog_single->category)
                            <span class="blg-feat-cat">{{ $blog_single->category->title }}</span>
                            @endif
                            <div class="blg-feat-title">{{ $blog_single->title }}</div>
                            <div class="blg-feat-meta">
                                <div class="blg-feat-meta-left">
                                    <span><i class="fa-regular fa-calendar"></i> {{ $blog_single->created_at->format('d M Y') }}</span>
                                    <span><i class="fa-regular fa-clock"></i> {{ rand(5,12) }} min read</span>
                                </div>
                                <span class="blg-feat-readbtn">
                                    পড়ুন <i class="fa-solid fa-arrow-right" style="font-size:0.72rem;"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- ════════ FILTER BAR ════════ --}}
@if($blog_categories->count())
<div class="blg-filter">
    <div class="container">
        <a href="{{ route('blog') }}"
           class="blg-ftab {{ !$active_category ? 'active' : '' }}">
            <i class="fa-solid fa-border-all" style="font-size:0.72rem;"></i>
            সব পোস্ট
            <span class="blg-ftab-count">{{ $blogs->total() }}</span>
        </a>
        @foreach($blog_categories as $cat)
        <a href="{{ route('blog', ['category' => $cat->slug]) }}"
           class="blg-ftab {{ $active_category == $cat->slug ? 'active' : '' }}">
            {{ $cat->title }}
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- ════════ BLOG CONTENT ════════ --}}
<section class="blg-content">
    <div class="container">

        <div class="blg-sec-header">
            <div class="blg-sec-label">
                {{ $active_category ? 'ক্যাটাগরি' : 'সকল পোস্ট' }}
            </div>
            <h2 class="blg-sec-title">
                @if($active_category)
                    {{ $blog_categories->where('slug', $active_category)->first()?->title ?? '' }}
                @else
                    সাম্প্রতিক ব্লগ পোস্ট
                @endif
            </h2>
            @if($blogs->count())
            <p class="blg-sec-sub">{{ $blogs->total() }}টি পোস্ট পাওয়া গেছে</p>
            @endif
        </div>

        @if($blogs->count() > 0)

        {{-- First 2 items: horizontal wide cards --}}
        @if($blogs->count() >= 2)
        <div class="row g-4 mb-4">
            @foreach($blogs->take(2) as $blog)
            <div class="col-md-6">
                <a href="{{ route('blog_details', $blog->slug) }}" class="blg-card-h">
                    <div class="blg-card-h-img">
                        <img src="{{ assetHelper(optional($blog)->images) }}" alt="{{ $blog->title }}" loading="lazy">
                        @if($blog->category)
                        <span class="blg-card-h-cat">{{ $blog->category->title }}</span>
                        @endif
                    </div>
                    <div class="blg-card-h-body">
                        <div class="blg-card-h-date">
                            <i class="fa-regular fa-calendar"></i>
                            {{ $blog->created_at->format('d M Y') }}
                            &nbsp;·&nbsp;
                            <i class="fa-regular fa-clock"></i>
                            {{ rand(5,14) }} min
                        </div>
                        <span class="blg-card-h-title">{{ $blog->title }}</span>
                        <div class="blg-card-h-footer">
                            <span style="font-size:0.75rem; color:#94a3b8; display:flex; align-items:center; gap:6px;">
                                <i class="fa-solid fa-user-pen" style="color:#fab005;"></i>
                                {{ $blog->creator ?? 'TechPark' }}
                            </span>
                            <span class="blg-readmore">পড়ুন <i class="fa-solid fa-arrow-right" style="font-size:0.7rem;"></i></span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Remaining items: 3-column grid --}}
        @php $remaining = $blogs->skip(2); @endphp
        @if($remaining->count() > 0)
        <div class="row g-4">
            @foreach($remaining as $blog)
            <div class="col-md-6 col-lg-4">
                <div class="blg-card">
                    <div class="blg-card-img">
                        <img src="{{ assetHelper(optional($blog)->images) }}" alt="{{ $blog->title }}" loading="lazy">
                        @if($blog->category)
                        <span class="blg-card-cat">{{ $blog->category->title }}</span>
                        @endif
                        <span class="blg-card-readtime">
                            <i class="fa-regular fa-clock" style="font-size:0.65rem;"></i> {{ rand(4,14) }} min
                        </span>
                    </div>
                    <div class="blg-card-body">
                        <div class="blg-card-date">
                            <i class="fa-regular fa-calendar"></i>
                            {{ $blog->created_at->format('d M Y') }}
                        </div>
                        <a href="{{ route('blog_details', $blog->slug) }}" class="blg-card-title">
                            {{ $blog->title }}
                        </a>
                        <div class="blg-card-footer">
                            <span class="blg-card-author">
                                <i class="fa-solid fa-user-pen"></i>
                                {{ $blog->creator ?? 'TechPark' }}
                            </span>
                            <a href="{{ route('blog_details', $blog->slug) }}" class="blg-readmore">
                                পড়ুন <i class="fa-solid fa-arrow-right" style="font-size:0.7rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Pagination --}}
        <div class="blg-pager">
            {{ $blogs->appends(request()->query())->links() }}
        </div>

        @else
        <div class="blg-empty">
            <div class="blg-empty-icon"><i class="fa-regular fa-newspaper"></i></div>
            <h3>কোনো পোস্ট পাওয়া যায়নি</h3>
            <p>এই ক্যাটাগরিতে এখনো কোনো পোস্ট নেই। অন্য ক্যাটাগরি দেখুন।</p>
        </div>
        @endif

    </div>
</section>

{{-- ════════ SUBSCRIBE ════════ --}}
<section class="blg-sub-section">
    <div class="container">
        <div class="blg-sub-wrap">
            <div class="blg-sub-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
            <h2>নিউজলেটার সাবস্ক্রাইব করুন</h2>
            <p>নতুন ব্লগ পোস্ট, ইংরেজি শেখার টিপস এবং কোর্স আপডেট সবার আগে পেতে সাবস্ক্রাইব করুন।</p>
            <form action="{{ route('blog.subscribe') }}" method="POST">
                @csrf
                <div class="blg-sub-form">
                    <input type="text" name="email" placeholder="আপনার ইমেইল ঠিকানা" value="{{ old('email') }}">
                    <button type="submit" class="blg-sub-btn">
                        <i class="fa-solid fa-paper-plane me-1"></i> Subscribe
                    </button>
                </div>
                @error('email')
                <p style="color:#ff8a80; font-size:0.82rem; margin-top:10px; text-align:center;">{{ $message }}</p>
                @enderror
            </form>
        </div>
    </div>
</section>

@endsection
