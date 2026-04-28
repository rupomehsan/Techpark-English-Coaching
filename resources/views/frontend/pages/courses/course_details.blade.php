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
/* ===== Course Details Hero ===== */
.cd-hero {
    background: linear-gradient(135deg, #001830 0%, #002147 60%, #003b7a 100%);
    padding: 50px 0 40px;
    position: relative; overflow: hidden;
}
.cd-hero::before { content:''; position:absolute; top:-80px; right:-60px; width:350px; height:350px; background:rgba(250,176,5,0.06); border-radius:50%; }
.cd-hero-badge { display:inline-block; background:rgba(250,176,5,0.18); border:1px solid rgba(250,176,5,0.5); color:#fab005; font-size:0.72rem; font-weight:700; padding:5px 16px; border-radius:50px; margin-bottom:12px; letter-spacing:0.8px; text-transform:uppercase; }
.cd-hero h1 { font-size:clamp(1.5rem,3vw,2.2rem); font-weight:800; color:#fff; line-height:1.3; margin-bottom:14px; }
.cd-hero-meta { display:flex; flex-wrap:wrap; gap:16px; align-items:center; }
.cd-hero-meta span { color:rgba(255,255,255,0.75); font-size:0.82rem; display:flex; align-items:center; gap:6px; }
.cd-hero-meta span i { color:#fab005; }

/* ===== Layout ===== */
#course_details { background:#f4f7fb; padding:40px 0 60px; }
.course_details_part { display:flex; gap:30px; align-items:flex-start; }
.course_details { flex:1; min-width:0; }
.course_info { width:360px; flex-shrink:0; }
@media(max-width:991px) {
    .course_details_part { flex-direction:column; }
    .course_info { width:100%; order:-1; }
}

/* ===== Left Content Cards ===== */
.cd-section-card {
    background:#fff; border-radius:16px; padding:28px 30px; margin-bottom:24px;
    box-shadow:0 2px 16px rgba(0,33,71,0.06); border:1px solid #eef2f8;
}
.cd-section-label {
    font-size:0.68rem; font-weight:700; letter-spacing:1px; text-transform:uppercase;
    color:#fab005; background:rgba(250,176,5,0.1); border:1px solid rgba(250,176,5,0.2);
    padding:4px 12px; border-radius:50px; display:inline-block; margin-bottom:12px;
}
.course_title { border-bottom:none !important; }
.course_title .course_title_text {
    font-size:clamp(1.3rem,2.5vw,1.8rem); font-weight:800; color:#002147; line-height:1.3;
    margin:0 0 6px;
}
.what_is_course_title, .why_learn_this_course_title {
    font-size:1.1rem; font-weight:700; color:#002147; margin-bottom:12px;
    padding-bottom:8px; border-bottom:2px solid #fab005; display:inline-block;
}
.what_is_course_details, .why_learn_this_course_details { color:#4a5568; line-height:1.85; font-size:0.92rem; }

/* ===== Features Accordion ===== */
.course_feature_part { background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 16px rgba(0,33,71,0.06); border:1px solid #eef2f8; margin-bottom:24px; }
.course_features { list-style:none; padding:0; margin:0; }
.course_features > li { border-bottom:1px solid #eef2f8; }
.course_features > li:last-child { border-bottom:none; }
.feature_title {
    display:flex; align-items:center; justify-content:space-between;
    padding:18px 24px; cursor:pointer; transition:background 0.2s;
}
.feature_title:hover { background:#f8fbff; }
.feature_name { font-weight:700; color:#002147; font-size:0.92rem; }
.feature_acordion_icon { width:28px; height:28px; background:#f0f4f8; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#002147; transition:all 0.3s; }
.course_features > li.active .feature_acordion_icon { background:#002147; color:#fff; transform:rotate(180deg); }
.feature_content { display:none; padding:4px 24px 20px; }
.course_features > li.active .feature_content { display:block; }
.feature_content ul { list-style:none; padding:0; margin:0; }
.feature_content ul li { display:flex; align-items:flex-start; gap:10px; padding:7px 0; border-bottom:1px solid #f0f4f8; color:#4a5568; font-size:0.88rem; line-height:1.5; }
.feature_content ul li:last-child { border-bottom:none; }
.cheak_icon { color:#fab005; flex-shrink:0; margin-top:2px; }

/* ===== Module ===== */
.class_module { background:#fff; border-radius:16px; padding:24px; margin-bottom:24px; box-shadow:0 2px 16px rgba(0,33,71,0.06); border:1px solid #eef2f8; }
.class_module_features { list-style:none; padding:0; margin:0 0 12px; }
.milestone-item { border:1px solid #e8edf5; border-radius:12px; overflow:hidden; margin-bottom:12px; }
.class_module_title {
    display:flex; align-items:center; justify-content:space-between;
    padding:14px 18px; background:#f8fbff; cursor:pointer;
}
.milestone-item.active .class_module_title { background:linear-gradient(135deg,#002147,#003b7a); }
.milestone-item.active .class_module_title * { color:#fff !important; }
.class_module_title_and_number { display:flex; align-items:center; gap:14px; }
.class_module_number { background:rgba(0,33,71,0.08); color:#002147; font-size:0.7rem; font-weight:700; padding:4px 10px; border-radius:50px; white-space:nowrap; }
.milestone-item.active .class_module_number { background:rgba(255,255,255,0.2); color:#fff; }
.class_module_title_details .title { font-weight:700; color:#002147; font-size:0.9rem; }
.class_module_title_details .details { list-style:none; padding:0; margin:4px 0 0; display:flex; gap:10px; flex-wrap:wrap; }
.class_module_title_details .details li { font-size:0.72rem; color:#888; }
.class_milestone_acordion_icon, .class_module_acordion_icon { width:26px; height:26px; background:rgba(0,33,71,0.08); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#002147; flex-shrink:0; transition:transform 0.3s; }
.milestone-item.active .class_milestone_acordion_icon { background:rgba(255,255,255,0.2); color:#fff; }
.milestone-content { display:none; padding:12px; background:#fff; }
.milestone-item.active .milestone-content { display:block; }

/* ===== Course Info Card ===== */
.course_info { min-width:0; }
.course_info_div {
    background:#fff; border-radius:18px; overflow:hidden;
    box-shadow:0 8px 40px rgba(0,33,71,0.12); border:1px solid #eef2f8;
    position:sticky; top:80px; width:100%; box-sizing:border-box;
}

/* ===== Thumbnail / Play Button ===== */
.cic-thumb {
    position:relative; cursor:pointer; overflow:hidden; display:block;
    height:230px;
}
.cic-thumb-img {
    width:100%; height:100%; object-fit:cover; display:block;
    transition:transform 0.45s ease;
}
.cic-thumb:hover .cic-thumb-img { transform:scale(1.05); }
.cic-thumb-overlay {
    position:absolute; inset:0;
    background:linear-gradient(180deg, rgba(0,8,20,0.15) 0%, rgba(0,8,20,0.7) 100%);
}
/* Play button */
.cic-play-btn {
    position:absolute; top:50%; left:50%; transform:translate(-50%,-58%);
    width:62px; height:62px;
    display:flex; align-items:center; justify-content:center;
    transition:transform 0.3s;
}
.cic-thumb:hover .cic-play-btn { transform:translate(-50%,-58%) scale(1.12); }
.cic-play-ring {
    position:absolute; inset:0; border-radius:50%;
    background:rgba(250,176,5,0.92);
    box-shadow:0 0 0 0 rgba(250,176,5,0.5);
    animation:playPulse 2s infinite;
}
@keyframes playPulse {
    0%  { box-shadow:0 0 0 0 rgba(250,176,5,0.55); }
    70% { box-shadow:0 0 0 14px rgba(250,176,5,0); }
    100%{ box-shadow:0 0 0 0 rgba(250,176,5,0); }
}
.cic-play-icon {
    position:relative; z-index:1;
    color:#fff; font-size:1.3rem; margin-left:4px;
}
/* "Watch Intro" label */
.cic-thumb-label {
    position:absolute; bottom:14px; left:50%; transform:translateX(-50%);
    background:rgba(0,0,0,0.55); backdrop-filter:blur(6px);
    color:#fff; font-size:0.7rem; font-weight:600; letter-spacing:0.5px;
    padding:5px 14px; border-radius:50px;
    border:1px solid rgba(255,255,255,0.2);
    white-space:nowrap;
}

/* ===== Timer Section ===== */
.course_info_time {
    padding:16px 20px 14px;
    background:linear-gradient(135deg,#001830 0%,#002147 60%,#003b7a 100%);
    text-align:center;
}
.time_have_title {
    color:rgba(255,255,255,0.55) !important;
    font-size:0.62rem !important;
    text-transform:uppercase !important;
    letter-spacing:1.6px !important;
    font-weight:700 !important;
    display:block; margin-bottom:12px;
}
ul.timer {
    display:flex; justify-content:center; align-items:flex-end;
    gap:0; list-style:none; padding:0; margin:0;
}
ul.timer li {
    text-align:center;
    color:rgba(255,255,255,0.9) !important;
    font-size:0.58rem !important;
    padding:0 8px; line-height:1;
}
ul.timer li .amount {
    font-size:1.75rem !important; font-weight:800 !important;
    color:#fab005 !important; line-height:1 !important;
    display:block !important; margin-bottom:4px;
    font-variant-numeric:tabular-nums;
}
ul.timer li .timer-label {
    color:rgba(255,255,255,0.45) !important;
    font-size:0.55rem !important; text-transform:uppercase !important;
    letter-spacing:0.6px !important; display:block !important;
}
.timer-sep {
    color:rgba(255,255,255,0.2) !important;
    font-size:1.5rem !important; font-weight:200 !important;
    padding:0; align-self:center; line-height:1; padding-bottom:10px;
}
/* Booked progress bar */
.cic-booked-bar-wrap { margin-top:14px; }
.cic-booked-bar-row {
    display:flex; justify-content:space-between; align-items:center;
    margin-bottom:5px;
}
.cic-booked-label { color:rgba(255,255,255,0.6); font-size:0.65rem; font-weight:600; }
.cic-booked-pct { color:#fab005; font-size:0.72rem; font-weight:800; }
.cic-booked-track {
    height:5px; background:rgba(255,255,255,0.12); border-radius:50px;
    overflow:hidden;
}
.cic-booked-fill {
    height:100%; background:linear-gradient(90deg,#fab005,#ff8c00);
    border-radius:50px; transition:width 1s ease;
}

/* ===== Price Row ===== */
.cic-price-row {
    padding:14px 20px;
    display:flex; align-items:center; justify-content:center; gap:14px;
    border-bottom:1px solid #eef2f8;
    background:#fafcff;
}
.cic-price-block { display:flex; align-items:baseline; gap:8px; }
.cic-old-price { font-size:0.95rem; color:#bbb; text-decoration:line-through; }
.cic-new-price { font-size:2rem; font-weight:800; color:#002147; line-height:1; }
.cic-discount-badge {
    background:linear-gradient(135deg,#e63946,#c1121f);
    color:#fff; font-size:0.7rem; font-weight:700;
    padding:4px 10px; border-radius:6px; letter-spacing:0.4px;
}

.admit_course { padding:14px 16px; }
.admit_course_title_and_icon {
    display:flex; align-items:center; justify-content:center; gap:8px;
    background:linear-gradient(135deg,#002147,#003b7a); color:#fff !important;
    padding:12px 16px; border-radius:50px; text-decoration:none; font-weight:700;
    font-size:0.85rem; transition:all 0.3s; text-align:center; flex-grow:1;
    white-space:nowrap; min-width:0;
}
.admit_course_title_and_icon:hover { background:linear-gradient(135deg,#fab005,#e09600); box-shadow:0 6px 20px rgba(250,176,5,0.35); }
.admit_course_title { color:#fff !important; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.admit_course_icon { color:#fff !important; flex-shrink:0; }

/* ===== Batch Info Card ===== */
.batch-info-card {
    margin-top:14px;
    border-radius:14px;
    overflow:hidden;
    border:1px solid #dce8ff;
    background:#fff;
}

/* Header */
.batch-header {
    display:flex; align-items:center; gap:12px;
    background:linear-gradient(135deg,#002147,#003b7a);
    padding:12px 16px;
}
.batch-badge {
    width:36px; height:36px; border-radius:10px;
    background:rgba(250,176,5,0.2); border:1px solid rgba(250,176,5,0.4);
    display:flex; align-items:center; justify-content:center;
    color:#fab005; font-size:0.9rem; flex-shrink:0;
}
.batch-label {
    font-size:0.6rem; text-transform:uppercase; letter-spacing:1px;
    color:rgba(255,255,255,0.55); font-weight:600;
}
.batch-name {
    font-size:0.88rem; font-weight:700; color:#fff; margin-top:1px;
}

/* Dates grid */
.batch-dates-grid {
    display:flex; align-items:center;
    padding:14px 16px; gap:10px;
    background:#f7faff; border-bottom:1px solid #e8eef8;
}
.batch-date-item {
    flex:1; display:flex; align-items:flex-start; gap:10px; min-width:0;
}
.batch-date-icon {
    width:32px; height:32px; border-radius:8px;
    display:flex; align-items:center; justify-content:center;
    font-size:0.8rem; flex-shrink:0; margin-top:1px;
}
.batch-date-start .batch-date-icon { background:#e8fff2; color:#00a651; }
.batch-date-end   .batch-date-icon { background:#fff0f0; color:#dc3545; }
.batch-date-label {
    font-size:0.6rem; text-transform:uppercase; letter-spacing:0.6px;
    color:#999; font-weight:600; margin-bottom:3px;
}
.batch-date-value {
    font-size:0.78rem; font-weight:700; color:#002147; line-height:1.2;
}
.batch-date-time {
    font-size:0.68rem; color:#dc3545; font-weight:600; margin-top:2px;
}
.batch-date-arrow {
    color:#ccd5e0; font-size:0.7rem; flex-shrink:0; padding-top:10px;
}

/* Meta rows */
.batch-meta {
    padding:12px 16px; display:flex; flex-direction:column; gap:10px;
}
.batch-meta-item {
    display:flex; align-items:flex-start; gap:12px;
}
.batch-meta-item > i {
    width:30px; height:30px; border-radius:8px;
    background:#f0f5ff; color:#002147;
    display:flex; align-items:center; justify-content:center;
    font-size:0.75rem; flex-shrink:0; margin-top:1px;
}
.batch-meta-label {
    font-size:0.6rem; text-transform:uppercase; letter-spacing:0.6px;
    color:#999; font-weight:600; margin-bottom:2px;
}
.batch-meta-value {
    font-size:0.78rem; font-weight:600; color:#2d3a4a; line-height:1.3;
}

/* Requirements section */
.course_needed { padding:0 16px 20px; }
.course_needed_title { font-weight:700; color:#002147; font-size:0.88rem; margin-bottom:10px; padding-bottom:6px; border-bottom:1px solid #eef2f8; }
.course_needed_internet { display:flex; align-items:flex-start; gap:8px; font-size:0.8rem; color:#555; margin-bottom:6px; word-break:break-word; }
.course_needed_internet i { color:#fab005; flex-shrink:0; margin-top:2px; }
.course_hotline { background:linear-gradient(135deg,#002147,#003b7a) !important; border-radius:12px; text-align:center; }
.course_hotline_title { color:rgba(255,255,255,0.85) !important; font-size:0.78rem; margin-bottom:8px; }
.course_hotline_number { color:#fab005 !important; font-weight:700; font-size:0.95rem; text-decoration:none; word-break:break-all; }
.course_schedule { background:rgba(250,176,5,0.1); color:#c07800; font-size:0.75rem; font-weight:600; padding:6px 14px; border-radius:50px; text-align:center; margin-top:8px; }

/* ===== Mobile Responsive Fixes ===== */
@media(max-width:991px) {
    .course_info_div { position:static; }
    .admit_course { padding:12px 14px; }
}
@media(max-width:575px) {
    #course_details { padding:20px 0 40px; }
    .course_details_part { gap:16px; }
    .cd-section-card { padding:18px 16px; margin-bottom:16px; }
    .cic-thumb { height:190px; }
    ul.timer li { padding:0 4px; }
    ul.timer li .amount { font-size:1.3rem !important; }
    .cic-new-price { font-size:1.6rem; }
    .admit_course_start_and_deadline { flex-direction:column; gap:8px; }
    .admit_course_line { display:none; }
    .admit_course_start { padding-right:0; }
    .admit_course_deadline { padding-left:0; }
    .course_hotline_number { font-size:0.85rem; }
    .d-flex.justify-content-between.align-items-center.gap-2 { flex-wrap:wrap; }
}

/* ===== Teachers Section ===== */
.teacher_list .trainer-card-mini {
    background:#fff; border-radius:14px; padding:16px; display:flex; gap:14px; align-items:center;
    box-shadow:0 2px 12px rgba(0,33,71,0.06); border:1px solid #eef2f8; margin-bottom:12px;
    transition:all 0.3s;
}
.teacher_list .trainer-card-mini:hover { transform:translateY(-3px); box-shadow:0 8px 28px rgba(0,33,71,0.1); }
.teacher_list .trainer-card-mini img { width:72px; height:72px; border-radius:50%; object-fit:cover; border:3px solid #fab005; flex-shrink:0; }
.teacher_list .trainer-card-mini .t-name { font-weight:700; color:#002147; }
.teacher_list .trainer-card-mini .t-desig { font-size:0.78rem; color:#fab005; font-weight:600; }
</style>
@endpush

@section('contents')

{{-- Course Hero Header --}}
<section class="cd-hero">
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="cd-hero-badge"><i class="fa-solid fa-graduation-cap me-1"></i> TechPark English Course</span>
                <h1>{{ $data->title }}</h1>
                <div class="cd-hero-meta">
                    <span><i class="fa-solid fa-layer-group"></i> {{ $data->type ?? 'English Course' }}</span>
                    <span><i class="fa-solid fa-clock"></i> {{ $data->duration ?? '2 Months' }}</span>
                    <span><i class="fa-solid fa-users"></i> সীমিত আসন</span>
                    <span><i class="fa-solid fa-certificate"></i> সার্টিফিকেট প্রদান</span>
                </div>
            </div>
        </div>
    </div>
</section>
    <section class="course_details_area" id="course_details">
        <div class="container">
            <div class="course_details_part">
                <div class="course_details">

                    {{-- Course overview card --}}
                    <div class="cd-section-card">
                        <span class="cd-section-label"><i class="fa-solid fa-circle-info me-1"></i> কোর্স পরিচিতি</span>
                        @include('frontend.pages.courses.includes.index')
                    </div>

                    {{-- Structured section --}}
                    <div class="cd-section-card">
                        <span class="cd-section-label"><i class="fa-solid fa-sitemap me-1"></i> কোর্স স্ট্রাকচার</span>
                        @include('frontend.pages.courses.includes.course_how_is_structured')
                    </div>

                    {{-- Features accordion --}}
                    @include('frontend.pages.courses.includes.features')

                    {{-- Module --}}
                    <div class="cd-section-card" style="padding:24px;">
                        <span class="cd-section-label"><i class="fa-solid fa-list-check me-1"></i> কোর্স কারিকুলাম</span>
                        @include('frontend.pages.courses.includes.course_module')
                    </div>

                    {{-- Teachers --}}
                    <div class="cd-section-card">
                        <span class="cd-section-label"><i class="fa-solid fa-chalkboard-user me-1"></i> কোর্স ইন্সট্রাক্টর</span>
                        @include('frontend.pages.courses.includes.teachers')
                    </div>

                </div>

                @include('frontend.pages.courses.includes.course_details_card')

            </div>
        </div>
    </section>

    @include('frontend.pages.courses.includes.course_faq')

@endsection
