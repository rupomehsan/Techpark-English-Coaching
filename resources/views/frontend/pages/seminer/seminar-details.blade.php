@php
    $meta = [
        'seo' => [
            'title' => ($seminar->title ?? 'Seminar Details').' | TechPark English',
            'image' => $seminar->poster ? asset($seminar->poster) : asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
    /* ── Seminar Details Page ── */
    .semdet-hero {
        background: linear-gradient(135deg, #002147 0%, #003d82 60%, #0056b3 100%);
        padding: 64px 0 80px;
        position: relative; overflow: hidden;
    }
    .semdet-hero::before {
        content: ''; position: absolute;
        top: -80px; right: -80px;
        width: 360px; height: 360px;
        background: rgba(250,176,5,0.09); border-radius: 50%;
    }
    .semdet-hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(250,176,5,0.18); color: #fab005;
        border: 1.5px solid rgba(250,176,5,0.35);
        border-radius: 50px; padding: 6px 18px; font-size: 0.82rem; font-weight: 700;
        margin-bottom: 16px;
    }
    .semdet-hero h1 { color: #fff; font-size: 1.9rem; font-weight: 800; line-height: 1.35; }
    .semdet-hero-meta { color: rgba(255,255,255,0.78); font-size: 0.9rem; display: flex; gap: 20px; flex-wrap: wrap; margin-top: 14px; }
    .semdet-hero-meta i { color: #fab005; margin-right: 5px; }

    /* Countdown */
    .semdet-countdown-bar {
        background: #fff;
        border-radius: 0 0 20px 20px;
        padding: 18px 28px;
        box-shadow: 0 8px 32px rgba(0,33,71,0.12);
        margin-bottom: -30px;
        position: relative; z-index: 2;
    }
    .semdet-countdown-bar .countdown-label { font-size: 0.72rem; font-weight: 700; color: #6c757d; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px; }
    .semdet-timer { display: flex; gap: 14px; align-items: center; }
    .semdet-timer li {
        list-style: none;
        background: linear-gradient(135deg, #002147, #003d82);
        border-radius: 12px; padding: 12px 16px; min-width: 64px;
        text-align: center; color: #fff;
    }
    .semdet-timer li .amount { font-size: 1.6rem; font-weight: 800; line-height: 1; display: block; }
    .semdet-timer li .title { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.06em; color: rgba(255,255,255,0.7); margin-top: 4px; }
    .semdet-timer-sep { font-size: 1.6rem; font-weight: 800; color: #002147; margin-top: -6px; }

    /* Layout */
    .semdet-body { padding: 56px 0 72px; background: #f4f7fb; }

    /* Main card */
    .semdet-main-card { background: #fff; border-radius: 20px; box-shadow: 0 4px 24px rgba(0,33,71,0.07); overflow: hidden; }
    .semdet-poster { width: 100%; max-height: 420px; object-fit: cover; display: block; }
    .semdet-content-body { padding: 30px 32px 36px; }
    .semdet-content-body h2 { font-size: 1.25rem; font-weight: 800; color: #002147; margin-bottom: 18px; }

    /* Sidebar */
    .semdet-sidebar-card {
        background: #fff; border-radius: 20px;
        box-shadow: 0 4px 24px rgba(0,33,71,0.07);
        overflow: hidden; margin-bottom: 24px;
    }
    .semdet-sidebar-header {
        background: linear-gradient(135deg, #002147, #003d82);
        color: #fff; padding: 16px 22px;
        font-weight: 800; font-size: 0.95rem;
        display: flex; align-items: center; gap: 10px;
    }
    .semdet-sidebar-body { padding: 20px 22px; }

    /* Upcoming seminar item */
    .sem-upcoming-item {
        display: flex; gap: 14px; align-items: flex-start;
        padding: 14px 0; border-bottom: 1px solid #f0f4f8;
    }
    .sem-upcoming-item:last-child { border-bottom: none; padding-bottom: 0; }
    .sem-upcoming-thumb {
        width: 72px; height: 52px; border-radius: 10px; overflow: hidden; flex-shrink: 0;
    }
    .sem-upcoming-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .sem-upcoming-info h6 { font-size: 0.82rem; font-weight: 700; color: #002147; margin-bottom: 4px; line-height: 1.35; }
    .sem-upcoming-info .days { font-size: 0.72rem; color: #fab005; font-weight: 700; }
    .sem-upcoming-info .date { font-size: 0.72rem; color: #6c757d; }

    /* Subscribe form */
    .semdet-subscribe .form-control { border-radius: 10px; border: 1.5px solid #e9ecef; padding: 10px 14px; font-size: 0.88rem; }
    .semdet-subscribe .form-control:focus { border-color: #003d82; box-shadow: 0 0 0 3px rgba(0,61,130,0.1); }
    .btn-semdet-sub {
        width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px;
        background: linear-gradient(135deg, #fab005, #e09600);
        color: #fff; font-weight: 700; border: none; border-radius: 10px;
        padding: 11px; cursor: pointer; transition: opacity 0.3s;
    }
    .btn-semdet-sub:hover { opacity: 0.9; }

    /* Join btn */
    .btn-semdet-join {
        display: inline-flex; align-items: center; gap: 8px;
        background: linear-gradient(135deg, #002147, #003d82);
        color: #fff; font-weight: 700; border: none; border-radius: 50px;
        padding: 12px 28px; font-size: 0.9rem; cursor: pointer; transition: all 0.3s;
        text-decoration: none;
    }
    .btn-semdet-join:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,33,71,0.25); color: #fff; }

    /* Reviews */
    .semdet-reviews { background: #fff; border-radius: 20px; box-shadow: 0 4px 24px rgba(0,33,71,0.07); padding: 30px 32px; margin-top: 28px; }
    .semdet-reviews h4 { font-size: 1.1rem; font-weight: 800; color: #002147; margin-bottom: 20px; }
    .review-item { border: 1px solid #f0f4f8; border-radius: 14px; padding: 18px 20px; margin-bottom: 16px; }
    .review-item .review-meta { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
    .review-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg,#002147,#003d82); display: flex; align-items: center; justify-content: center; color: #fab005; font-weight: 800; font-size: 0.9rem; flex-shrink: 0; }
    .review-name { font-weight: 700; font-size: 0.88rem; color: #002147; }
    .review-stars { color: #fab005; font-size: 0.78rem; }
    .review-comment { font-size: 0.85rem; color: #495057; line-height: 1.6; }
    .review-form-card { background: #f8fbff; border: 1.5px solid #eaf0fa; border-radius: 14px; padding: 20px; }
    .review-form-card .form-control,
    .review-form-card .form-select { border-radius: 10px; border: 1.5px solid #e9ecef; padding: 10px 14px; font-size: 0.88rem; }
    .review-form-card .form-control:focus,
    .review-form-card .form-select:focus { border-color: #003d82; box-shadow: 0 0 0 3px rgba(0,61,130,0.1); }
    .btn-review-submit {
        display: inline-flex; align-items: center; gap: 7px;
        background: linear-gradient(135deg, #002147, #003d82);
        color: #fff; font-weight: 700; border: none; border-radius: 10px;
        padding: 11px 24px; cursor: pointer; transition: opacity 0.3s;
    }
    .btn-review-submit:hover { opacity: 0.88; }
    .reply-toggle { font-size: 0.78rem; color: #003d82; cursor: pointer; background: none; border: none; font-weight: 600; }
    .reply-item { margin-left: 30px; border-left: 3px solid #e9ecef; padding-left: 16px; margin-top: 10px; }

    /* Registration modal */
    .sem-modal .modal-content { border-radius: 20px; border: none; overflow: hidden; }
    .sem-modal .modal-header { background: linear-gradient(135deg, #002147, #003d82); color: #fff; border: none; padding: 22px 28px; }
    .sem-modal .modal-title { font-weight: 800; }
    .sem-modal .btn-close { filter: invert(1); }
    .sem-modal .modal-body { padding: 28px; }
    .sem-modal .form-control { border-radius: 10px; border: 1.5px solid #e9ecef; padding: 10px 14px; }
    .sem-modal .form-control:focus { border-color: #003d82; box-shadow: 0 0 0 3px rgba(0,61,130,0.12); }
    .sem-modal label { font-weight: 600; font-size: 0.85rem; color: #002147; margin-bottom: 6px; }

    @media (max-width: 767px) {
        .semdet-hero h1 { font-size: 1.4rem; }
        .semdet-timer li { min-width: 50px; padding: 9px 10px; }
        .semdet-timer li .amount { font-size: 1.2rem; }
        .semdet-content-body { padding: 20px; }
    }
</style>
@endpush

@section('contents')

@php
    $now   = \Carbon\Carbon::now();
    $sdt   = \Carbon\Carbon::parse($seminar->date_time);
    $isToday = $sdt->isToday();
    $diff  = $now->diffInDays($sdt, false);
@endphp

{{-- Hero --}}
<section class="semdet-hero">
    <div class="container position-relative" style="z-index:1;">
        <div class="semdet-hero-badge">
            @if($isToday)
                <i class="fa-solid fa-circle-dot fa-beat"></i> আজকের সেমিনার
            @elseif($diff > 0)
                <i class="fa-regular fa-clock"></i> {{ $diff }} দিন বাকী
            @else
                <i class="fa-solid fa-calendar-check"></i> সম্পন্ন
            @endif
        </div>
        <h1>{{ $seminar->title }}</h1>
        <div class="semdet-hero-meta">
            <span><i class="fa-regular fa-calendar"></i>{{ $sdt->format('d F Y') }}</span>
            <span><i class="fa-regular fa-clock"></i>{{ $sdt->format('h:i A') }}</span>
            <span><i class="fa-solid fa-location-dot"></i>অনলাইন</span>
        </div>

        {{-- Countdown --}}
        @if($diff > 0)
        <div class="semdet-countdown-bar mt-4">
            <div class="countdown-label">সেমিনার শুরু হতে বাকী সময়</div>
            <ul class="semdet-timer seminar-time" style="padding:0; margin:0;">
                <li class="d-none">
                    <span class="amount" data-years></span>
                    <span class="title">বছর</span>
                </li>
                <li>
                    <span class="amount" data-days></span>
                    <span class="title">দিন</span>
                </li>
                <span class="semdet-timer-sep">:</span>
                <li>
                    <span class="amount" data-hours></span>
                    <span class="title">ঘণ্টা</span>
                </li>
                <span class="semdet-timer-sep">:</span>
                <li>
                    <span class="amount" data-minutes></span>
                    <span class="title">মিনিট</span>
                </li>
                <span class="semdet-timer-sep">:</span>
                <li>
                    <span class="amount" data-seconds></span>
                    <span class="title">সেকেন্ড</span>
                </li>
            </ul>
        </div>
        @endif
    </div>
</section>

{{-- Body --}}
<section class="semdet-body">
    <div class="container" style="padding-top: {{ $diff > 0 ? '46px' : '0' }};">
        <div class="row g-4">

            {{-- Main --}}
            <div class="col-lg-8">
                <div class="semdet-main-card">
                    @if($seminar->poster)
                        <img src="/{{ $seminar->poster }}" alt="{{ $seminar->title }}" class="semdet-poster">
                    @endif
                    <div class="semdet-content-body">
                        <h2>সেমিনার সম্পর্কে বিস্তারিত</h2>
                        <div style="line-height:1.8; color:#495057;">
                            {!! $seminar->description !!}
                        </div>

                        <div class="mt-4 d-flex gap-3 flex-wrap align-items-center">
                            <button class="btn-semdet-join" onclick="showSeminarModel({{ json_encode($seminar) }})">
                                <i class="fa-solid fa-paper-plane"></i> ফ্রি রেজিস্ট্রেশন করুন
                            </button>
                            <a href="{{ route('all-seminers') }}" style="color:#6c757d;font-size:0.85rem; text-decoration:none; display:flex; align-items:center; gap:6px;">
                                <i class="fa-solid fa-arrow-left"></i> সব সেমিনার দেখুন
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Reviews --}}
                <div class="semdet-reviews">
                    <h4><i class="fa-solid fa-star me-2" style="color:#fab005;"></i>রিভিউ ও মতামত</h4>

                    {{-- Review form --}}
                    <div class="review-form-card mb-4">
                        <h6 style="font-weight:700;color:#002147;margin-bottom:16px;">আপনার মতামত দিন</h6>
                        <form method="POST" action="{{ route('seminar.review', $seminar->id) }}" id="new-review-form">
                            @csrf
                            <input type="hidden" name="seminar_id" value="{{ $seminar->id }}">
                            @guest
                            <div class="row gx-2 mb-3">
                                <div class="col-sm-6 mb-2 mb-sm-0">
                                    <input name="name" class="form-control" placeholder="আপনার নাম" required>
                                </div>
                                <div class="col-sm-6">
                                    <input name="email" type="email" class="form-control" placeholder="ই-মেইল">
                                </div>
                            </div>
                            @endguest
                            <div class="mb-3">
                                <select name="rating" class="form-select" required>
                                    <option value="">রেটিং বেছে নিন</option>
                                    <option value="5">⭐⭐⭐⭐⭐ অসাধারণ</option>
                                    <option value="4">⭐⭐⭐⭐ খুব ভালো</option>
                                    <option value="3">⭐⭐⭐ ভালো</option>
                                    <option value="2">⭐⭐ মোটামুটি</option>
                                    <option value="1">⭐ দুর্বল</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <textarea name="comment" class="form-control" rows="3" placeholder="আপনার অভিজ্ঞতা শেয়ার করুন..."></textarea>
                            </div>
                            <button type="submit" class="btn-review-submit">
                                <i class="fa-solid fa-paper-plane"></i> রিভিউ দিন
                            </button>
                        </form>
                    </div>

                    {{-- Existing reviews --}}
                    <div id="reviews-list">
                        @forelse($seminar->reviews ?? collect() as $review)
                        <div class="review-item" id="review-{{ $review->id }}">
                            <div class="review-meta">
                                <div class="review-avatar">{{ strtoupper(substr($review->name ?? 'U', 0, 1)) }}</div>
                                <div>
                                    <div class="review-name">{{ $review->name ?? 'Anonymous' }}</div>
                                    <div class="review-stars">
                                        @for($r=0;$r<($review->rating??5);$r++)<i class="fa-solid fa-star"></i>@endfor
                                    </div>
                                </div>
                                <div class="ms-auto" style="font-size:0.72rem;color:#adb5bd;">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</div>
                            </div>
                            <div class="review-comment">{{ $review->comment }}</div>
                            <button class="reply-toggle mt-2" data-id="{{ $review->id }}">
                                <i class="fa-solid fa-reply me-1"></i>উত্তর দিন
                            </button>
                            {{-- Replies --}}
                            @foreach($review->replies ?? collect() as $reply)
                            <div class="reply-item">
                                <div class="review-meta">
                                    <div class="review-avatar" style="width:30px;height:30px;font-size:0.75rem;">{{ strtoupper(substr($reply->name ?? 'U', 0, 1)) }}</div>
                                    <div>
                                        <div class="review-name" style="font-size:0.82rem;">{{ $reply->name ?? 'Anonymous' }}</div>
                                    </div>
                                </div>
                                <div class="review-comment" style="font-size:0.82rem;">{{ $reply->comment }}</div>
                            </div>
                            @endforeach
                        </div>
                        @empty
                        <div style="text-align:center;padding:30px;color:#adb5bd;">
                            <i class="fa-regular fa-comment-dots" style="font-size:2rem;display:block;margin-bottom:10px;"></i>
                            এখনো কোনো রিভিউ নেই। প্রথম রিভিউ দিন!
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Register CTA --}}
                <div class="semdet-sidebar-card mb-4">
                    <div class="semdet-sidebar-header">
                        <i class="fa-solid fa-paper-plane"></i> ফ্রি রেজিস্ট্রেশন করুন
                    </div>
                    <div class="semdet-sidebar-body text-center">
                        <p style="font-size:0.85rem;color:#6c757d;margin-bottom:16px;">এই সেমিনারে অংশ নিতে এখনই রেজিস্ট্রেশন করুন। আসন সীমিত!</p>
                        <button class="btn-semdet-join w-100 justify-content-center" style="border-radius:12px;" onclick="showSeminarModel({{ json_encode($seminar) }})">
                            <i class="fa-solid fa-paper-plane"></i> রেজিস্ট্রেশন করুন
                        </button>
                    </div>
                </div>

                {{-- Subscribe --}}
                <div class="semdet-sidebar-card mb-4">
                    <div class="semdet-sidebar-header">
                        <i class="fa-solid fa-bell"></i> নোটিফিকেশন পান
                    </div>
                    <div class="semdet-sidebar-body semdet-subscribe">
                        <p style="font-size:0.83rem;color:#6c757d;margin-bottom:14px;">এই সেমিনারের আপডেট পেতে সাবস্ক্রাইব করুন।</p>
                        <form method="POST" action="{{ route('seminar.subscribe', $seminar->id) }}">
                            @csrf
                            <input type="hidden" name="seminar_id" value="{{ $seminar->id }}">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="আপনার ই-মেইল" required>
                            </div>
                            <button type="submit" class="btn-semdet-sub">
                                <i class="fa-solid fa-bell"></i> সাবস্ক্রাইব করুন
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Upcoming Seminars --}}
                @if($seminars && $seminars->count() > 0)
                <div class="semdet-sidebar-card">
                    <div class="semdet-sidebar-header">
                        <i class="fa-solid fa-calendar-days"></i> আসন্ন সেমিনার
                    </div>
                    <div class="semdet-sidebar-body" style="padding-top:8px;padding-bottom:8px;">
                        @foreach($seminars->take(5) as $item)
                        @php
                            $id  = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->date_time), false);
                        @endphp
                        <div class="sem-upcoming-item">
                            <div class="sem-upcoming-thumb">
                                @if($item->poster)
                                    <img src="/{{ $item->poster }}" alt="{{ $item->title }}">
                                @else
                                    <div style="width:100%;height:100%;background:linear-gradient(135deg,#002147,#003d82);display:flex;align-items:center;justify-content:center;border-radius:10px;">
                                        <i class="fa-solid fa-microphone" style="color:rgba(255,255,255,0.4);"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="sem-upcoming-info">
                                <h6>
                                    <a href="{{ route('seminar.details', $item->id) }}" style="color:inherit;text-decoration:none;">{{ $item->title }}</a>
                                </h6>
                                <div class="days">{{ $id > 0 ? $id.' দিন বাকী' : ($id === 0 ? 'আজকের সেমিনার' : 'সম্পন্ন') }}</div>
                                <div class="date"><i class="fa-regular fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($item->date_time)->format('d M Y') }}</div>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center mt-3 pb-2">
                            <a href="{{ route('all-seminers') }}" style="font-size:0.82rem;color:#003d82;font-weight:700;text-decoration:none;">
                                সব সেমিনার দেখুন <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

{{-- Registration Modal --}}
<div id="seminar_modal" class="modal fade sem-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-paper-plane me-2"></i> সেমিনারের জন্য রেজিস্ট্রেশন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="seminar_form" onsubmit="registerSeminar(event)">
                    <div class="mb-3">
                        <label>নামঃ</label>
                        <input type="text" name="full_name" class="form-control" placeholder="আপনার পূর্ণ নাম লিখুন" required>
                    </div>
                    <div class="mb-3">
                        <label>মোবাইল নাম্বারঃ</label>
                        <input type="number" name="phone_number" class="form-control" placeholder="01XXXXXXXXX" required>
                    </div>
                    <div class="mb-3">
                        <label>ই-মেইলঃ</label>
                        <input type="email" name="email" class="form-control" placeholder="example@email.com">
                    </div>
                    <div class="mb-4">
                        <label>ঠিকানাঃ</label>
                        <textarea name="address" class="form-control" rows="2" placeholder="আপনার ঠিকানা লিখুন"></textarea>
                    </div>
                    <button type="submit" class="btn-semdet-join w-100 justify-content-center" style="border-radius:12px; padding:13px;">
                        <i class="fa-solid fa-paper-plane"></i> সাবমিট করুন
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/js/plugins/countdown.js"></script>
<script>
    var seminar_modal = new bootstrap.Modal(document.getElementById('seminar_modal'));

    function showSeminarModel(seminar) {
        window.seminar_id = seminar.id;
        document.getElementById('seminar_form').reset();
        seminar_modal.show();
    }

    function registerSeminar(event) {
        event.preventDefault();
        let formData = new FormData(event.target);
        formData.append("seminar_id", window.seminar_id);
        fetch("/seminar-registration", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            body: formData
        }).then(async res => {
            return { status: res.status, data: await res.json() };
        }).then(res => {
            if (res.status === 422) { error_response(res.data); }
            if (res.status === 200) {
                window.toaster("রেজিস্ট্রেশন সফল হয়েছে!");
                seminar_modal.hide();
                document.getElementById('seminar_form').reset();
            }
        });
    }

    // Countdown timer
    setTimeout(function () {
        timezz(document.querySelector('.seminar-time'), {
            date: `{{ \Carbon\Carbon::parse($seminar->date_time)->format('M d, Y H:i:s') }}`,
            pause: false,
            stopOnZero: true,
        });
    }, 300);

    // Reply form toggle
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('reply-toggle')) {
            const id = e.target.getAttribute('data-id');
            const parent = document.getElementById('review-' + id);
            if (!parent) return;
            let replyForm = parent.querySelector('.reply-form');
            if (!replyForm) {
                replyForm = document.createElement('div');
                replyForm.className = 'reply-form mt-2';
                replyForm.innerHTML = `
                    <form method="POST" action="{{ route('seminar.review.reply', $seminar->id) }}" class="reply-subform">
                        @csrf
                        <input type="hidden" name="seminar_id" value="{{ $seminar->id }}">
                        <input type="hidden" name="parent_id" value="${id}">
                        @guest
                            <div class="mb-2"><input name="name" class="form-control" placeholder="আপনার নাম" required></div>
                            <div class="mb-2"><input name="email" type="email" class="form-control" placeholder="ই-মেইল"></div>
                        @endguest
                        <div class="mb-2"><textarea name="comment" class="form-control" rows="2" placeholder="উত্তর লিখুন..." required></textarea></div>
                        <div class="d-flex gap-2">
                            <button class="btn-review-submit" type="submit" style="padding:8px 18px;font-size:0.82rem;">উত্তর দিন</button>
                            <button type="button" class="cancel-reply" style="background:none;border:none;color:#6c757d;font-size:0.82rem;cursor:pointer;">বাতিল</button>
                        </div>
                    </form>`;
                parent.appendChild(replyForm);
                const ta = replyForm.querySelector('textarea');
                if (ta) ta.focus();
            } else {
                replyForm.remove();
            }
        }
        if (e.target && e.target.classList.contains('cancel-reply')) {
            const form = e.target.closest('.reply-form');
            if (form) form.remove();
        }
    });
</script>

@endsection
