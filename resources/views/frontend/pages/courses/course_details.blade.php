@php
    $meta = [
        'seo' => [
            'title' => $data->title,
            'image' => asset($data->image),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ============================================================
   DESIGN TOKENS
   ============================================================ */
:root {
    --navy:   #001e3c;
    --navy2:  #002d5c;
    --navy3:  #003b7a;
    --gold:   #fab005;
    --gold2:  #e09600;
    --bg:     #f0f4f9;
    --card:   #ffffff;
    --border: #e4ecf5;
    --text:   #1a2635;
    --muted:  #6b7a90;
    --radius: 16px;
    --shadow: 0 4px 24px rgba(0,30,60,0.08);
    --shadow-lg: 0 12px 48px rgba(0,30,60,0.14);
}

/* ============================================================
   HERO
   ============================================================ */
.cd-hero {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 55%, var(--navy3) 100%);
    padding: 56px 0 48px;
    position: relative; overflow: hidden;
}
.cd-hero::before {
    content:''; position:absolute; top:-100px; right:-80px;
    width:420px; height:420px;
    background: radial-gradient(circle, rgba(250,176,5,0.07) 0%, transparent 70%);
    border-radius:50%;
}
.cd-hero::after {
    content:''; position:absolute; bottom:-120px; left:-60px;
    width:380px; height:380px;
    background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, transparent 70%);
    border-radius:50%;
}
.cd-breadcrumb {
    display:flex; align-items:center; gap:6px; margin-bottom:18px;
    flex-wrap:wrap;
}
.cd-breadcrumb a, .cd-breadcrumb span {
    font-size:0.72rem; font-weight:600; color:rgba(255,255,255,0.45);
    text-decoration:none; transition:color 0.2s;
}
.cd-breadcrumb a:hover { color:var(--gold); }
.cd-breadcrumb .sep { color:rgba(255,255,255,0.2); }
.cd-breadcrumb .current { color:rgba(255,255,255,0.7); }
.cd-hero-badge {
    display:inline-flex; align-items:center; gap:6px;
    background:rgba(250,176,5,0.15); border:1px solid rgba(250,176,5,0.4);
    color:var(--gold); font-size:0.7rem; font-weight:700;
    padding:5px 14px; border-radius:50px; margin-bottom:16px;
    letter-spacing:0.8px; text-transform:uppercase;
}
.cd-hero h1 {
    font-size: clamp(1.6rem,3.5vw,2.4rem);
    font-weight:800; color:#fff; line-height:1.25; margin-bottom:18px;
}
.cd-hero-chips {
    display:flex; flex-wrap:wrap; gap:10px; margin-bottom:0;
}
.cd-hero-chip {
    display:inline-flex; align-items:center; gap:7px;
    background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12);
    color:rgba(255,255,255,0.75); font-size:0.75rem; font-weight:600;
    padding:6px 14px; border-radius:50px; backdrop-filter:blur(4px);
}
.cd-hero-chip i { color:var(--gold); font-size:0.72rem; }

/* ============================================================
   PAGE LAYOUT
   ============================================================ */
#course_details { background:var(--bg); padding:44px 0 64px; }
.course_details_part { display:flex; gap:28px; align-items:flex-start; }
.course_details   { flex:1; min-width:0; }
.course_info      { width:370px; flex-shrink:0; }
@media(max-width:991px){
    .course_details_part { flex-direction:column; }
    .course_info { width:100%; order:-1; }
}

/* ============================================================
   SECTION CARDS
   ============================================================ */
.cd-card {
    background:var(--card); border-radius:var(--radius);
    border:1px solid var(--border); box-shadow:var(--shadow);
    margin-bottom:22px; overflow:hidden;
}
.cd-card-header {
    display:flex; align-items:center; gap:12px;
    padding:20px 26px 18px; border-bottom:1px solid var(--border);
}
.cd-card-icon {
    width:38px; height:38px; border-radius:10px; flex-shrink:0;
    background:rgba(0,30,60,0.06);
    display:flex; align-items:center; justify-content:center;
    font-size:0.88rem; color:var(--navy2);
}
.cd-card-title {
    font-size:0.72rem; font-weight:700; text-transform:uppercase;
    letter-spacing:1px; color:var(--gold);
}
.cd-card-body { padding:24px 26px; }

