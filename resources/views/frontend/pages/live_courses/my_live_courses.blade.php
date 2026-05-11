@php $meta = ['seo' => ['title' => 'My Live Courses — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
:root { --navy:#001e3c; --navy2:#002d5c; --gold:#fab005; --bg:#f0f4f9; --card:#fff; --border:#e4ecf5; --radius:16px; --shadow:0 4px 24px rgba(0,30,60,0.07); }
.lms-wrap { background:var(--bg); min-height:80vh; padding:0 0 60px; }
.lms-hero { background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 60%,#003b7a 100%); padding:40px 0 32px; }
.lms-hero h1 { font-size:clamp(1.4rem,3vw,2rem); font-weight:800; color:#fff; margin-bottom:6px; }
.lms-hero p { color:rgba(255,255,255,0.6); font-size:0.88rem; }

.lms-stats { display:flex; gap:14px; flex-wrap:wrap; margin-bottom:24px; }
.lms-stat { flex:1; min-width:140px; background:var(--card); border-radius:14px; border:1px solid var(--border); box-shadow:var(--shadow); padding:18px 20px; display:flex; align-items:center; gap:14px; }
.lms-stat-ico { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; }
.lms-stat-num { font-size:1.6rem; font-weight:800; color:var(--navy); line-height:1; }
.lms-stat-lbl { font-size:0.7rem; font-weight:600; color:#6b7a90; text-transform:uppercase; letter-spacing:0.5px; margin-top:2px; }

.lms-section-head { display:flex; align-items:center; gap:10px; margin-bottom:18px; }
.lms-section-head h2 { font-size:1rem; font-weight:800; color:var(--navy); margin:0; }
.lms-section-head .cnt { background:rgba(0,30,60,0.08); color:var(--navy); font-size:0.7rem; font-weight:700; padding:2px 10px; border-radius:50px; }

.lms-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:18px; margin-bottom:36px; }
.lms-card { background:var(--card); border-radius:var(--radius); border:1px solid var(--border); box-shadow:var(--shadow); overflow:hidden; display:flex; flex-direction:column; transition:all 0.3s; }
.lms-card:hover { transform:translateY(-4px); box-shadow:0 16px 48px rgba(0,30,60,0.12); }
.lms-card-img { position:relative; height:170px; overflow:hidden; background:#e8edf5; }
.lms-card-img img { width:100%; height:100%; object-fit:cover; }
.lms-card-badge { position:absolute; top:10px; left:10px; font-size:0.62rem; font-weight:700; padding:3px 10px; border-radius:50px; text-transform:uppercase; letter-spacing:0.4px; }
.badge-pending  { background:rgba(250,176,5,0.9);  color:#fff; }
.badge-paid     { background:rgba(0,166,81,0.9);   color:#fff; }
.badge-partial  { background:rgba(13,110,253,0.9); color:#fff; }
.lms-card-body { padding:18px; flex:1; display:flex; flex-direction:column; gap:8px; }
.lms-card-batch { font-size:0.68rem; font-weight:700; color:var(--gold); text-transform:uppercase; letter-spacing:0.5px; }
.lms-card-title { font-weight:700; color:var(--navy); font-size:0.92rem; line-height:1.4; }
.lms-card-meta { font-size:0.78rem; color:#6b7280; display:flex; flex-wrap:wrap; gap:10px; margin-top:4px; }
.lms-card-meta span { display:inline-flex; align-items:center; gap:5px; }
.lms-card-meta i { color:var(--navy2); font-size:0.72rem; }
.lms-card-fee { font-size:0.82rem; font-weight:700; color:var(--navy); margin-top:auto; padding-top:10px; border-top:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; }

.lms-empty { text-align:center; padding:60px 20px; background:var(--card); border-radius:var(--radius); border:1px solid var(--border); }
.lms-empty i { font-size:3rem; color:#d1dce9; margin-bottom:16px; display:block; }
</style>
@endpush

@section('contents')
<div class="lms-wrap">
    <div class="lms-hero">
        <div class="container position-relative" style="z-index:1;">
            <h1><i class="fa-solid fa-chalkboard-user me-2" style="color:var(--gold);"></i>আমার লাইভ কোর্স</h1>
            <p>আপনার সকল এনরোল্ড লাইভ কোর্স এখানে পাবেন।</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-4 pt-4">
            <div class="col-lg-3">
                @include('frontend.components.student_sidebar')
            </div>
            <div class="col-lg-9">

                {{-- Stats --}}
                @php
                    $total   = $enrollments->count();
                    $paid    = $enrollments->where('payment_status', 'paid')->count();
                    $pending = $enrollments->where('payment_status', 'pending')->count();
                @endphp
                <div class="lms-stats">
                    <div class="lms-stat">
                        <div class="lms-stat-ico" style="background:#eef5ff;color:var(--navy2);"><i class="fa-solid fa-chalkboard-user"></i></div>
                        <div><div class="lms-stat-num">{{ $total }}</div><div class="lms-stat-lbl">Total Enrolled</div></div>
                    </div>
                    <div class="lms-stat">
                        <div class="lms-stat-ico" style="background:#e8fff2;color:#00a651;"><i class="fa-solid fa-circle-check"></i></div>
                        <div><div class="lms-stat-num">{{ $paid }}</div><div class="lms-stat-lbl">Payment Done</div></div>
                    </div>
                    <div class="lms-stat">
                        <div class="lms-stat-ico" style="background:#fff9e6;color:#c07800;"><i class="fa-solid fa-hourglass-half"></i></div>
                        <div><div class="lms-stat-num">{{ $pending }}</div><div class="lms-stat-lbl">Pending</div></div>
                    </div>
                </div>

                @if($enrollments->count() > 0)
                <div class="lms-section-head">
                    <i class="fa-solid fa-chalkboard" style="color:var(--gold);"></i>
                    <h2>এনরোল্ড লাইভ কোর্স</h2>
                    <span class="cnt">{{ $total }}</span>
                </div>
                <div class="lms-grid">
                    @foreach($enrollments as $enrollment)
                    @php
                        $course = $enrollment->getRelation('live_course_id');
                        $batch  = $enrollment->getRelation('batch_id');
                        $startDate = $batch && $batch->course_start_date
                            ? \Carbon\Carbon::parse($batch->course_start_date)->format('d M, Y')
                            : null;
                        $batchTime = ($batch && $batch->class_start_time && $batch->class_end_time)
                            ? \Carbon\Carbon::parse($batch->class_start_time)->format('g:i A').' – '.\Carbon\Carbon::parse($batch->class_end_time)->format('g:i A')
                            : null;
                        $statusClass = match($enrollment->payment_status) {
                            'paid'    => 'badge-paid',
                            'partial' => 'badge-partial',
                            default   => 'badge-pending',
                        };
                        $statusLabel = match($enrollment->payment_status) {
                            'paid'    => 'Paid',
                            'partial' => 'Partial',
                            default   => 'Pending',
                        };
                    @endphp
                    <div class="lms-card">
                        <div class="lms-card-img">
                            @if($course && $course->thumbnail)
                                <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}" loading="lazy">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--navy),var(--navy2));">
                                    <i class="fa-solid fa-chalkboard-user" style="font-size:2.5rem;color:rgba(250,176,5,0.5);"></i>
                                </div>
                            @endif
                            <span class="lms-card-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                        </div>
                        <div class="lms-card-body">
                            @if($batch)
                            <div class="lms-card-batch"><i class="fa-solid fa-layer-group me-1"></i>ব্যাচ {{ $batch->batch_number }}@if($batch->shift_name) — {{ $batch->shift_name }}@endif</div>
                            @endif
                            <div class="lms-card-title">{{ $course->title ?? 'Live Course' }}</div>
                            <div class="lms-card-meta">
                                @if($startDate)
                                <span><i class="fa-solid fa-calendar-days"></i> {{ $startDate }}</span>
                                @endif
                                @if($batchTime)
                                <span><i class="fa-regular fa-clock"></i> {{ $batchTime }}</span>
                                @endif
                                @if($enrollment->enrolled_at)
                                <span><i class="fa-solid fa-user-check"></i> {{ \Carbon\Carbon::parse($enrollment->enrolled_at)->format('d M, Y') }}</span>
                                @endif
                            </div>
                            <div class="lms-card-fee">
                                <span style="color:#6b7280;font-weight:500;font-size:0.75rem;">কোর্স ফি</span>
                                <span>৳{{ $enrollment->amount ? number_format($enrollment->amount) : '—' }}
                                    @if($enrollment->amount_paid > 0)
                                    <small style="color:#059669;font-size:0.7rem;">(৳{{ number_format($enrollment->amount_paid) }} paid)</small>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="lms-empty">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <h4 class="fw-bold" style="color:var(--navy);">কোনো লাইভ কোর্স নেই</h4>
                    <p class="text-muted mb-4">আপনি এখনো কোনো লাইভ কোর্সে এনরোল্ড হননি।</p>
                    <a href="{{ route('live_courses') }}" style="background:linear-gradient(135deg,var(--navy),var(--navy2));color:#fff;padding:12px 28px;border-radius:50px;font-weight:700;text-decoration:none;font-size:0.88rem;">লাইভ কোর্স দেখুন</a>
                </div>
                @endif

            </div>{{-- /col-lg-9 --}}
        </div>
    </div>
</div>
@endsection
