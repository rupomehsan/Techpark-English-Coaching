@php
    $meta = [
        'seo' => [
            'title' => 'Tech Park English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
    /* ===== Global ===== */
    .section-title { font-size: 1.8rem; font-weight: 700; color: #002147; text-align: center; margin-bottom: 5px; }
    .section-subtitle { display: block; font-size: 0.9rem; color: #777; text-align: center; margin-bottom: 40px; }
    .btn-tpe-fill { background: linear-gradient(135deg, #fab005, #e09600); color: #fff; padding: 11px 30px; border-radius: 50px; border: none; font-weight: 700; font-size: 0.9rem; transition: all 0.3s; box-shadow: 0 4px 15px rgba(250,176,5,0.35); text-decoration: none; display: inline-block; }
    .btn-tpe-fill:hover { background: linear-gradient(135deg, #e09600, #c07800); color: #fff; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(250,176,5,0.45); }
    .btn-tpe-outline { border: 2px solid #002147; color: #002147; padding: 11px 30px; border-radius: 50px; font-weight: 700; font-size: 0.9rem; transition: all 0.3s; text-decoration: none; display: inline-block; }
    .btn-tpe-outline:hover { background: #002147; color: #fff; transform: translateY(-2px); }
    .bg-soft { background: #f4f7fb; }

    /* ===== Carousel Arrows ===== */
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px; height: 50px;
        background: #fff !important;
        border-radius: 50% !important;
        top: 50%; transform: translateY(-50%);
        opacity: 1 !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        transition: all 0.3s ease; border: none;
    }
    .carousel-control-prev { left: 20px; }
    .carousel-control-next { right: 20px; }
    .carousel-control-prev:hover, .carousel-control-next:hover {
        background: #002147 !important;
        box-shadow: 0 8px 28px rgba(0,33,71,0.4);
        transform: translateY(-50%) scale(1.08);
    }
    .carousel-control-prev:hover .car-icon, .carousel-control-next:hover .car-icon { color: #fff; }
    .car-icon { font-size: 1rem; color: #002147; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; transition: color 0.3s; }
    .carousel-control-prev-icon, .carousel-control-next-icon { display: none; }

    /* ===== Stats ===== */
    .stats-section { background: linear-gradient(135deg, #002147 0%, #003b7a 100%); color: #fff; padding: 55px 0; position: relative; overflow: hidden; }
    .stats-section::before { content: ''; position: absolute; top: -80px; left: -60px; width: 280px; height: 280px; background: rgba(255,255,255,0.03); border-radius: 50%; }
    .stats-section::after { content: ''; position: absolute; bottom: -100px; right: -40px; width: 350px; height: 350px; background: rgba(250,176,5,0.05); border-radius: 50%; }
    .stat-item { text-align: center; border-right: 1px solid rgba(255,255,255,0.1); position: relative; z-index: 1; padding: 10px 0; }
    .stat-item:last-child { border-right: none; }
    .stat-icon { font-size: 2rem; margin-bottom: 10px; color: #fab005; }
    .stat-number { font-size: 2.6rem; font-weight: 800; line-height: 1; margin-bottom: 6px; background: linear-gradient(135deg, #fff 0%, #fab005 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .stat-label { font-size: 0.82rem; font-weight: 600; opacity: 0.75; }

    /* ===== Courses ===== */
    .course-card { border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.35s ease; background: #fff; overflow: hidden; }
    .course-card:hover { transform: translateY(-8px); box-shadow: 0 18px 45px rgba(0,33,71,0.13); }
    .course-card img { width: 100%; height: 200px; object-fit: cover; }
    .course-card .card-body { padding: 22px; }
    .course-badge { background: #002147; color: #fff; font-size: 0.68rem; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-bottom: 8px; font-weight: 700; letter-spacing: 0.5px; }
    .course-title { font-weight: 700; font-size: 1rem; color: #1a1a2e; margin-bottom: 14px; }
    .course-info { font-size: 0.8rem; color: #555; }
    .course-info i { color: #002147; width: 18px; text-align: center; margin-right: 4px; }
    .course-price { font-size: 1.2rem; font-weight: 800; color: #002147; }

    /* ===== Why Choose Us ===== */
    .why-section { background: linear-gradient(135deg, #f0f5fb 0%, #e8f0fe 100%); }
    .why-desc-content { font-size: 0.95rem; line-height: 1.8; color: #444; }
    .why-desc-content p { margin-bottom: 12px; }
    .why-desc-content strong, .why-desc-content b { color: #002147; }
    .why-desc-content ul, .why-desc-content ol { padding-left: 0; list-style: none; margin-bottom: 0; }
    .why-desc-content ol li, .why-desc-content ul li {
        position: relative; padding: 14px 16px 14px 60px;
        margin-bottom: 14px; background: #fff;
        border-radius: 12px; box-shadow: 0 2px 12px rgba(0,33,71,0.06);
        border-left: 3px solid #fab005; counter-increment: why-counter;
    }
    .why-desc-content ol { counter-reset: why-counter; }
    .why-desc-content ol li::before {
        content: counter(why-counter);
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        width: 32px; height: 32px; background: linear-gradient(135deg,#fab005,#e09600);
        color: #fff; border-radius: 50%; display: flex; align-items: center;
        justify-content: center; font-weight: 800; font-size: 0.82rem;
        box-shadow: 0 3px 10px rgba(250,176,5,0.35);
    }
    .why-desc-content ul li::before {
        content: '✓';
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        width: 32px; height: 32px; background: linear-gradient(135deg,#002147,#003b7a);
        color: #fab005; border-radius: 50%; display: flex; align-items: center;
        justify-content: center; font-weight: 800; font-size: 0.85rem;
    }
    .why-desc-content li strong, .why-desc-content li b { display: block; color: #1a1a2e; font-size: 0.93rem; margin-bottom: 3px; }
    .video-thumb-wrap { position: relative; border-radius: 18px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.18); cursor: pointer; }
    .video-thumb-wrap img { width: 100%; display: block; transition: transform 0.45s ease; }
    .video-thumb-wrap:hover img { transform: scale(1.04); }
    .play-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.28); display: flex; align-items: center; justify-content: center; transition: background 0.3s; }
    .video-thumb-wrap:hover .play-overlay { background: rgba(0,0,0,0.48); }
    .play-circle { width: 72px; height: 72px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 28px rgba(0,0,0,0.3); transition: transform 0.3s; }
    .video-thumb-wrap:hover .play-circle { transform: scale(1.12); }
    .play-circle i { color: #ff0000; font-size: 1.8rem; margin-left: 6px; }
    .yt-modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.88); z-index: 9999; align-items: center; justify-content: center; }
    .yt-modal.open { display: flex; }
    .yt-modal-inner { position: relative; width: 90%; max-width: 820px; aspect-ratio: 16/9; }
    .yt-modal-inner iframe { width: 100%; height: 100%; border: none; border-radius: 10px; }
    .yt-modal-close { position: absolute; top: -46px; right: 0; color: #fff; font-size: 1.6rem; cursor: pointer; background: none; border: none; padding: 4px 8px; line-height: 1; opacity: 0.85; transition: opacity 0.2s; }
    .yt-modal-close:hover { opacity: 1; }

    /* ===== Task 3: Services — gradient bg + animated hover ===== */
    @keyframes gradShift {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .service-card {
        border-radius: 18px; padding: 32px 26px; text-align: center;
        border: 1px solid rgba(255,255,255,0.6);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: all 0.4s ease;
        position: relative; overflow: hidden;
        background-size: 200% 200%;
    }
    .service-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 3px 3px 0 0; transition: transform 0.35s ease; transform: scaleX(0); transform-origin: left; }
    .service-card:hover { transform: translateY(-10px); box-shadow: 0 22px 55px rgba(0,33,71,0.15); border-color: transparent; background-size: 200% 200%; animation: gradShift 3s ease infinite; }
    .service-card:hover::before { transform: scaleX(1); }
    /* Per-card gradients */
    .service-card:nth-child(1) { background: linear-gradient(135deg, #e8f4ff, #dbeeff, #c8e4ff); }
    .service-card:nth-child(1)::before { background: linear-gradient(90deg, #0066cc, #002147); }
    .service-card:nth-child(1):hover { background: linear-gradient(135deg, #c8e4ff, #a0d0ff, #dbeeff, #e8f4ff); }
    .service-card:nth-child(2) { background: linear-gradient(135deg, #f0ebff, #e4d9ff, #d4c4ff); }
    .service-card:nth-child(2)::before { background: linear-gradient(90deg, #7c3aed, #5b21b6); }
    .service-card:nth-child(2):hover { background: linear-gradient(135deg, #d4c4ff, #b8a0ff, #e4d9ff, #f0ebff); }
    .service-card:nth-child(3) { background: linear-gradient(135deg, #e8fff0, #d4f5e0, #c0ebd0); }
    .service-card:nth-child(3)::before { background: linear-gradient(90deg, #059669, #047857); }
    .service-card:nth-child(3):hover { background: linear-gradient(135deg, #c0ebd0, #98d9b0, #d4f5e0, #e8fff0); }
    .service-card:nth-child(4) { background: linear-gradient(135deg, #fff8e8, #ffefc8, #ffe5a0); }
    .service-card:nth-child(4)::before { background: linear-gradient(90deg, #fab005, #e09600); }
    .service-card:nth-child(4):hover { background: linear-gradient(135deg, #ffe5a0, #ffd060, #ffefc8, #fff8e8); }
    .service-card:nth-child(5) { background: linear-gradient(135deg, #e0fbff, #c8f4fc, #a8ecf8); }
    .service-card:nth-child(5)::before { background: linear-gradient(90deg, #0891b2, #0e7490); }
    .service-card:nth-child(5):hover { background: linear-gradient(135deg, #a8ecf8, #80e0f4, #c8f4fc, #e0fbff); }
    .service-card:nth-child(6) { background: linear-gradient(135deg, #fff0f5, #ffe0eb, #ffc8da); }
    .service-card:nth-child(6)::before { background: linear-gradient(90deg, #db2777, #be185d); }
    .service-card:nth-child(6):hover { background: linear-gradient(135deg, #ffc8da, #ffa8c8, #ffe0eb, #fff0f5); }
    .service-icon-wrap { width: 76px; height: 76px; background: rgba(255,255,255,0.7); border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.9rem; color: #002147; margin: 0 auto 20px; transition: all 0.4s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
    .service-card:hover .service-icon-wrap { background: rgba(255,255,255,0.95); transform: scale(1.1) rotate(-5deg); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
    .service-card h5 { font-weight: 700; color: #1a1a2e; margin-bottom: 10px; font-size: 1rem; }
    .service-card p { color: #4a5568; font-size: 0.84rem; margin: 0; line-height: 1.7; }

    /* ===== Photo Gallery ===== */
    .gallery-item { position: relative; border-radius: 14px; overflow: hidden; cursor: pointer; box-shadow: 0 4px 18px rgba(0,0,0,0.08); }
    .gallery-item img { width: 100%; height: 225px; object-fit: cover; display: block; transition: transform 0.45s ease; }
    .gallery-item:hover img { transform: scale(1.08); }
    .gallery-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(0,33,71,0.6), rgba(250,176,5,0.4)); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.35s; }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    .gallery-overlay i { color: #fff; font-size: 2.2rem; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.4)); }
    .lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.93); z-index: 9999; align-items: center; justify-content: center; }
    .lightbox.open { display: flex; }
    .lightbox-content { position: relative; max-width: 90vw; max-height: 90vh; }
    .lightbox-content img { max-width: 90vw; max-height: 85vh; border-radius: 10px; object-fit: contain; box-shadow: 0 25px 70px rgba(0,0,0,0.6); }
    .lightbox-close { position: absolute; top: -48px; right: 0; background: none; border: none; color: #fff; font-size: 2rem; cursor: pointer; line-height: 1; opacity: 0.85; transition: opacity 0.2s; }
    .lightbox-close:hover { opacity: 1; }
    .lightbox-nav { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); color: #fff; width: 46px; height: 46px; border-radius: 50%; font-size: 1.1rem; cursor: pointer; transition: background 0.25s; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
    .lightbox-nav:hover { background: rgba(255,255,255,0.25); }
    .lightbox-prev { left: -64px; }
    .lightbox-next { right: -64px; }
    @media(max-width:768px) { .lightbox-prev { left: 10px; } .lightbox-next { right: 10px; } }

    /* ===== Video Gallery ===== */
    .vid-card { border-radius: 16px; overflow: hidden; background: #fff; box-shadow: 0 6px 25px rgba(0,0,0,0.08); transition: all 0.35s ease; }
    .vid-card:hover { transform: translateY(-7px); box-shadow: 0 18px 50px rgba(0,0,0,0.14); }
    .vid-thumb-wrap { position: relative; overflow: hidden; cursor: pointer; }
    .vid-thumb-wrap img { width: 100%; height: 215px; object-fit: cover; display: block; transition: opacity 0.3s, transform 0.4s; }
    .vid-card:hover .vid-thumb-wrap img { opacity: 0.88; transform: scale(1.04); }
    .vid-play-btn { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 56px; height: 56px; background: rgba(255,0,0,0.92); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: transform 0.3s, background 0.3s; box-shadow: 0 4px 20px rgba(255,0,0,0.4); }
    .vid-card:hover .vid-play-btn { transform: translate(-50%, -50%) scale(1.12); background: #ff0000; }
    .vid-play-btn i { color: #fff; font-size: 1.3rem; margin-left: 5px; }
    .vid-info { padding: 18px 20px; }
    .vid-info h6 { font-weight: 700; color: #1a1a2e; margin-bottom: 7px; font-size: 0.95rem; line-height: 1.4; }
    .vid-info p { color: #7a8492; font-size: 0.8rem; margin: 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

    /* ===== Trainer Section ===== */
    .trainer-card { background: #fff; border-radius: 18px; overflow: hidden; box-shadow: 0 4px 22px rgba(0,0,0,0.07); transition: all 0.35s ease; }
    .trainer-card:hover { transform: translateY(-9px); box-shadow: 0 22px 55px rgba(0,33,71,0.13); }
    .trainer-img-wrap { position: relative; overflow: hidden; }
    .trainer-img-wrap img { width: 100%; height: 275px; object-fit: cover; transition: transform 0.45s ease; }
    .trainer-card:hover .trainer-img-wrap img { transform: scale(1.05); }
    .trainer-social-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,33,71,0.88)); padding: 24px 16px 16px; display: flex; justify-content: center; gap: 10px; opacity: 0; transform: translateY(12px); transition: all 0.35s ease; }
    .trainer-card:hover .trainer-social-overlay { opacity: 1; transform: translateY(0); }
    .trainer-social-overlay a { width: 36px; height: 36px; background: rgba(255,255,255,0.18); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.85rem; text-decoration: none; transition: background 0.25s; }
    .trainer-social-overlay a:hover { background: #fab005; }
    .trainer-info { padding: 20px; text-align: center; }
    .trainer-info h5 { font-weight: 700; color: #002147; margin-bottom: 4px; font-size: 1rem; }
    .trainer-info .desig { color: #fab005; font-size: 0.82rem; font-weight: 700; margin-bottom: 8px; display: block; }
    .trainer-info p { color: #7a8492; font-size: 0.8rem; line-height: 1.6; margin: 0; }

    /* ===== Free Seminar ===== */
    .seminar-hero { background: linear-gradient(135deg, #001830 0%, #002147 50%, #003b7a 100%); padding: 85px 0; position: relative; overflow: hidden; }
    .seminar-hero::before { content: ''; position: absolute; top: -120px; right: -80px; width: 450px; height: 450px; background: rgba(250,176,5,0.07); border-radius: 50%; }
    .seminar-hero::after { content: ''; position: absolute; bottom: -160px; left: -100px; width: 400px; height: 400px; background: rgba(255,255,255,0.03); border-radius: 50%; }
    .seminar-badge { background: rgba(250,176,5,0.18); border: 1px solid rgba(250,176,5,0.5); color: #fab005; font-size: 0.8rem; padding: 7px 18px; border-radius: 50px; display: inline-block; margin-bottom: 18px; font-weight: 700; letter-spacing: 0.6px; }
    .seminar-feature { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 18px; display: flex; align-items: center; gap: 14px; backdrop-filter: blur(8px); }
    .seminar-feature-icon { width: 46px; height: 46px; min-width: 46px; background: rgba(250,176,5,0.18); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fab005; font-size: 1.1rem; }
    .seminar-form-card { background: #fff; border-radius: 22px; padding: 42px 38px; box-shadow: 0 25px 65px rgba(0,0,0,0.18); }
    .seminar-form-card .form-control, .seminar-form-card .form-select { background: #f5f8fc; border: 2px solid transparent; border-radius: 12px; padding: 12px 16px; font-size: 0.88rem; transition: border-color 0.3s, background 0.3s; }
    .seminar-form-card .form-control:focus, .seminar-form-card .form-select:focus { background: #fff; border-color: #002147; box-shadow: none; }
    .seminar-form-card label { font-size: 0.82rem; font-weight: 700; color: #444; margin-bottom: 6px; display: block; }
    .btn-seminar { background: linear-gradient(135deg, #002147, #003b7a); color: #fff; border: none; border-radius: 12px; padding: 14px; font-weight: 700; font-size: 1rem; width: 100%; transition: all 0.3s; cursor: pointer; }
    .btn-seminar:hover { background: linear-gradient(135deg, #fab005, #e09600); color: #fff; transform: translateY(-2px); box-shadow: 0 10px 28px rgba(250,176,5,0.35); }

    /* ===== Marquee ===== */
    .marquee-section { overflow: hidden; }
    .marquee-row { display: flex; gap: 20px; width: max-content; }
    .marquee-row-wrap { overflow: hidden; }
    .marquee-row-wrap:first-child .marquee-row { animation: marquee-left 32s linear infinite; }
    .marquee-row-wrap:last-child  .marquee-row { animation: marquee-right 36s linear infinite; }
    @keyframes marquee-left  { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    @keyframes marquee-right { 0% { transform: translateX(-50%); } 100% { transform: translateX(0); } }
    .marquee-row-wrap:hover .marquee-row { animation-play-state: paused; }
    .mq-card { background: #fff; border-radius: 18px; padding: 22px 20px; box-shadow: 0 4px 20px rgba(0,33,71,0.07); border: 1px solid #f0f4f8; width: 300px; flex-shrink: 0; transition: box-shadow 0.3s; }
    .mq-card:hover { box-shadow: 0 12px 40px rgba(0,33,71,0.13); }
    .mq-vid-thumb { position: relative; border-radius: 10px; overflow: hidden; margin-bottom: 14px; cursor: pointer; }
    .mq-vid-thumb img { width: 100%; height: 155px; object-fit: cover; display: block; transition: transform 0.4s; }
    .mq-card:hover .mq-vid-thumb img { transform: scale(1.05); }
    .mq-play { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 42px; height: 42px; background: rgba(255,0,0,0.88); border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    .mq-play i { color: #fff; font-size: 0.95rem; margin-left: 3px; }
    .mq-name { font-weight: 700; color: #002147; font-size: 0.88rem; margin-bottom: 3px; }
    .mq-role { font-size: 0.74rem; color: #fab005; font-weight: 600; }
    .mq-stars { color: #fab005; font-size: 0.72rem; margin-top: 6px; }

    /* ===== Success Stories — professional ===== */
    .testi-section { background: linear-gradient(180deg, #f4f7fb 0%, #fff 100%); }
    .testi-featured { background: linear-gradient(135deg, #002147, #003b7a); border-radius: 20px; padding: 40px 48px; color: #fff; position: relative; overflow: hidden; margin-bottom: 50px; }
    .testi-featured::before { content: '\201C'; position: absolute; top: -20px; left: 24px; font-size: 14rem; color: rgba(250,176,5,0.15); font-family: Georgia, serif; line-height: 1; }
    .testi-featured blockquote { font-size: 1.2rem; font-style: italic; line-height: 1.8; color: rgba(255,255,255,0.92); margin: 0 0 24px; position: relative; z-index: 1; }
    .testi-featured-author { display: flex; align-items: center; gap: 16px; }
    .testi-featured-author img { width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 3px solid #fab005; }
    .testi-featured-author .name { font-weight: 700; font-size: 1rem; color: #fff; }
    .testi-featured-author .role { font-size: 0.82rem; color: rgba(255,255,255,0.6); }
    .testi-featured-author .stars { color: #fab005; font-size: 0.85rem; margin-top: 3px; }
    .testi-card { background: #fff; border-radius: 18px; padding: 28px 24px; box-shadow: 0 4px 24px rgba(0,0,0,0.06); transition: all 0.35s ease; position: relative; border: 1px solid #f0f4f8; }
    .testi-card:hover { transform: translateY(-6px); box-shadow: 0 18px 50px rgba(0,33,71,0.10); border-color: #e2eaf5; }
    .testi-card .quote-icon { width: 40px; height: 40px; background: linear-gradient(135deg, #002147, #003b7a); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 18px; }
    .testi-card .quote-icon i { color: #fab005; font-size: 1rem; }
    .testi-card blockquote { font-size: 0.88rem; color: #4a5568; line-height: 1.8; font-style: italic; margin: 0 0 20px; border: none; padding: 0; }
    .testi-divider { height: 1px; background: linear-gradient(90deg, #e2eaf5, transparent); margin-bottom: 18px; }
    .testi-author { display: flex; align-items: center; gap: 12px; }
    .testi-author img { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid #fab005; }
    .testi-author .name { font-weight: 700; color: #002147; font-size: 0.9rem; }
    .testi-author .role { font-size: 0.76rem; color: #888; }
    .testi-stars { color: #fab005; font-size: 0.78rem; margin-top: 2px; }

    /* ===== CTA Footer ===== */
    .cta-footer { background: linear-gradient(135deg, #001830 0%, #002147 55%, #003b7a 100%); padding: 80px 0; position: relative; overflow: hidden; }
    .cta-footer::before { content:''; position:absolute; top:-80px; left:50%; transform:translateX(-50%); width:600px; height:600px; background:rgba(250,176,5,0.06); border-radius:50%; }
    .cta-footer::after  { content:''; position:absolute; bottom:-120px; right:-60px; width:400px; height:400px; background:rgba(255,255,255,0.02); border-radius:50%; }
    .cta-footer-inner  { position:relative; z-index:1; text-align:center; max-width:680px; margin:0 auto; }
    .cta-footer-badge  { display:inline-block; background:rgba(250,176,5,0.15); border:1px solid rgba(250,176,5,0.4); color:#fab005; font-size:0.72rem; font-weight:700; padding:6px 18px; border-radius:50px; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
    .cta-footer-title  { font-size:clamp(1.6rem,3.5vw,2.4rem); font-weight:800; color:#fff; line-height:1.25; margin-bottom:16px; }
    .cta-footer-title span { color:#fab005; }
    .cta-footer-sub    { color:rgba(255,255,255,0.7); font-size:0.95rem; line-height:1.8; margin-bottom:36px; }
    .cta-footer-btns   { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }
    .btn-cta-primary { background:linear-gradient(135deg,#fab005,#e09600); color:#fff !important; padding:14px 36px; border-radius:50px; font-weight:700; font-size:0.92rem; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all 0.3s; box-shadow:0 6px 20px rgba(250,176,5,0.4); }
    .btn-cta-primary:hover { transform:translateY(-3px); box-shadow:0 10px 28px rgba(250,176,5,0.55); }
    .btn-cta-outline { border:2px solid rgba(255,255,255,0.5); color:#fff !important; padding:13px 36px; border-radius:50px; font-weight:700; font-size:0.92rem; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all 0.3s; }
    .btn-cta-outline:hover { background:rgba(255,255,255,0.1); border-color:#fff; transform:translateY(-3px); }
</style>
@endpush

@section('contents')

    {{-- Hero Banner --}}
    <section class="hero-banner-section">
        @if(isset($banners) && count($banners) > 0)
            <div id="homeBannerCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($banners as $key => $banner)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset($banner->image) }}" class="d-block w-100" alt="Banner" style="height:75vh; object-fit:cover;">
                        </div>
                    @endforeach
                </div>
                @if(count($banners) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#homeBannerCarousel" data-bs-slide="prev">
                        <span class="car-icon"><i class="fa-solid fa-chevron-left"></i></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#homeBannerCarousel" data-bs-slide="next">
                        <span class="car-icon"><i class="fa-solid fa-chevron-right"></i></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        @else
            <div style="width:100%; height:75vh; background:linear-gradient(135deg,#002147,#003b7a); display:flex; align-items:center; justify-content:center;">
                <div class="text-center text-white">
                    <h1 class="fw-bold display-4 mb-3">TechPark English</h1>
                    <p class="fs-5 opacity-75">ইংরেজি শিখুন, জীবন বদলান</p>
                </div>
            </div>
        @endif
    </section>

    {{-- Stats Section --}}
    <section class="stats-section">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @php
                    $stat_icons = ['fa-users','fa-calendar-check','fa-graduation-cap','fa-trophy','fa-star','fa-book','fa-chalkboard-user','fa-award'];
                    $stat_fallback = [
                        ['number'=>'700+',   'title'=>'রেসিডেন্সিয়াল শিক্ষার্থী'],
                        ['number'=>'6+',     'title'=>'বছরের অভিজ্ঞতা'],
                        ['number'=>'15,000+','title'=>'মোট শিক্ষার্থী'],
                        ['number'=>'95%',    'title'=>'সাফল্যের হার'],
                    ];
                    $stats = (isset($at_a_glances) && $at_a_glances->count() > 0) ? $at_a_glances : collect($stat_fallback)->map(fn($s)=>(object)$s);
                    $stat_count = $stats->count();
                @endphp
                @foreach($stats as $idx => $stat)
                <div class="col-md-3 col-6 stat-item {{ $loop->last ? 'border-0' : '' }}">
                    <i class="fa-solid {{ $stat_icons[$idx % count($stat_icons)] }} stat-icon"></i>
                    <div class="stat-number">{{ $stat->number ?? $stat->number }}</div>
                    <div class="stat-label">{{ $stat->title }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Courses Section --}}
    <section class="py-5 bg-soft">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="section-title">আমাদের কোর্স সমূহ</h2>
                <span class="section-subtitle">রেসিডেন্সিয়াল ও অনলাইন — দুই মাধ্যমেই শিখুন</span>
            </div>
            <div class="row g-4 justify-content-center">
                @if(isset($courses) && count($courses) > 0)
                    @foreach($courses->take(3) as $course)
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card h-100">
                            <img src="{{ $course->image ? asset($course->image) : 'https://dummyimage.com/600x400/00377a/fff&text=Course' }}" alt="{{ $course->title }}">
                            <div class="card-body">
                                <span class="course-badge">RESIDENTIAL / ONLINE</span>
                                <h3 class="course-title">{{ $course->title ?? 'জিরো টু স্পোকেন ইংলিশ' }}</h3>
                                <div class="course-info mb-4">
                                    <p class="mb-2"><i class="fa-regular fa-clock"></i> <strong>মূল কোর্স:</strong> {{ $course->duration ?? '২ মাস' }}</p>
                                    <p class="mb-2"><i class="fa-solid fa-calendar-days"></i> <strong>ক্লাস:</strong> সপ্তাহে ৫ দিন</p>
                                    <p class="mb-0"><i class="fa-solid fa-list-ol"></i> <strong>মোট ক্লাস:</strong> 82</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div class="course-price">৳{{ number_format($course->fee ?? 25000) }} <small class="text-decoration-line-through text-muted" style="font-size:0.8rem;">৳{{ number_format(($course->fee ?? 25000) + 5000) }}</small></div>
                                    <div class="d-flex gap-2">
                                        <a href="/course/{{ $course->slug ?? '' }}" class="btn-tpe-outline" style="padding:6px 14px; font-size:0.78rem; border-width:1.5px;">Details</a>
                                        <a href="/course/enroll/{{ $course->slug ?? '' }}" class="btn-tpe-fill" style="padding:6px 14px; font-size:0.78rem;">Enroll</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    @for($i=1; $i<=3; $i++)
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card h-100">
                            <img src="https://dummyimage.com/600x400/00377a/fff&text=Course+{{ $i }}" alt="Course {{ $i }}">
                            <div class="card-body">
                                <span class="course-badge">ZERO TO SPOKEN ENGLISH</span>
                                <h3 class="course-title">জিরো টু স্পোকেন ইংলিশ (আবাসিক)</h3>
                                <div class="course-info mb-4">
                                    <p class="mb-2"><i class="fa-regular fa-clock"></i> <strong>মূল কোর্স:</strong> ২ মাস (৮ সপ্তাহ)</p>
                                    <p class="mb-2"><i class="fa-solid fa-calendar-days"></i> <strong>ক্লাস:</strong> সপ্তাহে ৫ দিন</p>
                                    <p class="mb-0"><i class="fa-solid fa-list-ol"></i> <strong>মোট ক্লাস:</strong> ৪২</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div class="course-price">৳25,000 <small class="text-decoration-line-through text-muted" style="font-size:0.78rem;">৳30,000</small></div>
                                    <div class="d-flex gap-2">
                                        <a href="#" class="btn-tpe-outline" style="padding:6px 14px; font-size:0.78rem; border-width:1.5px;">Details</a>
                                        <a href="#" class="btn-tpe-fill" style="padding:6px 14px; font-size:0.78rem;">Enroll</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                @endif
            </div>
            <div class="text-center mt-5">
                <a href="/courses" class="btn-tpe-fill"><i class="fa-solid fa-arrow-right-long me-2"></i> সকল কোর্স দেখুন</a>
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    @php
        $wy_title = $why_us->title       ?? 'কেন TechPark English বেছে নেবেন?';
        $wy_desc  = $why_us->description ?? '<p>দেশের সেরা ইংরেজি শেখার পরিবেশ, বিশেষজ্ঞ শিক্ষক এবং প্রমাণিত পদ্ধতিতে আপনার সাফল্য নিশ্চিত করা হয়।</p>';
        $wy_video = $why_us->video_link  ?? 'KlX7Z5OrFrw';
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $wy_video, $wy_vid_match);
        $wy_vid_id = $wy_vid_match[1] ?? $wy_video;
    @endphp
    <section class="py-5 why-section">
        <div class="container py-4">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3" style="color:#002147; font-size:2rem; line-height:1.3;">{!! $wy_title !!}</h2>
                    <div class="why-desc-content" style="font-size:0.95rem; line-height:1.8; color:#555;">
                        {!! $wy_desc !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="video-thumb-wrap" onclick="openYtModal('{{ $wy_vid_id }}')">
                        <img src="https://img.youtube.com/vi/{{ $wy_vid_id }}/maxresdefault.jpg"
                             alt="TechPark English Video"
                             onerror="this.src='https://img.youtube.com/vi/{{ $wy_vid_id }}/hqdefault.jpg'">
                        <div class="play-overlay">
                            <div class="play-circle"><i class="fa-solid fa-play"></i></div>
                        </div>
                    </div>
                    <p class="text-center text-muted small mt-3 mb-0">
                        <i class="fa-brands fa-youtube text-danger me-1"></i>
                        TechPark English — আমাদের ইউটিউব চ্যানেলে ভিজিট করুন
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- YouTube Modal --}}
    <div class="yt-modal" id="ytModal" onclick="ytModalBgClose(event)">
        <div class="yt-modal-inner">
            <button class="yt-modal-close" onclick="closeYtModal()"><i class="fa-solid fa-xmark"></i></button>
            <iframe id="ytIframe" src="" allowfullscreen allow="autoplay; encrypted-media; picture-in-picture"></iframe>
        </div>
    </div>

    {{-- Our Services --}}
    @php
        $svc_fallback = [
            ['icon'=>'fa-solid fa-bed',               'title'=>'আবাসন ব্যবস্থা',        'description'=>'সুবিধাজনক হোস্টেল সুবিধা সহ ২৪/৭ ইংরেজি পরিবেশ নিশ্চিত করা হয়।'],
            ['icon'=>'fa-solid fa-video',              'title'=>'লাইভ অনলাইন ক্লাস',    'description'=>'দেশের যেকোনো প্রান্ত থেকে লাইভ ক্লাসে অংশ নিন নির্বিঘ্নে।'],
            ['icon'=>'fa-solid fa-chalkboard-user',    'title'=>'প্র্যাক্টিস সেশন',     'description'=>'সার্বক্ষণিক স্পিকিং প্র্যাক্টিস এবং মেন্টর সাপোর্টের সুযোগ।'],
            ['icon'=>'fa-solid fa-book-open-reader',   'title'=>'ফ্রি স্টাডি ম্যাটেরিয়ালস','description'=>'সম্পূর্ণ বিনামূল্যে পিডিএফ, শিট ও রেকর্ডেড লেকচার।'],
            ['icon'=>'fa-solid fa-certificate',        'title'=>'ভেরিফাইড সার্টিফিকেট', 'description'=>'কোর্স শেষে আন্তর্জাতিক মানের ডিজিটাল ও প্রিন্টেড সার্টিফিকেট।'],
            ['icon'=>'fa-solid fa-infinity',           'title'=>'আজীবন অ্যাক্সেস',      'description'=>"রেকর্ডেড ভিডিও লেসনে সারাজীবন অ্যাক্সেস — যেকোনো সময় শিখুন।"],
        ];
        $services_list = (isset($our_services) && $our_services->count() > 0)
            ? $our_services
            : collect($svc_fallback)->map(fn($s)=>(object)$s);
    @endphp
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title mb-2">আমাদের সেবাসমূহ</h2>
                <span class="section-subtitle">TechPark English শিক্ষার্থীদের সর্বোচ্চ সুবিধা নিশ্চিত করে</span>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($services_list as $svc)
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100">
                        <div class="service-icon-wrap">
                            @if(!empty($svc->icon))
                                <i class="{{ $svc->icon }}"></i>
                            @else
                                <i class="fa-solid fa-star"></i>
                            @endif
                        </div>
                        <h5>{{ $svc->title }}</h5>
                        <p>{!! $svc->description !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Task 6: Photo Gallery — dynamic from Gallery model --}}
    <section class="py-5 bg-soft">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title">আমাদের একাডেমির ছবি</h2>
                <span class="section-subtitle">ক্যাম্পাস, ক্লাসরুম ও শিক্ষার্থীদের বিশেষ মুহূর্ত</span>
            </div>
            @php
                $homeGalleryImages = \App\Modules\Management\GalleryManagement\Gallery\Models\Model::where('status', 'active')
                    ->orderBy('top_image', 'DESC')
                    ->limit(6)
                    ->get();
                $galleryFallback = [
                    ['src'=>'https://dummyimage.com/800x600/00377a/fff&text=Classroom+01', 'alt'=>'Classroom 01'],
                    ['src'=>'https://dummyimage.com/800x600/003b7a/fff&text=Campus+Life',   'alt'=>'Campus Life'],
                    ['src'=>'https://dummyimage.com/800x600/002147/fff&text=Speaking',       'alt'=>'Speaking Session'],
                    ['src'=>'https://dummyimage.com/800x600/001a3d/fff&text=Workshop',       'alt'=>'Workshop'],
                    ['src'=>'https://dummyimage.com/800x600/c07800/fff&text=Graduation',     'alt'=>'Graduation Day'],
                    ['src'=>'https://dummyimage.com/800x600/004080/fff&text=Group+Activity', 'alt'=>'Group Activity'],
                ];
                $hasGallery = $homeGalleryImages && $homeGalleryImages->count() > 0;
            @endphp
            <div class="row g-3 justify-content-center">
                @if($hasGallery)
                    @foreach($homeGalleryImages as $idx => $gimg)
                    <div class="col-lg-4 col-md-6">
                        <div class="gallery-item" onclick="openLightbox({{ $idx }})">
                            <img src="{{ $gimg->image }}" alt="{{ $gimg->title ?? 'Gallery' }}">
                            <div class="gallery-overlay"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
                        </div>
                    </div>
                    @endforeach
                @else
                    @foreach($galleryFallback as $idx => $img)
                    <div class="col-lg-4 col-md-6">
                        <div class="gallery-item" onclick="openLightbox({{ $idx }})">
                            <img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}">
                            <div class="gallery-overlay"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="text-center mt-5">
                <a href="/gallery" class="btn-tpe-outline"><i class="fa-regular fa-image me-2"></i> সব ছবি দেখুন</a>
            </div>
        </div>
    </section>

    {{-- Lightbox --}}
    <div class="lightbox" id="lightbox" onclick="lightboxBgClose(event)">
        <div class="lightbox-content">
            <button class="lightbox-close" onclick="closeLightbox()"><i class="fa-solid fa-xmark"></i></button>
            <button class="lightbox-nav lightbox-prev" onclick="lightboxNav(-1)"><i class="fa-solid fa-chevron-left"></i></button>
            <img id="lightboxImg" src="" alt="Gallery Preview">
            <button class="lightbox-nav lightbox-next" onclick="lightboxNav(1)"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>

    {{-- Video Gallery --}}
    @php
        $vid_fallback = [
            ['video_link'=>'KlX7Z5OrFrw','title'=>'TechPark English — আমাদের পরিচয়',             'description'=>'TechPark English কীভাবে আপনার ইংরেজি জীবন বদলে দিতে পারে।'],
            ['video_link'=>'WBUqpFdbBHw','title'=>'Practical Spoken & Written English — Class 03','description'=>'প্র্যাক্টিক্যাল স্পোকেন ও রিটেন ইংলিশ কোর্সের তৃতীয় ক্লাস।'],
            ['video_link'=>'OiuVG0VVGX8','title'=>'How to Use "Others" in English Grammar',      'description'=>'"Others" শব্দের সঠিক ব্যবহার — বিস্তারিত গ্রামার বিশ্লেষণ ও উদাহরণ সহ।'],
            ['video_link'=>'iReyATpBxKw','title'=>'Learn 10 Tech-Related English Words',         'description'=>'প্রযুক্তি বিষয়ক ১০টি গুরুত্বপূর্ণ ইংরেজি শব্দ সহজ উদাহরণ দিয়ে শিখুন।'],
        ];
        $videos_list = (isset($our_videos) && $our_videos->count() > 0)
            ? $our_videos
            : collect($vid_fallback)->map(fn($v)=>(object)$v);
    @endphp
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title mb-2">আমাদের ভিডিও গ্যালারি</h2>
                <span class="section-subtitle">ইংরেজি শেখার ক্লাস, টিপস ও শিক্ষার্থীদের অভিজ্ঞতা</span>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($videos_list as $video)
                @php
                    preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->video_link ?? '', $vm);
                    $vid_id = $vm[1] ?? $video->video_link;
                @endphp
                <div class="col-lg-6">
                    <div class="vid-card">
                        <div class="vid-thumb-wrap" onclick="openYtModal('{{ $vid_id }}')">
                            <img src="https://img.youtube.com/vi/{{ $vid_id }}/maxresdefault.jpg"
                                 alt="{{ $video->title }}"
                                 onerror="this.src='https://img.youtube.com/vi/{{ $vid_id }}/hqdefault.jpg'">
                            <div class="vid-play-btn"><i class="fa-solid fa-play"></i></div>
                        </div>
                        <div class="vid-info">
                            <h6>{{ $video->title }}</h6>
                            <p>{{ $video->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('videos') }}" class="btn-tpe-fill">
                    <i class="fa-solid fa-play-circle me-2"></i> সব ভিডিও দেখুন
                </a>
            </div>
        </div>
    </section>

    {{-- Professional Trainers --}}
    @php
        $trainers_list = (isset($course_instructors) && $course_instructors->count() > 0)
            ? $course_instructors
            : collect([
                (object)['full_name'=>'Md. Ahsan Habib','designation'=>'Lead Trainer & Founder',  'short_description'=>'৬+ বছরের অভিজ্ঞতা — IELTS ও Spoken English বিশেষজ্ঞ।','image'=>null,'facebook'=>null,'linkedin'=>null,'instagram'=>null,'slug'=>null],
                (object)['full_name'=>'Farhan Ahmed',   'designation'=>'Senior English Trainer',  'short_description'=>'৫ বছরের অভিজ্ঞতা — Phonetics ও Pronunciation বিশেষজ্ঞ।', 'image'=>null,'facebook'=>null,'linkedin'=>null,'instagram'=>null,'slug'=>null],
                (object)['full_name'=>'Nusrat Jahan',   'designation'=>'English Writing Expert',  'short_description'=>'৪ বছরের অভিজ্ঞতা — Academic ও Business Writing বিশেষজ্ঞ।','image'=>null,'facebook'=>null,'linkedin'=>null,'instagram'=>null,'slug'=>null],
                (object)['full_name'=>'Kamrul Islam',   'designation'=>'IELTS Specialist',        'short_description'=>'৬ বছরের অভিজ্ঞতা — IELTS Band 8+ অর্জনকারী প্রশিক্ষক।', 'image'=>null,'facebook'=>null,'linkedin'=>null,'instagram'=>null,'slug'=>null],
            ]);
    @endphp
    <section class="py-5 bg-soft">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title mb-2">আমাদের প্রফেশনাল ট্রেইনার</h2>
                <span class="section-subtitle">অভিজ্ঞ ও দক্ষ প্রশিক্ষকদের তত্ত্বাবধানে আপনার ইংরেজি শিখুন</span>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($trainers_list as $trainer)
                @php
                    $t_img = $trainer->image ? asset($trainer->image) : 'https://dummyimage.com/400x500/002147/fff&text='.urlencode(strtoupper(substr($trainer->full_name ?? 'T', 0, 1)));
                @endphp
                <div class="col-lg-3 col-md-6">
                    <div class="trainer-card">
                        <div class="trainer-img-wrap">
                            <img src="{{ $t_img }}" alt="{{ $trainer->full_name }}">
                            <div class="trainer-social-overlay">
                                @if(!empty($trainer->facebook))
                                <a href="{{ $trainer->facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if(!empty($trainer->linkedin))
                                <a href="{{ $trainer->linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if(!empty($trainer->instagram))
                                <a href="{{ $trainer->instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="trainer-info">
                            <h5>{{ $trainer->full_name }}</h5>
                            <span class="desig">{{ $trainer->designation }}</span>
                            <p>{{ Str::limit(strip_tags($trainer->short_description ?? ''), 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Free Seminar --}}
    @php
        $fsem = $featured_seminar ?? null;
        $fsem_title = $fsem ? $fsem->title : null;
        $fsem_desc  = $fsem ? $fsem->description : null;
        $fsem_date  = $fsem ? \Carbon\Carbon::parse($fsem->date_time) : null;
        $fsem_days_left = $fsem_date ? (int)\Carbon\Carbon::now()->diffInDays($fsem_date, false) : null;
        $fsem_is_today  = $fsem_date ? $fsem_date->isToday() : false;
    @endphp
    <section class="seminar-hero">
        <div class="container position-relative" style="z-index:1;">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <span class="seminar-badge">
                        <i class="fa-solid fa-bolt me-2"></i>
                        {{ $fsem_is_today ? 'আজকের সেমিনার' : 'সম্পূর্ণ বিনামূল্যে' }}
                    </span>
                    @if($fsem)
                        <h2 class="fw-bold text-white mb-2" style="font-size:2.1rem; line-height:1.3;">{{ $fsem_title }}</h2>
                        @if($fsem_desc)
                        <p class="mb-3" style="color:rgba(255,255,255,0.65); font-size:0.95rem; line-height:1.8;">{!! Str::limit(strip_tags($fsem_desc), 200) !!}</p>
                        @endif
                        <div class="d-flex flex-wrap gap-3 mb-4" style="font-size:0.85rem; color:rgba(255,255,255,0.6);">
                            @if($fsem_is_today)
                                <span><i class="fa-solid fa-calendar me-1" style="color:#fab005;"></i> আজকে</span>
                            @elseif($fsem_days_left !== null && $fsem_days_left > 0)
                                <span><i class="fa-solid fa-calendar me-1" style="color:#fab005;"></i> {{ $fsem_days_left }} দিন বাকী</span>
                            @endif
                            <span><i class="fa-solid fa-clock me-1" style="color:#fab005;"></i> {{ $fsem_date->format('d M Y, h:i A') }}</span>
                            <span><i class="fa-solid fa-location-dot me-1" style="color:#fab005;"></i> অনলাইন / অফলাইন</span>
                        </div>
                    @else
                        <h2 class="fw-bold text-white mb-3" style="font-size:2.3rem; line-height:1.3;">ফ্রি সেমিনারে <br><span style="color:#fab005;">যোগ দিন আজই!</span></h2>
                        <p class="mb-4" style="color:rgba(255,255,255,0.65); font-size:0.95rem; line-height:1.8;">আমাদের বিশেষজ্ঞ প্রশিক্ষকদের সাথে সরাসরি কথা বলুন। ইংরেজি শেখার সেরা কৌশল ও রোডম্যাপ জানুন একদম বিনামূল্যে।</p>
                        <div class="d-flex flex-wrap gap-3 mb-4" style="font-size:0.85rem; color:rgba(255,255,255,0.6);">
                            <span><i class="fa-solid fa-calendar me-1" style="color:#fab005;"></i> প্রতি শুক্রবার</span>
                            <span><i class="fa-solid fa-clock me-1" style="color:#fab005;"></i> বিকাল ৩:০০ টা</span>
                            <span><i class="fa-solid fa-location-dot me-1" style="color:#fab005;"></i> অনলাইন / অফলাইন</span>
                        </div>
                    @endif
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6"><div class="seminar-feature"><div class="seminar-feature-icon"><i class="fa-solid fa-microphone"></i></div><div><div class="text-white fw-bold" style="font-size:0.88rem;">স্পিকিং সেশন</div><div style="color:rgba(255,255,255,0.55); font-size:0.76rem;">লাইভ প্র্যাক্টিস সেশন</div></div></div></div>
                        <div class="col-sm-6"><div class="seminar-feature"><div class="seminar-feature-icon"><i class="fa-solid fa-lightbulb"></i></div><div><div class="text-white fw-bold" style="font-size:0.88rem;">টিপস & ট্রিকস</div><div style="color:rgba(255,255,255,0.55); font-size:0.76rem;">প্রমাণিত কৌশল শিখুন</div></div></div></div>
                        <div class="col-sm-6"><div class="seminar-feature"><div class="seminar-feature-icon"><i class="fa-solid fa-circle-question"></i></div><div><div class="text-white fw-bold" style="font-size:0.88rem;">Q&A সেশন</div><div style="color:rgba(255,255,255,0.55); font-size:0.76rem;">সরাসরি প্রশ্ন করুন</div></div></div></div>
                        <div class="col-sm-6"><div class="seminar-feature"><div class="seminar-feature-icon"><i class="fa-solid fa-gift"></i></div><div><div class="text-white fw-bold" style="font-size:0.88rem;">ফ্রি উপহার</div><div style="color:rgba(255,255,255,0.55); font-size:0.76rem;">স্টাডি ম্যাটেরিয়াল পাবেন</div></div></div></div>
                    </div>
                    <a href="{{ route('all-seminers') }}" class="btn-tpe-fill" style="display:inline-flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-calendar-days"></i> আসন্ন সব সেমিনার দেখুন
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="seminar-form-card">
                        <div class="mb-4">
                            <h4 class="fw-bold mb-1" style="color:#002147;">ফ্রি রেজিস্ট্রেশন করুন</h4>
                            <p class="text-muted mb-0" style="font-size:0.85rem;">মাত্র ৩০ সেকেন্ডে রেজিস্ট্রেশন সম্পন্ন করুন</p>
                        </div>
                        <form id="home_seminar_form" onsubmit="registerHomeSeminar(event)">
                            @csrf
                            @if($fsem)
                                <input type="hidden" name="seminar_id" value="{{ $fsem->id }}">
                            @endif
                            <div class="row g-3">
                                <div class="col-12"><label>আপনার নাম *</label><input type="text" name="full_name" class="form-control" placeholder="আপনার পুরো নাম লিখুন" required></div>
                                <div class="col-12"><label>ফোন নম্বর *</label><input type="tel" name="phone_number" class="form-control" placeholder="01XXXXXXXXX" required></div>
                                <div class="col-12"><label>ইমেইল (ঐচ্ছিক)</label><input type="email" name="email" class="form-control" placeholder="your@email.com"></div>
                                <div class="col-12"><label>ঠিকানা</label><textarea name="address" class="form-control" rows="2" placeholder="আপনার ঠিকানা লিখুন"></textarea></div>
                                <div class="col-12 mt-2"><button type="submit" class="btn-seminar"><i class="fa-solid fa-paper-plane me-2"></i> ফ্রি রেজিস্ট্রেশন করুন</button></div>
                                <div class="col-12 text-center"><span class="text-muted" style="font-size:0.8rem;"><i class="fa-solid fa-shield-halved text-success me-1"></i> আপনার তথ্য সম্পূর্ণ নিরাপদ</span></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Success Stories --}}
    <section class="py-5 marquee-section" style="background:linear-gradient(135deg,#f8fbff 0%,#fff8e6 100%);">
        <div class="container py-2">
            <div class="text-center mb-5">
                <h2 class="section-title mb-2">সফল শিক্ষার্থীদের গল্প</h2>
                <span class="section-subtitle">হাজার হাজার শিক্ষার্থীর জীবন বদলে দিয়েছে TechPark English</span>
            </div>
        </div>

        @php
            $has_stories = isset($success_stories) && $success_stories->count() > 0;
            if ($has_stories) {
                $all_stories = $success_stories->values();
                $row1 = $all_stories->filter(fn($s, $i) => $i % 2 === 0)->values();
                $row2 = $all_stories->filter(fn($s, $i) => $i % 2 !== 0)->values();
                if ($row2->isEmpty()) { $row2 = $row1; }
            }
        @endphp

        @if($has_stories)
            {{-- Row 1: left animation --}}
            <div class="marquee-row-wrap mb-4">
                <div class="marquee-row">
                    @foreach([$row1, $row1] as $set)
                        @foreach($set as $story)
                        @php
                            preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $story->video_link ?? '', $mvm);
                            $mv = $mvm[1] ?? null;
                            $mimg = $mv ? "https://img.youtube.com/vi/{$mv}/mqdefault.jpg" : ($story->thumbnail_image ? asset($story->thumbnail_image) : 'https://dummyimage.com/300x155/002147/fff&text='.strtoupper(substr($story->title ?? 'S', 0, 1)));
                        @endphp
                        <div class="mq-card">
                            @if($mv)
                            <div class="mq-vid-thumb" onclick="openYtModal('{{ $mv }}')">
                                <img src="{{ $mimg }}" alt="{{ $story->title }}" onerror="this.src='https://img.youtube.com/vi/{{ $mv }}/hqdefault.jpg'">
                                <div class="mq-play"><i class="fa-solid fa-play"></i></div>
                            </div>
                            @else
                            <div class="mq-vid-thumb" style="cursor:default;">
                                <img src="{{ $mimg }}" alt="{{ $story->title }}">
                            </div>
                            @endif
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <div>
                                    <div class="mq-name">{{ $story->title }}</div>
                                    <div class="mq-role">TechPark English Graduate</div>
                                    <div class="mq-stars">
                                        @for($si=0;$si<5;$si++)<i class="fa-solid fa-star"></i>@endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div>

            {{-- Row 2: right animation --}}
            <div class="marquee-row-wrap">
                <div class="marquee-row">
                    @foreach([$row2, $row2] as $set)
                        @foreach($set as $story)
                        @php
                            preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $story->video_link ?? '', $mvm2);
                            $mv2 = $mvm2[1] ?? null;
                            $mimg2 = $mv2 ? "https://img.youtube.com/vi/{$mv2}/mqdefault.jpg" : ($story->thumbnail_image ? asset($story->thumbnail_image) : 'https://dummyimage.com/300x155/002147/fff&text='.strtoupper(substr($story->title ?? 'S', 0, 1)));
                        @endphp
                        <div class="mq-card">
                            @if($mv2)
                            <div class="mq-vid-thumb" onclick="openYtModal('{{ $mv2 }}')">
                                <img src="{{ $mimg2 }}" alt="{{ $story->title }}" onerror="this.src='https://img.youtube.com/vi/{{ $mv2 }}/hqdefault.jpg'">
                                <div class="mq-play"><i class="fa-solid fa-play"></i></div>
                            </div>
                            @else
                            <div class="mq-vid-thumb" style="cursor:default;">
                                <img src="{{ $mimg2 }}" alt="{{ $story->title }}">
                            </div>
                            @endif
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <div>
                                    <div class="mq-name">{{ $story->title }}</div>
                                    <div class="mq-role">TechPark English Graduate</div>
                                    <div class="mq-stars">
                                        @for($si2=0;$si2<5;$si2++)<i class="fa-solid fa-star"></i>@endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @else
            {{-- Fallback static marquee --}}
            @php
                $fb = [
                    ['n'=>'Sadia Islam',  'r'=>'IELTS Band 7.0',           'i'=>'S'],
                    ['n'=>'Rahim Uddin',  'r'=>'Business English Graduate', 'i'=>'R'],
                    ['n'=>'Naima Akter',  'r'=>'Spoken English Graduate',   'i'=>'N'],
                    ['n'=>'Karim Hossain','r'=>'IELTS Band 6.5',            'i'=>'K'],
                    ['n'=>'Fatema Begum', 'r'=>'Spoken English Graduate',   'i'=>'F'],
                    ['n'=>'Minhaj Ahmed', 'r'=>'Business English Graduate', 'i'=>'M'],
                ];
            @endphp
            <div class="marquee-row-wrap mb-4">
                <div class="marquee-row">
                    @foreach([$fb, $fb] as $fbs)
                        @foreach($fbs as $t)
                        <div class="mq-card">
                            <div class="mq-vid-thumb" style="cursor:default; background:#002147; display:flex; align-items:center; justify-content:center;">
                                <span style="color:#fab005;font-size:2.5rem;font-weight:800;">{{ $t['i'] }}</span>
                            </div>
                            <div class="mt-1">
                                <div class="mq-name">{{ $t['n'] }}</div>
                                <div class="mq-role">{{ $t['r'] }}</div>
                                <div class="mq-stars">
                                    @for($si=0;$si<5;$si++)<i class="fa-solid fa-star"></i>@endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="marquee-row-wrap">
                <div class="marquee-row">
                    @php $fb2 = array_reverse($fb); @endphp
                    @foreach([$fb2, $fb2] as $fbs)
                        @foreach($fbs as $t)
                        <div class="mq-card">
                            <div class="mq-vid-thumb" style="cursor:default; background:#002147; display:flex; align-items:center; justify-content:center;">
                                <span style="color:#fab005;font-size:2.5rem;font-weight:800;">{{ $t['i'] }}</span>
                            </div>
                            <div class="mt-1">
                                <div class="mq-name">{{ $t['n'] }}</div>
                                <div class="mq-role">{{ $t['r'] }}</div>
                                <div class="mq-stars">
                                    @for($si=0;$si<5;$si++)<i class="fa-solid fa-star"></i>@endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endif

        <div class="text-center mt-5">
            <a href="{{ route('stories') }}" class="btn-tpe-outline"><i class="fa-regular fa-star me-2"></i> সব সফলতার গল্প দেখুন</a>
        </div>
    </section>

    {{-- Footer CTA --}}
    <section class="cta-footer">
        <div class="container position-relative" style="z-index:1;">
            <div class="cta-footer-inner">
                <div class="cta-footer-badge"><i class="fa-solid fa-graduation-cap me-1"></i> আজই শুরু করুন</div>
                <h2 class="cta-footer-title">আজই শুরু করুন আপনার <span>ইংরেজি শেখার যাত্রা</span></h2>
                <p class="cta-footer-sub">Join our next batch and take the first step towards fluency. Limited seats available!</p>
                <div class="cta-footer-btns">
                    <a href="/courses" class="btn-cta-primary">
                        <i class="fa-solid fa-arrow-right"></i> Enroll Now
                    </a>
                    <a href="tel:01335119223" class="btn-cta-outline">
                        <i class="fa-solid fa-phone"></i> Call Us
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
// YouTube Modal
function openYtModal(videoId) {
    document.getElementById('ytIframe').src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0&modestbranding=1';
    document.getElementById('ytModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeYtModal() {
    document.getElementById('ytIframe').src = '';
    document.getElementById('ytModal').classList.remove('open');
    document.body.style.overflow = '';
}
function ytModalBgClose(e) {
    if (e.target === document.getElementById('ytModal')) closeYtModal();
}

// Lightbox
@php
    $lbImages = [];
    if($hasGallery) {
        foreach($homeGalleryImages as $g) { $lbImages[] = $g->image; }
    } else {
        foreach($galleryFallback as $g) { $lbImages[] = $g['src']; }
    }
@endphp
var galleryImages = {!! json_encode($lbImages) !!};
var currentIdx = 0;
function openLightbox(idx) {
    currentIdx = idx;
    document.getElementById('lightboxImg').src = galleryImages[idx];
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
function lightboxBgClose(e) {
    if (e.target === document.getElementById('lightbox')) closeLightbox();
}
function lightboxNav(dir) {
    currentIdx = (currentIdx + dir + galleryImages.length) % galleryImages.length;
    document.getElementById('lightboxImg').src = galleryImages[currentIdx];
}
document.addEventListener('keydown', function(e) {
    var lb = document.getElementById('lightbox').classList.contains('open');
    var yt = document.getElementById('ytModal').classList.contains('open');
    if (e.key === 'Escape') { if(lb) closeLightbox(); if(yt) closeYtModal(); }
    if (lb) { if(e.key==='ArrowLeft') lightboxNav(-1); if(e.key==='ArrowRight') lightboxNav(1); }
});

// Home seminar registration
function registerHomeSeminar(event) {
    event.preventDefault();
    var form = event.target;
    var formData = new FormData(form);
    var seminarId = formData.get('seminar_id');
    if (!seminarId) {
        alert('কোনো সক্রিয় সেমিনার নেই। অনুগ্রহ করে পরে চেষ্টা করুন।');
        return;
    }
    fetch('/seminar-registration', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
        body: formData
    }).then(function(res) {
        return res.json().then(function(data) { return { status: res.status, data: data }; });
    }).then(function(res) {
        if (res.status === 200) {
            form.reset();
            alert('রেজিস্ট্রেশন সফল হয়েছে!');
        } else {
            alert('ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
        }
    });
}
</script>
@endpush