/* ============================================================
   COURSE OVERVIEW (index include)
   ============================================================ */
.co-section { margin-bottom:22px; }
.co-section:last-child { margin-bottom:0; }
.co-heading {
    font-size:1.05rem; font-weight:800; color:var(--navy);
    margin-bottom:10px; display:flex; align-items:center; gap:9px;
}
.co-heading::before {
    content:''; width:3px; height:1.1em; background:var(--gold);
    border-radius:3px; flex-shrink:0;
}
.co-text { color:#4a5568; line-height:1.9; font-size:0.9rem; }
.co-text ul { padding-left:22px; }
.co-text ul li { list-style:disc; margin-bottom:4px; }

/* ============================================================
   HOW IS STRUCTURED
   ============================================================ */
.struct-grid {
    display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));
    gap:12px;
}
.struct-item {
    display:flex; align-items:flex-start; gap:10px;
    background:#f7faff; border:1px solid #e4eeff;
    border-radius:10px; padding:12px 14px;
}
.struct-check {
    width:22px; height:22px; border-radius:50%; flex-shrink:0;
    background:rgba(0,45,92,0.1); color:var(--navy2);
    display:flex; align-items:center; justify-content:center;
    font-size:0.65rem; margin-top:1px;
}
.struct-label { font-size:0.83rem; font-weight:600; color:var(--text); line-height:1.35; }

/* ============================================================
   FEATURES ACCORDION
   ============================================================ */
