@php
    $meta = [
        'seo' => [
            'title' => 'আবেদন সম্পন্ন — ' . $course->title,
            'image' => $course->thumbnail ? asset($course->thumbnail) : asset('seo.jpg'),
        ],
    ];
    $paid_online = $success['paid_online'] ?? false;
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
    .enroll-hero { background:linear-gradient(135deg,#001830 0%,#002147 100%); padding:36px 0 30px; }
    .enroll-hero h1 { font-size:1.8rem; font-weight:800; color:#fff; margin-bottom:4px; }
    .enroll-hero p  { color:rgba(255,255,255,0.55); font-size:0.85rem; }

    /* Stepper */
    .stepper { display:flex; align-items:center; justify-content:center; margin-bottom:36px; }
    .step { display:flex; flex-direction:column; align-items:center; gap:6px; }
    .step-icon { width:50px; height:50px; border-radius:50%; border:2px solid #d8e0ef; background:#fff; display:flex; align-items:center; justify-content:center; font-size:1.15rem; color:#b0b8cc; }
    .step.done .step-icon { border-color:#059669; background:#059669; color:#fff; }
    .step-label { font-size:0.73rem; font-weight:600; color:#999; white-space:nowrap; }
    .step.done .step-label { color:#059669; }
    .step-line { width:90px; height:2px; background:#059669; margin-bottom:22px; }

    /* Success card */
    .success-card { background:#fff; border-radius:20px; box-shadow:0 6px 32px rgba(0,33,71,0.09); border:1px solid #eef2f8; overflow:hidden; }
    .success-body { padding:52px 36px; text-align:center; }

    .success-icon-ring { width:90px; height:90px; border-radius:50%; background:linear-gradient(135deg,#dcfce7,#bbf7d0); display:flex; align-items:center; justify-content:center; margin:0 auto 22px; box-shadow:0 8px 28px rgba(5,150,105,0.2); }
    .success-icon-ring i { font-size:2.5rem; color:#16a34a; }
    .success-h { font-size:1.75rem; font-weight:800; color:#002147; margin-bottom:6px; }
    .success-sub { font-weight:700; font-size:0.95rem; margin-bottom:0; }
    .success-sub.online { color:#059669; }
    .success-sub.offline { color:#d97706; }

    /* Detail card */
    .sdc { border:1px solid #e4eaf5; border-radius:14px; overflow:hidden; margin:26px auto 0; max-width:520px; text-align:left; }
    .sdc-head { background:#f0f5ff; padding:12px 20px; font-size:0.84rem; font-weight:800; color:#002147; border-bottom:1px solid #dce8f8; }
    .sdc-row { display:flex; justify-content:space-between; align-items:center; padding:12px 20px; border-bottom:1px solid #f5f7fc; font-size:0.85rem; }
    .sdc-row:last-child { border-bottom:none; }
    .sdc-label { color:#6b7280; font-weight:500; }
    .sdc-value { color:#1a1a2e; font-weight:700; text-align:right; max-width:62%; }
    .badge-pending { color:#d97706; font-weight:800; background:#fef3c7; padding:3px 12px; border-radius:20px; font-size:0.75rem; display:inline-block; }
    .badge-paid    { color:#059669; font-weight:800; background:#dcfce7; padding:3px 12px; border-radius:20px; font-size:0.75rem; display:inline-block; }

    /* Next step note */
    .next-note { border-radius:12px; padding:15px 20px; margin:18px auto 0; max-width:520px; font-size:0.84rem; line-height:1.7; text-align:left; }
    .next-note.offline { background:#f0f9ff; border:1px solid #bae6fd; color:#0369a1; }
    .next-note.online  { background:#f0fff8; border:1px solid #6ee7b7; color:#065f46; }
    .next-note strong  { font-weight:800; }

    /* WA button */
    .btn-wa-big { background:linear-gradient(135deg,#25d366,#1da851); color:#fff; border:none; border-radius:12px; padding:14px 32px; font-weight:800; font-size:0.95rem; text-decoration:none; display:inline-flex; align-items:center; gap:9px; transition:all .3s; box-shadow:0 5px 18px rgba(37,211,102,0.35); }
    .btn-wa-big:hover { background:linear-gradient(135deg,#1da851,#168a3f); color:#fff; transform:translateY(-1px); }
    .btn-home-suc { background:#002147; color:#fff; border:none; border-radius:10px; padding:13px 28px; font-weight:800; font-size:0.9rem; text-decoration:none; display:inline-flex; align-items:center; gap:7px; transition:all .3s; }
    .btn-home-suc:hover { background:#003b7a; color:#fff; }
    .btn-courses-suc { background:#fff; color:#002147; border:2px solid #002147; border-radius:10px; padding:11px 22px; font-weight:800; font-size:0.9rem; text-decoration:none; display:inline-flex; align-items:center; gap:7px; transition:all .3s; }
    .btn-courses-suc:hover { background:#f0f5ff; }

    @@media(max-width:576px) { .success-body { padding:36px 18px; } }
</style>
@endpush

@section('contents')

<section class="enroll-hero">
    <div class="container text-center">
        <h1>ভর্তি ফর্ম</h1>
        <p>Enrollment Form — {{ $course->title }}</p>
    </div>
</section>

<section style="background:#f2f5fb; padding:44px 0 70px;">
    <div class="container">

        {{-- Stepper — all done --}}
        <div class="stepper">
            <div class="step done">
                <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                <div class="step-label">ভর্তি ফর্ম</div>
            </div>
            <div class="step-line"></div>
            <div class="step done">
                <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                <div class="step-label">পেমেন্ট</div>
            </div>
            <div class="step-line"></div>
            <div class="step done">
                <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                <div class="step-label">সম্পন্ন</div>
            </div>
        </div>

        <div class="success-card">
            <div class="success-body">

                <div class="success-icon-ring">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="success-h">আবেদন সম্পন্ন!</div>
                @if($paid_online)
                <p class="success-sub online">Payment Confirmed — Enrollment Submitted Successfully</p>
                @else
                <p class="success-sub offline">Enrollment Submitted — পেমেন্ট যাচাই চলছে</p>
                @endif

                {{-- Details --}}
                <div class="sdc">
                    <div class="sdc-head">আবেদনের বিবরণ</div>
                    <div class="sdc-row">
                        <span class="sdc-label">কোর্স:</span>
                        <span class="sdc-value">{{ $success['course_title'] }}</span>
                    </div>
                    @if($success['batch_label'])
                    <div class="sdc-row">
                        <span class="sdc-label">ব্যাচ:</span>
                        <span class="sdc-value">{{ $success['batch_label'] }}</span>
                    </div>
                    @endif
                    <div class="sdc-row">
                        <span class="sdc-label">নাম:</span>
                        <span class="sdc-value">{{ $success['name'] }}</span>
                    </div>
                    @if(!empty($success['tran_id']))
                    <div class="sdc-row">
                        <span class="sdc-label">ট্রানজেকশন:</span>
                        <span class="sdc-value">{{ $success['tran_id'] }}</span>
                    </div>
                    @endif
                    <div class="sdc-row">
                        <span class="sdc-label">স্ট্যাটাস:</span>
                        <span class="sdc-value">
                            @if($paid_online)
                            <span class="badge-paid"><i class="fa-solid fa-check" style="font-size:.7rem;"></i> Paid</span>
                            @else
                            <span class="badge-pending">Pending (আলোচনায়)</span>
                            @endif
                        </span>
                    </div>
                </div>

                {{-- Next step note --}}
                @if($paid_online)
                <div class="next-note online">
                    <strong>পেমেন্ট নিশ্চিত হয়েছে!</strong>
                    আমাদের টিম শীঘ্রই আপনার সাথে যোগাযোগ করবে এবং ক্লাসের বিস্তারিত তথ্য প্রদান করবে।
                </div>
                @else
                <div class="next-note offline">
                    <strong>পরবর্তী ধাপ:</strong>
                    নিচের WhatsApp বাটনে ক্লিক করুন এবং পেমেন্টের তথ্য আমাদের পাঠান।
                    আমাদের টিম ২৪ ঘণ্টার মধ্যে যাচাই করে ফোনে যোগাযোগ করবে।
                </div>
                @endif

                {{-- Action buttons --}}
                <div class="d-flex gap-3 justify-content-center flex-wrap mt-5">
                    @if(!$paid_online && !empty($success['wa_url']))
                    <a href="{{ $success['wa_url'] }}" target="_blank" class="btn-wa-big">
                        <i class="fa-brands fa-whatsapp" style="font-size:1.15rem;"></i> WhatsApp করুন
                    </a>
                    @endif
                    <a href="{{ route('website') }}" class="btn-home-suc">
                        <i class="fa-solid fa-house"></i> হোমে যান
                    </a>
                    <a href="{{ route('live_courses') }}" class="btn-courses-suc">
                        <i class="fa-solid fa-graduation-cap"></i> অন্যান্য কোর্স
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
