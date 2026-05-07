@php
    $meta = [
        'seo' => [
            'title' => $course->title . ' — TechPark English',
            'image' => $course->thumbnail ? asset($course->thumbnail) : asset('seo.jpg'),
        ],
    ];
    preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $course->promo_video_url ?? '', $vm);
    $vid_id = $vm[1] ?? null;
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
    @@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.2} }
    .live-dot { display:inline-block; width:7px; height:7px; background:#e91e63; border-radius:50%; animation:blink 1.2s infinite; vertical-align:middle; margin-right:4px; }

    /* ===== Hero ===== */
    .lcd-hero { background:linear-gradient(135deg,#001830 0%,#002147 65%,#003b7a 100%); padding:55px 0 50px; position:relative; overflow:hidden; }
    .lcd-hero::before { content:''; position:absolute; top:-100px; left:-80px; width:420px; height:420px; background:rgba(250,176,5,0.05); border-radius:50%; pointer-events:none; }
    .lcd-hero::after  { content:''; position:absolute; bottom:-120px; right:-60px; width:360px; height:360px; background:rgba(255,255,255,0.02); border-radius:50%; pointer-events:none; }

    .lcd-back { color:rgba(255,255,255,0.5); font-size:0.82rem; text-decoration:none; display:inline-flex; align-items:center; gap:6px; margin-bottom:18px; transition:color 0.2s; }
    .lcd-back:hover { color:#fab005; }
    .lcd-type-badge { display:inline-flex; align-items:center; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:#fff; font-size:0.72rem; font-weight:700; padding:5px 14px; border-radius:6px; margin-bottom:18px; letter-spacing:0.5px; }
    .lcd-hero h1 { font-size:clamp(1.6rem,3.2vw,2.4rem); font-weight:800; color:#fff; line-height:1.3; margin-bottom:16px; }
    .lcd-hero-desc { color:rgba(255,255,255,0.72); font-size:0.88rem; line-height:1.75; margin-bottom:28px; max-width:520px; }
    .btn-enroll-hero { background:linear-gradient(135deg,#fab005,#e09600); color:#fff; border:none; border-radius:8px; padding:14px 32px; font-weight:700; font-size:0.95rem; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all 0.3s; box-shadow:0 6px 20px rgba(250,176,5,0.4); }
    .btn-enroll-hero:hover { background:linear-gradient(135deg,#e09600,#c07800); color:#fff; transform:translateY(-2px); box-shadow:0 10px 28px rgba(250,176,5,0.5); }

    /* Video in hero */
    .lcd-hero-video { border-radius:14px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.4); aspect-ratio:16/9; background:#000; position:relative; z-index:1; }
    .lcd-hero-video iframe { width:100%; height:100%; border:none; display:block; }
    .lcd-hero-thumb { width:100%; height:100%; object-fit:cover; display:block; cursor:pointer; transition:transform 0.4s; }
    .lcd-hero-video:hover .lcd-hero-thumb { transform:scale(1.03); }
    .lcd-play-overlay { position:absolute; inset:0; background:rgba(0,0,0,0.28); display:flex; align-items:center; justify-content:center; transition:background 0.3s; cursor:pointer; }
    .lcd-hero-video:hover .lcd-play-overlay { background:rgba(0,0,0,0.45); }
    .lcd-play-btn { width:68px; height:68px; background:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 6px 28px rgba(0,0,0,0.3); transition:transform 0.3s; }
    .lcd-play-btn i { color:#ff0000; font-size:1.7rem; margin-left:6px; }
    .lcd-hero-video:hover .lcd-play-btn { transform:scale(1.1); }

    /* Modal */
    .yt-modal { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.92); z-index:9999; align-items:center; justify-content:center; }
    .yt-modal.open { display:flex; }
    .yt-modal-inner { position:relative; width:90%; max-width:880px; aspect-ratio:16/9; }
    .yt-modal-inner iframe { width:100%; height:100%; border:none; border-radius:10px; }
    .yt-modal-close { position:absolute; top:-48px; right:0; color:#fff; font-size:1.7rem; cursor:pointer; background:none; border:none; }

    /* Body layout */
    .lcd-body { background:#f4f7fb; padding:40px 0 60px; }
    .lcd-row { display:flex; gap:30px; align-items:flex-start; }
    .lcd-main { flex:1; min-width:0; }
    .lcd-sidebar { width:360px; flex-shrink:0; }
    @@media(max-width:991px) { .lcd-row { flex-direction:column; } .lcd-sidebar { width:100%; order:-1; } }

    /* Cards */
    .lcd-card { background:#fff; border-radius:16px; padding:28px 30px; margin-bottom:24px; box-shadow:0 2px 16px rgba(0,33,71,0.06); border:1px solid #eef2f8; }
    .lcd-section-label { font-size:0.68rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#fab005; background:rgba(250,176,5,0.1); border:1px solid rgba(250,176,5,0.2); padding:4px 12px; border-radius:50px; display:inline-block; margin-bottom:14px; }
    .lcd-card h2 { font-size:1.15rem; font-weight:700; color:#002147; margin-bottom:12px; }
    .lcd-desc-content { color:#4a5568; line-height:1.85; font-size:0.92rem; }

    /* Feature list */
    .feature-list { list-style:none; padding:0; margin:0; }
    .feature-list li { display:flex; align-items:flex-start; gap:10px; padding:10px 0; border-bottom:1px solid #f0f4f8; font-size:0.88rem; color:#444; }
    .feature-list li:last-child { border-bottom:none; }
    .feature-list li i { color:#059669; font-size:0.85rem; margin-top:3px; flex-shrink:0; }

    /* Batch cards */
    .batch-card { border:2px solid #e8edf5; border-radius:14px; padding:18px 20px; margin-bottom:12px; transition:all 0.25s; cursor:pointer; position:relative; background:#fff; display:flex; gap:14px; align-items:flex-start; }
    .batch-card:hover { border-color:#aab8d4; box-shadow:0 4px 16px rgba(0,33,71,0.08); }
    .batch-card.selected { border-color:#002147; background:linear-gradient(135deg,#f0f5ff 0%,#eaf0fd 100%); box-shadow:0 6px 24px rgba(0,33,71,0.11); }

    /* Radio indicator */
    .batch-radio { width:20px; height:20px; border-radius:50%; border:2px solid #c8d4e8; flex-shrink:0; margin-top:3px; display:flex; align-items:center; justify-content:center; transition:all 0.2s; background:#fff; }
    .batch-card.selected .batch-radio { border-color:#002147; background:#002147; }
    .batch-radio::after { content:''; width:8px; height:8px; border-radius:50%; background:#fff; opacity:0; transition:opacity 0.2s; }
    .batch-card.selected .batch-radio::after { opacity:1; }

    /* Batch content */
    .batch-content { flex:1; min-width:0; }
    .batch-title { font-weight:800; color:#002147; font-size:1.05rem; margin-bottom:6px; display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
    .batch-shift { display:inline-block; background:rgba(250,176,5,0.14); color:#92600a; font-size:0.72rem; font-weight:700; padding:3px 12px; border-radius:20px; }
    .batch-meta { display:flex; flex-wrap:wrap; gap:8px 24px; font-size:0.82rem; color:#6b7280; margin-top:10px; }
    .batch-meta span { display:inline-flex; align-items:center; gap:6px; }
    .batch-meta span strong { color:#1a1a2e; font-weight:700; font-size:0.85rem; }
    .batch-meta i { color:#002147; font-size:0.75rem; }
    .batch-days { display:flex; align-items:center; gap:6px; font-size:0.82rem; color:#6b7280; margin-top:7px; }
    .batch-days strong { color:#1a1a2e; font-weight:700; font-size:0.85rem; }
    .batch-days i { color:#002147; font-size:0.75rem; }

    /* Seats badge */
    .batch-seats { font-size:0.72rem; font-weight:700; padding:4px 12px; border-radius:20px; white-space:nowrap; flex-shrink:0; display:inline-flex; align-items:center; gap:5px; margin-top:2px; }
    .seats-ok { background:#dcfce7; color:#16a34a; }
    .seats-low { background:#fef3c7; color:#d97706; }
    .seats-full { background:#fee2e2; color:#dc2626; }

    /* Sticky sidebar */
    .lcd-sticky { position:sticky; top:90px; }
    .lcd-price-card { background:#fff; border-radius:18px; padding:28px; box-shadow:0 8px 35px rgba(0,33,71,0.12); border:1px solid #eef2f8; }
    .lcd-price-main { font-size:2rem; font-weight:800; color:#002147; }
    .lcd-price-old { font-size:0.88rem; text-decoration:line-through; color:#999; }
    .lcd-discount-badge { background:linear-gradient(135deg,#059669,#047857); color:#fff; font-size:0.72rem; font-weight:700; padding:4px 12px; border-radius:20px; }
    .btn-enroll { background:linear-gradient(135deg,#fab005,#e09600); color:#fff; border:none; border-radius:12px; padding:14px; font-weight:700; font-size:1rem; width:100%; transition:all 0.3s; cursor:pointer; text-decoration:none; display:block; text-align:center; }
    .btn-enroll:hover { background:linear-gradient(135deg,#e09600,#c07800); color:#fff; transform:translateY(-2px); box-shadow:0 10px 28px rgba(250,176,5,0.4); }
    .btn-wa { background:linear-gradient(135deg,#25d366,#1da851); color:#fff; border:none; border-radius:12px; padding:11px; font-weight:700; font-size:0.88rem; width:100%; text-decoration:none; display:block; text-align:center; transition:all 0.3s; }
    .btn-wa:hover { color:#fff; transform:translateY(-1px); }
    .lcd-features-mini { list-style:none; padding:0; margin:0; }
    .lcd-features-mini li { display:flex; align-items:center; gap:8px; padding:8px 0; font-size:0.82rem; color:#444; border-bottom:1px solid #f5f5f5; }
    .lcd-features-mini li:last-child { border:none; }
    .lcd-features-mini li i { color:#059669; }

    /* Related courses (reuse index card style) */
    .course-card { border:none; border-radius:16px; box-shadow:0 4px 20px rgba(0,0,0,0.06); transition:all 0.35s ease; background:#fff; overflow:hidden; height:100%; }
    .course-card:hover { transform:translateY(-8px); box-shadow:0 18px 45px rgba(0,33,71,0.13); }
    .course-card .card-body { padding:22px; }
    .course-badge { background:#002147; color:#fff; font-size:0.68rem; padding:4px 10px; border-radius:4px; display:inline-block; margin-bottom:8px; font-weight:700; letter-spacing:0.5px; }
    .course-title { font-weight:700; font-size:1rem; color:#1a1a2e; margin-bottom:14px; }
    .course-price { font-size:1.2rem; font-weight:800; color:#002147; }
    .btn-tpe-fill { background:linear-gradient(135deg,#fab005,#e09600); color:#fff; padding:9px 20px; border-radius:50px; border:none; font-weight:700; font-size:0.82rem; transition:all 0.3s; box-shadow:0 4px 15px rgba(250,176,5,0.35); text-decoration:none; display:inline-block; }
    .btn-tpe-fill:hover { background:linear-gradient(135deg,#e09600,#c07800); color:#fff; transform:translateY(-2px); }
    .card-img-wrap { position:relative; overflow:hidden; }
    .card-img-wrap img { width:100%; height:200px; object-fit:cover; display:block; }
    .disc-ribbon { position:absolute; top:12px; right:12px; background:linear-gradient(135deg,#ff3d00,#d50000); color:#fff; font-size:0.72rem; font-weight:800; padding:5px 11px; border-radius:50px; box-shadow:0 3px 12px rgba(213,0,0,0.45); letter-spacing:0.3px; z-index:2; }

    @@media(max-width:767px) {
        .lcd-hero-col-text { margin-bottom:30px; }
    }
</style>
@endpush

@section('contents')

{{-- Hero: two-column --}}
<section class="lcd-hero">
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center g-4">

            {{-- Left: text --}}
            <div class="col-lg-6 lcd-hero-col-text">
                <a href="{{ route('live_courses') }}" class="lcd-back">
                    <i class="fa-solid fa-arrow-left"></i> সব কোর্স
                </a>
                <div>
                    <span class="lcd-type-badge">
                        <span class="live-dot"></span>
                        {{ strtoupper($course->live_course_type ?? 'LIVE') }}
                    </span>
                </div>
                <h1 class="text-warning">{{ $course->title }}</h1>
                @if($course->description)
                <p class="lcd-hero-desc">{!! $course->description !!}</p>
                @endif
                <a href="{{ route('live_course_enroll', $course->slug) }}" class="btn-enroll-hero">
                    এখনই ভর্তি হন <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            {{-- Right: YouTube --}}
            <div class="col-lg-6">
                @if($vid_id)
                <div class="lcd-hero-video">
                    <iframe src="https://www.youtube.com/embed/{{ $vid_id }}?rel=0"
                            allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            loading="lazy"></iframe>
                </div>
                @elseif($course->thumbnail)
                <div class="lcd-hero-video">
                    <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}"
                         style="width:100%;height:100%;object-fit:cover;display:block;border-radius:14px;">
                </div>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- Body --}}
<section class="lcd-body">
    <div class="container">
        <div class="lcd-row">

            {{-- Main Content --}}
            <div class="lcd-main">

                {{-- Full Description --}}


                {{-- Course Features --}}
                @php $cf = is_array($course->course_features) ? $course->course_features : json_decode($course->course_features, true); @endphp
                @if($cf && count($cf) > 0)
                <div class="lcd-card">
                    <div class="lcd-section-label">কোর্সের বৈশিষ্ট্য</div>
                    <h2>এই কোর্সে যা পাবেন</h2>
                    <ul class="feature-list">
                        @foreach($cf as $feature)
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>{{ is_array($feature) ? ($feature['title'] ?? $feature['text'] ?? json_encode($feature)) : $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Course Specification --}}
                @php $cs = is_array($course->course_specification) ? $course->course_specification : json_decode($course->course_specification, true); @endphp
                @if($cs && count($cs) > 0)
                <div class="lcd-card">
                    <div class="lcd-section-label">কোর্সের ধরন ও সময়সূচি</div>
                    <h2>কোর্সের বিবরণ</h2>
                    <ul class="feature-list">
                        @foreach($cs as $spec)
                        <li>
                            <i class="fa-solid fa-check" style="color:#002147;"></i>
                            <span>{{ is_array($spec) ? ($spec['title'] ?? $spec['text'] ?? json_encode($spec)) : $spec }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Batch Selection --}}
                @if($batches->count() > 0)
                <div class="lcd-card">
                    <div class="lcd-section-label">ব্যাচ নির্বাচন করুন</div>
                    <h2>উপলব্ধ ব্যাচসমূহ</h2>
                    @foreach($batches as $batch)
                    @php
                        $days_label = is_array($batch->class_days) ? implode(', ', $batch->class_days) : $batch->class_days;
                        $seats = $batch->seats_remaining ?? null;
                        $seats_class = $seats === null ? '' : ($seats > 10 ? 'seats-ok' : ($seats > 0 ? 'seats-low' : 'seats-full'));
                        $seats_label = $seats === null ? '' : ($seats > 0 ? $seats.' সিট বাকি' : 'পূর্ণ');
                    @endphp
                    <div class="batch-card {{ $loop->first ? 'selected' : '' }}" onclick="selectBatch(this, {{ $batch->id }})">
                        <div class="batch-radio"></div>
                        <div class="batch-content">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div class="batch-title">
                                    ব্যাচঃ  {{ $batch->batch_number }} -
                                    @if($batch->shift_name)
                                    <span class="batch-shift">{{ $batch->shift_name }}</span>
                                    @endif
                                </div>
                                @if($seats !== null)
                                <span class="batch-seats {{ $seats_class }}">
                                    <i class="fa-solid fa-users" style="font-size:0.65rem;"></i> {{ $seats_label }}
                                </span>
                                @endif
                            </div>
                            <div class="batch-meta">
                                @if($batch->course_start_date)
                                <span><i class="fa-solid fa-calendar-days"></i> ক্লাসের শুরু : <strong>{{ \Carbon\Carbon::parse($batch->course_start_date)->format('d F, Y') }}</strong></span>
                                @endif
                                @if($batch->class_start_time && $batch->class_end_time)
                                <span><i class="fa-regular fa-clock"></i> ক্লাসের সময়ঃ <strong>{{ \Carbon\Carbon::parse($batch->class_start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($batch->class_end_time)->format('g:i A') }}</strong></span>
                                @endif
                            </div>
                            @if($days_label)
                            <div class="batch-days">
                                <i class="fa-solid fa-repeat"></i> ক্লাসের দিন: <strong>{{ $days_label }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>{{-- /main --}}

            {{-- Sidebar --}}
            <div class="lcd-sidebar">
                <div class="lcd-sticky">
                    <div class="lcd-price-card">
                        {{-- Thumbnail --}}
                        @if($course->thumbnail)
                        <img src="{{ asset($course->thumbnail) }}"
                             alt="{{ $course->title }}"
                             style="width:100%; border-radius:12px; object-fit:cover; height:180px; margin-bottom:20px; display:block;"
                             onerror="this.style.display='none'">
                        @endif

                        {{-- Price --}}
                        @php
                            $disc_pct = ($course->regular_price > 0 && $course->regular_price > $course->sale_price && $course->sale_price > 0)
                                ? round(($course->regular_price - $course->sale_price) / $course->regular_price * 100)
                                : 0;
                            $raw_wa    = preg_replace('/\D/', '', setting('whatsapp') ?: setting('phone_numbers') ?: '');
                            $wa_number = $raw_wa ? (str_starts_with($raw_wa, '880') ? $raw_wa : ('880' . ltrim($raw_wa, '0'))) : '';
                        @endphp
                        <div class="mb-3">
                            <div class="d-flex align-items-baseline gap-2 flex-wrap">
                                @if($course->sale_price)
                                <div class="lcd-price-main">৳{{ number_format($course->sale_price) }}</div>
                                @if($course->regular_price && $course->regular_price > $course->sale_price)
                                <div class="lcd-price-old">৳{{ number_format($course->regular_price) }}</div>
                                @endif
                                @if($disc_pct)
                                <span class="lcd-discount-badge">{{ $disc_pct }}% ছাড়</span>
                                @endif
                                @elseif($course->regular_price)
                                <div class="lcd-price-main">৳{{ number_format($course->regular_price) }}</div>
                                @else
                                <div class="lcd-price-main" style="font-size:1.2rem; color:#059669;">মূল্য জানতে যোগাযোগ করুন</div>
                                @endif
                            </div>
                            @if($course->installment_months)
                            <p class="text-muted mb-0 mt-1" style="font-size:0.78rem;">
                                <i class="fa-solid fa-credit-card me-1"></i>
                                {{ $course->installment_months }} মাসে কিস্তিতে পরিশোধ করুন
                            </p>
                            @endif
                        </div>

                        {{-- CTA Buttons --}}
                        <a href="{{ route('live_course_enroll', $course->slug) }}" class="btn-enroll mb-3">
                            <i class="fa-solid fa-file-pen me-2"></i> এখনই ভর্তি হন
                        </a>
                        <a href="https://api.whatsapp.com/send/?phone={{ $wa_number }}&text={{ urlencode('আমি '.$course->title.' কোর্সে ভর্তি হতে চাই।') }}&type=phone_number&app_absent=0"
                           target="_blank" class="btn-wa mb-3">
                            <i class="fa-brands fa-whatsapp me-2"></i> WhatsApp-এ যোগাযোগ করুন
                        </a>
                        <a href="tel:{{ preg_replace('/\D/', '', setting('phone_numbers') ?: setting('whatsapp') ?: '') }}" class="btn-enroll mb-3"
                           style="background:linear-gradient(135deg,#002147,#003b7a); box-shadow:0 4px 15px rgba(0,33,71,0.3);">
                            <i class="fa-solid fa-phone me-2"></i> কল করুন
                        </a>

                        {{-- Quick info --}}
                        <ul class="lcd-features-mini">
                            @if($course->course_duration)
                            <li><i class="fa-regular fa-clock"></i> কোর্সের মেয়াদ: <strong>{{ $course->course_duration }}</strong></li>
                            @endif
                            @if($course->total_seats)
                            <li><i class="fa-solid fa-users"></i> মোট আসন: <strong>{{ $course->total_seats }}</strong></li>
                            @endif
                            @if($batches->count() > 0)
                            <li><i class="fa-solid fa-layer-group"></i> সক্রিয় ব্যাচ: <strong>{{ $batches->count() }}টি</strong></li>
                            @endif
                            @if($course->installment_months)
                            <li><i class="fa-solid fa-credit-card"></i> কিস্তি সুবিধা: <strong>{{ $course->installment_months }} মাস</strong></li>
                            @endif
                            <li><i class="fa-solid fa-certificate"></i> সার্টিফিকেট প্রদান করা হয়</li>
                            <li><i class="fa-solid fa-video"></i> লাইভ ইন্টারেক্টিভ ক্লাস</li>
                        </ul>
                    </div>



                </div>
            </div>{{-- /sidebar --}}

        </div>
    </div>
</section>

@if($other_courses->count() > 0)
<section style="background:#f4f7fb; padding:50px 0 60px; border-top:1px solid #eef2f8;">
    <div class="container">
        <div class="text-center mb-4">
            <span style="font-size:0.68rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#fab005; background:rgba(250,176,5,0.1); border:1px solid rgba(250,176,5,0.2); padding:4px 14px; border-radius:50px; display:inline-block; margin-bottom:12px;">আরও দেখুন</span>
            <h2 style="font-size:1.5rem; font-weight:800; color:#002147; margin:0;"> আমাদের অন্যান্য কোর্স সমূহ </h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($other_courses as $oc)
            @php
                $oc_cs   = is_array($oc->course_specification) ? $oc->course_specification : json_decode($oc->course_specification, true);
                $oc_disc = ($oc->regular_price > 0 && $oc->regular_price > $oc->sale_price && $oc->sale_price > 0)
                    ? round(($oc->regular_price - $oc->sale_price) / $oc->regular_price * 100)
                    : 0;
            @endphp
            <div class="col-lg-4 col-md-6">
                <div class="course-card">
                    <div class="card-img-wrap">
                        <img src="{{ $oc->thumbnail ? asset($oc->thumbnail) : 'https://dummyimage.com/600x400/003b7a/fff&text=Live+Course' }}"
                             alt="{{ $oc->title }}"
                             onerror="this.src='https://dummyimage.com/600x400/003b7a/fff&text=Live'">
                        @if($oc_disc > 0)
                        <div class="disc-ribbon">{{ $oc_disc }}% ছাড়</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <span class="course-badge" style="background:linear-gradient(135deg,#e91e63,#c2185b);">
                            <i class="fa-solid fa-circle" style="font-size:0.5rem;vertical-align:middle;animation:blink 1.2s infinite;"></i>
                            {{ strtoupper($oc->live_course_type ?? 'LIVE') }}
                        </span>
                        @if($oc->is_popular)
                        <span class="course-badge ms-1" style="background:linear-gradient(135deg,#fab005,#e09600);">জনপ্রিয়</span>
                        @endif
                        <h3 class="course-title mt-1">{{ $oc->title }}</h3>
                        @if($oc_cs && count($oc_cs) > 0)
                        <ul class="mb-3 ps-0" style="list-style:none;">
                            @foreach(array_slice($oc_cs, 0, 3) as $spec)
                            <li style="font-size:0.82rem; color:#444; padding:3px 0; display:flex; align-items:flex-start; gap:6px;">
                                <i class="fa-solid fa-circle-check" style="color:#059669; margin-top:3px; flex-shrink:0; font-size:0.75rem;"></i>
                                {{ is_array($spec) ? ($spec['title'] ?? $spec['text'] ?? '') : $spec }}
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="d-flex justify-content-between align-items-center border-top pt-3">
                            <div>
                                @if($oc->sale_price)
                                <div class="course-price">৳{{ number_format($oc->sale_price) }}
                                    @if($oc->regular_price && $oc->regular_price > $oc->sale_price)
                                    <small class="text-decoration-line-through text-muted" style="font-size:0.78rem;">৳{{ number_format($oc->regular_price) }}</small>
                                    @endif
                                </div>
                                @elseif($oc->regular_price)
                                <div class="course-price">৳{{ number_format($oc->regular_price) }}</div>
                                @else
                                <div class="course-price" style="font-size:0.85rem; color:#059669;">যোগাযোগ করুন</div>
                                @endif
                            </div>
                            <a href="{{ route('live_course_details', $oc->slug) }}" class="btn-tpe-fill" style="padding:7px 16px; font-size:0.8rem;">
                                বিস্তারিত <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
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
function closeYtModal() {
    document.getElementById('ytIframe').src = '';
    document.getElementById('ytModal').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeYtModal();
});
var selectedBatchId = {{ $batches->first()?->id ?? 'null' }};
function selectBatch(el, id) {
    document.querySelectorAll('.batch-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    selectedBatchId = id;
}
</script>
@endpush
