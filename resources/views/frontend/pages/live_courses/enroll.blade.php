@php
    $meta = [
        'seo' => [
            'title' => 'ভর্তি ফর্ম — ' . $course->title,
            'image' => $course->thumbnail ? asset($course->thumbnail) : asset('seo.jpg'),
        ],
    ];
    $bkash_num  = setting('bkash_number') ?: (setting('phone_numbers') ?: setting('whatsapp'));
    $course_fee = $course->sale_price ?: $course->regular_price;
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
    /* ===== Hero ===== */
    .enroll-hero { background:linear-gradient(135deg,#001830 0%,#002147 100%); padding:36px 0 30px; }
    .enroll-hero h1 { font-size:1.8rem; font-weight:800; color:#fff; margin-bottom:4px; }
    .enroll-hero p  { color:rgba(255,255,255,0.55); font-size:0.85rem; }

    /* ===== Stepper ===== */
    .stepper { display:flex; align-items:center; justify-content:center; margin-bottom:36px; }
    .step { display:flex; flex-direction:column; align-items:center; gap:6px; }
    .step-icon { width:50px; height:50px; border-radius:50%; border:2px solid #d8e0ef; background:#fff; display:flex; align-items:center; justify-content:center; font-size:1.15rem; color:#b0b8cc; transition:all .3s; }
    .step.active .step-icon { border-color:#002147; background:#002147; color:#fab005; }
    .step.done   .step-icon { border-color:#059669; background:#059669; color:#fff; }
    .step-label { font-size:0.73rem; font-weight:600; color:#999; white-space:nowrap; }
    .step.active .step-label { color:#002147; font-weight:700; }
    .step.done   .step-label { color:#059669; }
    .step-line { width:90px; height:2px; background:#dde5ef; margin-bottom:22px; transition:background .4s; }
    .step-line.done { background:#059669; }

    /* ===== Card shell ===== */
    .enroll-card { background:#fff; border-radius:20px; box-shadow:0 6px 32px rgba(0,33,71,0.09); border:1px solid #eef2f8; overflow:hidden; }
    .enroll-section-head { padding:24px 36px 18px; border-bottom:1px solid #f0f4f8; }
    .enroll-section-head h3 { font-size:1.1rem; font-weight:800; color:#002147; margin:0 0 3px; }
    .enroll-section-head p  { font-size:0.78rem; color:#8a94a6; margin:0; }
    .enroll-body { padding:28px 36px; }
    .enroll-footer { padding:20px 36px; border-top:1px solid #f0f4f8; display:flex; justify-content:space-between; align-items:center; }

    /* ===== Course info card ===== */
    .course-info-card { border:1px solid #edf1f8; border-radius:14px; padding:18px 22px; background:#f8faff; margin-bottom:24px; display:flex; justify-content:space-between; align-items:flex-start; gap:14px; flex-wrap:wrap; }
    .cic-label { font-size:0.67rem; font-weight:700; color:#8a94a6; text-transform:uppercase; letter-spacing:.6px; margin-bottom:4px; }
    .cic-value { font-size:1rem; font-weight:800; color:#1a1a2e; line-height:1.4; }
    .cic-price { font-size:1.4rem; font-weight:800; color:#002147; }
    .cic-meta  { font-size:0.75rem; color:#555; background:#e4eaf5; border-radius:6px; padding:3px 10px; }

    /* ===== Batch cards ===== */
    .batch-card { border:2px solid #e8edf5; border-radius:14px; padding:18px 20px; margin-bottom:12px; transition:all .25s; cursor:pointer; background:#fff; display:flex; gap:14px; align-items:flex-start; }
    .batch-card:hover { border-color:#aab8d4; box-shadow:0 4px 16px rgba(0,33,71,0.08); }
    .batch-card.selected { border-color:#002147; background:linear-gradient(135deg,#f0f5ff,#eaf0fd); box-shadow:0 6px 24px rgba(0,33,71,0.11); }
    .batch-card input[type=radio] { display:none; }
    .batch-radio { width:20px; height:20px; border-radius:50%; border:2px solid #c8d4e8; flex-shrink:0; margin-top:3px; display:flex; align-items:center; justify-content:center; transition:all .2s; background:#fff; position:relative; }
    .batch-card.selected .batch-radio { border-color:#002147; background:#002147; }
    .batch-radio::after { content:''; width:8px; height:8px; border-radius:50%; background:#fff; opacity:0; transition:opacity .2s; position:absolute; }
    .batch-card.selected .batch-radio::after { opacity:1; }
    .batch-content { flex:1; min-width:0; }
    .batch-title { font-weight:800; color:#002147; font-size:1.05rem; margin-bottom:6px; display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
    .batch-shift { display:inline-block; background:rgba(250,176,5,0.14); color:#92600a; font-size:0.72rem; font-weight:700; padding:3px 12px; border-radius:20px; }
    .batch-meta { display:flex; flex-wrap:wrap; gap:8px 24px; font-size:0.82rem; color:#6b7280; margin-top:10px; }
    .batch-meta span { display:inline-flex; align-items:center; gap:6px; }
    .batch-meta span strong { color:#1a1a2e; font-weight:700; font-size:0.85rem; }
    .batch-meta i { color:#002147; font-size:0.75rem; }
    .batch-days { display:flex; align-items:center; gap:6px; font-size:0.82rem; color:#6b7280; margin-top:7px; }
    .batch-days strong { color:#1a1a2e; font-weight:700; font-size:0.85rem; }
    .batch-days i { color:#002147; font-size:0.75rem; }
    .batch-seats { font-size:0.72rem; font-weight:700; padding:4px 12px; border-radius:20px; white-space:nowrap; flex-shrink:0; display:inline-flex; align-items:center; gap:5px; margin-top:2px; }
    .seats-ok   { background:#dcfce7; color:#16a34a; }
    .seats-low  { background:#fef3c7; color:#d97706; }
    .seats-full { background:#fee2e2; color:#dc2626; }

    /* ===== Form inputs ===== */
    .form-label-custom { font-size:0.85rem; font-weight:700; color:#374151; margin-bottom:7px; display:block; }
    .form-label-custom span { color:#e91e63; }
    .form-control-custom { width:100%; border:1.5px solid #dce3ef; border-radius:10px; padding:13px 16px; font-size:0.9rem; color:#1a1a2e; transition:border-color .2s; outline:none; background:#fff; font-family:inherit; }
    .form-control-custom:focus { border-color:#002147; box-shadow:0 0 0 3px rgba(0,33,71,0.08); }
    .form-control-custom::placeholder { color:#b4bcc8; }

    /* Gender */
    .gender-group { display:flex; gap:10px; flex-wrap:wrap; }
    .gender-opt { display:flex; align-items:center; gap:7px; border:1.5px solid #dce3ef; border-radius:10px; padding:10px 20px; cursor:pointer; transition:all .2s; font-size:0.88rem; color:#374151; font-weight:600; }
    .gender-opt:hover { border-color:#aab8d4; }
    .gender-opt input { display:none; }
    .gender-opt.selected { border-color:#002147; background:#f0f5ff; color:#002147; }

    /* Divider label */
    .divider-label { font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.8px; color:#fab005; background:rgba(250,176,5,0.1); border:1px solid rgba(250,176,5,0.2); border-radius:50px; padding:4px 16px; display:inline-block; margin-bottom:16px; }

    /* ===== Step 2: Order summary ===== */
    .order-card { border:1px solid #e4eaf5; border-radius:14px; overflow:hidden; margin-bottom:24px; }
    .order-card-head { background:#f0f5ff; padding:13px 20px; font-size:0.84rem; font-weight:800; color:#002147; border-bottom:1px solid #dce8f8; display:flex; align-items:center; gap:8px; }
    .order-row { display:flex; justify-content:space-between; align-items:center; padding:12px 20px; border-bottom:1px solid #f5f7fc; font-size:0.86rem; }
    .order-row:last-child { border-bottom:none; }
    .order-row-label { color:#6b7280; font-weight:500; }
    .order-row-value { color:#1a1a2e; font-weight:700; text-align:right; max-width:60%; }
    .order-row.total-row { background:#f0f5ff; }
    .order-row.total-row .order-row-label { font-weight:800; color:#002147; }
    .order-row.total-row .order-row-value { font-size:1.2rem; font-weight:800; color:#002147; }

    /* ===== Payment type tabs ===== */
    .pay-type-tabs { display:flex; gap:0; border:2px solid #e4eaf5; border-radius:12px; overflow:hidden; margin-bottom:24px; }
    .pay-tab { flex:1; padding:14px 20px; font-size:0.9rem; font-weight:700; border:none; cursor:pointer; transition:all .2s; background:#fff; color:#6b7280; display:flex; align-items:center; justify-content:center; gap:8px; }
    .pay-tab:first-child { border-right:2px solid #e4eaf5; }
    .pay-tab.active { background:#002147; color:#fff; }
    .pay-tab.active .pay-tab-badge { background:rgba(255,255,255,0.2); }
    .pay-tab-badge { font-size:0.65rem; padding:2px 8px; border-radius:20px; background:#e4eaf5; font-weight:700; }

    /* bKash payment panel */
    .pm-card { border:2px solid #25d366; border-radius:14px; padding:16px 20px; display:flex; align-items:center; gap:16px; background:#f0fff8; margin-bottom:22px; }
    .pm-icon { width:46px; height:46px; border-radius:10px; background:#E2136E; display:flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:0 2px 10px rgba(226,19,110,0.3); }
    .pm-icon span { color:#fff; font-weight:900; font-size:0.72rem; letter-spacing:-.5px; }
    .pm-name   { font-weight:800; color:#1a1a2e; font-size:0.95rem; }
    .pm-number { font-size:0.88rem; color:#059669; font-weight:700; margin-top:2px; }
    .pm-check  { margin-left:auto; width:26px; height:26px; border-radius:50%; background:#25d366; display:flex; align-items:center; justify-content:center; color:#fff; font-size:0.85rem; flex-shrink:0; }

    /* Instructions */
    .pay-instructions { background:#fffbeb; border:1px solid #fde68a; border-radius:12px; padding:18px 22px; margin-bottom:22px; }
    .pay-instructions h5 { font-size:0.88rem; font-weight:800; color:#92600a; margin-bottom:12px; display:flex; align-items:center; gap:7px; }
    .pay-instructions ol { margin:0; padding-left:20px; }
    .pay-instructions li { font-size:0.84rem; color:#78350f; line-height:1.75; margin-bottom:2px; }
    .pay-instructions li strong { color:#92600a; }

    /* Online SSL panel */
    .ssl-info-card { border:2px solid #002147; border-radius:14px; padding:22px 24px; background:linear-gradient(135deg,#f0f5ff,#eaf0fd); margin-bottom:22px; text-align:center; }
    .ssl-info-card .ssl-ico { font-size:2.5rem; color:#002147; margin-bottom:12px; }
    .ssl-info-card h5 { font-weight:800; color:#002147; font-size:1rem; margin-bottom:6px; }
    .ssl-info-card p { font-size:0.84rem; color:#555; margin-bottom:14px; }
    .ssl-logos { display:flex; align-items:center; justify-content:center; gap:10px; flex-wrap:wrap; opacity:0.65; }
    .ssl-logos span { font-size:0.72rem; font-weight:700; color:#555; background:#fff; border:1px solid #dde5ef; border-radius:6px; padding:4px 10px; }

    /* Or divider + upload */
    .or-divider { text-align:center; position:relative; margin:20px 0; }
    .or-divider::before { content:''; position:absolute; left:0; top:50%; width:100%; height:1px; background:#e4eaf5; }
    .or-divider span { background:#fff; position:relative; padding:0 16px; font-size:0.8rem; color:#8a94a6; font-weight:700; }
    .upload-area { border:2px dashed #c8d4e8; border-radius:12px; padding:28px 20px; text-align:center; cursor:pointer; transition:all .2s; background:#f8faff; }
    .upload-area:hover { border-color:#002147; background:#f0f5ff; }
    .upload-area input[type=file] { display:none; }
    .upload-area .up-ico { font-size:2.2rem; color:#b0bec8; margin-bottom:10px; display:block; transition:color .2s; }
    .upload-area p { font-size:0.84rem; color:#8a94a6; margin:0; }
    .upload-area .up-hint { font-size:0.72rem; color:#b4bcc8; margin-top:5px; }
    .upload-area.has-file { border-color:#059669; background:#f0fff8; }
    .upload-area.has-file .up-ico { color:#059669; }

    /* Image preview */
    .img-preview-wrap { position:relative; margin-top:14px; display:none; border-radius:12px; overflow:hidden; border:2px solid #059669; box-shadow:0 4px 16px rgba(5,150,105,0.15); }
    .img-preview-wrap img { width:100%; max-height:260px; object-fit:contain; background:#f0fff8; display:block; }
    .img-preview-badge { position:absolute; top:10px; left:10px; background:#059669; color:#fff; font-size:0.72rem; font-weight:700; padding:4px 12px; border-radius:20px; display:flex; align-items:center; gap:5px; }
    .img-preview-remove { position:absolute; top:10px; right:10px; background:rgba(220,38,38,0.9); color:#fff; border:none; border-radius:50%; width:28px; height:28px; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:0.9rem; transition:background .2s; }
    .img-preview-remove:hover { background:#dc2626; }

    /* ===== Footer buttons ===== */
    .btn-back-enroll { color:#6b7280; font-size:0.9rem; font-weight:700; display:inline-flex; align-items:center; gap:6px; transition:color .2s; background:none; border:none; cursor:pointer; padding:0; text-decoration:none; }
    .btn-back-enroll:hover { color:#002147; }
    .btn-next-enroll { background:linear-gradient(135deg,#fab005,#e09600); color:#fff; border:none; border-radius:10px; padding:14px 40px; font-weight:800; font-size:0.95rem; cursor:pointer; transition:all .3s; box-shadow:0 5px 18px rgba(250,176,5,0.4); display:inline-flex; align-items:center; gap:8px; }
    .btn-next-enroll:hover { background:linear-gradient(135deg,#e09600,#c07800); transform:translateY(-1px); }
    .btn-confirm-enroll { background:linear-gradient(135deg,#059669,#047857); color:#fff; border:none; border-radius:10px; padding:14px 40px; font-weight:800; font-size:0.95rem; cursor:pointer; transition:all .3s; box-shadow:0 5px 18px rgba(5,150,105,0.35); display:inline-flex; align-items:center; gap:8px; }
    .btn-confirm-enroll:hover { background:linear-gradient(135deg,#047857,#065f46); transform:translateY(-1px); }
    .btn-ssl-pay { background:linear-gradient(135deg,#002147,#003b7a); color:#fff; border:none; border-radius:10px; padding:14px 40px; font-weight:800; font-size:0.95rem; cursor:pointer; transition:all .3s; box-shadow:0 5px 18px rgba(0,33,71,0.35); display:inline-flex; align-items:center; gap:8px; }
    .btn-ssl-pay:hover { background:linear-gradient(135deg,#003b7a,#005094); transform:translateY(-1px); }

    /* Error alert */
    .enroll-alert { background:#fee2e2; border:1px solid #fca5a5; color:#dc2626; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:0.86rem; font-weight:600; display:flex; align-items:center; gap:8px; }

    @@media(max-width:576px) {
        .enroll-section-head, .enroll-body, .enroll-footer { padding-left:18px; padding-right:18px; }
        .step-line { width:48px; }
        .pay-tab { font-size:0.8rem; padding:12px 10px; }
    }
</style>
@endpush

@section('contents')

{{-- Hero --}}
<section class="enroll-hero">
    <div class="container text-center">
        <h1>ভর্তি ফর্ম</h1>
        <p>Enrollment Form — {{ $course->title }}</p>
    </div>
</section>

{{-- Main --}}
<section style="background:#f2f5fb; padding:44px 0 70px;">
    <div class="container">

        {{-- Stepper --}}
        <div class="stepper" id="stepperEl">
            <div class="step active" id="stp1">
                <div class="step-icon"><i class="fa-solid fa-file-pen"></i></div>
                <div class="step-label">ভর্তি ফর্ম</div>
            </div>
            <div class="step-line" id="sl1"></div>
            <div class="step" id="stp2">
                <div class="step-icon"><i class="fa-solid fa-credit-card"></i></div>
                <div class="step-label">পেমেন্ট</div>
            </div>
            <div class="step-line" id="sl2"></div>
            <div class="step" id="stp3">
                <div class="step-icon"><i class="fa-solid fa-circle-check"></i></div>
                <div class="step-label">সম্পন্ন</div>
            </div>
        </div>

        @if(session('error'))
        <div class="enroll-alert mb-3">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
        @endif

        {{-- Real form — wraps both steps ——————————————————————————————————— --}}
        <form action="{{ route('live_course_enroll_submit', $course->slug) }}" method="POST" enctype="multipart/form-data" id="enrollForm" onsubmit="return false;">
            @csrf

            {{-- Hidden fields populated by JS from step 1 inputs --}}
            <input type="hidden" name="batch_id"     id="h_batch_id">
            <input type="hidden" name="name"         id="h_name">
            <input type="hidden" name="phone"        id="h_phone">
            <input type="hidden" name="address"      id="h_address">
            <input type="hidden" name="gender"       id="h_gender" value="পুরুষ">
            <input type="hidden" name="payment_type" id="h_payment_type" value="offline">
            <input type="hidden" name="transaction_id" id="h_transaction_id">

            {{-- ═══════ STEP 1: Student & Batch ═══════ --}}
            <div id="stepContent1" class="enroll-card">

                <div class="enroll-section-head">
                    <h3>কোর্স ও ব্যাচ তথ্য</h3>
                    <p>Course & Batch Information</p>
                </div>
                <div class="enroll-body">

                    {{-- Course card --}}
                    <div class="course-info-card">
                        <div style="flex:1; min-width:0;">
                            <div class="cic-label">নির্বাচিত কোর্স</div>
                            <div class="cic-value">{{ $course->title }}</div>
                            <div class="d-flex gap-2 mt-2 flex-wrap">
                                @if($course->live_course_type)
                                <span class="cic-meta">{{ $course->live_course_type }}</span>
                                @endif
                                @if($course->course_duration)
                                <span class="cic-meta">{{ $course->course_duration }}</span>
                                @endif
                            </div>
                        </div>
                        @if($course_fee)
                        <div class="text-end flex-shrink-0">
                            <div class="cic-label">কোর্স ফি</div>
                            <div class="cic-price">৳{{ number_format($course_fee) }}</div>
                        </div>
                        @endif
                    </div>

                    {{-- Batch selection --}}
                    <div class="divider-label">ব্যাচ নির্বাচন করুন *</div>

                    @foreach($batches as $batch)
                    @php
                        $days_label = is_array($batch->class_days) ? implode(', ', $batch->class_days) : $batch->class_days;
                        $seats      = $batch->seats_remaining ?? null;
                        $s_class    = $seats === null ? '' : ($seats > 10 ? 'seats-ok' : ($seats > 0 ? 'seats-low' : 'seats-full'));
                        $s_label    = $seats === null ? '' : ($seats > 0 ? $seats.' সিট বাকি' : 'পূর্ণ');
                        $b_start    = $batch->course_start_date ? \Carbon\Carbon::parse($batch->course_start_date)->format('d F, Y') : '';
                        $b_time     = ($batch->class_start_time && $batch->class_end_time)
                                        ? \Carbon\Carbon::parse($batch->class_start_time)->format('g:i A').' - '.\Carbon\Carbon::parse($batch->class_end_time)->format('g:i A')
                                        : '';
                    @endphp
                    <div class="batch-card {{ $loop->first ? 'selected' : '' }}"
                         onclick="selectBatch(this)"
                         data-batch-id="{{ $batch->id }}"
                         data-batch-number="{{ $batch->batch_number }}"
                         data-shift="{{ $batch->shift_name }}"
                         data-start-date="{{ $b_start }}"
                         data-time="{{ $b_time }}"
                         data-days="{{ $days_label }}">
                        <div class="batch-radio"></div>
                        <div class="batch-content">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div class="batch-title">
                                    ব্যাচঃ {{ $batch->batch_number }}
                                    @if($batch->shift_name)
                                    <span class="batch-shift">{{ $batch->shift_name }}</span>
                                    @endif
                                </div>
                                @if($seats !== null)
                                <span class="batch-seats {{ $s_class }}">
                                    <i class="fa-solid fa-users" style="font-size:.65rem;"></i> {{ $s_label }}
                                </span>
                                @endif
                            </div>
                            <div class="batch-meta">
                                @if($b_start)
                                <span><i class="fa-solid fa-calendar-days"></i> ক্লাসের শুরু : <strong>{{ $b_start }}</strong></span>
                                @endif
                                @if($b_time)
                                <span><i class="fa-regular fa-clock"></i> ক্লাসের সময়ঃ <strong>{{ $b_time }}</strong></span>
                                @endif
                            </div>
                            @if($days_label)
                            <div class="batch-days">
                                <i class="fa-solid fa-repeat"></i> ক্লাসের দিন: <strong>{{ $days_label }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach

                </div>

                {{-- Student info --}}
                <div class="enroll-section-head">
                    <h3>শিক্ষার্থীর তথ্য</h3>
                </div>
                <div class="enroll-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">শিক্ষার্থীর নাম <span>*</span></label>
                            <input type="text" id="f_name" class="form-control-custom" placeholder="পুরো নাম লিখুন">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">মোবাইল নম্বর <span>*</span></label>
                            <input type="tel" id="f_phone" class="form-control-custom" placeholder="01XXX-XXXXXXX">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">ঠিকানা <span>*</span></label>
                            <input type="text" id="f_address" class="form-control-custom" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">লিঙ্গ <span>*</span></label>
                            <div class="gender-group">
                                <label class="gender-opt selected" onclick="selectGender(this)">
                                    <input type="radio" name="gender_vis" value="পুরুষ" checked> পুরুষ
                                </label>
                                <label class="gender-opt" onclick="selectGender(this)">
                                    <input type="radio" name="gender_vis" value="মহিলা"> মহিলা
                                </label>
                                <label class="gender-opt" onclick="selectGender(this)">
                                    <input type="radio" name="gender_vis" value="অন্যান্য"> অন্যান্য
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="enroll-footer">
                    <a href="{{ route('live_course_details', $course->slug) }}" class="btn-back-enroll">
                        <i class="fa-solid fa-arrow-left"></i> বাতিল
                    </a>
                    <button type="button" class="btn-next-enroll" onclick="goToStep2()">
                        পরবর্তী <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>

            </div>{{-- /step1 --}}

            {{-- ═══════ STEP 2: Payment ═══════ --}}
            <div id="stepContent2" class="enroll-card" style="display:none;">

                <div class="enroll-section-head">
                    <h3>পেমেন্ট তথ্য</h3>
                    <p>Payment Information</p>
                </div>
                <div class="enroll-body">

                    {{-- Order summary --}}
                    <div class="order-card">
                        <div class="order-card-head">
                            <i class="fa-solid fa-receipt"></i> অর্ডার সারাংশ
                        </div>
                        <div class="order-row">
                            <span class="order-row-label">কোর্স:</span>
                            <span class="order-row-value">{{ $course->title }}</span>
                        </div>
                        <div class="order-row">
                            <span class="order-row-label">ব্যাচ:</span>
                            <span class="order-row-value" id="ord_batch">—</span>
                        </div>
                        <div class="order-row">
                            <span class="order-row-label">নাম:</span>
                            <span class="order-row-value" id="ord_name">—</span>
                        </div>
                        <div class="order-row">
                            <span class="order-row-label">শুরুর তারিখ:</span>
                            <span class="order-row-value" id="ord_date">—</span>
                        </div>
                        @if($course_fee)
                        <div class="order-row total-row">
                            <span class="order-row-label">কোর্স ফি:</span>
                            <span class="order-row-value">৳{{ number_format($course_fee) }}</span>
                        </div>
                        @endif
                    </div>

                    {{-- Payment type tabs --}}
                    <div class="divider-label">পেমেন্ট পদ্ধতি নির্বাচন করুন *</div>
                    <div class="pay-type-tabs">
                        <button type="button" class="pay-tab active" id="tab_offline" onclick="selectPayType('offline')">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                            অফলাইন পেমেন্ট
                            <span class="pay-tab-badge">bKash</span>
                        </button>
                        <button type="button" class="pay-tab" id="tab_online" onclick="selectPayType('online')">
                            <i class="fa-solid fa-lock"></i>
                            অনলাইন পেমেন্ট
                            <span class="pay-tab-badge">SSLCommerz</span>
                        </button>
                    </div>

                    {{-- ── Offline Panel ── --}}
                    <div id="panel_offline">
                        <div class="pm-card">
                            <div class="pm-icon"><span>bKash</span></div>
                            <div>
                                <div class="pm-name">Bkash payment number</div>
                                <div class="pm-number">{{ $bkash_num }}</div>
                            </div>
                            <div class="pm-check"><i class="fa-solid fa-check"></i></div>
                        </div>

                        <div class="pay-instructions">
                            <h5><i class="fa-solid fa-circle-info"></i> পেমেন্ট নির্দেশনা:</h5>
                            <ol>
                                <li>নম্বর: <strong>{{ $bkash_num }}</strong></li>
                                <li>আকাউন্ট নাম: <strong>{{ setting('site_name') ?: 'TechPark English' }}</strong></li>
                                <li>পরিমান: <strong>৳{{ $course_fee ? number_format($course_fee) : '—' }}</strong></li>
                                <li>পেমেন্ট করার পর ট্রানজেকশন আইডি বা স্ক্রিনশট দিন</li>
                            </ol>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">ট্রানজেকশন আইডি</label>
                            <input type="text" id="f_txn" class="form-control-custom" placeholder="যেমন: TXN23456789">
                        </div>

                        <div class="or-divider"><span>অথবা</span></div>

                        <div class="mb-1">
                            <label class="form-label-custom">পেমেন্ট স্ক্রিনশট আপলোড করুন</label>
                            <div class="upload-area" id="uploadArea" onclick="document.getElementById('f_screenshot').click()">
                                <input type="file" id="f_screenshot" name="payment_photo" accept="image/*" onchange="previewUpload(this)">
                                <i class="fa-solid fa-cloud-arrow-up up-ico" id="upload_icon"></i>
                                <p id="upload_text">ক্লিক করুন বা ড্রাগ করে ছবি আপলোড করুন</p>
                                <p class="up-hint">PNG, JPG, JPEG (সর্বোচ্চ ২ MB)</p>
                            </div>
                            {{-- Image preview --}}
                            <div class="img-preview-wrap" id="imgPreviewWrap">
                                <div class="img-preview-badge"><i class="fa-solid fa-check"></i> স্ক্রিনশট সংযুক্ত</div>
                                <button type="button" class="img-preview-remove" onclick="removeUpload(event)" title="সরিয়ে দিন">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <img id="imgPreview" src="" alt="Payment Screenshot">
                            </div>
                        </div>
                        <p style="font-size:.75rem; color:#e03438; margin-top:10px; margin-bottom:0;">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            ট্রানজেকশন আইডি অথবা স্ক্রিনশট যেকোনো একটি দিতে হবে
                        </p>
                    </div>

                    {{-- ── Online Panel ── --}}
                    <div id="panel_online" style="display:none;">
                        <div class="ssl-info-card">
                            <div class="ssl-ico"><i class="fa-solid fa-shield-halved"></i></div>
                            <h5>নিরাপদ অনলাইন পেমেন্ট</h5>
                            <p>SSLCommerz গেটওয়ের মাধ্যমে নিরাপদে পেমেন্ট করুন।<br>
                               ক্রেডিট/ডেবিট কার্ড, মোবাইল ব্যাংকিং সব পদ্ধতিতে পেমেন্ট করা যাবে।</p>
                            <div class="ssl-logos">
                                <span>Visa</span>
                                <span>Mastercard</span>
                                <span>bKash</span>
                                <span>Nagad</span>
                                <span>Rocket</span>
                                <span>Dutch-Bangla</span>
                            </div>
                        </div>
                        <div style="background:#f0f5ff; border-radius:10px; padding:14px 18px; font-size:0.84rem; color:#374151; line-height:1.7;">
                            <i class="fa-solid fa-circle-info" style="color:#002147;"></i>
                            "অনলাইনে পেমেন্ট করুন" বাটনে ক্লিক করলে আপনাকে SSLCommerz পেমেন্ট গেটওয়েতে নিয়ে যাওয়া হবে।
                            পেমেন্ট সম্পন্ন হলে স্বয়ংক্রিয়ভাবে আবেদন নিশ্চিত হয়ে যাবে।
                        </div>
                    </div>

                </div>

                <div class="enroll-footer">
                    <button type="button" class="btn-back-enroll" onclick="goToStep(1)">
                        <i class="fa-solid fa-arrow-left"></i> পেছনে
                    </button>
                    {{-- Offline confirm button --}}
                    <button type="button" class="btn-confirm-enroll" id="btn_offline_confirm" onclick="submitOffline()">
                        ভর্তি নিশ্চিত করুন <i class="fa-solid fa-check-circle"></i>
                    </button>
                    {{-- Online pay button (hidden by default) --}}
                    <button type="button" class="btn-ssl-pay" id="btn_online_pay" style="display:none;" onclick="submitOnline()">
                        <i class="fa-solid fa-lock"></i> অনলাইনে পেমেন্ট করুন
                    </button>
                </div>

            </div>{{-- /step2 --}}

        </form>{{-- /enrollForm --}}

    </div>
</section>

@endsection

@push('scripts')
<script>
var currentPayType = 'offline';

/* ── batch selection ── */
function selectBatch(el) {
    document.querySelectorAll('.batch-card').forEach(function(c) { c.classList.remove('selected'); });
    el.classList.add('selected');
}

/* ── gender ── */
function selectGender(el) {
    document.querySelectorAll('.gender-opt').forEach(function(o) {
        o.classList.remove('selected');
        o.querySelector('input[type=radio]').checked = false;
    });
    el.classList.add('selected');
    el.querySelector('input[type=radio]').checked = true;
    document.getElementById('h_gender').value = el.querySelector('input[type=radio]').value;
}

/* ── payment type tabs ── */
function selectPayType(type) {
    currentPayType = type;
    document.getElementById('h_payment_type').value = type;

    document.getElementById('tab_offline').classList.toggle('active', type === 'offline');
    document.getElementById('tab_online').classList.toggle('active', type === 'online');
    document.getElementById('panel_offline').style.display = type === 'offline' ? 'block' : 'none';
    document.getElementById('panel_online').style.display  = type === 'online'  ? 'block' : 'none';
    document.getElementById('btn_offline_confirm').style.display = type === 'offline' ? 'inline-flex' : 'none';
    document.getElementById('btn_online_pay').style.display      = type === 'online'  ? 'inline-flex' : 'none';
}

/* ── step 1 → 2 ── */
function goToStep2() {
    var name    = document.getElementById('f_name').value.trim();
    var phone   = document.getElementById('f_phone').value.trim();
    var address = document.getElementById('f_address').value.trim();

    if (!name)    { alert('অনুগ্রহ করে আপনার নাম লিখুন।');       document.getElementById('f_name').focus();    return; }
    if (!phone)   { alert('অনুগ্রহ করে মোবাইল নম্বর লিখুন।');   document.getElementById('f_phone').focus();   return; }
    if (!address) { alert('অনুগ্রহ করে ঠিকানা লিখুন।');          document.getElementById('f_address').focus(); return; }

    var sel = document.querySelector('.batch-card.selected');
    if (!sel) { alert('অনুগ্রহ করে একটি ব্যাচ নির্বাচন করুন।'); return; }

    /* populate hidden fields */
    document.getElementById('h_batch_id').value = sel.dataset.batchId;
    document.getElementById('h_name').value     = name;
    document.getElementById('h_phone').value    = phone;
    document.getElementById('h_address').value  = address;
    document.getElementById('h_gender').value   = document.querySelector('[name=gender_vis]:checked').value;

    /* populate order summary */
    var batchLabel = 'ব্যাচঃ ' + sel.dataset.batchNumber + (sel.dataset.shift ? ' (' + sel.dataset.shift + ')' : '');
    document.getElementById('ord_batch').textContent = batchLabel;
    document.getElementById('ord_name').textContent  = name;
    document.getElementById('ord_date').textContent  = sel.dataset.startDate || '—';

    goToStep(2);
}

/* ── offline submit ── */
function submitOffline() {
    var txn  = document.getElementById('f_txn').value.trim();
    var file = document.getElementById('f_screenshot').files[0];
    if (!txn && !file) {
        alert('অনুগ্রহ করে ট্রানজেকশন আইডি অথবা পেমেন্ট স্ক্রিনশট প্রদান করুন।');
        return;
    }
    document.getElementById('h_transaction_id').value = txn;
    document.getElementById('h_payment_type').value   = 'offline';
    submitForm();
}

/* ── online submit ── */
function submitOnline() {
    document.getElementById('h_payment_type').value = 'online';
    submitForm();
}

/* ── actual form submit ── */
function submitForm() {
    var form = document.getElementById('enrollForm');
    form.onsubmit = null;
    form.submit();
}

/* ── step navigator ── */
function goToStep(n) {
    for (var i = 1; i <= 2; i++) {
        var el = document.getElementById('stepContent' + i);
        if (el) el.style.display = (i === n) ? 'block' : 'none';
    }
    updateStepper(n);
    var card = document.getElementById('stepContent' + n);
    if (card) window.scrollTo({ top: card.getBoundingClientRect().top + window.pageYOffset - 20, behavior: 'smooth' });
}

function updateStepper(n) {
    for (var i = 1; i <= 3; i++) {
        var s = document.getElementById('stp' + i);
        if (!s) continue;
        s.classList.remove('active', 'done');
        if (i < n)       s.classList.add('done');
        else if (i === n) s.classList.add('active');
    }
    for (var j = 1; j <= 2; j++) {
        var l = document.getElementById('sl' + j);
        if (l) l.classList.toggle('done', j < n);
    }
}

/* ── screenshot preview ── */
function previewUpload(input) {
    if (!input.files || !input.files[0]) return;
    var file = input.files[0];

    if (file.size > 2 * 1024 * 1024) {
        alert('ফাইলের সাইজ ২ MB-এর বেশি হতে পারবে না।');
        input.value = '';
        return;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('imgPreview').src        = e.target.result;
        document.getElementById('imgPreviewWrap').style.display = 'block';
        document.getElementById('upload_text').textContent      = file.name;
        document.getElementById('upload_icon').className        = 'fa-solid fa-file-image up-ico';
        document.getElementById('uploadArea').classList.add('has-file');
    };
    reader.readAsDataURL(file);
}

function removeUpload(e) {
    e.stopPropagation();
    var input = document.getElementById('f_screenshot');
    input.value = '';
    document.getElementById('imgPreviewWrap').style.display = 'none';
    document.getElementById('imgPreview').src               = '';
    document.getElementById('upload_text').textContent      = 'ক্লিক করুন বা ড্রাগ করে ছবি আপলোড করুন';
    document.getElementById('upload_icon').className        = 'fa-solid fa-cloud-arrow-up up-ico';
    document.getElementById('uploadArea').classList.remove('has-file');
}

/* init first batch selected */
(function() {
    var first = document.querySelector('.batch-card');
    if (first) first.classList.add('selected');
    updateStepper(1);
})();
</script>
@endpush
