@php
    $meta = [
        'seo' => [
            'title' => 'About Us — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
<style>
/* ===== Shared ===== */
.abt-section-label { display: inline-block; font-size: 0.74rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; padding: 6px 18px; border-radius: 50px; margin-bottom: 14px; }
.abt-label-blue  { background: rgba(0,33,71,0.08); color: #002147; border: 1px solid rgba(0,33,71,0.15); }
.abt-label-gold  { background: rgba(250,176,5,0.12); color: #c07800; border: 1px solid rgba(250,176,5,0.3); }
.abt-label-white { background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); }
.abt-title { font-size: 2rem; font-weight: 800; line-height: 1.25; color: #002147; }
.abt-title-white { color: #fff; }
.abt-body { font-size: 0.95rem; line-height: 1.9; color: #4a5568; }
.abt-body-white { color: rgba(255,255,255,0.75); }
.abt-divider { width: 60px; height: 4px; background: linear-gradient(90deg, #002147, #fab005); border-radius: 4px; margin: 16px 0 24px; }
.abt-divider-center { margin: 16px auto 24px; }
.btn-abt-fill { background: linear-gradient(135deg, #fab005, #e09600); color: #fff !important; padding: 12px 30px; border-radius: 50px; font-weight: 700; font-size: 0.88rem; text-decoration: none; display: inline-block; transition: all 0.3s; box-shadow: 0 4px 15px rgba(250,176,5,0.35); }
.btn-abt-fill:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(250,176,5,0.45); }
.btn-abt-outline-white { border: 2px solid rgba(255,255,255,0.6); color: #fff !important; padding: 12px 30px; border-radius: 50px; font-weight: 700; font-size: 0.88rem; text-decoration: none; display: inline-block; transition: all 0.3s; }
.btn-abt-outline-white:hover { background: rgba(255,255,255,0.15); border-color: #fff; transform: translateY(-2px); }

/* ===== Page Hero Banner ===== */
.abt-hero { background: linear-gradient(135deg, #001830 0%, #002147 60%, #003b7a 100%); padding: 80px 0 70px; position: relative; overflow: hidden; }
.abt-hero::before { content: ''; position: absolute; top: -100px; right: -80px; width: 500px; height: 500px; background: rgba(250,176,5,0.06); border-radius: 50%; }
.abt-hero::after  { content: ''; position: absolute; bottom: -200px; left: -100px; width: 600px; height: 600px; background: rgba(255,255,255,0.02); border-radius: 50%; }
.abt-hero-img { border-radius: 20px; overflow: hidden; box-shadow: 0 25px 70px rgba(0,0,0,0.35); position: relative; }
.abt-hero-img::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(0,33,71,0.2), rgba(250,176,5,0.1)); z-index: 1; border-radius: 20px; }
.abt-hero-img img { width: 100%; height: 380px; object-fit: cover; display: block; }
.abt-hero-badge { position: absolute; bottom: 20px; left: 20px; z-index: 2; background: rgba(0,0,0,0.65); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 12px 20px; color: #fff; }
.abt-hero-badge .num { font-size: 1.8rem; font-weight: 800; color: #fab005; line-height: 1; }
.abt-hero-badge .lbl { font-size: 0.75rem; opacity: 0.75; }

/* ===== Stats Strip ===== */
.abt-stats { background: linear-gradient(90deg, #fab005 0%, #e09600 100%); padding: 30px 0; }
.abt-stat-item { text-align: center; border-right: 1px solid rgba(255,255,255,0.3); padding: 0 10px; }
.abt-stat-item:last-child { border-right: none; }
.abt-stat-num { font-size: 2.2rem; font-weight: 800; color: #fff; line-height: 1; }
.abt-stat-lbl { font-size: 0.8rem; color: rgba(255,255,255,0.85); font-weight: 600; }

/* ===== Motto / Quote ===== */
.abt-motto { background: #f4f7fb; }
.motto-card { background: #fff; border-radius: 20px; padding: 50px 60px; text-align: center; box-shadow: 0 8px 40px rgba(0,33,71,0.08); position: relative; overflow: hidden; border: 1px solid #eef2f8; }
.motto-card::before { content: '\201C'; position: absolute; top: -30px; left: 30px; font-size: 16rem; color: rgba(0,33,71,0.04); font-family: Georgia, serif; line-height: 1; }
.motto-card h2 { font-size: 1.6rem; font-weight: 700; color: #002147; line-height: 1.5; position: relative; z-index: 1; }
.motto-card p { font-size: 1rem; color: #4a5568; line-height: 1.9; margin-top: 20px; position: relative; z-index: 1; }
.motto-icon { width: 70px; height: 70px; background: linear-gradient(135deg, #002147, #003b7a); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; }
.motto-icon i { color: #fab005; font-size: 1.8rem; }

/* ===== Mission / Vision ===== */
.mission-img { border-radius: 18px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.1); position: relative; }
.mission-img img { width: 100%; height: 380px; object-fit: cover; display: block; transition: transform 0.5s; }
.mission-img:hover img { transform: scale(1.04); }
.mission-img-badge { position: absolute; bottom: 20px; right: 20px; background: linear-gradient(135deg, #002147, #003b7a); color: #fff; border-radius: 12px; padding: 10px 18px; font-size: 0.8rem; font-weight: 700; }
.mission-img-badge span { color: #fab005; font-size: 1.4rem; font-weight: 800; display: block; line-height: 1; }
.check-list { list-style: none; padding: 0; margin: 0; }
.check-list li { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; font-size: 0.9rem; color: #4a5568; line-height: 1.6; }
.check-list li i { color: #002147; font-size: 1rem; margin-top: 3px; flex-shrink: 0; }
.vision-section { background: linear-gradient(135deg, #002147 0%, #003b7a 100%); }
.vision-img { border-radius: 18px; overflow: hidden; box-shadow: 0 15px 50px rgba(0,0,0,0.3); }
.vision-img img { width: 100%; height: 380px; object-fit: cover; display: block; }

/* ===== Team Section ===== */
.team-section { background: #f4f7fb; }
.carousel-main-image { border-radius: 18px; overflow: hidden; box-shadow: 0 12px 40px rgba(0,0,0,0.12); margin-bottom: 20px; }
.carousel-main-image img { width: 100%; height: 480px; object-fit: cover; display: block; transition: opacity 0.3s, transform 0.4s; }
.carousel-thumb-item { padding: 5px; }
.carousel-thumb-item img { width: 100%; height: 68px; object-fit: cover; border-radius: 10px; cursor: pointer; transition: all 0.3s; border: 3px solid transparent; }
.carousel-thumb-item img:hover, .carousel-thumb-item img.active { border-color: #fab005; box-shadow: 0 4px 15px rgba(250,176,5,0.3); transform: translateY(-3px); }

/* ===== Trainers Section ===== */
.trainer-card { background: #fff; border-radius: 18px; overflow: hidden; box-shadow: 0 4px 22px rgba(0,0,0,0.07); transition: all 0.35s ease; }
.trainer-card:hover { transform: translateY(-8px); box-shadow: 0 20px 55px rgba(0,33,71,0.12); }
.trainer-img-wrap { position: relative; overflow: hidden; }
.trainer-img-wrap img { width: 100%; height: 260px; object-fit: cover; transition: transform 0.45s; }
.trainer-card:hover .trainer-img-wrap img { transform: scale(1.05); }
.trainer-social { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,33,71,0.9)); padding: 20px 14px 14px; display: flex; justify-content: center; gap: 10px; opacity: 0; transform: translateY(10px); transition: all 0.35s; }
.trainer-card:hover .trainer-social { opacity: 1; transform: translateY(0); }
.trainer-social a { width: 34px; height: 34px; background: rgba(255,255,255,0.18); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.8rem; text-decoration: none; transition: background 0.2s; }
.trainer-social a:hover { background: #fab005; }
.trainer-info { padding: 20px; text-align: center; }
.trainer-info h5 { font-weight: 700; color: #002147; margin-bottom: 4px; font-size: 1rem; }
.trainer-info .desig { color: #fab005; font-size: 0.82rem; font-weight: 700; margin-bottom: 8px; display: block; }
.trainer-info p { color: #7a8492; font-size: 0.8rem; line-height: 1.6; margin: 0; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.trainer-link { display: flex; justify-content: center; gap: 8px; margin-top: 12px; }
.trainer-link a { width: 32px; height: 32px; border-radius: 50%; background: #f4f7fb; display: flex; align-items: center; justify-content: center; color: #002147; font-size: 0.78rem; text-decoration: none; transition: all 0.2s; }
.trainer-link a:hover { background: #002147; color: #fab005; }

/* ===== CTA Banner ===== */
.abt-cta { background: linear-gradient(135deg, #001830 0%, #002147 55%, #003b7a 100%); padding: 80px 0; position: relative; overflow: hidden; }
.abt-cta::before { content:''; position:absolute; top:-80px; left:50%; transform:translateX(-50%); width:600px; height:600px; background:rgba(250,176,5,0.06); border-radius:50%; }
.abt-cta::after  { content:''; position:absolute; bottom:-120px; right:-60px; width:400px; height:400px; background:rgba(255,255,255,0.02); border-radius:50%; }
.abt-cta-inner  { position:relative; z-index:1; text-align:center; max-width:680px; margin:0 auto; }
.abt-cta-badge  { display:inline-block; background:rgba(250,176,5,0.15); border:1px solid rgba(250,176,5,0.4); color:#fab005; font-size:0.72rem; font-weight:700; padding:6px 18px; border-radius:50px; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.abt-cta-title  { font-size:clamp(1.6rem,3.5vw,2.4rem); font-weight:800; color:#fff; line-height:1.25; margin-bottom:16px; }
.abt-cta-title span { color:#fab005; }
.abt-cta-sub    { color:rgba(255,255,255,0.7); font-size:0.95rem; line-height:1.8; margin-bottom:36px; }
.abt-cta-btns   { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }
.btn-cta-primary { background:linear-gradient(135deg,#fab005,#e09600); color:#fff !important; padding:14px 36px; border-radius:50px; font-weight:700; font-size:0.92rem; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all 0.3s; box-shadow:0 6px 20px rgba(250,176,5,0.4); }
.btn-cta-primary:hover { transform:translateY(-3px); box-shadow:0 10px 28px rgba(250,176,5,0.55); }
.btn-cta-outline { border:2px solid rgba(255,255,255,0.5); color:#fff !important; padding:13px 36px; border-radius:50px; font-weight:700; font-size:0.92rem; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all 0.3s; }
.btn-cta-outline:hover { background:rgba(255,255,255,0.1); border-color:#fff; transform:translateY(-3px); }
</style>
@endpush

@section('contents')

    {{-- ===== Page Hero ===== --}}
    <section class="abt-hero">
        <div class="container position-relative" style="z-index:1;">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <span class="abt-section-label abt-label-white">আমাদের সম্পর্কে</span>
                    @if(isset($AboutUs))
                        <h1 class="abt-title abt-title-white mb-3">{{ $AboutUs->title }}</h1>
                    @else
                        <h1 class="abt-title abt-title-white mb-3">TechPark English-এ আপনাকে স্বাগতম</h1>
                    @endif
                    <div class="abt-divider" style="background:linear-gradient(90deg,#fab005,#fff8);"></div>
                    @if(isset($AboutUs))
                        <div class="abt-body abt-body-white mb-5">{!! Str::limit(strip_tags($AboutUs->description ?? ''), 320) !!}</div>
                    @else
                        <p class="abt-body abt-body-white mb-5">TechPark English বাংলাদেশের একটি অগ্রণী ইংরেজি শিক্ষা প্রতিষ্ঠান। আমরা বিশ্বাস করি, সঠিক পরিবেশ এবং পদ্ধতিতে যেকেউ ইংরেজিতে দক্ষ হতে পারে।</p>
                    @endif
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="/courses" class="btn-abt-fill">আমাদের কোর্স দেখুন</a>
                        <a href="/contact" class="btn-abt-outline-white">যোগাযোগ করুন</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="abt-hero-img">
                        @if(isset($AboutUs) && $AboutUs->image)
                            <img src="{{ assetHelper($AboutUs->image) }}" alt="{{ $AboutUs->title }}">
                        @else
                            <img src="https://dummyimage.com/700x380/003b7a/fff&text=TechPark+English" alt="About TechPark English">
                        @endif
                        <div class="abt-hero-badge">
                            <div class="num">6+</div>
                            <div class="lbl">বছরের অভিজ্ঞতা</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Stats Strip ===== --}}
    <section class="abt-stats">
        <div class="container">
            @php
                $stat_list = (isset($at_a_glances) && $at_a_glances->count() > 0) ? $at_a_glances : collect([
                    (object)['number' => '15,000+', 'title' => 'মোট শিক্ষার্থী'],
                    (object)['number' => '700+',    'title' => 'রেসিডেন্সিয়াল ব্যাচ'],
                    (object)['number' => '95%',     'title' => 'সাফল্যের হার'],
                    (object)['number' => '20+',     'title' => 'দক্ষ প্রশিক্ষক'],
                ]);
                $stat_cols = $stat_list->count() <= 4 ? 'col-md-3 col-6' : 'col-md-2 col-4';
            @endphp
            <div class="row g-3 justify-content-center">
                @foreach($stat_list as $stat)
                <div class="{{ $stat_cols }} abt-stat-item">
                    <div class="abt-stat-num">{{ $stat->number }}</div>
                    <div class="abt-stat-lbl">{{ $stat->title }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== Motto / Quote Section ===== --}}
    {{-- @if(isset($our_moto))
    <section class="abt-motto py-5">
        <div class="container py-4">
            <div class="motto-card">
                <div class="motto-icon"><i class="fa-solid fa-quote-left"></i></div>
                <h2>{{ $our_moto->title }}</h2>
                <p>{!! $our_moto->description !!}</p>
            </div>
        </div>
    </section>
    @endif --}}

    {{-- ===== Mission Section ===== --}}
    @if(isset($our_mission))
    <section class="py-5 bg-white" id="our_mission">
        <div class="container py-4">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="mission-img">
                        <img src="{{ assetHelper(optional($our_mission)->image) }}" alt="{{ $our_mission->title }}">
                        <div class="mission-img-badge">
                            <span>100%</span>English Environment
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <span class="abt-section-label abt-label-blue">আমাদের মিশন</span>
                    <h2 class="abt-title mb-0">{{ $our_mission->title }}</h2>
                    <div class="abt-divider"></div>
                    <div class="abt-body mb-4">{!! $our_mission->description !!}</div>

                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===== Vision Section ===== --}}
    @if(isset($our_vision))
    <section class="py-5 vision-section" id="our_vision">
        <div class="container py-4">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="vision-img">
                        <img src="{{ assetHelper(optional($our_vision)->image) }}" alt="{{ $our_vision->title }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="abt-section-label abt-label-white">আমাদের ভিশন</span>
                    <h2 class="abt-title abt-title-white mb-0">{{ $our_vision->title }}</h2>
                    <div class="abt-divider" style="background:linear-gradient(90deg,#fab005,rgba(255,255,255,0.2));"></div>
                    <div class="abt-body abt-body-white mb-4">{!! $our_vision->description !!}</div>
                 
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===== Team Gallery Section ===== --}}
    @if(isset($our_team) && isset($team_top_image))
    <section class="py-5 team-section" id="our_team">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="abt-section-label abt-label-blue">আমাদের দল</span>
                <h2 class="abt-title">{{ $our_team->title }}</h2>
                <div class="abt-divider abt-divider-center"></div>
                @if($our_team->description)
                    <p class="abt-body mx-auto" style="max-width:620px;">{!! $our_team->description !!}</p>
                @endif
            </div>
            <div style="max-width:900px; margin:0 auto;">
                <div class="carousel-main-image">
                    <img id="mainTeamImage" src="{{ assetHelper(optional($team_top_image)->image) }}" alt="{{ $team_top_image->title ?? 'Team' }}" loading="lazy">
                </div>
                @if(isset($team_related_image) && $team_related_image && $team_related_image->count() > 0)
                <div class="carousel-thumbnails owl-carousel no-global-owl">
                    @foreach($team_related_image as $img)
                        <div class="carousel-thumb-item">
                            <img src="{{ assetHelper(optional($img)->image) }}" alt="{{ $img->title ?? 'Team' }}" loading="lazy" onclick="changeMainImage(this)">
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ===== Professional Trainers ===== --}}
    @if(isset($teachers) && $teachers->count() > 0)
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="abt-section-label abt-label-blue">আমাদের প্রশিক্ষক</span>
                <h2 class="abt-title">আমাদের প্রফেশনাল ট্রেইনারস</h2>
                <div class="abt-divider abt-divider-center"></div>
                <p class="abt-body mx-auto" style="max-width:580px;">অভিজ্ঞ ও দক্ষ প্রশিক্ষকদের তত্ত্বাবধানে আপনার ইংরেজি দক্ষতা বিকাশ করুন।</p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($teachers as $teacher)
                <div class="col-lg-4 col-md-6">
                    <div class="trainer-card">
                        <div class="trainer-img-wrap">
                            <img src="{{ assetHelper(optional($teacher)->image) }}" alt="{{ $teacher->full_name }}" loading="lazy">
                            <div class="trainer-social">
                                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="trainer-info">
                            <h5>{{ $teacher->full_name }}</h5>
                            <span class="desig">{!! $teacher->designation !!}</span>
                            <p>{!! $teacher->short_description !!}</p>
                            <a href="{{ route('teacher.details', ['teacher_name' => str_replace(' ', '-', $teacher->full_name), 'slug' => $teacher->slug]) }}"
                               class="btn-abt-fill mt-3" style="padding:8px 20px; font-size:0.8rem;">
                                বিস্তারিত দেখুন <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== CTA Banner ===== --}}
    <section class="abt-cta">
        <div class="container position-relative" style="z-index:1;">
            <div class="abt-cta-inner">
                <div class="abt-cta-badge"><i class="fa-solid fa-graduation-cap me-1"></i> আজই শুরু করুন</div>
                <h2 class="abt-cta-title">আজই শুরু করুন আপনার <span>ইংরেজি শেখার যাত্রা</span></h2>
                <p class="abt-cta-sub">Join our next batch and take the first step towards fluency. Limited seats available!</p>
                @php
                    $cta_phones = setting('phone_numbers', true);
                    if (is_array($cta_phones) && isset($cta_phones[0]['setting_values'])) {
                        $cta_phones = $cta_phones[0]['setting_values'];
                    }
                @endphp
                <div class="abt-cta-btns">
                    <a href="/courses" class="btn-cta-primary">
                        <i class="fa-solid fa-arrow-right"></i> Enroll Now
                    </a>
                    @if(!empty($cta_phones))
                        @php $cta_num = is_array($cta_phones[0]) ? ($cta_phones[0]['value'] ?? '') : $cta_phones[0]; @endphp
                        @if($cta_num)
                        <a href="tel:{{ $cta_num }}" class="btn-cta-outline">
                            <i class="fa-solid fa-phone"></i> Call Us
                        </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
let isTransitioning = false;
function changeMainImage(el) {
    if (isTransitioning) return;
    const mainImage = document.getElementById('mainTeamImage');
    if (!mainImage) return;
    // Avoid switching to same image (prevent duplication)
    const newSrc = el.getAttribute('data-src') || el.src;
    if (mainImage.src === newSrc) return;
    isTransitioning = true;
    mainImage.style.opacity = '0';
    mainImage.style.transform = 'scale(0.98)';
    setTimeout(() => {
        mainImage.src = newSrc;
        mainImage.alt = el.alt;
        setTimeout(() => {
            mainImage.style.opacity = '1';
            mainImage.style.transform = 'scale(1)';
            setTimeout(() => { isTransitioning = false; }, 350);
        }, 50);
    }, 200);
    // Only mark non-cloned thumbs as active
    document.querySelectorAll('.carousel-thumb-item:not(.cloned) img').forEach(i => i.classList.remove('active'));
    el.classList.add('active');
}
$(document).ready(function() {
    setTimeout(() => {
        // Store real item count before owl clones are created
        const realItems = $('.carousel-thumb-item img').toArray();
        const realCount = realItems.length;

        const $owl = $('.carousel-thumbnails').owlCarousel({
            loop: true, margin: 10, nav: false, dots: false,
            autoplay: true, autoplayTimeout: 4000, autoplayHoverPause: true,
            mouseDrag: true, touchDrag: true,
            responsive: { 0:{items:3}, 480:{items:4}, 768:{items:5}, 1000:{items:6} }
        });

        // Mark first real thumb active
        if (realItems.length) realItems[0].classList.add('active');

        $owl.on('changed.owl.carousel', function(e) {
            if (!e.item || realCount === 0) return;
            // e.item.index in loop mode includes clone offset
            const cloneOffset = e.relatedTarget && e.relatedTarget._clones
                ? e.relatedTarget._clones.length / 2
                : 0;
            const realIdx = ((e.item.index - cloneOffset) % realCount + realCount) % realCount;
            const img = realItems[realIdx];
            if (img && !isTransitioning) changeMainImage(img);
        });
    }, 300);
});
</script>
@endpush
