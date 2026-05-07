@php
    $meta = [
        'seo' => [
            'title' => ($blog->title ?? 'Blog') . ' — TechPark English',
            'image' => $blog->images ? asset($blog->images) : asset('seo.jpg'),
        ],
    ];
    $word_count = str_word_count(strip_tags($blog->description ?? ''));
    $read_time  = max(1, (int) ceil($word_count / 200));

    $recent_blogs = \App\Modules\Management\BlogManagement\Blog\Models\Model
        ::where('is_published', 1)
        ->where('status', 'active')
        ->where('id', '!=', $blog->id)
        ->latest()
        ->limit(4)
        ->get(['id','title','images','slug','created_at']);

    $all_categories = \App\Modules\Management\BlogManagement\BlogCategory\Models\Model
        ::active()->get();
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
    /* ── Hero ── */
    .bd-hero {
        background: linear-gradient(135deg, #001830 0%, #002147 65%, #003b7a 100%);
        padding: 60px 0 55px; position: relative; overflow: hidden;
    }
    .bd-hero::before {
        content: ''; position: absolute; top: -80px; right: -60px;
        width: 400px; height: 400px; background: rgba(250,176,5,0.06); border-radius: 50%;
    }
    .bd-hero::after {
        content: ''; position: absolute; bottom: -100px; left: -70px;
        width: 350px; height: 350px; background: rgba(255,255,255,0.025); border-radius: 50%;
    }
    .bd-back {
        display: inline-flex; align-items: center; gap: 7px;
        color: rgba(255,255,255,0.5); font-size: 0.82rem; text-decoration: none;
        margin-bottom: 20px; transition: color 0.2s;
    }
    .bd-back:hover { color: #fab005; }
    .bd-cat-pill {
        display: inline-block; background: #fab005; color: #001830;
        font-size: 0.7rem; font-weight: 800; padding: 5px 14px;
        border-radius: 50px; margin-bottom: 16px; letter-spacing: 0.6px; text-transform: uppercase;
    }
    .bd-hero h1 {
        font-size: clamp(1.6rem, 3.2vw, 2.5rem); font-weight: 800; color: #fff;
        line-height: 1.3; margin-bottom: 20px; max-width: 760px;
    }
    .bd-meta {
        display: flex; align-items: center; flex-wrap: wrap; gap: 18px;
    }
    .bd-meta-item {
        display: flex; align-items: center; gap: 7px;
        color: rgba(255,255,255,0.6); font-size: 0.82rem;
    }
    .bd-meta-item i { color: #fab005; }

    /* ── Cover image ── */
    .bd-cover-wrap {
        margin-top: -30px; position: relative; z-index: 2;
    }
    .bd-cover-img {
        width: 100%; max-height: 480px; object-fit: cover;
        border-radius: 18px; display: block;
        box-shadow: 0 24px 70px rgba(0,0,0,0.22);
        border: 4px solid #fff;
    }

    /* ── Layout ── */
    .bd-body { background: #f4f7fb; padding: 50px 0 80px; }
    .bd-row { display: flex; gap: 32px; align-items: flex-start; }
    .bd-main { flex: 1; min-width: 0; }
    .bd-sidebar { width: 330px; flex-shrink: 0; }
    @media(max-width: 991px) { .bd-row { flex-direction: column; } .bd-sidebar { width: 100%; } }

    /* ── Content card ── */
    .bd-card {
        background: #fff; border-radius: 18px; padding: 38px 42px;
        box-shadow: 0 4px 24px rgba(0,33,71,0.07); border: 1px solid #eef2f8;
        margin-bottom: 24px;
    }
    @media(max-width: 768px) { .bd-card { padding: 24px 20px; } }

    /* ── Blog content typography ── */
    .bd-content { font-size: 0.95rem; line-height: 1.9; color: #374151; }
    .bd-content h1, .bd-content h2, .bd-content h3,
    .bd-content h4, .bd-content h5 {
        font-weight: 800; color: #002147; margin: 28px 0 12px; line-height: 1.35;
    }
    .bd-content h2 { font-size: 1.45rem; padding-bottom: 8px; border-bottom: 2px solid #eef2f8; }
    .bd-content h3 { font-size: 1.2rem; }
    .bd-content p { margin-bottom: 18px; }
    .bd-content a { color: #002147; font-weight: 600; text-decoration: underline; text-underline-offset: 3px; }
    .bd-content a:hover { color: #fab005; }
    .bd-content img { max-width: 100%; border-radius: 12px; margin: 20px 0; box-shadow: 0 6px 24px rgba(0,0,0,0.1); }
    .bd-content ul, .bd-content ol { padding-left: 24px; margin-bottom: 18px; }
    .bd-content li { margin-bottom: 8px; }
    .bd-content blockquote {
        border-left: 4px solid #fab005; background: rgba(250,176,5,0.06);
        padding: 16px 22px; border-radius: 0 10px 10px 0; margin: 24px 0;
        color: #4a5568; font-style: italic; font-size: 1rem;
    }
    .bd-content code {
        background: #f1f5f9; color: #e11d48; padding: 2px 7px;
        border-radius: 4px; font-size: 0.88em;
    }
    .bd-content pre {
        background: #1e293b; color: #e2e8f0; padding: 22px;
        border-radius: 12px; overflow-x: auto; margin: 20px 0; font-size: 0.87rem;
    }
    .bd-content table {
        width: 100%; border-collapse: collapse; margin: 20px 0;
        border-radius: 10px; overflow: hidden; border: 1px solid #e8eef7;
    }
    .bd-content th { background: #002147; color: #fff; padding: 12px 16px; font-size: 0.85rem; text-align: left; }
    .bd-content td { padding: 11px 16px; border-bottom: 1px solid #eef2f8; font-size: 0.87rem; color: #4a5568; }
    .bd-content tr:nth-child(even) td { background: #f8fafd; }

    /* ── Share row ── */
    .bd-share {
        display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
        padding-top: 24px; margin-top: 24px; border-top: 2px solid #eef2f8;
    }
    .bd-share-label { font-size: 0.85rem; font-weight: 700; color: #5a6a85; }
    .share-btn {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 8px 18px; border-radius: 8px; font-size: 0.8rem; font-weight: 700;
        text-decoration: none; border: none; cursor: pointer; transition: all 0.2s;
    }
    .share-fb { background: #1877f2; color: #fff; }
    .share-fb:hover { background: #1464d4; color: #fff; }
    .share-tw { background: #1da1f2; color: #fff; }
    .share-tw:hover { background: #0d8fd9; color: #fff; }
    .share-wa { background: #25d366; color: #fff; }
    .share-wa:hover { background: #1ab956; color: #fff; }
    .share-copy { background: #f4f7fb; color: #5a6a85; border: 1px solid #e0e8f5; }
    .share-copy:hover { background: #e8eef7; }

    /* ── Sidebar cards ── */
    .sb-card {
        background: #fff; border-radius: 16px; padding: 24px 22px;
        box-shadow: 0 4px 20px rgba(0,33,71,0.07); border: 1px solid #eef2f8; margin-bottom: 22px;
    }
    .sb-title {
        font-size: 0.68rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
        color: #fab005; background: rgba(250,176,5,0.1); border: 1px solid rgba(250,176,5,0.2);
        padding: 4px 12px; border-radius: 50px; display: inline-block; margin-bottom: 18px;
    }

    /* Recent posts */
    .recent-post {
        display: flex; gap: 13px; align-items: flex-start;
        padding: 12px 0; border-bottom: 1px solid #eef2f8;
    }
    .recent-post:last-child { border-bottom: none; padding-bottom: 0; }
    .recent-post img {
        width: 66px; height: 56px; object-fit: cover; border-radius: 10px; flex-shrink: 0;
    }
    .recent-post-info a {
        font-size: 0.85rem; font-weight: 700; color: #1a2540; line-height: 1.4;
        text-decoration: none; display: block; margin-bottom: 5px;
    }
    .recent-post-info a:hover { color: #002147; }
    .recent-post-date { font-size: 0.75rem; color: #8a9ab5; display: flex; align-items: center; gap: 5px; }
    .recent-post-date i { color: #fab005; }

    /* Categories sidebar */
    .cat-pill-link {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f4f7fb; border: 1px solid #e0e8f5; color: #5a6a85;
        padding: 7px 14px; border-radius: 50px; font-size: 0.8rem; font-weight: 600;
        text-decoration: none; margin: 0 5px 8px 0; transition: all 0.2s;
    }
    .cat-pill-link:hover, .cat-pill-link.active {
        background: #002147; color: #fff; border-color: #002147;
    }

    /* Subscribe sidebar */
    .sb-sub-form { display: flex; flex-direction: column; gap: 10px; }
    .sb-sub-form input[type="text"] {
        border: 1px solid #e0e8f5; border-radius: 10px; padding: 11px 15px;
        font-size: 0.87rem; outline: none; color: #374151; transition: border-color 0.2s;
    }
    .sb-sub-form input[type="text"]:focus { border-color: #fab005; }
    .sb-sub-btn {
        background: linear-gradient(135deg, #fab005, #e09600); color: #fff;
        border: none; border-radius: 10px; padding: 12px; font-weight: 700;
        font-size: 0.87rem; cursor: pointer; transition: all 0.25s;
    }
    .sb-sub-btn:hover { background: linear-gradient(135deg, #e09600, #c07800); }

    /* ── Transition ── */
    .modal-fade-enter-active, .modal-fade-leave-active { transition: opacity .2s; }
    .modal-fade-enter-from, .modal-fade-leave-to { opacity: 0; }
</style>
@endpush

@section('contents')

{{-- ── Hero ── --}}
<section class="bd-hero">
    <div class="container position-relative" style="z-index:1;">
        <a href="{{ route('blog') }}" class="bd-back">
            <i class="fa-solid fa-arrow-left"></i> সকল পোস্ট
        </a>
        @if($blog->category)
        <div><span class="bd-cat-pill">{{ strtoupper($blog->category->title) }}</span></div>
        @endif
        <h1>{{ $blog->title }}</h1>
        <div class="bd-meta">
            <span class="bd-meta-item"><i class="fa-regular fa-calendar"></i> {{ $blog->created_at->format('d F Y') }}</span>
            <span class="bd-meta-item"><i class="fa-regular fa-clock"></i> {{ $read_time }} min read</span>
            @if($blog->creator)
            <span class="bd-meta-item"><i class="fa-solid fa-user-pen"></i> {{ $blog->creator }}</span>
            @endif
        </div>
    </div>
</section>

{{-- ── Body ── --}}
<div class="bd-body">
    <div class="container">

        {{-- Cover image --}}
        @if($blog->images)
        <div class="bd-cover-wrap mb-4">
            <img src="{{ assetHelper($blog->images) }}" alt="{{ $blog->title }}" class="bd-cover-img" loading="lazy">
        </div>
        @endif

        <div class="bd-row">

            {{-- ── Main content ── --}}
            <div class="bd-main">
                <div class="bd-card">
                    <div class="bd-content">
                        {!! $blog->description !!}
                    </div>

                    {{-- Share ── --}}
                    <div class="bd-share">
                        <span class="bd-share-label">শেয়ার করুন:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                           target="_blank" class="share-btn share-fb">
                            <i class="fa-brands fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}"
                           target="_blank" class="share-btn share-tw">
                            <i class="fa-brands fa-x-twitter"></i> Twitter
                        </a>
                        <a href="https://api.whatsapp.com/send/?text={{ urlencode($blog->title . ' ' . url()->current()) }}&type=phone_number&app_absent=0"
                           target="_blank" class="share-btn share-wa">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </a>
                        <button class="share-btn share-copy" onclick="copyLink(this)">
                            <i class="fa-regular fa-copy"></i> Copy Link
                        </button>
                    </div>
                </div>
            </div>

            {{-- ── Sidebar ── --}}
            <aside class="bd-sidebar">

                {{-- Categories --}}
                @if($all_categories->count())
                <div class="sb-card">
                    <div class="sb-title">ক্যাটাগরি</div>
                    <div>
                        <a href="{{ route('blog') }}" class="cat-pill-link">
                            <i class="fa-solid fa-border-all" style="font-size:0.7rem;"></i> সব পোস্ট
                        </a>
                        @foreach($all_categories as $cat)
                        <a href="{{ route('blog', ['category' => $cat->slug]) }}"
                           class="cat-pill-link {{ optional($blog->category)->slug == $cat->slug ? 'active' : '' }}">
                            {{ $cat->title }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Recent posts --}}
                @if($recent_blogs->count())
                <div class="sb-card">
                    <div class="sb-title">সাম্প্রতিক পোস্ট</div>
                    @foreach($recent_blogs as $rb)
                    <div class="recent-post">
                        <img src="{{ assetHelper(optional($rb)->images) }}" alt="{{ $rb->title }}" loading="lazy">
                        <div class="recent-post-info">
                            <a href="{{ route('blog_details', $rb->slug) }}">{{ \Str::limit($rb->title, 55) }}</a>
                            <span class="recent-post-date">
                                <i class="fa-regular fa-calendar"></i> {{ $rb->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Subscribe --}}
                <div class="sb-card">
                    <div class="sb-title">নিউজলেটার</div>
                    <p style="font-size:0.84rem; color:#6b7a99; margin-bottom:16px;">
                        নতুন পোস্ট সবার আগে পেতে সাবস্ক্রাইব করুন।
                    </p>
                    <form action="{{ route('blog.subscribe') }}" method="POST" class="sb-sub-form">
                        @csrf
                        <input type="text" name="email" placeholder="আপনার ইমেইল" value="{{ old('email') }}">
                        @error('email')
                        <span style="color:#e53e3e; font-size:0.78rem;">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="sb-sub-btn">
                            <i class="fa-solid fa-paper-plane me-1"></i> Subscribe করুন
                        </button>
                    </form>
                </div>

            </aside>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function copyLink(btn) {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Copied!';
        btn.style.background = '#dcfce7';
        btn.style.color = '#16a34a';
        btn.style.borderColor = '#86efac';
        setTimeout(() => {
            btn.innerHTML = orig;
            btn.style.background = '';
            btn.style.color = '';
            btn.style.borderColor = '';
        }, 2000);
    });
}
</script>
@endpush
