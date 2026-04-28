@php
    $meta = [
        'seo' => [
            'title' => 'ফ্রি সেমিনার | TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
    /* ── Seminar List Page ── */
    .sem-hero {
        background: linear-gradient(135deg, #002147 0%, #003d82 60%, #0056b3 100%);
        padding: 72px 0 56px;
        position: relative;
        overflow: hidden;
    }
    .sem-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -80px;
        width: 340px; height: 340px;
        background: rgba(250,176,5,0.10);
        border-radius: 50%;
    }
    .sem-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -60px;
        width: 260px; height: 260px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .sem-hero h1 { color: #fff; font-size: 2.2rem; font-weight: 800; }
    .sem-hero p  { color: rgba(255,255,255,0.82); font-size: 1rem; max-width: 600px; margin: 0 auto; }
    .sem-hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(250,176,5,0.18); color: #fab005;
        border: 1.5px solid rgba(250,176,5,0.35);
        border-radius: 50px; padding: 6px 18px; font-size: 0.82rem; font-weight: 700;
        margin-bottom: 18px;
    }

    .sem-section { background: #f4f7fb; padding: 56px 0 72px; }

    /* card */
    .sem-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,33,71,0.07);
        border: 1px solid #eaf0fa;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
        display: flex; flex-direction: column;
    }
    .sem-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(0,33,71,0.13); }

    .sem-card-poster {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .sem-card-poster img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.5s ease;
    }
    .sem-card:hover .sem-card-poster img { transform: scale(1.06); }
    .sem-card-poster .sem-promo-btn {
        position: absolute; inset: 0;
        display: flex; align-items: center; justify-content: center;
        background: rgba(0,33,71,0.35);
        opacity: 0; transition: opacity 0.3s;
        cursor: pointer; border: none;
    }
    .sem-card:hover .sem-card-poster .sem-promo-btn { opacity: 1; }
    .sem-promo-play {
        width: 58px; height: 58px; background: #fff;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    .sem-promo-play i { color: #ff0000; font-size: 1.4rem; margin-left: 4px; }

    .sem-days-badge {
        position: absolute; top: 14px; left: 14px;
        background: linear-gradient(135deg, #fab005, #e09600);
        color: #fff; border-radius: 50px;
        padding: 6px 14px; font-size: 0.78rem; font-weight: 800;
        display: flex; align-items: center; gap: 6px;
        box-shadow: 0 3px 12px rgba(250,176,5,0.4);
    }
    .sem-today-badge {
        position: absolute; top: 14px; left: 14px;
        background: linear-gradient(135deg, #28a745, #1e7e34);
        color: #fff; border-radius: 50px;
        padding: 6px 14px; font-size: 0.78rem; font-weight: 800;
        box-shadow: 0 3px 12px rgba(40,167,69,0.4);
    }

    .sem-card-body { padding: 22px 22px 16px; flex: 1; }
    .sem-card-title { font-size: 1.05rem; font-weight: 800; color: #002147; margin-bottom: 10px; line-height: 1.4; }
    .sem-card-meta { font-size: 0.8rem; color: #6c757d; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
    .sem-card-meta i { color: #fab005; }

    .sem-card-footer { padding: 14px 22px 22px; border-top: 1px solid #f0f4f8; display: flex; gap: 10px; flex-wrap: wrap; }
    .btn-sem-primary {
        display: inline-flex; align-items: center; gap: 7px;
        background: linear-gradient(135deg, #002147, #003d82);
        color: #fff; border: none; border-radius: 50px;
        padding: 9px 20px; font-size: 0.82rem; font-weight: 700;
        cursor: pointer; transition: all 0.3s; text-decoration: none;
    }
    .btn-sem-primary:hover { background: linear-gradient(135deg, #003d82, #002147); color: #fff; transform: translateY(-1px); }
    .btn-sem-outline {
        display: inline-flex; align-items: center; gap: 7px;
        background: transparent; color: #002147;
        border: 1.5px solid #dee2e9; border-radius: 50px;
        padding: 8px 18px; font-size: 0.82rem; font-weight: 600;
        cursor: pointer; transition: all 0.3s; text-decoration: none;
    }
    .btn-sem-outline:hover { border-color: #002147; color: #002147; background: #f4f7fb; }
    .btn-sem-gold {
        display: inline-flex; align-items: center; gap: 7px;
        background: linear-gradient(135deg, #fab005, #e09600);
        color: #fff; border: none; border-radius: 50px;
        padding: 9px 20px; font-size: 0.82rem; font-weight: 700;
        cursor: pointer; transition: all 0.3s;
    }
    .btn-sem-gold:hover { opacity: 0.9; transform: translateY(-1px); }

    .sem-empty { text-align: center; padding: 80px 20px; color: #6c757d; }
    .sem-empty i { font-size: 3.5rem; color: #dee2e9; margin-bottom: 20px; display: block; }

    /* Registration modal */
    .sem-modal .modal-content { border-radius: 20px; border: none; overflow: hidden; }
    .sem-modal .modal-header { background: linear-gradient(135deg, #002147, #003d82); color: #fff; border: none; padding: 22px 28px; }
    .sem-modal .modal-title { font-weight: 800; }
    .sem-modal .btn-close { filter: invert(1); }
    .sem-modal .modal-body { padding: 28px; }
    .sem-modal .form-control { border-radius: 10px; border: 1.5px solid #e9ecef; padding: 10px 14px; }
    .sem-modal .form-control:focus { border-color: #003d82; box-shadow: 0 0 0 3px rgba(0,61,130,0.12); }
    .sem-modal label { font-weight: 600; font-size: 0.85rem; color: #002147; margin-bottom: 6px; }

    /* Promo video modal */
    .promo-vid-modal .modal-content { background: #000; border-radius: 16px; border: none; }
    .promo-vid-modal .modal-header { border: none; padding: 10px 16px; }
    .promo-vid-modal .btn-close { filter: invert(1); }
    .promo-vid-modal .modal-body { padding: 0; }
    .promo-vid-modal iframe { display: block; }
</style>
@endpush

@section('contents')

{{-- Hero --}}
<section class="sem-hero text-center">
    <div class="container position-relative" style="z-index:1;">
        <div class="sem-hero-badge"><i class="fa-solid fa-calendar-days"></i> আসন্ন সেমিনার</div>
        <h1>ফ্রি সেমিনারের সময়সূচি</h1>
        <p class="mt-2">আপনার ক্যারিয়ার কোন সেক্টরে গড়ে তুলবেন? আমাদের ফ্রি সেমিনারে জয়েন করুন এবং বিশেষজ্ঞদের সাথে সরাসরি কথা বলুন।</p>
    </div>
</section>

{{-- Cards --}}
<section class="sem-section">
    <div class="container">
        @if($seminars && $seminars->count() > 0)
        <div class="row g-4">
            @foreach($seminars as $item)
            @php
                $now  = \Carbon\Carbon::now();
                $sdt  = \Carbon\Carbon::parse($item->date_time);
                $diff = $now->diffInDays($sdt, false);
                $isToday = $sdt->isToday();
            @endphp
            <div class="col-lg-4 col-md-6">
                <div class="sem-card">
                    <div class="sem-card-poster">
                        @if($item->poster)
                            <img src="/{{ $item->poster }}" alt="{{ $item->title }}">
                        @else
                            <div style="width:100%;height:100%;background:linear-gradient(135deg,#002147,#003d82);display:flex;align-items:center;justify-content:center;">
                                <i class="fa-solid fa-microphone" style="font-size:3rem;color:rgba(255,255,255,0.3);"></i>
                            </div>
                        @endif

                        @if($item->promo_video)
                        <button class="sem-promo-btn" onclick="showPromoVideo('{{ $item->promo_video }}')" aria-label="Watch promo">
                            <div class="sem-promo-play"><i class="fa-solid fa-play"></i></div>
                        </button>
                        @endif

                        @if($isToday)
                            <div class="sem-today-badge"><i class="fa-solid fa-circle-dot fa-beat"></i> আজকের সেমিনার</div>
                        @else
                            <div class="sem-days-badge"><i class="fa-regular fa-clock"></i> {{ $diff > 0 ? $diff.' দিন বাকী' : 'অতিক্রান্ত' }}</div>
                        @endif
                    </div>

                    <div class="sem-card-body">
                        <h3 class="sem-card-title">{{ $item->title }}</h3>
                        <div class="sem-card-meta">
                            <span><i class="fa-regular fa-calendar"></i> {{ $sdt->format('d M Y') }}</span>
                            <span><i class="fa-regular fa-clock"></i> {{ $sdt->format('h:i A') }}</span>
                            <span><i class="fa-solid fa-location-dot"></i> অনলাইন</span>
                        </div>
                    </div>

                    <div class="sem-card-footer">
                        <a href="{{ route('seminar.details', $item->id) }}" class="btn-sem-outline">
                            <i class="fa-solid fa-circle-info"></i> বিস্তারিত
                        </a>
                        <button class="btn-sem-gold" onclick="showSeminarModel({{ $item }})">
                            <i class="fa-solid fa-paper-plane"></i> রেজিস্ট্রেশন
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="sem-empty">
            <i class="fa-regular fa-calendar-xmark"></i>
            <h4>কোনো আসন্ন সেমিনার নেই</h4>
            <p>নতুন সেমিনারের জন্য পরে আবার চেক করুন।</p>
        </div>
        @endif
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
                    <button type="submit" class="btn-sem-primary w-100 justify-content-center" style="border-radius:12px; padding:12px;">
                        <i class="fa-solid fa-paper-plane"></i> সাবমিট করুন
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Promo Video Modal --}}
<div id="promo_video_modal" class="modal fade promo-vid-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="stopPromoVideo()"></button>
            </div>
            <div class="modal-body">
                <iframe id="promoIframe" width="100%" height="420" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    var seminar_modal = new bootstrap.Modal(document.getElementById('seminar_modal'));
    var promo_modal   = new bootstrap.Modal(document.getElementById('promo_video_modal'));

    function showSeminarModel(seminar) {
        window.seminar_id = seminar.id;
        document.getElementById('seminar_form').reset();
        seminar_modal.show();
    }

    function showPromoVideo(url) {
        var iframe = document.getElementById('promoIframe');
        // Try to extract YouTube ID
        var match = url.match(/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
        if (match) {
            iframe.src = 'https://www.youtube.com/embed/' + match[1] + '?autoplay=1&rel=0';
        } else {
            iframe.src = url;
        }
        promo_modal.show();
    }

    function stopPromoVideo() {
        document.getElementById('promoIframe').src = '';
    }

    document.getElementById('promo_video_modal').addEventListener('hidden.bs.modal', stopPromoVideo);

    function registerSeminar(event) {
        event.preventDefault();
        let formData = new FormData(event.target);
        formData.append("seminar_id", window.seminar_id);
        fetch("/seminar-registration", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            body: formData
        }).then(async res => {
            let response = { status: res.status, data: await res.json() };
            return response;
        }).then(res => {
            if (res.status === 422) { error_response(res.data); }
            if (res.status === 200) {
                window.toaster("রেজিস্ট্রেশন সফল হয়েছে!");
                seminar_modal.hide();
                document.getElementById('seminar_form').reset();
            }
        });
    }
</script>

@endsection
