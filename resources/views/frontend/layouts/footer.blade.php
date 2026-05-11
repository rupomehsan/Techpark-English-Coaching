<style>
/* ===== Modern Footer ===== */
.footer_area_start {
    background: linear-gradient(180deg, #001020 0%, #001830 100%);
    padding: 70px 0 0;
    color: rgba(255,255,255,0.72);
    font-size: 0.88rem;
}
.footer-brand img { height: 52px; width: auto; }
.footer-brand-desc { color: rgba(255,255,255,0.55); font-size: 0.83rem; line-height: 1.8; margin: 16px 0 20px; max-width: 280px; }
.footer-social-row { display: flex; gap: 8px; flex-wrap: wrap; }
.footer-social-btn {
    width: 36px; height: 36px; border-radius: 50%;
    background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1);
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.65); font-size: 0.78rem; text-decoration: none;
    transition: all 0.25s;
}
.footer-social-btn:hover { transform: translateY(-3px); color: #fff; }
.footer-social-btn.fb:hover  { background: #1877f2; border-color: #1877f2; }
.footer-social-btn.yt:hover  { background: #ff0000; border-color: #ff0000; }
.footer-social-btn.ig:hover  { background: linear-gradient(135deg,#f09433,#dc2743,#bc1888); border-color:transparent; }
.footer-social-btn.wa:hover  { background: #25d366; border-color: #25d366; }
.footer-social-btn.li:hover  { background: #0a66c2; border-color: #0a66c2; }
.footer-social-btn.tg:hover  { background: #0088cc; border-color: #0088cc; }

.footer-col-title {
    font-size: 0.78rem; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase;
    color: #fab005; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;
}
.footer-col-title::after { content:''; flex:1; height:1px; background:rgba(250,176,5,0.2); }

.footer-links { list-style: none; padding: 0; margin: 0; }
.footer-links li { margin-bottom: 10px; }
.footer-links li a {
    color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.85rem;
    display: flex; align-items: center; gap: 8px; transition: all 0.2s;
}
.footer-links li a i { color: #fab005; font-size: 0.65rem; flex-shrink: 0; }
.footer-links li a:hover { color: #fab005; padding-left: 4px; }

.footer-contact-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; }
.footer-contact-icon {
    width: 34px; height: 34px; background: rgba(250,176,5,0.12); border-radius: 8px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    color: #fab005; font-size: 0.82rem;
}
.footer-contact-text { flex: 1; }
.footer-contact-text a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.83rem; line-height: 1.6; transition: color 0.2s; }
.footer-contact-text a:hover { color: #fab005; }
.footer-contact-text p { margin: 0; color: rgba(255,255,255,0.7); font-size: 0.83rem; line-height: 1.6; }

.footer-map-wrap { border-radius: 10px; overflow: hidden; margin-top: 14px; border: 1px solid rgba(255,255,255,0.06); }
.footer-map-wrap iframe { width: 100%; height: 130px; border: 0; display: block; filter: brightness(0.8) saturate(0.8); }

.footer-divider { border: none; margin-top: 50px; }
.footer-bottom {
    background: rgba(0,0,0,0.25);
    border-top: 1px solid rgba(255,255,255,0.06);
    padding: 16px 0;
}
.footer-copyright {
    color: rgba(255,255,255,0.45);
    font-size: 0.78rem;
    display: flex; align-items: center; gap: 8px;
}
.footer-copyright i { color: #fab005; font-size: 0.7rem; }
.footer-copyright .copy-year {
    background: rgba(250,176,5,0.12);
    border: 1px solid rgba(250,176,5,0.2);
    color: #fab005; font-size: 0.7rem; font-weight: 700;
    padding: 2px 8px; border-radius: 4px;
}
.footer-bottom-links { display: flex; gap: 0; flex-wrap: wrap; }
.footer-bottom-links a {
    color: rgba(255,255,255,0.38); font-size: 0.74rem;
    text-decoration: none; transition: color 0.2s;
    padding: 4px 12px;
    border-right: 1px solid rgba(255,255,255,0.08);
}
.footer-bottom-links a:last-child { border-right: none; }
.footer-bottom-links a:hover { color: #fab005; }

@media(max-width:767px) {
    .footer_area_start { padding: 50px 0 0; }
    .footer-brand-desc { max-width: 100%; }
}
</style>

<footer class="footer_area_start">
    <div class="container">
        <div class="row g-5">

            {{-- Col 1: Brand --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-brand">
                    <a href="/"><img class="rounded" src="{{ assetHelper(setting('image')) }}" alt="TechPark English" loading="lazy"></a>
                </div>
                <p class="footer-brand-desc">বাংলাদেশের অন্যতম শীর্ষস্থানীয় ইংরেজি শিক্ষা প্রতিষ্ঠান। সঠিক পরিবেশে ইংরেজি শিখুন, স্বপ্ন পূরণ করুন।</p>
                <div class="footer-social-row">
                    <a href="{{ setting('facebook') }}" target="_blank" rel="noopener" class="footer-social-btn fb" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ setting('youtube') }}"  target="_blank" rel="noopener" class="footer-social-btn yt" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="{{ setting('instagram') }}" target="_blank" rel="noopener" class="footer-social-btn ig" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/{{ setting('whatsapp') }}" target="_blank" rel="noopener" class="footer-social-btn wa" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="{{ setting('telegram') }}" target="_blank" rel="noopener" class="footer-social-btn tg" aria-label="Telegram"><i class="fab fa-telegram"></i></a>
                    <a href="{{ setting('linkedin') }}" target="_blank" rel="noopener" class="footer-social-btn li" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            {{-- Col 2: Quick Links --}}
            <div class="col-lg-2 col-md-6">
                <div class="footer-col-title"><i class="fa-solid fa-link"></i> Quick Links</div>
                <ul class="footer-links">
                    <li><a href="{{ route('website') }}"><i class="fa-solid fa-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="fa-solid fa-chevron-right"></i> About</a></li>
                    <li><a href="{{ route('courses') }}"><i class="fa-solid fa-chevron-right"></i> Courses</a></li>
                    <li><a href="{{ route('gallery') }}"><i class="fa-solid fa-chevron-right"></i> Gallery</a></li>
                    <li><a href="{{ route('blog') }}"><i class="fa-solid fa-chevron-right"></i> Blog</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fa-solid fa-chevron-right"></i> Contact</a></li>
                    <li><a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right"></i> Login</a></li>
                </ul>
            </div>

            {{-- Col 3: Important Links --}}
            <div class="col-lg-2 col-md-6">
                <div class="footer-col-title"><i class="fa-solid fa-shield-halved"></i> Important</div>
                <ul class="footer-links">
                    <li><a href="{{ route('refund.policy') }}"><i class="fa-solid fa-chevron-right"></i> Refund Policy</a></li>
                    <li><a href="{{ route('terms.policy') }}"><i class="fa-solid fa-chevron-right"></i> Terms &amp; Conditions</a></li>
                    <li><a href="{{ route('cookies.policy') }}"><i class="fa-solid fa-chevron-right"></i> Cookies Policy</a></li>
                    <li><a href="{{ route('privacy.policy') }}"><i class="fa-solid fa-chevron-right"></i> Privacy Policy</a></li>
                    <li><a href="{{ route('sitemap.policy') }}"><i class="fa-solid fa-chevron-right"></i> Site Map</a></li>
                </ul>
            </div>

            {{-- Col 4: Contact --}}
            <div class="col-lg-2 col-md-6">
                <div class="footer-col-title"><i class="fa-solid fa-headset"></i> Contact</div>

                @php
                    $fp_numbers = setting('phone_numbers', true);
                    if (is_array($fp_numbers) && isset($fp_numbers[0]['setting_values'])) {
                        $fp_numbers = $fp_numbers[0]['setting_values'];
                    }
                @endphp
                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="footer-contact-text">
                        @foreach($fp_numbers as $item)
                            @php $pn = is_array($item) ? ($item['value'] ?? '') : $item; @endphp
                            <a href="tel:{{ $pn }}" style="display:block;">{{ $pn }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i class="fab fa-whatsapp"></i></div>
                    <div class="footer-contact-text">
                        <a href="https://wa.me/{{ setting('whatsapp') }}" target="_blank">{{ setting('whatsapp') }}</a>
                    </div>
                </div>

                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i class="fab fa-telegram"></i></div>
                    <div class="footer-contact-text">
                        <a href="{{ setting('telegram') }}" target="_blank">Join Telegram</a>
                    </div>
                </div>

                @php
                    $fe_mails = setting('emails', true);
                    if (is_array($fe_mails) && isset($fe_mails[0]['setting_values'])) {
                        $fe_mails = $fe_mails[0]['setting_values'];
                    }
                @endphp
                @foreach($fe_mails as $item)
                    @php $em = is_array($item) ? ($item['value'] ?? '') : $item; @endphp
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon"><i class="fa-regular fa-envelope"></i></div>
                        <div class="footer-contact-text"><a href="mailto:{{ $em }}">{{ $em }}</a></div>
                    </div>
                @endforeach
            </div>

            {{-- Col 5: Address & Map --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-col-title"><i class="fa-solid fa-location-dot"></i> Address</div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i class="fa-solid fa-map-pin"></i></div>
                    <div class="footer-contact-text">
                        <p>{{ setting('address_bangla') ?: 'বাড়ি ৩১, লেন ০১, ব্লক বি, সেকশন ০৬, মিরপুর, ঢাকা, বাংলাদেশ (প্রশিকা মোড়ের পাশে)' }}</p>
                    </div>
                </div>
                <div class="footer-map-wrap">
                    {!! setting('map_link') !!}
                </div>
            </div>

        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="footer-divider">
        <div class="footer-bottom"><div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">
            <p class="footer-copyright mb-0">
                <i class="fa-regular fa-copyright"></i>
                <span class="copy-year">2019–{{ date('Y') }}</span>
                @php $site_name_cr = setting('site_name') ?: 'TechPark English'; @endphp
                {{ $site_name_cr }}. সর্বস্বত্ব সংরক্ষিত।
            </p>
            <div class="footer-bottom-links">
                <a href="{{ route('privacy.policy') }}">প্রাইভেসি পলিসি</a>
                <a href="{{ route('terms.policy') }}">টার্মস</a>
                <a href="{{ route('refund.policy') }}">রিফান্ড</a>
                <a href="{{ route('sitemap.policy') }}">সাইটম্যাপ</a>
            </div>
        </div></div>
    </div>
</footer>
