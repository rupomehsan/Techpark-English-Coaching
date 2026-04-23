@php
    $meta = [
        'seo' => [
            'title' => "$course->title - ভর্তি ফর্ম",
            'image' => asset($course->image),
        ],
    ];
    $cc = new App\Http\Controllers\Course\CourseController();
    $bdata = $cc->course_batch_details($course->id);
    $enroll_batch = $bdata['batch'] ?? null;
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ===== Enrollment Hero ===== */
.enroll-hero {
    background: linear-gradient(135deg, #001830 0%, #002147 60%, #003b7a 100%);
    padding: 44px 0 38px; text-align: center; position: relative; overflow: hidden;
}
.enroll-hero::before { content:''; position:absolute; top:-60px; right:-40px; width:280px; height:280px; background:rgba(250,176,5,0.06); border-radius:50%; }
.enroll-hero h1 { font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 4px; position:relative; z-index:1; }
.enroll-hero p  { color: rgba(255,255,255,0.65); font-size: 0.88rem; letter-spacing: 1px; text-transform: uppercase; position:relative; z-index:1; }

/* ===== Step Indicator ===== */
.enroll-steps-wrap { background: #fff; border-bottom: 1px solid #eef2f8; padding: 20px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
.enroll-steps { display: flex; align-items: center; justify-content: center; gap: 0; max-width: 500px; margin: 0 auto; }
.enroll-step { display: flex; flex-direction: column; align-items: center; gap: 6px; flex: 1; }
.step-circle {
    width: 44px; height: 44px; border-radius: 50%;
    background: #e8edf5; border: 2px solid #d0d9e6;
    display: flex; align-items: center; justify-content: center;
    color: #aaa; font-size: 1rem; transition: all 0.3s;
}
.enroll-step.active .step-circle, .enroll-step.done .step-circle {
    background: linear-gradient(135deg, #002147, #003b7a);
    border-color: #002147; color: #fff;
}
.enroll-step.done .step-circle { background: linear-gradient(135deg, #22c55e, #16a34a); border-color: #22c55e; }
.step-label { font-size: 0.72rem; font-weight: 700; color: #aaa; text-align: center; }
.enroll-step.active .step-label, .enroll-step.done .step-label { color: #002147; }
.step-connector { flex: 1; height: 2px; background: #e8edf5; margin: 0 4px; margin-bottom: 22px; transition: background 0.3s; }
.step-connector.done { background: #002147; }

/* ===== Main Content ===== */
.enroll-body { background: #f4f7fb; padding: 36px 0 60px; }

/* ===== Section Header inside card ===== */
.enroll-card { background: #fff; border-radius: 16px; padding: 28px 30px; margin-bottom: 20px; box-shadow: 0 2px 16px rgba(0,33,71,0.06); border: 1px solid #eef2f8; }
.enroll-section-title { font-size: 1.05rem; font-weight: 800; color: #002147; margin-bottom: 4px; }
.enroll-section-sub { font-size: 0.78rem; color: #888; margin-bottom: 20px; }

/* ===== Selected Course Card ===== */
.selected-course-card {
    border: 2px solid #002147; border-radius: 12px; padding: 16px 18px;
    display: flex; justify-content: space-between; align-items: flex-start;
    flex-wrap: wrap; gap: 10px; background: #f8fbff; margin-bottom: 20px;
}
.selected-course-label { font-size: 0.65rem; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 4px; }
.selected-course-name { font-weight: 800; color: #002147; font-size: 0.95rem; line-height: 1.4; }
.selected-course-sub  { font-size: 0.75rem; color: #fab005; font-weight: 600; margin-top: 3px; }
.selected-course-tags { display: flex; gap: 6px; flex-wrap: wrap; margin-top: 8px; }
.selected-course-tag { background: #eef2f8; color: #555; font-size: 0.68rem; font-weight: 600; padding: 3px 10px; border-radius: 50px; }
.selected-course-price { font-size: 1.5rem; font-weight: 800; color: #002147; text-align: right; white-space: nowrap; }
.selected-course-price small { font-size: 0.75rem; color: #888; text-decoration: line-through; display: block; text-align: right; }

/* ===== Batch Card ===== */
.batch-option {
    border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 16px 18px;
    margin-bottom: 10px; cursor: pointer; transition: all 0.25s; position: relative;
    display: flex; align-items: center; gap: 14px;
}
.batch-option:hover { border-color: #002147; background: #f8fbff; }
.batch-option.selected { border-color: #002147; background: #f0f5ff; }
.batch-radio { width: 18px; height: 18px; border: 2px solid #d0d9e6; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
.batch-option.selected .batch-radio { border-color: #002147; background: #002147; }
.batch-option.selected .batch-radio::after { content: ''; width: 7px; height: 7px; background: #fff; border-radius: 50%; display: block; }
.batch-info { flex: 1; }
.batch-name { font-weight: 700; color: #002147; font-size: 0.9rem; }
.batch-days { font-size: 0.75rem; color: #888; margin-top: 2px; }
.batch-time { font-size: 0.75rem; color: #555; margin-top: 4px; display: flex; align-items: center; gap: 5px; }
.batch-time i { color: #fab005; }
.batch-seats { font-size: 0.72rem; font-weight: 700; color: #fff; background: #22c55e; padding: 3px 10px; border-radius: 50px; white-space: nowrap; }

/* ===== Student Info Form ===== */
.enroll-form-group { margin-bottom: 18px; }
.enroll-label { font-size: 0.8rem; font-weight: 700; color: #2d3748; margin-bottom: 6px; display: block; }
.enroll-label span { color: #e53e3e; }
.enroll-input {
    width: 100%; padding: 11px 16px; border: 1.5px solid #e2e8f0; border-radius: 10px;
    font-size: 0.88rem; color: #333; background: #fff; transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
}
.enroll-input:focus { border-color: #002147; box-shadow: 0 0 0 3px rgba(0,33,71,0.08); }
.enroll-input::placeholder { color: #bbb; }
.gender-group { display: flex; gap: 14px; flex-wrap: wrap; }
.gender-option { display: flex; align-items: center; gap: 6px; cursor: pointer; font-size: 0.85rem; color: #555; font-weight: 600; }
.gender-option input { accent-color: #002147; width: 16px; height: 16px; }

/* ===== Payment Step ===== */
.payment-method-card {
    border: 1px solid #eef2f8; border-radius: 12px; overflow: hidden;
    margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,33,71,0.05);
}
.payment-method-header { background: linear-gradient(135deg, #002147, #003b7a); color: #fff; padding: 14px 20px; }
.payment-method-header h5 { margin: 0; font-weight: 700; font-size: 0.95rem; display: flex; align-items: center; gap: 8px; }
.payment-method-header p { margin: 4px 0 0; font-size: 0.75rem; color: rgba(255,255,255,0.7); }
.payment-method-row { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px; border-bottom: 1px solid #f0f4f8; }
.payment-method-row:last-child { border-bottom: none; }
.payment-method-row img { height: 36px; width: auto; }
.payment-method-row span { font-weight: 700; color: #1a1a2e; font-size: 0.9rem; }
.payment-method-row small { display: block; color: #888; font-size: 0.72rem; }

.price-summary { background: #f8fbff; border-radius: 12px; padding: 18px; margin-bottom: 20px; border: 1px solid #eef2f8; }
.price-row { display: flex; justify-content: space-between; align-items: center; padding: 7px 0; border-bottom: 1px solid #f0f4f8; font-size: 0.85rem; color: #555; }
.price-row:last-child { border-bottom: none; padding-top: 12px; margin-top: 4px; }
.price-row.total { font-weight: 800; font-size: 1.1rem; color: #002147; }
.price-row.discount span:last-child { color: #22c55e; font-weight: 700; }

/* ===== Buttons ===== */
.btn-enroll-next {
    width: 100%; padding: 14px; background: linear-gradient(135deg, #002147, #003b7a);
    color: #fff; border: none; border-radius: 50px; font-weight: 800; font-size: 0.95rem;
    cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-enroll-next:hover { background: linear-gradient(135deg, #fab005, #e09600); box-shadow: 0 6px 20px rgba(250,176,5,0.4); }
.btn-enroll-back {
    background: none; border: 1.5px solid #d0d9e6; color: #555; padding: 11px 24px;
    border-radius: 50px; font-weight: 600; font-size: 0.88rem; cursor: pointer;
    transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
}
.btn-enroll-back:hover { border-color: #002147; color: #002147; }

.btn-pay-now {
    width: 100%; padding: 14px; background: linear-gradient(135deg, #fab005, #e09600);
    color: #fff; border: none; border-radius: 50px; font-weight: 800; font-size: 1rem;
    cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-pay-now:hover { box-shadow: 0 8px 25px rgba(250,176,5,0.5); transform: translateY(-2px); }

/* ===== Step visibility ===== */
.enroll-step-panel { display: none; }
.enroll-step-panel.active { display: block; }

/* ===== Payment logos footer ===== */
.payment-logos-bar { background: #fff; padding: 28px 0; border-top: 1px solid #eef2f8; }
.payment-logos-bar img { height: 42px; width: auto; filter: grayscale(20%); transition: all 0.3s; cursor: pointer; }
.payment-logos-bar img:hover { filter: grayscale(0%); transform: scale(1.08); }

@media(max-width:575px) {
    .enroll-card { padding: 20px 18px; }
    .selected-course-card { flex-direction: column; }
}
</style>
@endpush

@section('contents')

{{-- ===== Hero ===== --}}
<section class="enroll-hero">
    <div class="container position-relative" style="z-index:1;">
        <h1>ভর্তি ফর্ম</h1>
        <p>Enrollment Form</p>
    </div>
</section>

{{-- ===== Step Indicator ===== --}}
<div class="enroll-steps-wrap">
    <div class="container">
        <div class="enroll-steps">
            <div class="enroll-step active" id="si-1">
                <div class="step-circle"><i class="fa-solid fa-book-open"></i></div>
                <div class="step-label">ভর্তি ফর্ম</div>
            </div>
            <div class="step-connector" id="sc-1"></div>
            <div class="enroll-step" id="si-2">
                <div class="step-circle"><i class="fa-solid fa-credit-card"></i></div>
                <div class="step-label">পেমেন্ট</div>
            </div>
            <div class="step-connector" id="sc-2"></div>
            <div class="enroll-step" id="si-3">
                <div class="step-circle"><i class="fa-solid fa-circle-check"></i></div>
                <div class="step-label">সম্পন্ন</div>
            </div>
        </div>
    </div>
</div>

{{-- ===== Body ===== --}}
<div class="enroll-body">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-8">

                {{-- ========== STEP 1: Course & Student Info ========== --}}
                <div class="enroll-step-panel active" id="panel-1">

                    {{-- Course & Batch Info --}}
                    <div class="enroll-card">
                        <div class="enroll-section-title">কোর্স ও ব্যাচ তথ্য</div>
                        <div class="enroll-section-sub">Course &amp; Batch Information</div>

                        {{-- Selected course --}}
                        <div class="selected-course-card">
                            <div>
                                <div class="selected-course-label">নির্বাচিত কোর্স</div>
                                <div class="selected-course-name">{{ $course->title }}</div>
                                <div class="selected-course-sub">{{ $course->title }}</div>
                                <div class="selected-course-tags">
                                    @if($enroll_batch)
                                        <span class="selected-course-tag">{{ $enroll_batch->batch_type ?? 'ব্যাচ' }}</span>
                                        <span class="selected-course-tag">{{ $enroll_batch->duration ?? '' }}</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="selected-course-label" style="text-align:right;">কোর্স ফি</div>
                                @if($enroll_batch)
                                    @if($enroll_batch->after_discount_price && $enroll_batch->after_discount_price > 0)
                                        <div class="selected-course-price">
                                            <small>৳{{ number_format($enroll_batch->course_price) }}</small>
                                            ৳{{ number_format($enroll_batch->after_discount_price) }}
                                        </div>
                                    @else
                                        <div class="selected-course-price">
                                            ৳{{ number_format($enroll_batch->course_price ?? 0) }}
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>

                        {{-- Batch details (current batch) --}}
                        @if($enroll_batch)
                        <div style="margin-bottom:8px;">
                            <div class="enroll-label" style="margin-bottom:10px;">ব্যাচ তথ্য <span></span></div>
                            <div class="batch-option selected">
                                <div class="batch-radio"></div>
                                <div class="batch-info">
                                    <div class="batch-name">{{ $enroll_batch->batch_name }}</div>
                                    <div class="batch-days">{{ $enroll_batch->class_days }}</div>
                                    <div class="batch-time">
                                        <i class="fa-regular fa-clock"></i>
                                        ক্লাসের সময় {{ \Carbon\Carbon::parse($enroll_batch->class_start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($enroll_batch->class_end_time)->format('g:i A') }}
                                    </div>
                                </div>
                                @if($enroll_batch->show_percentage_on_cards === 'yes')
                                    <span class="batch-seats">{{ 100 - ($enroll_batch->booked_percent ?? 0) }}% আসন বাকি</span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Student Info --}}
                    <div class="enroll-card">
                        <div class="enroll-section-title">শিক্ষার্থীর তথ্য</div>
                        <div class="enroll-section-sub">Student Information</div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="enroll-form-group">
                                    <label class="enroll-label">শিক্ষার্থীর নাম <span>*</span></label>
                                    <input type="text" class="enroll-input" id="std-name" placeholder="পুরো নাম লিখুন"
                                           value="{{ auth()->check() ? auth()->user()->first_name.' '.auth()->user()->last_name : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="enroll-form-group">
                                    <label class="enroll-label">মোবাইল নম্বর <span>*</span></label>
                                    <input type="tel" class="enroll-input" id="std-phone" placeholder="01XXX-XXXXXX"
                                           value="{{ auth()->check() ? (auth()->user()->phone ?? '') : '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="enroll-form-group">
                                    <label class="enroll-label">ঠিকানা <span>*</span></label>
                                    <input type="text" class="enroll-input" id="std-address" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="enroll-form-group">
                                    <label class="enroll-label">লিঙ্গ <span>*</span></label>
                                    <div class="gender-group">
                                        <label class="gender-option"><input type="radio" name="gender" value="male"> পুরুষ</label>
                                        <label class="gender-option"><input type="radio" name="gender" value="female"> মহিলা</label>
                                        <label class="gender-option"><input type="radio" name="gender" value="other"> অন্যান্য</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <button class="btn-enroll-next" onclick="goStep(2)" style="max-width:260px;">
                                পরবর্তী <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ========== STEP 2: Payment ========== --}}
                <div class="enroll-step-panel" id="panel-2">

                    {{-- Course summary --}}
                    <div class="enroll-card" style="padding:18px 24px;">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <img src="{{ asset($course->image) }}" alt="{{ $course->title }}"
                                 style="width:70px;height:70px;object-fit:cover;border-radius:10px;flex-shrink:0;">
                            <div class="flex-grow-1">
                                <div style="font-weight:800;color:#002147;font-size:1rem;">{{ $course->title }}</div>
                                @if($enroll_batch)
                                    <div style="font-size:0.78rem;color:#888;margin-top:3px;">{{ $enroll_batch->batch_name }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Payment methods --}}
                    <div class="enroll-card" style="padding:0;overflow:hidden;">
                        <div class="payment-method-header">
                            <h5><i class="fas fa-mobile-alt"></i> পেমেন্ট পদ্ধতি</h5>
                            <p>একাধিক পেমেন্ট মাধ্যম উপলব্ধ</p>
                        </div>
                        <div class="payment-method-row">
                            <div><span>bKash</span><small>Personal</small></div>
                            <img src="{{ asset('frontend/assets/images/bkash.png') }}" alt="bKash">
                        </div>
                        <div class="payment-method-row">
                            <div><span>Rocket</span><small>Personal</small></div>
                            <img src="{{ asset('frontend/assets/images/roket.png') }}" alt="Rocket">
                        </div>
                        <div class="payment-method-row">
                            <div><span>Nagad</span><small>Personal</small></div>
                            <img src="{{ asset('frontend/assets/images/nogot.png') }}" alt="Nagad">
                        </div>
                        <div class="payment-method-row">
                            <div><span>CellFin</span><small>Personal</small></div>
                            <img src="{{ asset('frontend/assets/images/cellz_fin.png') }}" alt="CellFin">
                        </div>
                    </div>

                    {{-- Price summary + form --}}
                    <div class="enroll-card">
                        <div class="enroll-section-title">মূল্য সারসংক্ষেপ</div>
                        <div class="enroll-section-sub">Price Summary</div>

                        @if($enroll_batch)
                        <div class="price-summary">
                            <div class="price-row">
                                <span>মূল মূল্য</span>
                                <span>৳{{ number_format($enroll_batch->course_price ?? 0) }}</span>
                            </div>
                            @if($enroll_batch->after_discount_price && $enroll_batch->after_discount_price > 0)
                            <div class="price-row discount">
                                <span>ছাড়</span>
                                <span>- ৳{{ number_format($enroll_batch->course_price - $enroll_batch->after_discount_price) }}</span>
                            </div>
                            @endif
                            <div class="price-row total">
                                <span>মোট পরিমাণ</span>
                                <span>৳{{ number_format($enroll_batch->after_discount_price ?: $enroll_batch->course_price) }}</span>
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('course_enroll_submit', $course->slug) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-pay-now">
                                <i class="fa-solid fa-lock me-1"></i> এখনই পেমেন্ট করুন
                            </button>
                        </form>

                        <div class="mt-3 text-center">
                            <button class="btn-enroll-back" onclick="goStep(1)">
                                <i class="fa-solid fa-arrow-left"></i> পিছনে যান
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Payment logos --}}
<div class="payment-logos-bar">
    <div class="container">
        <div class="text-center mb-3">
            <small class="text-muted fw-bold" style="font-size:0.78rem;letter-spacing:0.8px;text-transform:uppercase;">আপনি যেভাবে পেমেন্ট করতে পারবেন</small>
        </div>
        <div class="d-flex justify-content-center align-items-center gap-4 flex-wrap">
            <img src="{{ asset('frontend/assets/images/bkash.png') }}" alt="bKash">
            <img src="{{ asset('frontend/assets/images/roket.png') }}" alt="Rocket">
            <img src="{{ asset('frontend/assets/images/nogot.png') }}" alt="Nagad">
            <img src="{{ asset('frontend/assets/images/cellz_fin.png') }}" alt="CellFin">
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function goStep(n) {
    // Update panels
    document.querySelectorAll('.enroll-step-panel').forEach(function(p){ p.classList.remove('active'); });
    var target = document.getElementById('panel-' + n);
    if (target) target.classList.add('active');

    // Update step indicators
    for (var i = 1; i <= 3; i++) {
        var si = document.getElementById('si-' + i);
        var sc = document.getElementById('sc-' + (i - 1));
        if (!si) continue;
        si.classList.remove('active', 'done');
        if (i < n)      si.classList.add('done');
        else if (i === n) si.classList.add('active');
        if (sc) sc.classList.toggle('done', i <= n);
    }

    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
@endpush
