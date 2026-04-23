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

/* ===== Right Sidebar — Course Info Card ===== */
.course_info { }
.course_info_div {
    background:#fff; border-radius:18px; overflow:hidden;
    box-shadow:0 8px 40px rgba(0,33,71,0.12); border:1px solid #eef2f8;
    position:sticky; top:80px;
}
.course_info_thubnail { position:relative; }
.course_main_img { width:100%; height:220px !important; object-fit:cover; display:block; }
.course_info_icon {
    position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
    width:60px; height:60px; background:rgba(250,176,5,0.95); border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    box-shadow:0 0 0 8px rgba(250,176,5,0.25); transition:transform 0.3s;
}
.course_info_icon:hover { transform:translate(-50%,-50%) scale(1.1); }
.course_info_icon img { width:28px; height:28px; object-fit:contain; filter:brightness(0) invert(1); }
.course_info_thubnail_and_icon { position:relative; }

.course_info_time { padding:16px 20px; background:linear-gradient(135deg,#002147,#003b7a); }
.time_have { text-align:center; }
.time_have_title { color:rgba(255,255,255,0.75); font-size:0.72rem; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; }
ul.timer { display:flex; justify-content:center; align-items:center; gap:8px; list-style:none; padding:0; margin:0; }
ul.timer li { text-align:center; color:#fff; font-size:0.7rem; }
ul.timer li .amount { font-size:1.5rem; font-weight:800; color:#fab005; line-height:1; }
.course_booked { text-align:center; margin-top:10px; color:rgba(255,255,255,0.85); font-size:0.8rem; font-weight:700; }

.course_fee { padding:16px 20px; display:flex; align-items:baseline; gap:10px; justify-content:center; border-bottom:1px solid #eef2f8; }
.course_fee .twenty_thousand { font-size:1rem; color:#aaa; text-decoration:line-through; }
.course_fee .ten_thousand { font-size:1.8rem; font-weight:800; color:#002147; }

.admit_course { padding:16px 20px; }
.admit_course_title_and_icon {
    display:flex; align-items:center; justify-content:center; gap:10px;
    background:linear-gradient(135deg,#002147,#003b7a); color:#fff !important;
    padding:13px 20px; border-radius:50px; text-decoration:none; font-weight:700;
    font-size:0.9rem; transition:all 0.3s; text-align:center; flex-grow:1;
}
.admit_course_title_and_icon:hover { background:linear-gradient(135deg,#fab005,#e09600); box-shadow:0 6px 20px rgba(250,176,5,0.35); }
.admit_course_title { color:#fff; }
.admit_course_icon { color:#fff; }

.admit_course_batch { background:#f8fbff; border-radius:10px; padding:12px 14px; margin-top:12px; }
.admit_course_batch_title { font-size:0.8rem; color:#555; margin-bottom:8px; }
.admit_course_batch_title span { font-weight:700; color:#002147; }
.admit_course_start_and_deadline { display:flex; gap:8px; }
.admit_course_start, .admit_course_deadline { flex:1; }
.admit_course_start_title, .admit_course_deadline_title { font-size:0.68rem; color:#888; display:flex; align-items:center; gap:4px; margin-bottom:3px; }
.admit_course_start_date, .admit_course_deadline_date { font-size:0.75rem; font-weight:700; color:#002147; }
.admit_course_line { width:1px; background:#e2e8f0; }
.admit_course_batch_details { background:#f8fbff; border-radius:10px; padding:12px 14px; margin-top:8px; }
.admit_course_orientation, .admit_course_class_date, .admit_course_class_time { font-size:0.78rem; color:#555; margin-bottom:6px; display:flex; align-items:flex-start; gap:6px; }
.admit_course_orientation i, .admit_course_class_date i, .admit_course_class_time i { color:#fab005; margin-top:2px; flex-shrink:0; }

/* Requirements section */
.course_needed { padding:0 20px 20px; }
.course_needed_title { font-weight:700; color:#002147; font-size:0.88rem; margin-bottom:10px; padding-bottom:6px; border-bottom:1px solid #eef2f8; }
.course_needed_internet { display:flex; align-items:center; gap:8px; font-size:0.8rem; color:#555; margin-bottom:6px; }
.course_needed_internet i { color:#fab005; }
.course_hotline { background:linear-gradient(135deg,#002147,#003b7a) !important; border-radius:12px; text-align:center; }
.course_hotline_title { color:rgba(255,255,255,0.85); font-size:0.78rem; margin-bottom:8px; }
.course_hotline_number { color:#fab005 !important; font-weight:700; font-size:0.95rem; text-decoration:none; }
.course_schedule { background:rgba(250,176,5,0.1); color:#c07800; font-size:0.75rem; font-weight:600; padding:6px 14px; border-radius:50px; text-align:center; margin-top:8px; }

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
