<style>
/* ===== Policy Hero ===== */
.pol-hero {
    background: linear-gradient(135deg, #001830 0%, #002147 55%, #003b7a 100%);
    padding: 70px 0 60px; position: relative; overflow: hidden;
}
.pol-hero::before { content:''; position:absolute; top:-100px; right:-80px; width:500px; height:500px; border-radius:50%; background:rgba(250,176,5,0.05); }
.pol-hero::after  { content:''; position:absolute; bottom:-160px; left:-80px; width:450px; height:450px; border-radius:50%; background:rgba(255,255,255,0.02); }
.pol-hero-inner   { position:relative; z-index:1; display:flex; align-items:center; gap:28px; flex-wrap:wrap; }
.pol-icon-wrap {
    width:80px; height:80px; border-radius:22px; flex-shrink:0;
    background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12);
    display:flex; align-items:center; justify-content:center; font-size:2rem;
}
.pol-hero-text {}
.pol-badge {
    display:inline-block; font-size:0.68rem; font-weight:700; letter-spacing:1px;
    text-transform:uppercase; padding:5px 16px; border-radius:50px; margin-bottom:10px;
    background:rgba(250,176,5,0.15); border:1px solid rgba(250,176,5,0.35); color:#fab005;
}
.pol-hero-title { font-size:clamp(1.8rem,4vw,2.6rem); font-weight:800; color:#fff; line-height:1.2; margin-bottom:10px; }
.pol-hero-sub   { font-size:0.9rem; color:rgba(255,255,255,0.62); line-height:1.75; max-width:600px; }

/* ===== Breadcrumb ===== */
.pol-breadcrumb {
    background:#fff; border-bottom:1px solid #eef2f8;
    padding:12px 0; font-size:0.78rem;
}
.pol-breadcrumb a { color:#002147; text-decoration:none; font-weight:600; }
.pol-breadcrumb a:hover { color:#fab005; }
.pol-breadcrumb span { color:#9aa3b0; margin:0 6px; }
.pol-breadcrumb .current { color:#6b7a90; }

/* ===== Layout ===== */
.pol-body { background:#f0f4fb; padding:50px 0 70px; }
.pol-card {
    background:#fff; border-radius:20px;
    box-shadow:0 4px 32px rgba(0,33,71,0.07);
    border:1px solid #e8eef8; overflow:hidden;
}
.pol-card-head {
    background:linear-gradient(135deg,#f7faff,#eef3fc);
    padding:22px 32px; border-bottom:1px solid #e4ecf5;
    display:flex; align-items:center; gap:14px;
}
.pol-card-head-icon {
    width:40px; height:40px; border-radius:12px;
    background:linear-gradient(135deg,#002147,#003b7a);
    display:flex; align-items:center; justify-content:center;
    color:#fab005; font-size:1rem; flex-shrink:0;
}
.pol-card-head-text { font-size:0.85rem; font-weight:700; color:#002147; }
.pol-card-head-sub  { font-size:0.72rem; color:#6b7a90; margin-top:2px; }
.pol-card-body { padding:36px 40px; }

/* ===== Prose Styling ===== */
.pol-prose { font-size:0.95rem; color:#3d4a5c; line-height:1.9; }
.pol-prose h1,.pol-prose h2 {
    font-size:1.25rem; font-weight:800; color:#001e3c;
    margin:36px 0 14px; padding-bottom:10px;
    border-bottom:2px solid #eef2f8; position:relative;
}
.pol-prose h1::before,.pol-prose h2::before {
    content:''; position:absolute; bottom:-2px; left:0;
    width:48px; height:2px; background:linear-gradient(90deg,#002147,#fab005);
}
.pol-prose h3 { font-size:1.05rem; font-weight:700; color:#002147; margin:26px 0 10px; }
.pol-prose h4 { font-size:0.95rem; font-weight:700; color:#002d5c; margin:20px 0 8px; }
.pol-prose p  { margin-bottom:16px; }
.pol-prose ul,.pol-prose ol { padding-left:0; list-style:none; margin-bottom:18px; }
.pol-prose ul li,.pol-prose ol li {
    padding:8px 14px 8px 38px; position:relative;
    border-radius:8px; margin-bottom:6px;
    background:#f7faff; border:1px solid #edf2fb;
    font-size:0.9rem; color:#3d4a5c;
}
.pol-prose ul li::before {
    content:'\f00c'; font-family:'Font Awesome 6 Free'; font-weight:900;
    position:absolute; left:12px; top:50%; transform:translateY(-50%);
    color:#002147; font-size:0.65rem;
}
.pol-prose ol { counter-reset:ol-counter; }
.pol-prose ol li::before {
    content:counter(ol-counter); counter-increment:ol-counter;
    position:absolute; left:10px; top:50%; transform:translateY(-50%);
    width:20px; height:20px; border-radius:50%;
    background:linear-gradient(135deg,#002147,#003b7a);
    color:#fab005; font-size:0.65rem; font-weight:800;
    display:flex; align-items:center; justify-content:center;
}
.pol-prose strong { color:#001e3c; font-weight:700; }
.pol-prose a { color:#002147; font-weight:600; text-decoration:underline; text-underline-offset:3px; }
.pol-prose a:hover { color:#fab005; }
.pol-prose blockquote {
    border-left:4px solid #fab005; background:#fffbf0;
    padding:16px 20px; border-radius:0 10px 10px 0; margin:20px 0;
    font-style:italic; color:#7a6200;
}
.pol-prose table { width:100%; border-collapse:collapse; margin:20px 0; font-size:0.88rem; }
.pol-prose table th { background:#002147; color:#fff; padding:10px 14px; text-align:left; font-weight:600; }
.pol-prose table td { padding:10px 14px; border-bottom:1px solid #eef2f8; color:#4a5568; }
.pol-prose table tr:hover td { background:#f7faff; }

/* ===== Sidebar info card ===== */
.pol-sidebar-card {
    background:#fff; border-radius:16px; border:1px solid #e8eef8;
    box-shadow:0 4px 20px rgba(0,33,71,0.06); overflow:hidden; margin-bottom:20px;
}
.pol-sidebar-card-head {
    background:linear-gradient(135deg,#002147,#003b7a);
    padding:14px 18px; font-size:0.78rem; font-weight:700; color:#fff;
    display:flex; align-items:center; gap:8px;
}
.pol-sidebar-card-head i { color:#fab005; }
.pol-sidebar-card-body { padding:18px; }
.pol-info-row { display:flex; gap:10px; align-items:flex-start; margin-bottom:14px; }
.pol-info-row:last-child { margin-bottom:0; }
.pol-info-icon { width:32px; height:32px; border-radius:8px; background:#f0f4fb; flex-shrink:0; display:flex; align-items:center; justify-content:center; color:#002147; font-size:0.75rem; }
.pol-info-label { font-size:0.68rem; color:#9aa3b0; text-transform:uppercase; letter-spacing:0.5px; font-weight:700; }
.pol-info-val   { font-size:0.82rem; color:#2d3a4a; font-weight:600; margin-top:2px; }

/* ===== Contact CTA ===== */
.pol-cta {
    background:linear-gradient(135deg,#001830,#002d5c);
    border-radius:16px; padding:28px 24px; text-align:center;
    border:1px solid rgba(255,255,255,0.06);
}
.pol-cta p { color:rgba(255,255,255,0.65); font-size:0.82rem; line-height:1.7; margin-bottom:16px; }
.pol-cta a {
    display:inline-flex; align-items:center; gap:7px;
    background:linear-gradient(135deg,#fab005,#e09600);
    color:#fff !important; padding:10px 22px; border-radius:50px;
    font-weight:700; font-size:0.8rem; text-decoration:none; transition:all 0.3s;
}
.pol-cta a:hover { transform:translateY(-2px); box-shadow:0 6px 18px rgba(250,176,5,0.4); }

@media(max-width:768px) {
    .pol-card-body { padding:24px 20px; }
    .pol-hero-inner { gap:18px; }
    .pol-icon-wrap { width:60px; height:60px; font-size:1.5rem; }
}
</style>
