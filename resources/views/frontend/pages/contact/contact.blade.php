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
.contact-hero { background: linear-gradient(135deg, #001830 0%, #002147 60%, #003b7a 100%); padding: 60px 0 50px; position: relative; overflow: hidden; }
.contact-hero::before { content:''; position:absolute; top:-80px; right:-60px; width:350px; height:350px; background:rgba(250,176,5,0.06); border-radius:50%; }

/* ===== Info Cards ===== */
.contact-info-card {
    background: #fff; border-radius: 18px; padding: 28px 24px;
    box-shadow: 0 4px 24px rgba(0,33,71,0.07); border: 1px solid #eef2f8;
    height: 100%; transition: all 0.3s;
}
.contact-info-card:hover { transform: translateY(-4px); box-shadow: 0 14px 40px rgba(0,33,71,0.1); }
.contact-icon-box {
    width: 52px; height: 52px; border-radius: 14px;
    background: linear-gradient(135deg, #002147, #003b7a);
    display: flex; align-items: center; justify-content: center;
    color: #fab005; font-size: 1.1rem; margin-bottom: 16px;
}
.contact-info-title { font-weight: 800; color: #002147; font-size: 1rem; margin-bottom: 6px; }
.contact-info-value { color: #4a5568; font-size: 0.88rem; line-height: 1.7; }
.contact-info-value a { color: #4a5568; text-decoration: none; transition: color 0.2s; }
.contact-info-value a:hover { color: #002147; }

/* ===== Social Row ===== */
.contact-social-row { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 10px; }
.contact-social-btn {
    width: 36px; height: 36px; border-radius: 50%;
    background: #f0f4f8; display: flex; align-items: center; justify-content: center;
    color: #002147; font-size: 0.82rem; text-decoration: none; transition: all 0.2s;
}
.contact-social-btn:hover { background: #002147; color: #fab005; transform: translateY(-2px); }

/* ===== Form Card ===== */
.contact-form-card {
    background: #fff; border-radius: 18px; padding: 36px;
    box-shadow: 0 4px 24px rgba(0,33,71,0.07); border: 1px solid #eef2f8;
}
.cf-label { font-size: 0.8rem; font-weight: 700; color: #2d3748; margin-bottom: 6px; display: block; }
.cf-input {
    width: 100%; padding: 12px 16px; border: 1.5px solid #e2e8f0; border-radius: 10px;
    font-size: 0.88rem; color: #333; background: #fff; transition: border-color 0.2s, box-shadow 0.2s;
    outline: none; font-family: inherit;
}
.cf-input:focus { border-color: #002147; box-shadow: 0 0 0 3px rgba(0,33,71,0.08); }
.cf-input::placeholder { color: #bbb; }
textarea.cf-input { resize: vertical; min-height: 130px; }
.cf-submit {
    background: linear-gradient(135deg, #002147, #003b7a); color: #fff;
    border: none; padding: 13px 36px; border-radius: 50px; font-weight: 700;
    font-size: 0.92rem; cursor: pointer; transition: all 0.3s;
    display: inline-flex; align-items: center; gap: 8px;
}
.cf-submit:hover { background: linear-gradient(135deg, #fab005, #e09600); box-shadow: 0 6px 20px rgba(250,176,5,0.4); }

/* ===== Map ===== */
.contact-map-wrap { border-radius: 18px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,33,71,0.08); border: 1px solid #eef2f8; }
.contact-map-wrap iframe { width: 100%; height: 400px; border: 0; display: block; }

/* ===== FAQ ===== */
.contact-faq-card { background: #fff; border-radius: 14px; border: 1px solid #eef2f8; overflow: hidden; margin-bottom: 10px; box-shadow: 0 2px 10px rgba(0,33,71,0.04); }
.faq-q { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; cursor: pointer; transition: background 0.2s; }
.faq-q:hover { background: #f8fbff; }
.faq-q p { margin: 0; font-weight: 700; color: #002147; font-size: 0.9rem; flex: 1; }
.faq-q .faq-icon { width: 28px; height: 28px; background: #f0f4f8; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #002147; transition: all 0.3s; flex-shrink: 0; }
.faq-q.active { background: #f0f5ff; }
.faq-q.active .faq-icon { background: #002147; color: #fab005; transform: rotate(180deg); }
.faq-a { display: none; padding: 4px 20px 16px; color: #4a5568; font-size: 0.88rem; line-height: 1.75; }
.faq-a.show { display: block; }
</style>
@endpush

@section('contents')

{{-- ===== Hero ===== --}}
<section class="contact-hero">
    <div class="container position-relative" style="z-index:1;">
        <div class="text-center">
            <span style="background:rgba(250,176,5,0.18); border:1px solid rgba(250,176,5,0.5); color:#fab005; font-size:0.75rem; font-weight:700; padding:6px 18px; border-radius:50px; display:inline-block; margin-bottom:14px; letter-spacing:0.8px; text-transform:uppercase;"><i class="fa-solid fa-headset me-1"></i> যোগাযোগ</span>
            <h1 class="fw-bold text-white mb-3" style="font-size:2.2rem;">Contact With Us</h1>
            <p style="color:rgba(255,255,255,0.65); font-size:0.95rem; max-width:560px; margin:0 auto;">আমাদের যেকোনো প্রশ্ন বা জিজ্ঞাসার জন্য নিচের মাধ্যমে যোগাযোগ করুন।</p>
        </div>
    </div>
</section>

{{-- ===== Contact Info Cards ===== --}}
<section class="py-5" style="background:#f4f7fb;">
    <div class="container py-2">
        <div class="row g-4 mb-5">

            {{-- Phone --}}
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
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
                </div>
            </div>

            {{-- WhatsApp / Telegram --}}
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <div class="contact-icon-box"><i class="fab fa-whatsapp"></i></div>
                    <div class="contact-info-title">WhatsApp / Telegram</div>
                    <div class="contact-info-value">
                        <a href="https://wa.me/{{ setting('whatsapp') }}" target="_blank" style="display:block;">{{ setting('whatsapp') }}</a>
                        <a href="{{ setting('telegram') }}" target="_blank" style="display:block; margin-top:4px;">Join Telegram</a>
                    </div>
                </div>
            </div>

            {{-- Email --}}
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <div class="contact-icon-box"><i class="fa-regular fa-envelope"></i></div>
                    <div class="contact-info-title">ইমেইল</div>
                    <div class="contact-info-value">
                        @php
                            $c_emails = setting('emails', true);
                            if (is_array($c_emails) && isset($c_emails[0]['setting_values'])) {
                                $c_emails = $c_emails[0]['setting_values'];
                            }
                        @endphp
                        @foreach($c_emails as $item)
                            @php $em = is_array($item) ? ($item['value'] ?? '') : $item; @endphp
                            <a href="mailto:{{ $em }}" style="display:block;">{{ $em }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Social --}}
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <div class="contact-icon-box"><i class="fa-solid fa-share-nodes"></i></div>
                    <div class="contact-info-title">সোশ্যাল মিডিয়া</div>
                    <div class="contact-info-value mb-2">আমাদের ফলো করুন</div>
                    <div class="contact-social-row">
                        <a href="{{ setting('facebook') }}"  target="_blank" class="contact-social-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ setting('instagram') }}" target="_blank" class="contact-social-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="{{ setting('youtube') }}"   target="_blank" class="contact-social-btn" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="{{ setting('linkedin') }}"  target="_blank" class="contact-social-btn" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="{{ setting('twitter') }}"   target="_blank" class="contact-social-btn" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Message Form + Map --}}
        <div class="row g-4 mb-5">
            {{-- Form --}}
            <div class="col-lg-5">
                <div class="contact-form-card">
                    <div style="margin-bottom:24px;">
                        <span style="background:rgba(0,33,71,0.06); border:1px solid rgba(0,33,71,0.1); color:#002147; font-size:0.68rem; font-weight:700; padding:5px 14px; border-radius:50px; letter-spacing:1px; text-transform:uppercase; display:inline-block; margin-bottom:10px;"><i class="fa-solid fa-paper-plane me-1"></i> বার্তা পাঠান</span>
                        <h2 style="font-size:1.4rem; font-weight:800; color:#002147; margin-bottom:4px;">Inbox Us</h2>
                        <p style="font-size:0.82rem; color:#888; margin:0;">আপনার বার্তা লিখুন, আমরা যত দ্রুত সম্ভব সাড়া দেব।</p>
                    </div>
                    <form action="{{ route('contact_store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="cf-label">আপনার নাম</label>
                            <input type="text" name="full_name" class="cf-input" placeholder="পুরো নাম লিখুন">
                            @error('full_name') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="cf-label">ইমেইল</label>
                            <input type="email" name="email" class="cf-input" placeholder="আপনার ইমেইল">
                            @error('email') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="cf-label">বিষয়</label>
                            <input type="text" name="subject" class="cf-input" placeholder="বিষয় লিখুন">
                            @error('subject') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="cf-label">বার্তা</label>
                            <textarea name="message" class="cf-input" placeholder="আপনার বার্তা লিখুন..."></textarea>
                            @error('message') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                        </div>
                        <button type="submit" class="cf-submit">
                            <i class="fa-solid fa-paper-plane"></i> বার্তা পাঠান
                        </button>
                    </form>
                </div>
            </div>

            {{-- Map --}}
            <div class="col-lg-7">
                <div class="contact-map-wrap" style="height:100%; min-height:400px;">
                    @include('frontend.pages.contact.includes.map')
                </div>
            </div>
        </div>

        {{-- FAQ --}}
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-4">
                    <span style="background:rgba(0,33,71,0.06); border:1px solid rgba(0,33,71,0.1); color:#002147; font-size:0.68rem; font-weight:700; padding:5px 14px; border-radius:50px; letter-spacing:1px; text-transform:uppercase; display:inline-block; margin-bottom:10px;"><i class="fa-solid fa-circle-question me-1"></i> সাধারণ প্রশ্ন</span>
                    <h2 style="font-size:1.6rem; font-weight:800; color:#002147;">General Questions</h2>
                    <p style="color:#888; font-size:0.88rem;">আপনার যদি কোনো প্রশ্ন থাকে, এখানে খুঁজে দেখুন।</p>
                </div>
                @foreach($faqs as $faq)
                <div class="contact-faq-card">
                    <div class="faq-q" onclick="this.classList.toggle('active'); this.nextElementSibling.classList.toggle('show'); this.querySelector('.faq-icon i').classList.toggle('fa-chevron-down'); this.querySelector('.faq-icon i').classList.toggle('fa-chevron-up');">
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
