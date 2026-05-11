@php
    $meta = [
        'seo' => [
            'title' => 'Contact Us — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ===== Hero ===== */
.contact-hero {
    background: linear-gradient(135deg, #001025 0%, #002147 55%, #003b7a 100%);
    padding: 80px 0 70px; position: relative; overflow: hidden;
}
.contact-hero::before {
    content:''; position:absolute; top:-120px; right:-100px;
    width:500px; height:500px;
    background: radial-gradient(circle, rgba(250,176,5,0.09) 0%, transparent 70%);
    border-radius:50%;
}
.contact-hero::after {
    content:''; position:absolute; bottom:-150px; left:-80px;
    width:400px; height:400px;
    background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, transparent 70%);
    border-radius:50%;
}
.contact-hero-deco {
    position:absolute; top:40px; left:10%;
    width:160px; height:160px;
    border:1px solid rgba(250,176,5,0.12); border-radius:50%;
}
.contact-hero-deco2 {
    position:absolute; bottom:20px; right:8%;
    width:90px; height:90px;
    border:1px solid rgba(255,255,255,0.07); border-radius:50%;
}
.contact-hero-badge {
    display:inline-flex; align-items:center; gap:8px;
    background:rgba(250,176,5,0.15); border:1px solid rgba(250,176,5,0.4);
    color:#fab005; font-size:0.75rem; font-weight:700;
    padding:7px 20px; border-radius:50px;
    letter-spacing:0.8px; text-transform:uppercase; margin-bottom:18px;
}
.contact-hero-title {
    font-size: clamp(2rem,4vw,3rem); font-weight:900; color:#fff;
    line-height:1.2; margin-bottom:14px;
}
.contact-hero-title span {
    background: linear-gradient(135deg,#fab005,#ff6b35);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
}
.contact-hero-sub { color:rgba(255,255,255,0.6); font-size:0.95rem; max-width:520px; margin:0 auto 28px; line-height:1.7; }
.contact-hero-stats {
    display:inline-flex; gap:0; background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.1); border-radius:16px;
    overflow:hidden; backdrop-filter:blur(8px);
}
.contact-hero-stat {
    padding:14px 28px; text-align:center;
    border-right:1px solid rgba(255,255,255,0.08);
}
.contact-hero-stat:last-child { border-right:none; }
.contact-hero-stat-num { font-size:1.4rem; font-weight:900; color:#fab005; line-height:1; }
.contact-hero-stat-label { font-size:0.68rem; color:rgba(255,255,255,0.5); font-weight:600; margin-top:3px; text-transform:uppercase; letter-spacing:0.5px; }

/* ===== Info Cards ===== */
.contact-cards-section { background: linear-gradient(180deg,#f0f5ff 0%,#fff 100%); }
.contact-info-card {
    background:#fff; border-radius:22px; padding:32px 26px;
    box-shadow: 0 6px 32px rgba(0,33,71,0.09); border:1px solid rgba(0,33,71,0.06);
    height:100%; transition: transform 0.35s cubic-bezier(.25,.46,.45,.94), box-shadow 0.35s;
    position:relative; overflow:hidden;
}
.contact-info-card::before {
    content:''; position:absolute; top:-40px; right:-40px;
    width:120px; height:120px; border-radius:50%;
    opacity:0.06; transition:opacity 0.35s;
}
.contact-info-card.card-phone::before  { background:#002147; }
.contact-info-card.card-wa::before     { background:#25d366; }
.contact-info-card.card-email::before  { background:#003b7a; }
.contact-info-card.card-social::before { background:#fab005; }
.contact-info-card:hover { transform:translateY(-6px); box-shadow:0 20px 55px rgba(0,33,71,0.13); }
.contact-info-card:hover::before { opacity:0.12; }
.contact-icon-box {
    width:58px; height:58px; border-radius:16px;
    display:flex; align-items:center; justify-content:center;
    font-size:1.2rem; margin-bottom:18px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}
.card-phone  .contact-icon-box { background:linear-gradient(135deg,#002147,#003b7a); color:#fab005; }
.card-wa     .contact-icon-box { background:linear-gradient(135deg,#128C7E,#25d366); color:#fff; }
.card-email  .contact-icon-box { background:linear-gradient(135deg,#002147,#1a4c8c); color:#fab005; }
.card-social .contact-icon-box { background:linear-gradient(135deg,#fab005,#ff6b35); color:#fff; }
.contact-info-title { font-weight:800; color:#002147; font-size:1rem; margin-bottom:8px; }
.contact-info-value { color:#5a6a7e; font-size:0.87rem; line-height:1.75; }
.contact-info-value a { color:#5a6a7e; text-decoration:none; transition:color 0.2s; }
.contact-info-value a:hover { color:#002147; }
.contact-info-action {
    display:inline-flex; align-items:center; gap:6px; margin-top:14px;
    background:rgba(0,33,71,0.06); border:1px solid rgba(0,33,71,0.1);
    border-radius:50px; padding:6px 14px; font-size:0.72rem; font-weight:700;
    color:#002147; text-decoration:none; transition:all 0.25s;
}
.contact-info-action:hover { background:#002147; color:#fab005; }
.contact-social-row { display:flex; gap:8px; flex-wrap:wrap; margin-top:14px; }
.contact-social-btn {
    width:38px; height:38px; border-radius:12px;
    background:#f0f4f8; display:flex; align-items:center; justify-content:center;
    color:#002147; font-size:0.85rem; text-decoration:none; transition:all 0.25s;
}
.contact-social-btn:hover { background:#002147; color:#fab005; transform:translateY(-3px); }

/* ===== Address Strip ===== */
.contact-address-strip {
    background: #fff; border-radius: 18px; padding: 24px 30px;
    box-shadow: 0 4px 24px rgba(0,33,71,0.08); border: 1px solid rgba(0,33,71,0.07);
    display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
    border-left: 4px solid #002147;
}
.contact-address-icon-wrap { flex-shrink: 0; }
.contact-address-content { flex: 1; min-width: 200px; }

/* ===== Form Section ===== */
.contact-form-section { background:#fff; }
.contact-form-card {
    background:#fff; border-radius:24px; padding:42px 40px;
    box-shadow: 0 8px 40px rgba(0,33,71,0.10); border:1px solid rgba(0,33,71,0.07);
    position:relative; overflow:hidden;
}
.contact-form-card::before {
    content:''; position:absolute; bottom:-80px; right:-80px;
    width:200px; height:200px; border-radius:50%;
    background:radial-gradient(circle,rgba(250,176,5,0.07) 0%,transparent 70%);
}
.cf-section-badge {
    display:inline-flex; align-items:center; gap:7px;
    background:rgba(0,33,71,0.06); border:1px solid rgba(0,33,71,0.1);
    color:#002147; font-size:0.68rem; font-weight:700;
    padding:5px 14px; border-radius:50px; letter-spacing:1px;
    text-transform:uppercase; margin-bottom:12px;
}
.cf-title { font-size:1.6rem; font-weight:900; color:#002147; margin-bottom:6px; }
.cf-subtitle { font-size:0.82rem; color:#94a3b8; margin-bottom:28px; line-height:1.6; }
.cf-field-group { position:relative; }
.cf-label { font-size:0.78rem; font-weight:700; color:#374151; margin-bottom:7px; display:block; }
.cf-input {
    width:100%; padding:13px 16px 13px 44px; border:1.5px solid #e8edf5;
    border-radius:12px; font-size:0.88rem; color:#333; background:#f8faff;
    transition:border-color 0.25s, box-shadow 0.25s, background 0.25s;
    outline:none; font-family:inherit;
}
.cf-input:focus { border-color:#002147; box-shadow:0 0 0 4px rgba(0,33,71,0.07); background:#fff; }
.cf-input::placeholder { color:#c4c9d4; }
textarea.cf-input { resize:vertical; min-height:140px; padding-top:13px; }
.cf-field-icon {
    position:absolute; left:14px; top:50%; transform:translateY(-50%);
    color:#94a3b8; font-size:0.88rem; pointer-events:none;
}
.cf-field-icon.textarea-icon { top:16px; transform:none; }
.cf-submit {
    background:linear-gradient(135deg,#002147,#003b7a); color:#fff;
    border:none; padding:15px 40px; border-radius:50px; font-weight:700;
    font-size:0.92rem; cursor:pointer; transition:all 0.3s;
    display:inline-flex; align-items:center; gap:9px;
    box-shadow:0 6px 24px rgba(0,33,71,0.25);
}
.cf-submit:hover {
    background:linear-gradient(135deg,#fab005,#e09600);
    box-shadow:0 10px 30px rgba(250,176,5,0.4); transform:translateY(-2px);
}

/* ===== Map ===== */
.contact-map-outer { border-radius:24px; overflow:hidden; box-shadow:0 8px 40px rgba(0,33,71,0.12); height:100%; display:flex; flex-direction:column; }
.contact-map-outer iframe { width:100%; flex:1; min-height:300px; border:0; display:block; }
.map-address-badge {
    background:#fff;
    padding:18px 22px;
    border-bottom:1px solid #eef2fa;
}
.map-address-badge .map-badge-icon {
    width:40px; height:40px; background:linear-gradient(135deg,#002147,#003b7a);
    border-radius:10px; display:flex; align-items:center; justify-content:center;
    color:#fab005; font-size:0.9rem; flex-shrink:0;
}
.map-address-badge .map-badge-label { font-size:0.68rem; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; }
.map-address-badge .map-badge-text { font-size:0.82rem; color:#1a2540; font-weight:600; line-height:1.5; }

/* ===== FAQ ===== */
.contact-faq-section { background:linear-gradient(180deg,#fff 0%,#f4f7ff 100%); }
.faq-badge {
    display:inline-flex; align-items:center; gap:8px;
    background:linear-gradient(135deg,rgba(0,33,71,0.07),rgba(250,176,5,0.08));
    border:1px solid rgba(0,33,71,0.10); border-radius:30px;
    padding:6px 18px; font-size:0.75rem; font-weight:700; color:#002147;
    letter-spacing:0.5px; text-transform:uppercase; margin-bottom:14px;
}
.faq-badge i { color:#fab005; }
.contact-faq-card {
    background:#fff; border-radius:16px; border:1px solid #e8edf5;
    overflow:hidden; margin-bottom:12px;
    box-shadow:0 2px 12px rgba(0,33,71,0.05);
    transition:box-shadow 0.3s;
}
.contact-faq-card:hover { box-shadow:0 6px 24px rgba(0,33,71,0.09); }
.faq-q {
    display:flex; align-items:center; gap:14px;
    padding:18px 22px; cursor:pointer; transition:background 0.2s;
}
.faq-q:hover { background:#f8fbff; }
.faq-num {
    width:32px; height:32px; min-width:32px;
    background:rgba(0,33,71,0.07); border-radius:8px;
    display:flex; align-items:center; justify-content:center;
    font-size:0.72rem; font-weight:800; color:#002147;
    transition:all 0.3s;
}
.faq-q p { margin:0; font-weight:700; color:#002147; font-size:0.9rem; flex:1; line-height:1.4; }
.faq-q .faq-icon {
    width:30px; height:30px; background:#f0f4f8; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    color:#002147; transition:all 0.3s; flex-shrink:0; font-size:0.75rem;
}
.faq-q.active { background:#f0f6ff; }
.faq-q.active .faq-icon { background:#002147; color:#fab005; transform:rotate(180deg); }
.faq-q.active .faq-num { background:#002147; color:#fab005; }
.faq-a { display:none; padding:0 22px 18px 68px; color:#5a6a7e; font-size:0.88rem; line-height:1.8; }
.faq-a.show { display:block; }

/* ===== Quick Contact Bar ===== */
.quick-contact-bar {
    background:linear-gradient(135deg,#001830 0%,#002147 60%,#003b7a 100%);
    padding:48px 0; position:relative; overflow:hidden;
}
.quick-contact-bar::before {
    content:''; position:absolute; top:-60px; right:-60px;
    width:280px; height:280px;
    background:radial-gradient(circle,rgba(250,176,5,0.08) 0%,transparent 70%);
    border-radius:50%;
}
.qcb-btn {
    display:inline-flex; align-items:center; gap:10px;
    padding:14px 30px; border-radius:50px; font-weight:700; font-size:0.9rem;
    text-decoration:none; transition:all 0.3s;
}
.qcb-btn-wa { background:linear-gradient(135deg,#128C7E,#25d366); color:#fff; box-shadow:0 6px 20px rgba(37,211,102,0.3); }
.qcb-btn-wa:hover { transform:translateY(-3px); box-shadow:0 12px 32px rgba(37,211,102,0.4); color:#fff; }
.qcb-btn-fb { background:linear-gradient(135deg,#1565C0,#1877f2); color:#fff; box-shadow:0 6px 20px rgba(24,119,242,0.3); }
.qcb-btn-fb:hover { transform:translateY(-3px); box-shadow:0 12px 32px rgba(24,119,242,0.4); color:#fff; }
.qcb-btn-tg { background:linear-gradient(135deg,#006DAA,#0088cc); color:#fff; box-shadow:0 6px 20px rgba(0,136,204,0.3); }
.qcb-btn-tg:hover { transform:translateY(-3px); box-shadow:0 12px 32px rgba(0,136,204,0.4); color:#fff; }
</style>
@endpush

@section('contents')

{{-- ===== Hero ===== --}}
<section class="contact-hero">
    <div class="contact-hero-deco"></div>
    <div class="contact-hero-deco2"></div>
    <div class="container position-relative" style="z-index:1;">
        <div class="text-center">
            <div class="contact-hero-badge"><i class="fa-solid fa-headset"></i> যোগাযোগ করুন</div>
            <h1 class="contact-hero-title">আমাদের সাথে <span>যোগাযোগ করুন</span></h1>
            <p class="contact-hero-sub">যেকোনো প্রশ্ন, ভর্তি তথ্য বা সহযোগিতার জন্য আমরা সর্বদা প্রস্তুত। নিচের যেকোনো মাধ্যমে যোগাযোগ করুন।</p>
            <div class="contact-hero-stats">
                <div class="contact-hero-stat">
                    <div class="contact-hero-stat-num">২৪/৭</div>
                    <div class="contact-hero-stat-label">সাপোর্ট</div>
                </div>
                <div class="contact-hero-stat">
                    <div class="contact-hero-stat-num">&lt;২ঘন্টা</div>
                    <div class="contact-hero-stat-label">রিপ্লাই টাইম</div>
                </div>
                <div class="contact-hero-stat">
                    <div class="contact-hero-stat-num">১০০%</div>
                    <div class="contact-hero-stat-label">সন্তুষ্টি</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== Info Cards ===== --}}
<section class="py-5 contact-cards-section">
    <div class="container py-3">
        <div class="row g-4 justify-content-center">

            {{-- Phone --}}
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card card-phone">
                    <div class="contact-icon-box"><i class="fa-solid fa-phone-volume"></i></div>
                    <div class="contact-info-title">ফোন নম্বর</div>
                    <div class="contact-info-value">
                        @php
                            $c_phones = setting('phone_numbers', true);
                            if (is_array($c_phones) && isset($c_phones[0]['setting_values'])) {
                                $c_phones = $c_phones[0]['setting_values'];
                            }
                        @endphp
                        @foreach($c_phones as $item)
                            @php $pn = is_array($item) ? ($item['value'] ?? '') : $item; @endphp
                            <a href="tel:{{ $pn }}" style="display:block;">{{ $pn }}</a>
                        @endforeach
                    </div>
                    <a href="tel:{{ is_array($c_phones[0] ?? '') ? ($c_phones[0]['value'] ?? '') : ($c_phones[0] ?? '') }}" class="contact-info-action">
                        <i class="fa-solid fa-phone"></i> এখনই কল করুন
                    </a>
                </div>
            </div>

            {{-- WhatsApp / Telegram --}}
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card card-wa">
                    <div class="contact-icon-box"><i class="fab fa-whatsapp"></i></div>
                    <div class="contact-info-title">WhatsApp / Telegram</div>
                    <div class="contact-info-value">
                        <a href="https://wa.me/{{ setting('whatsapp') }}" target="_blank" style="display:block;">{{ setting('whatsapp') }}</a>
                    </div>
                    <a href="https://wa.me/{{ setting('whatsapp') }}" target="_blank" class="contact-info-action">
                        <i class="fab fa-whatsapp"></i> WhatsApp করুন
                    </a>
                </div>
            </div>

            {{-- Email --}}
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card card-email">
                    <div class="contact-icon-box"><i class="fa-regular fa-envelope"></i></div>
                    <div class="contact-info-title">ইমেইল ঠিকানা</div>
                    <div class="contact-info-value">
                        @php
                            $c_emails = setting('email', true);
                            if (is_array($c_emails) && isset($c_emails[0]['setting_values'])) {
                                $c_emails = $c_emails[0]['setting_values'];
                            }
                        @endphp
                        @foreach($c_emails as $item)
                            @php $em = is_array($item) ? ($item['value'] ?? '') : $item; @endphp
                            <a href="mailto:{{ $em }}" style="display:block;">{{ $em }}</a>
                        @endforeach
                    </div>
                    <a href="mailto:{{ is_array($c_emails[0] ?? '') ? ($c_emails[0]['value'] ?? '') : ($c_emails[0] ?? '') }}" class="contact-info-action">
                        <i class="fa-regular fa-envelope"></i> ইমেইল করুন
                    </a>
                </div>
            </div>

            {{-- Social --}}
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card card-social">
                    <div class="contact-icon-box"><i class="fa-solid fa-share-nodes"></i></div>
                    <div class="contact-info-title">সোশ্যাল মিডিয়া</div>
                    <div class="contact-info-value mb-1">আমাদের ফলো করুন ও আপডেট পান</div>
                    <div class="contact-social-row">
                        <a href="{{ setting('facebook') }}"  target="_blank" class="contact-social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ setting('instagram') }}" target="_blank" class="contact-social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="{{ setting('youtube') }}"   target="_blank" class="contact-social-btn" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="{{ setting('linkedin') }}"  target="_blank" class="contact-social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="{{ setting('twitter') }}"   target="_blank" class="contact-social-btn" title="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===== Form + Map ===== --}}
<section class="py-5 contact-form-section">
    <div class="container py-2">
        <div class="row g-5 align-items-stretch">

            {{-- Form --}}
            <div class="col-lg-5">
                <div class="contact-form-card h-100">
                    <div class="cf-section-badge"><i class="fa-solid fa-paper-plane"></i> বার্তা পাঠান</div>
                    <div class="cf-title">আমাদের লিখুন</div>
                    <div class="cf-subtitle">আপনার বার্তা লিখুন — আমরা যত দ্রুত সম্ভব সাড়া দেব।</div>

                    @if(session('success'))
                        <div style="background:rgba(5,150,105,0.1); border:1px solid rgba(5,150,105,0.3); border-radius:12px; padding:14px 18px; margin-bottom:22px; color:#065f46; font-size:0.88rem; font-weight:600; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-circle-check" style="color:#059669;"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact_store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="cf-label">আপনার নাম *</label>
                            <div class="cf-field-group">
                                <i class="fa-solid fa-user cf-field-icon"></i>
                                <input type="text" name="full_name" class="cf-input" placeholder="পুরো নাম লিখুন" value="{{ old('full_name') }}">
                            </div>
                            @error('full_name') <small class="text-danger d-block mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="cf-label">ইমেইল *</label>
                            <div class="cf-field-group">
                                <i class="fa-regular fa-envelope cf-field-icon"></i>
                                <input type="email" name="email" class="cf-input" placeholder="আপনার ইমেইল ঠিকানা" value="{{ old('email') }}">
                            </div>
                            @error('email') <small class="text-danger d-block mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="cf-label">বিষয় *</label>
                            <div class="cf-field-group">
                                <i class="fa-solid fa-tag cf-field-icon"></i>
                                <input type="text" name="subject" class="cf-input" placeholder="বার্তার বিষয় লিখুন" value="{{ old('subject') }}">
                            </div>
                            @error('subject') <small class="text-danger d-block mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="cf-label">বার্তা *</label>
                            <div class="cf-field-group">
                                <i class="fa-regular fa-comment-dots cf-field-icon textarea-icon" style="top:14px;"></i>
                                <textarea name="message" class="cf-input" placeholder="আপনার বিস্তারিত বার্তা লিখুন...">{{ old('message') }}</textarea>
                            </div>
                            @error('message') <small class="text-danger d-block mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</small> @enderror
                        </div>
                        <button type="submit" class="cf-submit">
                            <i class="fa-solid fa-paper-plane"></i> বার্তা পাঠান
                        </button>
                    </form>
                </div>
            </div>

            {{-- Map --}}
            <div class="col-lg-7">
                <div class="contact-map-outer">
                    <div class="map-address-badge">
                        <div class="d-flex align-items-center gap-3">
                            <div class="map-badge-icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <div class="map-badge-label">আমাদের ঠিকানা</div>
                                <div class="map-badge-text">{{ setting('address_bangla') ?: 'বাড়ি ৩১, লেন ০১, ব্লক বি, সেকশন ০৬, মিরপুর, ঢাকা, বাংলাদেশ (প্রশিকা মোড়ের পাশে)' }}</div>
                            </div>
                        </div>
                    </div>
                    @include('frontend.pages.contact.includes.map')
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== Quick Contact Bar ===== --}}
<section class="quick-contact-bar">
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center g-4">
            <div class="col-lg-5">
                <div style="color:rgba(255,255,255,0.5); font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:8px;"><i class="fa-solid fa-bolt me-1" style="color:#fab005;"></i> দ্রুত যোগাযোগ</div>
                <h3 style="font-size:1.6rem; font-weight:900; color:#fff; margin-bottom:6px; line-height:1.3;">এখনই কথা বলুন</h3>
                <p style="color:rgba(255,255,255,0.55); font-size:0.88rem; margin:0;">আমাদের টিম সর্বদা আপনার সেবায় প্রস্তুত।</p>
            </div>
            <div class="col-lg-7">
                <div class="d-flex flex-wrap gap-3 justify-content-lg-end">
                    <a href="https://wa.me/{{ setting('whatsapp') }}" target="_blank" class="qcb-btn qcb-btn-wa">
                        <i class="fab fa-whatsapp fa-lg"></i> WhatsApp করুন
                    </a>
                    <a href="{{ setting('facebook') }}" target="_blank" class="qcb-btn qcb-btn-fb">
                        <i class="fab fa-facebook-messenger fa-lg"></i> Messenger
                    </a>
                    <a href="{{ setting('telegram') }}" target="_blank" class="qcb-btn qcb-btn-tg">
                        <i class="fab fa-telegram fa-lg"></i> Telegram
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== FAQ ===== --}}
<section class="py-5 contact-faq-section">
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <div class="faq-badge"><i class="fa-solid fa-circle-question"></i> সাধারণ প্রশ্ন</div>
                    <h2 style="font-size:1.9rem; font-weight:900; color:#002147; margin-bottom:8px;">প্রায়শই জিজ্ঞাসিত প্রশ্ন</h2>
                    <p style="color:#94a3b8; font-size:0.9rem;">আপনার মনের প্রশ্নের উত্তর এখানে খুঁজে নিন।</p>
                </div>
                @foreach($faqs as $i => $faq)
                <div class="contact-faq-card">
                    <div class="faq-q" onclick="this.classList.toggle('active'); this.nextElementSibling.classList.toggle('show'); this.querySelector('.faq-icon i').classList.toggle('fa-chevron-down'); this.querySelector('.faq-icon i').classList.toggle('fa-chevron-up');">
                        <div class="faq-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
                        <p>{{ $faq->title }}</p>
                        <div class="faq-icon"><i class="fa-solid fa-chevron-down"></i></div>
                    </div>
                    <div class="faq-a"><p>{!! $faq->description !!}</p></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
