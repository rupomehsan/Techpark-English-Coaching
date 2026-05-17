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
    .bg-soft { background: #f5f7fa; border-top: 1px solid #eaedf2; }

    /* ===== Section Stripe System ===== */
    .sec-white  { background: #ffffff; border-top: 1px solid #edf0f5; }
    .sec-light  { background: #f5f7fa; border-top: 1px solid #eaedf2; }
    .sec-lighter{ background: #fafbfc; border-top: 1px solid #eef1f5; }

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

    /* ===== Recorded Courses Section ===== */
    .rc-section { background: #fafbfc; border-top: 1px solid #eef1f5; padding: 80px 0 90px; position: relative; overflow: hidden; }
    .rc-section::before { content: ''; position: absolute; top: -140px; right: -100px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(0,33,71,0.04) 0%, transparent 70%); pointer-events: none; }
    .rc-tag { display: inline-flex; align-items: center; gap: 7px; background: rgba(0,33,71,0.07); border: 1px solid rgba(0,33,71,0.14); color: #002147; font-size: 0.72rem; font-weight: 800; padding: 5px 16px; border-radius: 50px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 14px; }
    .rc-tag span { width: 7px; height: 7px; background: #fab005; border-radius: 50%; display: inline-block; }
    .rc-card { background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,31,80,0.07); border: 1px solid #e8eef8; transition: all 0.35s ease; display: flex; flex-direction: column; height: 100%; }
    .rc-card:hover { transform: translateY(-10px); box-shadow: 0 24px 60px rgba(0,31,80,0.15); border-color: #d0dcf4; }
    .rc-img-wrap { position: relative; overflow: hidden; flex-shrink: 0; }
    .rc-img-wrap img { width: 100%; height: 215px; object-fit: cover; display: block; transition: transform 0.45s ease; }
    .rc-card:hover .rc-img-wrap img { transform: scale(1.06); }
    .rc-cat-badge { position: absolute; top: 12px; left: 12px; background: rgba(0,33,71,0.85); backdrop-filter: blur(4px); color: #fff; font-size: 0.62rem; font-weight: 800; padding: 5px 11px; border-radius: 5px; letter-spacing: 0.5px; z-index: 2; }
    .rc-disc-ribbon { position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, #ff3d00, #d50000); color: #fff; font-size: 0.7rem; font-weight: 800; padding: 5px 12px; border-radius: 50px; box-shadow: 0 3px 12px rgba(213,0,0,0.4); z-index: 2; }
    .rc-body { padding: 22px 22px 18px; flex: 1; display: flex; flex-direction: column; }
    .rc-title { font-size: 1.02rem; font-weight: 800; color: #1a2540; line-height: 1.45; margin-bottom: 14px; }
    .rc-meta { list-style: none; padding: 0; margin: 0 0 18px; display: flex; flex-direction: column; gap: 7px; }
    .rc-meta li { font-size: 0.8rem; color: #4a5a7a; display: flex; align-items: flex-start; gap: 8px; }
    .rc-meta li i { color: #002147; font-size: 0.75rem; margin-top: 2px; flex-shrink: 0; width: 14px; text-align: center; }
    .rc-footer { margin-top: auto; padding-top: 16px; border-top: 1px solid #eef2fa; display: flex; align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap; }
    .rc-price-block { display: flex; align-items: baseline; gap: 7px; }
    .rc-price { font-size: 1.25rem; font-weight: 900; color: #002147; line-height: 1; }
    .rc-old-price { font-size: 0.8rem; color: #9aa8c0; text-decoration: line-through; }
    .rc-btns { display: flex; align-items: center; gap: 8px; }
    .rc-btn-detail { font-size: 0.78rem; font-weight: 700; color: #002147; background: #f0f4fb; border: 1px solid #d4dff5; border-radius: 8px; padding: 8px 14px; text-decoration: none; transition: all 0.22s; white-space: nowrap; }
    .rc-btn-detail:hover { background: #e0e8f7; border-color: #b0c4e8; color: #001830; }
    .rc-btn-enroll { font-size: 0.78rem; font-weight: 800; color: #fff; background: linear-gradient(135deg, #fab005, #e09600); border: none; border-radius: 8px; padding: 8px 16px; text-decoration: none; transition: all 0.25s; white-space: nowrap; box-shadow: 0 4px 14px rgba(250,176,5,0.35); display: inline-flex; align-items: center; gap: 6px; }
    .rc-btn-enroll:hover { background: linear-gradient(135deg, #e09600, #c07800); color: #fff; transform: translateY(-1px); box-shadow: 0 7px 20px rgba(250,176,5,0.45); }
    .rc-btn-enrolled { font-size: 0.78rem; font-weight: 800; color: #fff; background: linear-gradient(135deg, #059669, #047857); border-radius: 8px; padding: 8px 16px; text-decoration: none; white-space: nowrap; opacity: 0.9; display: inline-flex; align-items: center; gap: 6px; cursor: default; }

    /* ===== Live Courses Section ===== */
    @@keyframes hm-blink { 0%,100%{opacity:1} 50%{opacity:0.2} }
    .hm-lc-section { background: #f5f7fa; border-top: 1px solid #eaedf2; padding: 72px 0 80px; }
    .hm-lc-label { display:inline-flex; align-items:center; gap:7px; background:rgba(233,30,99,0.1); border:1px solid rgba(233,30,99,0.35); color:#e91e63; font-size:0.7rem; font-weight:800; padding:6px 18px; border-radius:50px; margin-bottom:14px; letter-spacing:0.9px; text-transform:uppercase; }
    .hm-live-dot { width:8px; height:8px; background:#e91e63; border-radius:50%; animation:hm-blink 1.2s infinite; display:inline-block; }
    .hm-live-dot-sm { width:6px; height:6px; background:#fff; border-radius:50%; animation:hm-blink 1.2s infinite; display:inline-block; flex-shrink:0; }

    /* Card */
    .hm-lc-card { background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 4px 24px rgba(0,31,80,0.07); border:1px solid #e8eef8; transition:all 0.35s ease; display:flex; flex-direction:column; }
    .hm-lc-card:hover { transform:translateY(-9px); box-shadow:0 22px 55px rgba(0,31,80,0.14); border-color:#d4dff5; }

    /* Image */
    .hm-lc-img-wrap { position:relative; overflow:hidden; flex-shrink:0; }
    .hm-lc-img-wrap img { width:100%; height:210px; object-fit:cover; display:block; transition:transform 0.45s ease; }
    .hm-lc-card:hover .hm-lc-img-wrap img { transform:scale(1.06); }

    /* Discount ribbon — top right */
    .hm-disc-ribbon { position:absolute; top:12px; right:12px; background:linear-gradient(135deg,#ff3d00,#d50000); color:#fff; font-size:0.72rem; font-weight:800; padding:5px 12px; border-radius:50px; box-shadow:0 3px 12px rgba(213,0,0,0.4); letter-spacing:0.3px; z-index:2; }

    /* Type badge — top left */
    .hm-lc-type-badge { position:absolute; top:12px; left:12px; background:rgba(233,30,99,0.88); backdrop-filter:blur(4px); color:#fff; font-size:0.63rem; font-weight:800; padding:5px 11px; border-radius:5px; letter-spacing:0.5px; display:flex; align-items:center; gap:5px; z-index:2; }

    /* Popular badge — bottom left */
    .hm-popular-badge { position:absolute; bottom:12px; left:12px; background:linear-gradient(135deg,#fab005,#e09600); color:#fff; font-size:0.67rem; font-weight:800; padding:4px 12px; border-radius:5px; display:flex; align-items:center; gap:5px; z-index:2; }

    /* Body */
    .hm-lc-body { padding:22px 22px 20px; flex:1; display:flex; flex-direction:column; }
    .hm-lc-title { font-size:1.02rem; font-weight:800; color:#1a2540; line-height:1.42; margin-bottom:14px; }

    /* Specs */
    .hm-lc-specs { list-style:none; padding:0; margin:0 0 18px; display:flex; flex-direction:column; gap:6px; }
    .hm-lc-specs li { font-size:0.81rem; color:#4a5a7a; display:flex; align-items:flex-start; gap:7px; }
    .hm-lc-specs li i { color:#059669; font-size:0.72rem; margin-top:3px; flex-shrink:0; }

    /* Footer */
    .hm-lc-footer { margin-top:auto; padding-top:16px; border-top:1px solid #eef2fa; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; }
    .hm-lc-price-block { display:flex; align-items:baseline; gap:7px; }
    .hm-lc-price { font-size:1.25rem; font-weight:900; color:#002147; line-height:1; }
    .hm-lc-price-free { font-size:0.88rem; color:#059669; }
    .hm-lc-old-price { font-size:0.8rem; color:#9aa8c0; text-decoration:line-through; }
    .hm-lc-btns { display:flex; align-items:center; gap:8px; }
    .hm-btn-outline { font-size:0.78rem; font-weight:700; color:#002147; background:#f0f4fb; border:1px solid #d4dff5; border-radius:8px; padding:8px 14px; text-decoration:none; transition:all 0.22s; white-space:nowrap; }
    .hm-btn-outline:hover { background:#e0e8f7; border-color:#b0c4e8; color:#001830; }
    .hm-btn-fill { font-size:0.78rem; font-weight:800; color:#fff; background:linear-gradient(135deg,#fab005,#e09600); border:none; border-radius:8px; padding:8px 16px; text-decoration:none; transition:all 0.25s; white-space:nowrap; box-shadow:0 4px 14px rgba(250,176,5,0.35); display:inline-flex; align-items:center; gap:6px; }
    .hm-btn-fill:hover { background:linear-gradient(135deg,#e09600,#c07800); color:#fff; transform:translateY(-1px); box-shadow:0 7px 20px rgba(250,176,5,0.45); }

    /* ===== Why Choose Us ===== */
    /* ===== Why Section ===== */
    .why-section {
        background: #fff;
        border-top: 1px solid #edf0f5;
        position: relative;
        overflow: hidden;
    }
    .why-section::before {
        content: '';
        position: absolute;
        top: -120px; right: -120px;
        width: 420px; height: 420px;
        background: radial-gradient(circle, rgba(250,176,5,0.07) 0%, transparent 70%);
        pointer-events: none;
    }
    .why-badge {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(0,33,71,0.06); border: 1px solid rgba(0,33,71,0.12);
        color: #002147; font-size: 0.72rem; font-weight: 800;
        padding: 5px 16px; border-radius: 50px; letter-spacing: 1px;
        text-transform: uppercase; margin-bottom: 14px;
    }
    .why-badge span { width:7px; height:7px; background:#fab005; border-radius:50%; display:inline-block; }
    .why-heading {
        font-size: clamp(1.6rem, 2.8vw, 2.1rem);
        font-weight: 800; color: #002147;
        line-height: 1.3; margin-bottom: 8px;
    }
    .why-lead {
        font-size: 0.92rem; color: #64748b; margin-bottom: 28px; line-height: 1.7;
    }

    /* List items */
    .why-desc-content p { margin-bottom: 12px; font-size: 0.94rem; color: #475569; line-height: 1.8; }
    .why-desc-content strong, .why-desc-content b { color: #002147; }
    .why-desc-content ul, .why-desc-content ol { padding-left: 0; list-style: none; margin-bottom: 0; }
    .why-desc-content ol { counter-reset: why-counter; }
    .why-desc-content ol li, .why-desc-content ul li {
        position: relative;
        padding: 16px 18px 16px 64px;
        margin-bottom: 12px;
        background: #f8faff;
        border-radius: 14px;
        border: 1px solid #e8f0fb;
        counter-increment: why-counter;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }
    .why-desc-content ol li:hover, .why-desc-content ul li:hover {
        transform: translateX(6px);
        box-shadow: 0 4px 20px rgba(0,33,71,0.09);
        border-color: #c8dcf8;
        background: #fff;
    }
    .why-desc-content ol li::before {
        content: counter(why-counter);
        position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
        width: 34px; height: 34px;
        background: linear-gradient(135deg, #fab005, #e09600);
        color: #fff; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 900; font-size: 0.82rem;
        box-shadow: 0 4px 12px rgba(250,176,5,0.4);
    }
    .why-desc-content ul li::before {
        content: '✓';
        position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
        width: 34px; height: 34px;
        background: linear-gradient(135deg, #002147, #003b7a);
        color: #fab005; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 900; font-size: 0.88rem;
    }
    .why-desc-content li strong, .why-desc-content li b {
        display: block; color: #1a2540; font-size: 0.93rem;
        font-weight: 700; margin-bottom: 2px;
    }
    .why-desc-content li { font-size: 0.82rem; color: #64748b; }

    /* Video */
    .video-col-wrap { position: relative; padding: 16px 0 0 0; }
    .video-deco {
        position: absolute;
        top: 0; right: -16px;
        width: 100%; height: calc(100% - 80px);
        border-radius: 28px;
        background: linear-gradient(135deg, #fab005 0%, #002147 100%);
        opacity: 0.13;
        z-index: 0;
        transform: rotate(2.5deg);
        filter: blur(1px);
    }
    .video-deco-2 {
        position: absolute;
        top: 10px; left: -12px;
        width: 60%; height: 60%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(250,176,5,0.18) 0%, transparent 70%);
        z-index: 0;
        pointer-events: none;
    }
    .video-thumb-wrap {
        position: relative; z-index: 1;
        border-radius: 22px; overflow: hidden;
        box-shadow: 0 24px 72px rgba(0,33,71,0.28), 0 4px 16px rgba(250,176,5,0.10);
        cursor: pointer;
        height: 480px;
    }
    .video-thumb-wrap img {
        width: 100%; height: 100%;
        object-fit: cover; display: block;
        transition: transform 0.6s cubic-bezier(.25,.46,.45,.94);
    }
    .video-thumb-wrap:hover img { transform: scale(1.06); }
    .play-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(
            to top,
            rgba(0,15,40,0.80) 0%,
            rgba(0,15,40,0.25) 45%,
            rgba(0,0,0,0.08) 100%
        );
        display: flex; align-items: center; justify-content: center;
        transition: background 0.35s;
    }
    .video-thumb-wrap:hover .play-overlay {
        background: linear-gradient(
            to top,
            rgba(0,15,40,0.88) 0%,
            rgba(0,15,40,0.35) 50%,
            rgba(0,0,0,0.15) 100%
        );
    }
    .video-top-bar {
        position: absolute; top: 0; left: 0; right: 0;
        padding: 16px 18px;
        background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, transparent 100%);
        display: flex; align-items: center; gap: 8px;
        z-index: 2;
    }
    .video-top-logo {
        width: 28px; height: 28px;
        background: #ff0000; border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(255,0,0,0.4);
    }
    .video-top-logo i { color: #fff; font-size: 0.75rem; }
    .video-top-channel { font-size: 0.75rem; color: rgba(255,255,255,0.9); font-weight: 700; letter-spacing: 0.3px; }
    .video-bottom-info {
        position: absolute; bottom: 0; left: 0; right: 0;
        padding: 20px 20px 22px;
        z-index: 2;
        pointer-events: none;
    }
    .video-bottom-title {
        font-size: 0.9rem; color: #fff; font-weight: 700;
        line-height: 1.4; margin-bottom: 8px;
        text-shadow: 0 1px 4px rgba(0,0,0,0.5);
    }
    .video-bottom-meta {
        display: flex; align-items: center; gap: 10px;
    }
    .video-meta-pill {
        display: inline-flex; align-items: center; gap: 5px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 20px; padding: 3px 10px;
        font-size: 0.72rem; color: rgba(255,255,255,0.9); font-weight: 600;
    }
    .video-meta-pill i { font-size: 0.68rem; color: #fab005; }
    .play-circle {
        width: 90px; height: 90px;
        background: linear-gradient(135deg, #fff 60%, #f0f4ff 100%);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 8px 40px rgba(0,0,0,0.40), 0 0 0 6px rgba(255,255,255,0.15);
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.4), box-shadow 0.3s;
        position: relative;
        z-index: 3;
    }
    .play-circle::before {
        content: '';
        position: absolute; inset: -10px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        animation: pulseRing 2.2s ease infinite;
    }
    .play-circle::after {
        content: '';
        position: absolute; inset: -22px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
        animation: pulseRing 2.2s ease 0.6s infinite;
    }
    @keyframes pulseRing {
        0%   { transform: scale(1);   opacity: 0.8; }
        70%  { transform: scale(1.5); opacity: 0; }
        100% { transform: scale(1.5); opacity: 0; }
    }
    .video-thumb-wrap:hover .play-circle {
        transform: scale(1.12);
        box-shadow: 0 12px 50px rgba(0,0,0,0.5), 0 0 0 8px rgba(255,255,255,0.18);
    }
    .play-circle i { color: #e60000; font-size: 2.1rem; margin-left: 7px; }
    .video-caption {
        display: flex; align-items: center; gap: 12px;
        margin-top: 18px; padding: 14px 18px;
        background: linear-gradient(135deg, #fff 0%, #f8faff 100%);
        border-radius: 14px;
        border: 1px solid #e2ecfb;
        box-shadow: 0 4px 20px rgba(0,33,71,0.08);
        position: relative; z-index: 1;
        transition: box-shadow 0.3s, transform 0.3s;
    }
    .video-caption:hover { box-shadow: 0 8px 30px rgba(0,33,71,0.14); transform: translateY(-2px); }
    .video-caption-icon {
        width: 40px; height: 40px;
        background: linear-gradient(135deg, #ff0000, #cc0000);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(255,0,0,0.3);
    }
    .video-caption-icon i { color: #fff; font-size: 1rem; }
    .video-caption-body { flex: 1; }
    .video-caption-label { font-size: 0.68rem; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; }
    .video-caption-text { font-size: 0.84rem; color: #1a2540; font-weight: 700; }
    .video-caption-arrow { color: #002147; opacity: 0.4; font-size: 0.9rem; }
    .yt-modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.88); z-index: 9999; align-items: center; justify-content: center; }
    .yt-modal.open { display: flex; }
    .yt-modal-inner { position: relative; width: 90%; max-width: 820px; aspect-ratio: 16/9; }
    .yt-modal-inner iframe { width: 100%; height: 100%; border: none; border-radius: 10px; }
    .yt-modal-close { position: absolute; top: -46px; right: 0; color: #fff; font-size: 1.6rem; cursor: pointer; background: none; border: none; padding: 4px 8px; line-height: 1; opacity: 0.85; transition: opacity 0.2s; }
    .yt-modal-close:hover { opacity: 1; }

    /* ===== Services Section ===== */
    .services-section {
        background: linear-gradient(160deg, #0a1f3d 0%, #0d2b52 45%, #103060 100%);
        position: relative;
        overflow: hidden;
    }
    .services-section::before {
        content: '';
        position: absolute;
        top: -200px; right: -200px;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(250,176,5,0.06) 0%, transparent 70%);
        pointer-events: none;
    }
    .services-section::after {
        content: '';
        position: absolute;
        bottom: -150px; left: -150px;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(99,102,241,0.07) 0%, transparent 70%);
        pointer-events: none;
    }
    .svc-section-tag {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(250,176,5,0.12); border: 1px solid rgba(250,176,5,0.28);
        color: #fab005; font-size: 0.72rem; font-weight: 800;
        padding: 5px 16px; border-radius: 50px; letter-spacing: 1px;
        text-transform: uppercase; margin-bottom: 14px;
    }
    .svc-section-tag span { width:7px; height:7px; background:#fab005; border-radius:50%; display:inline-block; }
    .svc-title { color: #f1f5f9; font-size: clamp(1.6rem,3vw,2.2rem); font-weight: 800; line-height: 1.25; margin-bottom: 10px; }
    .svc-subtitle { color: rgba(255,255,255,0.45); font-size: 0.92rem; max-width: 540px; margin: 0 auto; }

    /* Card */
    .service-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 20px;
        padding: 34px 26px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: transform 0.38s cubic-bezier(.22,.68,0,1.2), box-shadow 0.38s ease, border-color 0.38s ease, background 0.38s ease;
        cursor: default;
        height: 100%;
        display: flex; flex-direction: column; align-items: center;
    }
    /* Glow blob hidden by default */
    .service-card::after {
        content: '';
        position: absolute;
        bottom: -60px; left: 50%;
        transform: translateX(-50%);
        width: 120px; height: 120px;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0;
        transition: opacity 0.45s ease, bottom 0.45s ease;
        pointer-events: none;
    }
    /* Top accent line */
    .service-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: var(--svc-color, #fab005);
        border-radius: 20px 20px 0 0;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    .service-card:hover {
        transform: translateY(-12px);
        background: rgba(255,255,255,0.07);
        border-color: rgba(255,255,255,0.14);
        box-shadow: 0 28px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.06);
    }
    .service-card:hover::before { transform: scaleX(1); }
    .service-card:hover::after  { opacity: 0.55; bottom: -20px; background: var(--svc-color, #fab005); }

    /* Icon */
    .service-icon-wrap {
        width: 72px; height: 72px;
        border-radius: 18px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.75rem;
        color: var(--svc-color, #fab005);
        margin: 0 auto 22px;
        transition: all 0.4s cubic-bezier(.22,.68,0,1.4);
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }
    .service-card:hover .service-icon-wrap {
        background: var(--svc-color, #fab005);
        color: #fff;
        border-color: transparent;
        transform: scale(1.12) rotate(-6deg);
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    }

    /* Text */
    .service-card h5 {
        font-weight: 800; color: #e2e8f0;
        margin-bottom: 10px; font-size: 1rem;
        position: relative; z-index: 1;
    }
    .service-card p {
        color: rgba(255,255,255,0.45);
        font-size: 0.83rem; margin: 0; line-height: 1.75;
        position: relative; z-index: 1;
    }

    /* Arrow hint */
    .svc-arrow {
        margin-top: 18px;
        color: var(--svc-color, #fab005);
        font-size: 0.78rem; font-weight: 700;
        opacity: 0; transform: translateY(6px);
        transition: opacity 0.3s ease, transform 0.3s ease;
        position: relative; z-index: 1;
        letter-spacing: 0.3px;
    }
    .service-card:hover .svc-arrow { opacity: 1; transform: translateY(0); }

    /* ===== Photo Gallery ===== */
    .gallery-section-wrap { background: #f5f7fa; border-top: 1px solid #eaedf2; }
    .gallery-badge { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, rgba(0,33,71,0.07), rgba(250,176,5,0.10)); border: 1px solid rgba(0,33,71,0.10); border-radius: 30px; padding: 6px 16px; font-size: 0.78rem; font-weight: 700; color: #002147; letter-spacing: 0.5px; margin-bottom: 14px; text-transform: uppercase; }
    .gallery-badge i { color: #fab005; font-size: 0.82rem; }
    .gallery-item {
        position: relative; border-radius: 18px; overflow: hidden; cursor: pointer;
        box-shadow: 0 6px 28px rgba(0,33,71,0.12);
        transition: transform 0.38s cubic-bezier(.25,.46,.45,.94), box-shadow 0.38s;
    }
    .gallery-item:hover { transform: translateY(-5px); box-shadow: 0 18px 55px rgba(0,33,71,0.20); }
    .gallery-item img { width: 100%; height: 300px; object-fit: cover; display: block; transition: transform 0.55s cubic-bezier(.25,.46,.45,.94); }
    .gallery-item:hover img { transform: scale(1.07); }
    .gallery-item.gallery-featured img { height: 624px; }
    .gallery-item.gallery-sm img { height: 300px; }
    .gallery-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,15,40,0.80) 0%, rgba(0,15,40,0.20) 45%, transparent 100%);
        display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-end;
        padding: 22px 20px;
        opacity: 0; transition: opacity 0.38s;
    }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    .gallery-overlay-icon {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%,-60%);
        width: 52px; height: 52px; background: rgba(255,255,255,0.18);
        backdrop-filter: blur(6px); border: 2px solid rgba(255,255,255,0.35);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.4);
    }
    .gallery-item:hover .gallery-overlay-icon { transform: translate(-50%,-50%) scale(1.1); }
    .gallery-overlay-icon i { color: #fff; font-size: 1.3rem; }
    .gallery-overlay-title { font-size: 0.88rem; color: #fff; font-weight: 700; line-height: 1.4; margin-bottom: 6px; text-shadow: 0 1px 4px rgba(0,0,0,0.4); }
    .gallery-overlay-tag { display: inline-flex; align-items: center; gap: 5px; background: rgba(250,176,5,0.22); border: 1px solid rgba(250,176,5,0.4); border-radius: 20px; padding: 3px 10px; font-size: 0.7rem; color: #fab005; font-weight: 700; }
    .gallery-number-badge { position: absolute; top: 14px; left: 14px; background: rgba(0,0,0,0.45); backdrop-filter: blur(6px); border-radius: 8px; padding: 4px 10px; font-size: 0.7rem; color: rgba(255,255,255,0.85); font-weight: 600; z-index: 2; }
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
    .vid-section-wrap { background: #ffffff; border-top: 1px solid #edf0f5; }
    .vid-section-badge { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, rgba(255,0,0,0.08), rgba(0,33,71,0.06)); border: 1px solid rgba(255,0,0,0.18); border-radius: 30px; padding: 6px 16px; font-size: 0.78rem; font-weight: 700; color: #cc0000; letter-spacing: 0.5px; margin-bottom: 14px; text-transform: uppercase; }
    .vid-section-badge i { font-size: 0.82rem; }
    .vid-card {
        border-radius: 20px; overflow: hidden;
        background: #fff;
        box-shadow: 0 8px 32px rgba(0,33,71,0.10);
        transition: transform 0.38s cubic-bezier(.25,.46,.45,.94), box-shadow 0.38s;
        border: 1px solid rgba(0,33,71,0.06);
    }
    .vid-card:hover { transform: translateY(-8px); box-shadow: 0 24px 64px rgba(0,33,71,0.16); }
    .vid-thumb-wrap { position: relative; overflow: hidden; cursor: pointer; }
    .vid-thumb-wrap img { width: 100%; height: 280px; object-fit: cover; display: block; transition: transform 0.55s cubic-bezier(.25,.46,.45,.94); }
    .vid-card:hover .vid-thumb-wrap img { transform: scale(1.06); }
    .vid-thumb-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,10,30,0.75) 0%, rgba(0,10,30,0.15) 50%, transparent 100%);
        transition: background 0.35s;
    }
    .vid-card:hover .vid-thumb-overlay { background: linear-gradient(to top, rgba(0,10,30,0.85) 0%, rgba(0,10,30,0.25) 55%, transparent 100%); }
    .vid-yt-badge { position: absolute; top: 14px; left: 14px; background: rgba(0,0,0,0.55); backdrop-filter: blur(6px); border-radius: 8px; padding: 5px 10px; display: flex; align-items: center; gap: 6px; font-size: 0.72rem; color: #fff; font-weight: 700; z-index: 2; }
    .vid-yt-badge i { color: #ff4444; font-size: 0.8rem; }
    .vid-play-btn {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        width: 70px; height: 70px;
        background: linear-gradient(135deg, #fff 60%, #f5f5f5 100%);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.4), box-shadow 0.3s;
        box-shadow: 0 6px 28px rgba(0,0,0,0.35), 0 0 0 6px rgba(255,255,255,0.15);
        z-index: 2;
    }
    .vid-play-btn::before {
        content: ''; position: absolute; inset: -10px; border-radius: 50%;
        background: rgba(255,255,255,0.12); animation: pulseRing 2.2s ease infinite;
    }
    .vid-card:hover .vid-play-btn { transform: translate(-50%, -50%) scale(1.12); box-shadow: 0 10px 40px rgba(0,0,0,0.45), 0 0 0 8px rgba(255,255,255,0.18); }
    .vid-play-btn i { color: #e60000; font-size: 1.6rem; margin-left: 6px; }
    .vid-bottom-title {
        position: absolute; bottom: 0; left: 0; right: 0;
        padding: 18px 18px 20px; z-index: 2;
    }
    .vid-bottom-title h6 { font-size: 0.92rem; font-weight: 800; color: #fff; line-height: 1.4; margin: 0; text-shadow: 0 1px 4px rgba(0,0,0,0.4); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .vid-info {
        padding: 16px 20px 20px;
        display: flex; align-items: flex-start; gap: 12px;
    }
    .vid-info-icon {
        width: 38px; height: 38px; min-width: 38px;
        background: linear-gradient(135deg, #ff0000, #cc0000);
        border-radius: 10px; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(255,0,0,0.25);
    }
    .vid-info-icon i { color: #fff; font-size: 0.88rem; }
    .vid-info-body { flex: 1; }
    .vid-info-body p { color: #64748b; font-size: 0.8rem; margin: 0; line-height: 1.65; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .vid-info-meta { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; }
    .vid-info-tag { display: inline-flex; align-items: center; gap: 4px; background: rgba(0,33,71,0.07); border-radius: 20px; padding: 3px 9px; font-size: 0.68rem; color: #002147; font-weight: 700; }
    .vid-info-tag i { font-size: 0.62rem; color: #fab005; }

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
    .seminar-social-btn { display: inline-flex; align-items: center; gap: 7px; padding: 8px 18px; border-radius: 50px; font-size: 0.82rem; font-weight: 700; text-decoration: none; transition: all 0.25s; }
    .seminar-social-wa { background: rgba(37,211,102,0.18); border: 1px solid rgba(37,211,102,0.45); color: #25d366; }
    .seminar-social-wa:hover { background: #25d366; color: #fff; }
    .seminar-social-fb { background: rgba(24,119,242,0.18); border: 1px solid rgba(24,119,242,0.45); color: #1877f2; }
    .seminar-social-fb:hover { background: #1877f2; color: #fff; }
    .seminar-social-tg { background: rgba(0,136,204,0.18); border: 1px solid rgba(0,136,204,0.45); color: #0088cc; }
    .seminar-social-tg:hover { background: #0088cc; color: #fff; }
    .seminar-poster-wrap { border-radius: 18px; overflow: hidden; box-shadow: 0 18px 50px rgba(0,0,0,0.25); }
    .seminar-poster-wrap img { width: 100%; height: auto; display: block; }

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

    /* ===== Live dot blink ===== */
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.2} }

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


    {{-- Live Courses Section --}}
    @if(isset($live_courses) && $live_courses->count() > 0)
    <section class="hm-lc-section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="hm-lc-label">
                    <span class="hm-live-dot"></span> লাইভ কোর্স
                </div>
                <h2 class="section-title">আমাদের <span style="background:linear-gradient(90deg,#fab005,#ff6b35);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">কোর্স সমূহ</span></h2>
                <span class="section-subtitle">রেসিডেন্সিয়াল ও অনলাইন — দুই মাধ্যমেই শিখুন</span>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($live_courses->take(6) as $lc)
                @php
                    $hm_disc = ($lc->regular_price > 0 && $lc->regular_price > $lc->sale_price && $lc->sale_price > 0)
                        ? round(($lc->regular_price - $lc->sale_price) / $lc->regular_price * 100) : 0;
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="hm-lc-card h-100">

                        {{-- Image --}}
                        <div class="hm-lc-img-wrap">
                            <img src="{{ $lc->thumbnail ? asset($lc->thumbnail) : 'https://dummyimage.com/600x400/003b7a/fff&text=Live+Course' }}"
                                 alt="{{ $lc->title }}"
                                 onerror="this.src='https://dummyimage.com/600x400/003b7a/fff&text=Live'">
                            {{-- Discount ribbon --}}
                            @if($hm_disc > 0)
                            <div class="hm-disc-ribbon">{{ $hm_disc }}% ছাড়</div>
                            @endif
                            {{-- Live type badge --}}
                            <div class="hm-lc-type-badge">
                                <span class="hm-live-dot-sm"></span>
                                {{ strtoupper($lc->live_course_type ?? 'LIVE') }}
                            </div>
                            @if($lc->is_popular)
                            <div class="hm-popular-badge"><i class="fa-solid fa-fire-flame-curved"></i> জনপ্রিয়</div>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="hm-lc-body">
                            <h3 class="hm-lc-title">{{ $lc->title }}</h3>

                            @php $cs = is_array($lc->course_specification) ? $lc->course_specification : json_decode($lc->course_specification, true); @endphp
                            @if($cs && count($cs) > 0)
                            <ul class="hm-lc-specs">
                                @foreach(array_slice($cs, 0, 3) as $spec)
                                <li>
                                    <i class="fa-solid fa-circle-check"></i>
                                    {{ is_array($spec) ? ($spec['title'] ?? $spec['text'] ?? '') : $spec }}
                                </li>
                                @endforeach
                            </ul>
                            @endif

                            {{-- Price + Buttons --}}
                            <div class="hm-lc-footer">
                                <div class="hm-lc-price-block">
                                    @if($lc->sale_price)
                                        <div class="hm-lc-price">৳{{ number_format($lc->sale_price) }}</div>
                                        @if($lc->regular_price && $lc->regular_price > $lc->sale_price)
                                        <div class="hm-lc-old-price">৳{{ number_format($lc->regular_price) }}</div>
                                        @endif
                                    @elseif($lc->regular_price)
                                        <div class="hm-lc-price">৳{{ number_format($lc->regular_price) }}</div>
                                    @else
                                        <div class="hm-lc-price hm-lc-price-free">যোগাযোগ করুন</div>
                                    @endif
                                </div>
                                <div class="hm-lc-btns">
                                    <a href="{{ route('live_course_details', $lc->slug) }}" class="hm-btn-outline">
                                        <i class="fa-solid fa-circle-info me-1"></i> বিস্তারিত
                                    </a>
                                    @if(in_array($lc->id, $enrolled_live_ids ?? []))
                                    <span class="hm-btn-fill" style="opacity:0.7;cursor:default;background:linear-gradient(135deg,#059669,#047857);box-shadow:none;">
                                        <i class="fa-solid fa-circle-check"></i> ভর্তি হয়েছেন
                                    </span>
                                    @else
                                    <a href="{{ route('live_course_enroll', $lc->slug) }}" class="hm-btn-fill">
                                        <i class="fa-solid fa-pen-to-square"></i> ভর্তি হন
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('live_courses') }}" class="btn-tpe-fill">
                    <i class="fa-solid fa-circle me-2" style="color:#ff4d6d;font-size:0.6rem;animation:blink 1.2s infinite;"></i>
                সব কোর্স দেখুন
                </a>
            </div>
        </div>
    </section>
    @endif



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
    @php
        $svc_colors = ['#3b82f6','#8b5cf6','#10b981','#f59e0b','#06b6d4','#ec4899','#f97316','#6366f1'];
    @endphp
    <section class="py-5 services-section">
        <div class="container py-4" style="position:relative;z-index:1;">
            <div class="text-center mb-5">
                <div class="svc-section-tag"><span></span> আমাদের সেবা</div>
                <h2 class="svc-title">আমাদের <span style="background:linear-gradient(90deg,#fab005,#ff6b35);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">সেবাসমূহ</span></h2>
                <p class="svc-subtitle">TechPark English শিক্ষার্থীদের সর্বোচ্চ সুবিধা নিশ্চিত করে</p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($services_list as $i => $svc)
                @php $svc_color = $svc_colors[$i % count($svc_colors)]; @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="service-card" style="--svc-color:{{ $svc_color }}">
                        <div class="service-icon-wrap">
                            <i class="{{ !empty($svc->icon) ? $svc->icon : 'fa-solid fa-star' }}"></i>
                        </div>
                        <h5>{{ $svc->title }}</h5>
                        <p>{!! $svc->description !!}</p>
                    </div>
                </div>
                @endforeach
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
        <div class="container py-4" style="position:relative;z-index:1;">
            <div class="row g-5 align-items-center">

                {{-- Left: text --}}
                <div class="col-lg-6">
                    <div class="why-badge"><span></span> কেন আমরা?</div>
                    <h2 class="why-heading">{!! str_replace('TechPark English', '<span style="background:linear-gradient(135deg,#fab005,#ff6b35,#e91e63);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">TechPark English</span>', $wy_title) !!}</h2>
                    <div class="why-desc-content">
                        {!! $wy_desc !!}
                    </div>
                </div>

                {{-- Right: video --}}
                <div class="col-lg-6">
                    <div class="video-col-wrap">
                        <div class="video-deco"></div>
                        <div class="video-deco-2"></div>
                        <div class="video-thumb-wrap" onclick="openYtModal('{{ $wy_vid_id }}')">
                            <img src="https://img.youtube.com/vi/{{ $wy_vid_id }}/maxresdefault.jpg"
                                 alt="TechPark English Video"
                                 onerror="this.src='https://img.youtube.com/vi/{{ $wy_vid_id }}/hqdefault.jpg'">
                            {{-- Top channel bar --}}
                            <div class="video-top-bar">
                                <div class="video-top-logo"><i class="fa-brands fa-youtube"></i></div>
                                <span class="video-top-channel">TechPark English</span>
                            </div>
                            {{-- Play button --}}
                            <div class="play-overlay">
                                <div class="play-circle"><i class="fa-solid fa-play"></i></div>
                            </div>
                            {{-- Bottom info --}}
                            <div class="video-bottom-info">
                                <div class="video-bottom-title">How to Learn English Effectively</div>
                                <div class="video-bottom-meta">
                                    <span class="video-meta-pill"><i class="fa-solid fa-circle-play"></i> ভিডিও দেখুন</span>
                                    <span class="video-meta-pill"><i class="fa-solid fa-star"></i> বিনামূল্যে</span>
                                </div>
                            </div>
                        </div>
                        <div class="video-caption">
                            <div class="video-caption-icon"><i class="fa-brands fa-youtube"></i></div>
                            <div class="video-caption-body">
                                <div class="video-caption-label">আমাদের চ্যানেল</div>
                                <div class="video-caption-text">TechPark English — ইউটিউবে ভিজিট করুন</div>
                            </div>
                            <i class="fa-solid fa-chevron-right video-caption-arrow"></i>
                        </div>
                    </div>
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


    {{-- Recorded Courses Section --}}
    <section class="rc-section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="rc-tag"><span></span> Recorded Courses</div>
                <h2 class="section-title">আমাদের অনলাইন <span style="background:linear-gradient(90deg,#fab005,#ff6b35);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">রেকর্ডেড কোর্সসমূহ</span></h2>
                <span class="section-subtitle">নিজের গতিতে শিখুন — যেকোনো সময়, যেকোনো ডিভাইস থেকে</span>
            </div>
            <div class="row g-4 justify-content-center">
                @if(isset($courses) && count($courses) > 0)
                    @foreach($courses->take(6) as $course)
                    @php
                        $cc = new App\Http\Controllers\Course\CourseController();
                        $cdata = $cc->course_batch_details($course->id);
                        $homeBatch  = $cdata['batch'] ?? null;
                        $rcOriginal = $course->regular_price ?? 0;
                        $rcPrice    = $course->sales_price ?? $rcOriginal;
                        $rcDiscount = ($rcOriginal > 0 && $rcPrice < $rcOriginal) ? round((($rcOriginal - $rcPrice) / $rcOriginal) * 100) : 0;
                        $rcFallback = 'https://dummyimage.com/600x340/002147/fff&text='.urlencode($course->title ?? 'Course');
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="rc-card">
                            <div class="rc-img-wrap">
                                <img src="{{ $course->image ? asset($course->image) : $rcFallback }}"
                                     alt="{{ $course->title }}"
                                     onerror="this.onerror=null;this.src='{{ $rcFallback }}'">
                                <span class="rc-cat-badge">{{ strtoupper($course->course_category->title ?? 'Course') }}</span>
                                @if($rcDiscount > 0)
                                    <span class="rc-disc-ribbon">{{ $rcDiscount }}% OFF</span>
                                @endif
                            </div>
                            <div class="rc-body">
                                <h3 class="rc-title">{{ $course->title }}</h3>
                                <ul class="rc-meta">
                                    <li><i class="fa-solid fa-layer-group"></i><span><strong>মোট মডিউল:</strong> {{ $course->modules_count ?? 0 }}</span></li>
                                    <li><i class="fa-solid fa-book"></i><span><strong>মোট ক্লাস:</strong> {{ $course->classes_count ?? 0 }}</span></li>
                                    <li><i class="fa-solid fa-video"></i><span><strong>মোট ভিডিও:</strong> {{ $course->classes_count ?? 0 }}</span></li>
                                    <li><i class="fa-solid fa-brain"></i><span><strong>মোট কুইজ:</strong> {{ $course->quizzes_count ?? 0 }}</span></li>
                                    <li><i class="fa-solid fa-flag"></i><span><strong>মোট মাইলস্টোন:</strong> {{ $course->milestones_count ?? 0 }}</span></li>
                                </ul>
                                <div class="rc-footer">
                                    <div class="rc-price-block">
                                        <span class="rc-price">৳{{ number_format($rcPrice, 0, '.', ',') }}</span>
                                        @if($rcDiscount > 0)
                                            <span class="rc-old-price">৳{{ number_format($rcOriginal, 0, '.', ',') }}</span>
                                        @endif
                                    </div>
                                    <div class="rc-btns">
                                        <a href="{{ route('course_details', $course->slug) }}" class="rc-btn-detail"><i class="fa-solid fa-circle-info"></i> বিস্তারিত</a>
                                        @if(in_array($course->id, $enrolled_course_ids ?? []))
                                            <span class="rc-btn-enrolled"><i class="fa-solid fa-circle-check"></i> ভর্তি হয়েছেন</span>
                                        @else
                                            <a href="{{ route('course_enroll', $course->slug) }}" class="rc-btn-enroll"><i class="fa-solid fa-pen-to-square"></i> ভর্তি হন</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5">
                        <i class="fa-solid fa-book-open" style="font-size:3rem; color:#dde3ea;"></i>
                        <p class="mt-3 text-muted">কোনো কোর্স পাওয়া যায়নি।</p>
                    </div>
                @endif
            </div>
            <div class="text-center mt-5">
                <a href="/courses" class="btn-tpe-fill"><i class="fa-solid fa-arrow-right-long me-2"></i> সকল কোর্স দেখুন</a>
            </div>
        </div>
    </section>




    {{-- Task 6: Photo Gallery — dynamic from Gallery model --}}
    <section class="py-5 gallery-section-wrap">
        <div class="container py-4">
            <div class="text-center mb-5">
                <div class="gallery-badge"><i class="fa-solid fa-camera-retro"></i> আমাদের গ্যালারি</div>
                <h2 class="section-title">আমাদের একাডেমির <span style="background:linear-gradient(90deg,#fab005,#ff6b35);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">ছবি</span></h2>
                <span class="section-subtitle">ক্যাম্পাস, ক্লাসরুম ও শিক্ষার্থীদের বিশেষ মুহূর্ত</span>
            </div>
            @php
                $homeGalleryImages = \App\Modules\Management\GalleryManagement\Gallery\Models\Model::where('status', 'active')
                    ->orderBy('top_image', 'DESC')
                    ->limit(6)
                    ->get();
                $galleryFallback = [
                    ['src'=>'https://dummyimage.com/800x600/00377a/fff&text=Classroom+01', 'alt'=>'Classroom 01',    'title'=>'ক্লাসরুম ০১'],
                    ['src'=>'https://dummyimage.com/800x600/003b7a/fff&text=Campus+Life',   'alt'=>'Campus Life',     'title'=>'ক্যাম্পাস লাইফ'],
                    ['src'=>'https://dummyimage.com/800x600/002147/fff&text=Speaking',       'alt'=>'Speaking Session','title'=>'স্পিকিং সেশন'],
                    ['src'=>'https://dummyimage.com/800x600/001a3d/fff&text=Workshop',       'alt'=>'Workshop',        'title'=>'ওয়ার্কশপ'],
                    ['src'=>'https://dummyimage.com/800x600/c07800/fff&text=Graduation',     'alt'=>'Graduation Day',  'title'=>'গ্র্যাজুয়েশন ডে'],
                    ['src'=>'https://dummyimage.com/800x600/004080/fff&text=Group+Activity', 'alt'=>'Group Activity',  'title'=>'গ্রুপ অ্যাক্টিভিটি'],
                ];
                $hasGallery = $homeGalleryImages && $homeGalleryImages->count() > 0;
            @endphp

            {{-- Masonry-style layout: featured first card + 2 stacked + bottom 3 --}}
            @if($hasGallery)
                @php $galleryList = $homeGalleryImages; @endphp
            @else
                @php $galleryList = collect($galleryFallback); @endphp
            @endif

            <div class="row g-3">
                {{-- Featured large card --}}
                <div class="col-lg-8 col-md-12">
                    @php $item = $galleryList->get(0); @endphp
                    @if($item)
                    <div class="gallery-item gallery-featured" onclick="openLightbox(0)">
                        <div class="gallery-number-badge"><i class="fa-solid fa-camera me-1"></i> ০১</div>
                        <img src="{{ $hasGallery ? $item->image : $item['src'] }}" alt="{{ $hasGallery ? ($item->title ?? 'Gallery') : $item['alt'] }}">
                        <div class="gallery-overlay">
                            <div class="gallery-overlay-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
                            <div class="gallery-overlay-title">{{ $hasGallery ? ($item->title ?? 'TechPark English') : $item['title'] }}</div>
                            <div class="gallery-overlay-tag"><i class="fa-solid fa-star"></i> ফিচার্ড</div>
                        </div>
                    </div>
                    @endif
                </div>
                {{-- 2 stacked cards --}}
                <div class="col-lg-4 col-md-12 d-flex flex-column gap-3">
                    @foreach([1,2] as $si)
                        @php $item = $galleryList->get($si); @endphp
                        @if($item)
                        <div class="gallery-item gallery-sm" onclick="openLightbox({{ $si }})">
                            <div class="gallery-number-badge"><i class="fa-solid fa-camera me-1"></i> 0{{ $si + 1 }}</div>
                            <img src="{{ $hasGallery ? $item->image : $item['src'] }}" alt="{{ $hasGallery ? ($item->title ?? 'Gallery') : $item['alt'] }}">
                            <div class="gallery-overlay">
                                <div class="gallery-overlay-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
                                <div class="gallery-overlay-title">{{ $hasGallery ? ($item->title ?? 'TechPark English') : $item['title'] }}</div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Bottom row 3 equal cards --}}
            <div class="row g-3 mt-0">
                @foreach([3,4,5] as $bi)
                    @php $item = $galleryList->get($bi); @endphp
                    @if($item)
                    <div class="col-lg-4 col-md-6">
                        <div class="gallery-item" onclick="openLightbox({{ $bi }})">
                            <div class="gallery-number-badge"><i class="fa-solid fa-camera me-1"></i> 0{{ $bi + 1 }}</div>
                            <img src="{{ $hasGallery ? $item->image : $item['src'] }}" alt="{{ $hasGallery ? ($item->title ?? 'Gallery') : $item['alt'] }}">
                            <div class="gallery-overlay">
                                <div class="gallery-overlay-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
                                <div class="gallery-overlay-title">{{ $hasGallery ? ($item->title ?? 'TechPark English') : $item['title'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="/gallery" class="btn-tpe-fill"><i class="fa-solid fa-images me-2"></i> সব ছবি দেখুন</a>
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
    <section class="py-5 vid-section-wrap">
        <div class="container py-4">
            <div class="text-center mb-5">
                <div class="vid-section-badge"><i class="fa-brands fa-youtube"></i> ভিডিও গ্যালারি</div>
                <h2 class="section-title mb-2">আমাদের <span style="background:linear-gradient(90deg,#fab005,#ff6b35);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">ভিডিও গ্যালারি</span></h2>
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
                            <div class="vid-thumb-overlay"></div>
                            <div class="vid-yt-badge"><i class="fa-brands fa-youtube"></i> TechPark English</div>
                            <div class="vid-play-btn"><i class="fa-solid fa-play"></i></div>
                            <div class="vid-bottom-title">
                                <h6>{{ $video->title }}</h6>
                            </div>
                        </div>
                        <div class="vid-info">
                            <div class="vid-info-icon"><i class="fa-solid fa-circle-play"></i></div>
                            <div class="vid-info-body">
<p>{{ strip_tags($video->description) }}</p>
                            </div>
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
                <h2 class="section-title mb-2">আমাদের প্রফেশনাল <span style="background:linear-gradient(90deg,#fab005,#ff6b35);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">ট্রেইনার</span></h2>
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
        $fsem_id  = $fsem ? $fsem->id : null;
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

                    @if($fsem && ($fsem->whatsapp_group || $fsem->facebook_group || $fsem->telegram_group))
                    <div class="d-flex flex-wrap gap-2 mt-4 align-items-center my-5">
                        <span style="color:rgba(255,255,255,0.55); font-size:0.82rem; font-weight:600;">গ্রুপে যোগ দিন:</span>
                        @if($fsem->whatsapp_group)
                        <a href="{{ $fsem->whatsapp_group }}" target="_blank" rel="noopener" class="seminar-social-btn seminar-social-wa">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </a>
                        @endif
                        @if($fsem->facebook_group)
                        <a href="{{ $fsem->facebook_group }}" target="_blank" rel="noopener" class="seminar-social-btn seminar-social-fb">
                            <i class="fa-brands fa-facebook-f"></i> Facebook
                        </a>
                        @endif
                        @if($fsem->telegram_group)
                        <a href="{{ $fsem->telegram_group }}" target="_blank" rel="noopener" class="seminar-social-btn seminar-social-tg">
                            <i class="fa-brands fa-telegram"></i> Telegram
                        </a>
                        @endif
                    </div>
                    @endif
                    @if($fsem)
                      <a href="{{ route('seminar.details', $fsem_id) }}" class="btn-tpe-fill" >
                            <i class="fa-solid fa-circle-info"></i> বিস্তারিত
                        </a>
                    @endif
                    <a href="{{ route('all-seminers') }}" class="btn-tpe-fill mx-1" style="display:inline-flex; align-items:center; gap:8px;">
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
    <section class="py-5 marquee-section" style="background:#fafbfc; border-top: 1px solid #eef1f5;">
        <div class="container py-2">
            <div class="text-center mb-5">
                <h2 class="section-title mb-2">সফল শিক্ষার্থীদের <span style="background:linear-gradient(90deg,#fab005,#ff6b35);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">গল্প</span></h2>
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
                        <i class="fa-solid fa-arrow-right"></i> এখনই ভর্তি হন
                    </a>
                    @php $cta_phone = setting('phone_numbers') ?: ''; @endphp
                    @if($cta_phone)
                    <a href="tel:{{ $cta_phone }}" class="btn-cta-outline">
                        <i class="fa-solid fa-phone"></i> কল করুন
                    </a>
                    @endif
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