.feat-list { list-style:none; padding:0; margin:0; }
.feat-item { border-bottom:1px solid var(--border); }
.feat-item:last-child { border-bottom:none; }
.feat-trigger {
    display:flex; align-items:center; gap:14px;
    padding:18px 26px; cursor:pointer; transition:background 0.2s; user-select:none;
}
.feat-trigger:hover { background:#f7faff; }
.feat-ico {
    width:36px; height:36px; border-radius:10px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    font-size:0.82rem; transition:all 0.3s;
}
.feat-name { font-weight:700; color:var(--navy); font-size:0.9rem; flex:1; }
.feat-arrow {
    width:28px; height:28px; border-radius:50%; flex-shrink:0;
    background:#f0f4f8; color:var(--navy2);
    display:flex; align-items:center; justify-content:center;
    font-size:0.65rem; transition:all 0.3s;
}
.feat-item.active .feat-arrow { background:var(--navy2); color:#fff; transform:rotate(180deg); }
.feat-item.active .feat-trigger { background:#f7faff; }
.feat-body { display:none; padding:0 26px 20px 76px; }
.feat-item.active .feat-body { display:block; }
.feat-ul { list-style:none; padding:0; margin:0; }
.feat-ul li {
    display:flex; align-items:flex-start; gap:10px;
    padding:8px 0; border-bottom:1px solid #f5f7fb;
    font-size:0.87rem; color:#4a5568; line-height:1.5;
}
.feat-ul li:last-child { border-bottom:none; }
.feat-ul .ck { color:var(--gold); font-size:0.8rem; flex-shrink:0; margin-top:2px; }

/* ============================================================
   CURRICULUM (already styled — keep wrapper)
   ============================================================ */
.class_module { background:transparent; padding:0; margin-bottom:0; }
.class_module_details { display:flex; flex-direction:column; gap:14px; }
.class_module_features { list-style:none; padding:0; margin:0; }

.milestone-item { border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,33,71,0.09); border:1px solid #dce8f5; background:#fff; }
.milestone-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:16px 20px; cursor:pointer; user-select:none;
    background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 100%);
    transition:background 0.25s;
}
.milestone-header:hover { background:linear-gradient(135deg,var(--navy2) 0%,var(--navy3) 100%); }
.milestone-left { display:flex; align-items:center; gap:14px; }
.milestone-num-badge {
    width:44px; height:44px; border-radius:12px; flex-shrink:0;
    background:rgba(250,176,5,0.18); border:1.5px solid rgba(250,176,5,0.45);
    display:flex; flex-direction:column; align-items:center; justify-content:center; line-height:1;
}
.milestone-num-badge .m-label { font-size:0.5rem; font-weight:700; color:rgba(250,176,5,0.8); text-transform:uppercase; letter-spacing:0.5px; }
.milestone-num-badge .m-num  { font-size:1.15rem; font-weight:800; color:var(--gold); line-height:1.1; }
.milestone-info .m-title { font-weight:700; color:#fff; font-size:0.95rem; line-height:1.3; }
.milestone-info .m-meta { margin-top:4px; display:flex; gap:8px; flex-wrap:wrap; }
.milestone-info .m-meta span { font-size:0.67rem; font-weight:600; color:rgba(255,255,255,0.55); background:rgba(255,255,255,0.08); padding:2px 9px; border-radius:50px; }
.milestone-chevron { width:30px; height:30px; border-radius:50%; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.15); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.7); font-size:0.72rem; flex-shrink:0; transition:transform 0.3s, background 0.2s; }
.milestone-item.active .milestone-chevron { transform:rotate(180deg); background:rgba(250,176,5,0.25); color:var(--gold); }
.milestone-content { display:none; padding:12px 14px; background:#f7faff; border-top:1px solid #dce8f5; }
.milestone-item.active .milestone-content { display:block; }

.module-item { border-radius:12px; overflow:hidden; border:1px solid #e2ecf8; background:#fff; margin-bottom:8px; box-shadow:0 2px 8px rgba(0,33,71,0.05); }
.module-item:last-child { margin-bottom:0; }
.module-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:13px 16px; cursor:pointer; user-select:none;
    background:linear-gradient(135deg,var(--navy3),#0057b3);
    transition:background 0.2s;
}
.module-header:hover { background:linear-gradient(135deg,#004a99,#0069cc); }
.module-left { display:flex; align-items:center; gap:12px; }
.module-num-pill { font-size:0.62rem; font-weight:700; color:rgba(255,255,255,0.75); background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2); padding:3px 10px; border-radius:50px; white-space:nowrap; flex-shrink:0; }
.module-info .mod-title { font-weight:700; color:#fff; font-size:0.85rem; }
.module-info .mod-stats { margin-top:5px; display:flex; gap:6px; flex-wrap:wrap; }
.mod-stat-pill { font-size:0.63rem; font-weight:600; padding:2px 8px; border-radius:50px; white-space:nowrap; }
.mod-stat-live     { background:rgba(220,53,69,0.2);  color:#ffaaaa; border:1px solid rgba(220,53,69,0.3); }
.mod-stat-recorded { background:rgba(90,175,250,0.2); color:#9fd5ff; border:1px solid rgba(90,175,250,0.3); }
.mod-stat-quiz     { background:rgba(250,176,5,0.2);  color:#ffd77a; border:1px solid rgba(250,176,5,0.3); }
.module-chevron { width:26px; height:26px; border-radius:50%; background:rgba(255,255,255,0.1); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.7); font-size:0.65rem; flex-shrink:0; transition:transform 0.3s; }
.module-item.active .module-chevron { transform:rotate(180deg); }
.class_module_feature_content { display:none; }
.module-item.active .class_module_feature_content { display:block; }

.module-classes-wrap { padding-bottom:4px; }
.module-class-group { padding:12px 16px 0; }
.class-group-label { font-size:0.68rem; font-weight:700; color:#999; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:8px; display:flex; align-items:center; gap:6px; }
.class-group-label::after { content:''; flex:1; height:1px; background:#eef2f8; }
.class-row { display:flex; align-items:flex-start; gap:10px; padding:8px 0; border-bottom:1px solid #f3f6fb; }
.class-row:last-child { border-bottom:none; }
.class-type-dot { width:8px; height:8px; border-radius:50%; flex-shrink:0; margin-top:5px; }
.class-row.type-live     .class-type-dot { background:#dc3545; box-shadow:0 0 0 3px rgba(220,53,69,0.15); }
.class-row.type-recorded .class-type-dot { background:#0d6efd; box-shadow:0 0 0 3px rgba(13,110,253,0.15); }
.class-type-icon { width:28px; height:28px; border-radius:8px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:0.72rem; }
.class-row.type-live     .class-type-icon { background:#fff0f0; color:#dc3545; }
.class-row.type-recorded .class-type-icon { background:#eef5ff; color:#0d6efd; }
.class-body { flex:1; min-width:0; }
.class-label-tag { font-size:0.6rem; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; padding:1px 7px; border-radius:50px; display:inline-block; margin-bottom:3px; }
.class-row.type-live     .class-label-tag { background:#fff0f0; color:#dc3545; }
.class-row.type-recorded .class-label-tag { background:#eef5ff; color:#0d6efd; }
.class-title { font-size:0.82rem; font-weight:600; color:#2d3a4a; line-height:1.4; }
.quiz-row { display:flex; align-items:center; gap:10px; padding:7px 16px; background:#fffbf0; border-top:1px solid #fef3cd; }
.quiz-icon { width:26px; height:26px; border-radius:8px; background:#fff3cd; color:#c07800; display:flex; align-items:center; justify-content:center; font-size:0.68rem; flex-shrink:0; }
.quiz-label { font-size:0.6rem; font-weight:700; color:#c07800; text-transform:uppercase; letter-spacing:0.5px; white-space:nowrap; }
.quiz-title { font-size:0.8rem; font-weight:600; color:#5a4000; flex:1; min-width:0; }

/* ============================================================
   INSTRUCTORS
   ============================================================ */
.instr-card {
    display:flex; gap:20px; align-items:flex-start;
    background:var(--card); border:1px solid var(--border);
    border-radius:var(--radius); padding:22px; margin-bottom:14px;
    box-shadow:var(--shadow); transition:all 0.3s;
}
.instr-card:last-child { margin-bottom:0; }
.instr-card:hover { transform:translateY(-3px); box-shadow:var(--shadow-lg); }
.instr-avatar {
    width:84px; height:84px; border-radius:50%; object-fit:cover;
    border:3px solid var(--gold); flex-shrink:0;
}
.instr-avatar-placeholder {
    width:84px; height:84px; border-radius:50%; flex-shrink:0;
    background:linear-gradient(135deg,var(--navy),var(--navy3));
    display:flex; align-items:center; justify-content:center;
    border:3px solid var(--gold); color:#fff; font-size:1.6rem; font-weight:700;
}
.instr-name { font-weight:800; color:var(--navy); font-size:1rem; margin-bottom:2px; }
.instr-desig { font-size:0.78rem; font-weight:600; color:var(--gold); margin-bottom:10px; }
.instr-bio { font-size:0.83rem; color:#4a5568; line-height:1.7; margin-bottom:10px; }
.instr-social { display:flex; gap:8px; flex-wrap:wrap; }
.instr-social a {
    width:30px; height:30px; border-radius:8px; border:1px solid var(--border);
    display:flex; align-items:center; justify-content:center;
    color:var(--navy); font-size:0.82rem; text-decoration:none; transition:all 0.25s;
}
.instr-social a:hover { background:var(--navy); color:#fff; border-color:var(--navy); }
@media(max-width:576px){
    .instr-card { flex-direction:column; align-items:center; text-align:center; }
    .instr-social { justify-content:center; }
}

/* ============================================================
   FAQ
   ============================================================ */
.faq-section { background:var(--bg); padding:56px 0; }
.faq-eyebrow {
    font-size:0.72rem; font-weight:700; text-transform:uppercase;
    letter-spacing:1px; color:var(--gold);
    background:rgba(250,176,5,0.1); border:1px solid rgba(250,176,5,0.25);
    padding:5px 16px; border-radius:50px; display:inline-block; margin-bottom:14px;
}
.faq-heading { font-size:clamp(1.4rem,3vw,1.9rem); font-weight:800; color:var(--navy); margin-bottom:6px; }
.faq-sub { color:var(--muted); font-size:0.9rem; margin-bottom:36px; }
.faq-list { max-width:720px; margin:0 auto; display:flex; flex-direction:column; gap:12px; }
.faq-item {
    background:var(--card); border-radius:14px; border:1px solid var(--border);
    box-shadow:0 2px 12px rgba(0,30,60,0.05); overflow:hidden; transition:box-shadow 0.3s;
}
.faq-item.active { box-shadow:0 6px 28px rgba(0,30,60,0.1); border-color:#c8d9f0; }
.faq-q {
    display:flex; align-items:center; gap:14px;
    padding:18px 22px; cursor:pointer; user-select:none; transition:background 0.2s;
}
.faq-q:hover { background:#f7faff; }
.faq-q-num {
    width:30px; height:30px; border-radius:8px; flex-shrink:0;
    background:rgba(0,30,60,0.06); color:var(--navy2);
    display:flex; align-items:center; justify-content:center;
    font-size:0.72rem; font-weight:800;
}
.faq-item.active .faq-q-num { background:var(--navy2); color:#fff; }
.faq-q-text { flex:1; font-weight:700; color:var(--navy); font-size:0.9rem; line-height:1.4; }
.faq-chevron {
    width:28px; height:28px; border-radius:50%; flex-shrink:0;
    background:#f0f4f8; color:var(--navy);
    display:flex; align-items:center; justify-content:center;
    font-size:0.65rem; transition:all 0.3s;
}
.faq-item.active .faq-chevron { background:var(--navy2); color:#fff; transform:rotate(180deg); }
.faq-a { display:none; padding:0 22px 18px 66px; color:#4a5568; font-size:0.875rem; line-height:1.8; }
.faq-item.active .faq-a { display:block; }

/* ============================================================
   COURSE INFO CARD (right sidebar)
   ============================================================ */
.course_info { min-width:0; }
.course_info_div {
    background:var(--card); border-radius:20px; overflow:hidden;
    box-shadow:var(--shadow-lg); border:1px solid var(--border);
    position:sticky; top:80px; width:100%; box-sizing:border-box;
}
.cic-thumb { position:relative; cursor:pointer; overflow:hidden; display:block; height:220px; }
.cic-thumb-img { width:100%; height:100%; object-fit:cover; display:block; transition:transform 0.45s ease; }
.cic-thumb:hover .cic-thumb-img { transform:scale(1.05); }
.cic-thumb-overlay { position:absolute; inset:0; background:linear-gradient(180deg, rgba(0,8,20,0.1) 0%, rgba(0,8,20,0.65) 100%); }
.cic-play-btn { position:absolute; top:50%; left:50%; transform:translate(-50%,-58%); width:60px; height:60px; display:flex; align-items:center; justify-content:center; transition:transform 0.3s; }
.cic-thumb:hover .cic-play-btn { transform:translate(-50%,-58%) scale(1.12); }
.cic-play-ring { position:absolute; inset:0; border-radius:50%; background:rgba(250,176,5,0.92); animation:playPulse 2s infinite; }
@keyframes playPulse {
    0%  { box-shadow:0 0 0 0 rgba(250,176,5,0.55); }
    70% { box-shadow:0 0 0 14px rgba(250,176,5,0); }
    100%{ box-shadow:0 0 0 0 rgba(250,176,5,0); }
}
.cic-play-icon { position:relative; z-index:1; color:#fff; font-size:1.25rem; margin-left:4px; }
.cic-thumb-label { position:absolute; bottom:12px; left:50%; transform:translateX(-50%); background:rgba(0,0,0,0.5); backdrop-filter:blur(6px); color:#fff; font-size:0.68rem; font-weight:600; padding:4px 14px; border-radius:50px; border:1px solid rgba(255,255,255,0.18); white-space:nowrap; }

.course_info_time { padding:16px 20px 14px; background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 60%,var(--navy3) 100%); text-align:center; }
.time_have_title { color:rgba(255,255,255,0.5) !important; font-size:0.6rem !important; text-transform:uppercase !important; letter-spacing:1.6px !important; font-weight:700 !important; display:block; margin-bottom:12px; }
ul.timer { display:flex; justify-content:center; align-items:flex-end; gap:0; list-style:none; padding:0; margin:0; }
ul.timer li { text-align:center; color:rgba(255,255,255,0.9) !important; font-size:0.58rem !important; padding:0 8px; line-height:1; }
ul.timer li .amount { font-size:1.75rem !important; font-weight:800 !important; color:var(--gold) !important; line-height:1 !important; display:block !important; margin-bottom:4px; font-variant-numeric:tabular-nums; }
ul.timer li .timer-label { color:rgba(255,255,255,0.45) !important; font-size:0.55rem !important; text-transform:uppercase !important; letter-spacing:0.6px !important; display:block !important; }
.timer-sep { color:rgba(255,255,255,0.2) !important; font-size:1.5rem !important; font-weight:200 !important; padding:0; align-self:center; line-height:1; padding-bottom:10px; }
.cic-booked-bar-wrap { margin-top:14px; }
.cic-booked-bar-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:5px; }
.cic-booked-label { color:rgba(255,255,255,0.6); font-size:0.65rem; font-weight:600; }
.cic-booked-pct { color:var(--gold); font-size:0.72rem; font-weight:800; }
.cic-booked-track { height:5px; background:rgba(255,255,255,0.12); border-radius:50px; overflow:hidden; }
.cic-booked-fill { height:100%; background:linear-gradient(90deg,var(--gold),#ff8c00); border-radius:50px; transition:width 1s ease; }

.cic-price-row { padding:14px 20px; display:flex; align-items:center; justify-content:center; gap:14px; border-bottom:1px solid var(--border); background:#fafcff; }
.cic-price-block { display:flex; align-items:baseline; gap:8px; }
.cic-old-price { font-size:0.95rem; color:#bbb; text-decoration:line-through; }
.cic-new-price { font-size:2rem; font-weight:800; color:var(--navy); line-height:1; }
.cic-discount-badge { background:linear-gradient(135deg,#e63946,#c1121f); color:#fff; font-size:0.7rem; font-weight:700; padding:4px 10px; border-radius:6px; letter-spacing:0.4px; }

.admit_course { padding:14px 16px; }
.admit_course_title_and_icon { display:flex; align-items:center; justify-content:center; gap:8px; background:linear-gradient(135deg,var(--navy),var(--navy3)); color:#fff !important; padding:13px 16px; border-radius:50px; text-decoration:none; font-weight:700; font-size:0.85rem; transition:all 0.3s; text-align:center; flex-grow:1; white-space:nowrap; min-width:0; }
.admit_course_title_and_icon:hover { background:linear-gradient(135deg,var(--gold),var(--gold2)); box-shadow:0 6px 20px rgba(250,176,5,0.35); }
.admit_course_title { color:#fff !important; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.admit_course_icon { color:#fff !important; flex-shrink:0; }

.batch-info-card { margin-top:14px; border-radius:14px; overflow:hidden; border:1px solid #dce8ff; background:#fff; }
.batch-header { display:flex; align-items:center; gap:12px; background:linear-gradient(135deg,var(--navy),var(--navy3)); padding:12px 16px; }
.batch-badge { width:36px; height:36px; border-radius:10px; background:rgba(250,176,5,0.2); border:1px solid rgba(250,176,5,0.4); display:flex; align-items:center; justify-content:center; color:var(--gold); font-size:0.9rem; flex-shrink:0; }
.batch-label { font-size:0.6rem; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.55); font-weight:600; }
.batch-name { font-size:0.88rem; font-weight:700; color:#fff; margin-top:1px; }
.batch-dates-grid { display:flex; align-items:center; padding:14px 16px; gap:10px; background:#f7faff; border-bottom:1px solid #e8eef8; }
.batch-date-item { flex:1; display:flex; align-items:flex-start; gap:10px; min-width:0; }
.batch-date-icon { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:0.8rem; flex-shrink:0; margin-top:1px; }
.batch-date-start .batch-date-icon { background:#e8fff2; color:#00a651; }
.batch-date-end   .batch-date-icon { background:#fff0f0; color:#dc3545; }
.batch-date-label { font-size:0.6rem; text-transform:uppercase; letter-spacing:0.6px; color:#999; font-weight:600; margin-bottom:3px; }
.batch-date-value { font-size:0.78rem; font-weight:700; color:var(--navy); line-height:1.2; }
.batch-date-time { font-size:0.68rem; color:#dc3545; font-weight:600; margin-top:2px; }
.batch-date-arrow { color:#ccd5e0; font-size:0.7rem; flex-shrink:0; padding-top:10px; }
.batch-meta { padding:12px 16px; display:flex; flex-direction:column; gap:10px; }
.batch-meta-item { display:flex; align-items:flex-start; gap:12px; }
.batch-meta-item > i { width:30px; height:30px; border-radius:8px; background:#f0f5ff; color:var(--navy); display:flex; align-items:center; justify-content:center; font-size:0.75rem; flex-shrink:0; margin-top:1px; }
.batch-meta-label { font-size:0.6rem; text-transform:uppercase; letter-spacing:0.6px; color:#999; font-weight:600; margin-bottom:2px; }
.batch-meta-value { font-size:0.78rem; font-weight:600; color:#2d3a4a; line-height:1.3; }

.course_needed { padding:0 16px 20px; }
.course_needed_title { font-weight:700; color:var(--navy); font-size:0.88rem; margin-bottom:10px; padding-bottom:6px; border-bottom:1px solid var(--border); }
.course_needed_internet { display:flex; align-items:flex-start; gap:8px; font-size:0.8rem; color:#555; margin-bottom:6px; }
.course_needed_internet i { color:var(--gold); flex-shrink:0; margin-top:2px; }
.course_hotline { background:linear-gradient(135deg,var(--navy),var(--navy3)) !important; border-radius:12px; text-align:center; }
.course_hotline_title { color:rgba(255,255,255,0.85) !important; font-size:0.78rem; margin-bottom:8px; }
.course_hotline_number { color:var(--gold) !important; font-weight:700; font-size:0.95rem; text-decoration:none; }
.course_schedule { background:rgba(250,176,5,0.1); color:#c07800; font-size:0.75rem; font-weight:600; padding:6px 14px; border-radius:50px; text-align:center; margin-top:8px; }

.course_details_area .course_details_part .course_info .course_info_div .admit_course .admit_course_title_and_icon .admit_course_icon.wishlist-icon,
.admit_course_icon.wishlist-icon { width:24px; height:30px !important; color:#fff; }

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:991px){
    .course_info_div { position:static; }
    .admit_course { padding:12px 14px; }
}
@media(max-width:767px){
    .feat-body { padding-left:20px; }
    .faq-a { padding-left:22px; }
    .struct-grid { grid-template-columns:1fr 1fr; }
}
@media(max-width:575px){
    #course_details { padding:20px 0 40px; }
    .course_details_part { gap:16px; }
    .cd-card-body { padding:16px 18px; }
    .cd-card-header { padding:16px 18px; }
    .cic-thumb { height:190px; }
    ul.timer li { padding:0 4px; }
    ul.timer li .amount { font-size:1.3rem !important; }
    .cic-new-price { font-size:1.6rem; }
    .struct-grid { grid-template-columns:1fr; }
}
</style>
@endpush

@section('contents')

{{-- ── HERO ─────────────────────────────────────────────────────── --}}
<section class="cd-hero">
    <div class="container position-relative" style="z-index:1;">
        <div class="cd-breadcrumb">
            <a href="{{ route('website') }}">Home</a>
            <span class="sep"><i class="fa-solid fa-chevron-right" style="font-size:0.55rem;"></i></span>
            <a href="{{ route('courses') }}">Courses</a>
            <span class="sep"><i class="fa-solid fa-chevron-right" style="font-size:0.55rem;"></i></span>
            <span class="current">{{ Str::limit($data->title, 40) }}</span>
        </div>
        <span class="cd-hero-badge">
            <i class="fa-solid fa-graduation-cap"></i>
            {{ $data->course_category->title ?? 'TechPark English' }}
        </span>
        <h1>{{ $data->title }}</h1>
        <div class="cd-hero-chips">
            @php
                $heroController = new App\Http\Controllers\Course\CourseController();
                $heroData = $heroController->course_batch_details($data->id);
                $heroBatch = $heroData['batch'] ?? null;
            @endphp
            @if($heroBatch?->class_days)
                <span class="cd-hero-chip"><i class="fa-solid fa-calendar-days"></i> {{ $heroBatch->class_days }}</span>
            @endif
            @if($heroBatch?->class_start_time && $heroBatch?->class_end_time)
                <span class="cd-hero-chip"><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($heroBatch->class_start_time)->format('g:i A') }} – {{ \Carbon\Carbon::parse($heroBatch->class_end_time)->format('g:i A') }}</span>
            @endif
            @if($heroBatch?->batch_student_limit)
                <span class="cd-hero-chip"><i class="fa-solid fa-users"></i> সীমিত আসন ({{ $heroBatch->batch_student_limit }})</span>
            @endif
            <span class="cd-hero-chip"><i class="fa-solid fa-certificate"></i> সার্টিফিকেট প্রদান</span>
        </div>
    </div>
</section>

{{-- ── MAIN CONTENT ─────────────────────────────────────────────── --}}
<section class="course_details_area" id="course_details">
    <div class="container">
        <div class="course_details_part">
            <div class="course_details">

                {{-- Course Overview --}}
                <div class="cd-card">
                    <div class="cd-card-header">
                        <div class="cd-card-icon"><i class="fa-solid fa-circle-info"></i></div>
                        <span class="cd-card-title">কোর্স পরিচিতি</span>
                    </div>
                    <div class="cd-card-body">
                        @include('frontend.pages.courses.includes.index')
                    </div>
                </div>

                {{-- How Structured --}}
                @if($data->course_how_is_structured()->count() > 0)
                <div class="cd-card">
                    <div class="cd-card-header">
                        <div class="cd-card-icon"><i class="fa-solid fa-sitemap"></i></div>
                        <span class="cd-card-title">কোর্স স্ট্রাকচার</span>
                    </div>
                    <div class="cd-card-body">
                        @include('frontend.pages.courses.includes.course_how_is_structured')
                    </div>
                </div>
                @endif

                {{-- Features --}}
                <div class="cd-card" style="padding:0; overflow:hidden;">
                    @include('frontend.pages.courses.includes.features')
                </div>

                {{-- Curriculum --}}
                <div class="cd-card">
                    <div class="cd-card-header">
                        <div class="cd-card-icon"><i class="fa-solid fa-list-check"></i></div>
                        <span class="cd-card-title">কোর্স কারিকুলাম</span>
                    </div>
                    <div class="cd-card-body" style="padding:20px;">
                        @include('frontend.pages.courses.includes.course_module')
                    </div>
                </div>

                {{-- Instructors --}}
                @if($data->course_instructors != null && count($data->course_instructors) > 0)
                <div class="cd-card">
                    <div class="cd-card-header">
                        <div class="cd-card-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        <span class="cd-card-title">কোর্স ইন্সট্রাক্টর</span>
                    </div>
                    <div class="cd-card-body">
                        @include('frontend.pages.courses.includes.teachers')
                    </div>
                </div>
                @endif

            </div>

            {{-- Sidebar --}}
            @include('frontend.pages.courses.includes.course_details_card')

        </div>
    </div>
</section>

{{-- ── FAQ ──────────────────────────────────────────────────────── --}}
@include('frontend.pages.courses.includes.course_faq')

@endsection
