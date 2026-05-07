@php
    $meta = [
        'seo' => [
            'title' => 'লাইভ কোর্স সমূহ — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];

    $type_labels = [
        'residential'     => 'Residential',
        'non_residential' => 'Non-Residential',
        'online'          => 'Online',
    ];

    $unique_types = $live_courses->pluck('live_course_type')->filter()->unique()->values();
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
    .lc-hero { background: linear-gradient(135deg, #001830 0%, #002147 60%, #003b7a 100%); padding: 60px 0 50px; position: relative; overflow: hidden; }
    .lc-hero::before { content:''; position:absolute; top:-80px; right:-60px; width:400px; height:400px; background:rgba(250,176,5,0.06); border-radius:50%; }
    .lc-hero::after  { content:''; position:absolute; bottom:-120px; left:-80px; width:350px; height:350px; background:rgba(255,255,255,0.02); border-radius:50%; }
    .live-badge { display:inline-flex; align-items:center; gap:6px; background:rgba(233,30,99,0.18); border:1px solid rgba(233,30,99,0.5); color:#ff80ab; font-size:0.72rem; font-weight:700; padding:5px 16px; border-radius:50px; margin-bottom:14px; letter-spacing:0.8px; text-transform:uppercase; }
    .live-dot { width:8px; height:8px; background:#e91e63; border-radius:50%; animation:blink 1.2s infinite; display:inline-block; }
    @@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.2} }

    /* Filter tabs */
    .filter-bar { background:#fff; border-bottom:2px solid #e8eef7; padding:0; }
    .filter-bar .container { display:flex; align-items:center; gap:0; overflow-x:auto; -webkit-overflow-scrolling:touch; scrollbar-width:none; }
    .filter-bar .container::-webkit-scrollbar { display:none; }
    .filter-tab { flex-shrink:0; padding:16px 24px; font-size:0.88rem; font-weight:600; color:#5a6a85; border:none; background:transparent; cursor:pointer; border-bottom:3px solid transparent; margin-bottom:-2px; transition:all 0.25s; white-space:nowrap; }
    .filter-tab:hover { color:#002147; }
    .filter-tab.active { color:#002147; border-bottom-color:#fab005; font-weight:800; }

    /* Card */
    .course-card { border:1px solid #e8eef8; border-radius:18px; box-shadow:0 4px 22px rgba(0,31,80,0.07); transition:all 0.35s ease; background:#fff; overflow:hidden; height:100%; display:flex; flex-direction:column; }
    .course-card:hover { transform:translateY(-9px); box-shadow:0 22px 55px rgba(0,31,80,0.14); border-color:#d4dff5; }
    .course-card .card-body { padding:22px; flex:1; display:flex; flex-direction:column; }
    .course-badge { background:#002147; color:#fff; font-size:0.65rem; padding:4px 10px; border-radius:4px; display:inline-flex; align-items:center; gap:5px; margin-bottom:8px; font-weight:800; letter-spacing:0.5px; }
    .course-title { font-weight:800; font-size:1.02rem; color:#1a2540; margin-bottom:14px; line-height:1.42; }
    .course-price { font-size:1.25rem; font-weight:900; color:#002147; line-height:1; }
    .course-old-price { font-size:0.8rem; color:#9aa8c0; text-decoration:line-through; margin-left:6px; }

    /* Image wrap + badges */
    .card-img-wrap { position:relative; overflow:hidden; flex-shrink:0; }
    .card-img-wrap img { width:100%; height:210px; object-fit:cover; display:block; transition:transform 0.45s ease; }
    .course-card:hover .card-img-wrap img { transform:scale(1.06); }
    .disc-ribbon { position:absolute; top:12px; right:12px; background:linear-gradient(135deg,#ff3d00,#d50000); color:#fff; font-size:0.72rem; font-weight:800; padding:5px 12px; border-radius:50px; box-shadow:0 3px 12px rgba(213,0,0,0.4); letter-spacing:0.3px; z-index:2; }
    .lc-popular-badge { position:absolute; bottom:12px; left:12px; background:linear-gradient(135deg,#fab005,#e09600); color:#fff; font-size:0.67rem; font-weight:800; padding:4px 12px; border-radius:5px; display:flex; align-items:center; gap:5px; z-index:2; }

    /* Specs */
    .lc-specs { list-style:none; padding:0; margin:0 0 16px; display:flex; flex-direction:column; gap:6px; }
    .lc-specs li { font-size:0.81rem; color:#4a5a7a; display:flex; align-items:flex-start; gap:7px; }
    .lc-specs li i { color:#059669; font-size:0.72rem; margin-top:3px; flex-shrink:0; }

    /* Footer */
    .lc-card-footer { margin-top:auto; padding-top:14px; border-top:1px solid #eef2fa; display:flex; align-items:center; justify-content:space-between; gap:8px; }
    .lc-price-block { display:flex; align-items:baseline; gap:6px; flex-wrap:wrap; }

    /* Buttons */
    .btn-tpe-fill { background:linear-gradient(135deg,#fab005,#e09600); color:#fff; padding:9px 20px; border-radius:8px; border:none; font-weight:800; font-size:0.82rem; transition:all 0.3s; box-shadow:0 4px 15px rgba(250,176,5,0.35); text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
    .btn-tpe-fill:hover { background:linear-gradient(135deg,#e09600,#c07800); color:#fff; transform:translateY(-2px); }
    .btn-tpe-outline { background:#f0f4fb; color:#002147; border:1px solid #d4dff5; padding:8px 15px; border-radius:8px; font-weight:700; font-size:0.79rem; text-decoration:none; transition:all 0.22s; white-space:nowrap; display:inline-block; }
    .btn-tpe-outline:hover { background:#e0e8f7; border-color:#b0c4e8; color:#001830; }
    .lc-btn-group { display:flex; align-items:center; gap:7px; }

    .empty-state { text-align:center; padding:80px 20px; }
    .empty-state i { font-size:3.5rem; color:#dde3ed; margin-bottom:20px; }

    .course-col { transition:opacity 0.25s, transform 0.25s; }
    .course-col.hidden { display:none; }
</style>
@endpush

@section('contents')

{{-- Hero --}}
<section class="lc-hero">
    <div class="container position-relative" style="z-index:1;">
        <div class="text-center">
            <div class="live-badge">
                <span class="live-dot"></span> লাইভ ক্লাস
            </div>
            <h1 class="text-white fw-800 mb-3" style="font-size:clamp(1.8rem,3.5vw,2.6rem); font-weight:800;">আমাদের কোর্স সমূহ</h1>
            <p class="mb-0" style="color:rgba(255,255,255,0.65); font-size:0.95rem; max-width:560px; margin:0 auto;">
                সরাসরি অভিজ্ঞ প্রশিক্ষকের সাথে লাইভ ক্লাসে শিখুন। ব্যাচ অনুযায়ী ভর্তি হোন এবং দ্রুত ইংরেজিতে দক্ষ হোন।
            </p>
        </div>
    </div>
</section>

{{-- Filter Tabs --}}
@if($unique_types->count() > 0)
<div class="filter-bar">
    <div class="container">
        <button class="filter-tab active" data-filter="all">সকল কোর্স</button>
        @foreach($unique_types as $type)
        <button class="filter-tab" data-filter="{{ $type }}">
            {{ $type_labels[$type] ?? ucwords(str_replace('_', ' ', $type)) }}
        </button>
        @endforeach
    </div>
</div>
@endif

{{-- Courses Grid --}}
<section class="py-5" style="background:#f4f7fb;">
    <div class="container py-3">
        @if($live_courses->count() > 0)
        <div class="row g-4 justify-content-center" id="coursesGrid">
            @foreach($live_courses as $lc)
            @php
                $disc = ($lc->regular_price > 0 && $lc->regular_price > $lc->sale_price && $lc->sale_price > 0)
                    ? round(($lc->regular_price - $lc->sale_price) / $lc->regular_price * 100)
                    : 0;
            @endphp
            <div class="col-lg-4 col-md-6 course-col" data-type="{{ $lc->live_course_type ?? '' }}">
                <div class="course-card">
                    {{-- Image --}}
                    <div class="card-img-wrap">
                        <img src="{{ $lc->thumbnail ? asset($lc->thumbnail) : 'https://dummyimage.com/600x400/003b7a/fff&text=Live+Course' }}"
                             alt="{{ $lc->title }}"
                             onerror="this.src='https://dummyimage.com/600x400/003b7a/fff&text=Live'">
                        @if($disc > 0)
                        <div class="disc-ribbon">{{ $disc }}% ছাড়</div>
                        @endif
                        @if($lc->is_popular)
                        <div class="lc-popular-badge"><i class="fa-solid fa-fire-flame-curved"></i> জনপ্রিয়</div>
                        @endif
                    </div>
                    {{-- Body --}}
                    <div class="card-body">
                        <span class="course-badge" style="background:linear-gradient(135deg,#e91e63,#c2185b);">
                            <span class="live-dot"></span>
                            {{ strtoupper($lc->live_course_type ?? 'LIVE') }}
                        </span>
                        <h3 class="course-title mt-2">{{ $lc->title }}</h3>
                        @php $cs = is_array($lc->course_specification) ? $lc->course_specification : json_decode($lc->course_specification, true); @endphp
                        @if($cs && count($cs) > 0)
                        <ul class="lc-specs">
                            @foreach(array_slice($cs, 0, 3) as $spec)
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                {{ is_array($spec) ? ($spec['title'] ?? $spec['text'] ?? '') : $spec }}
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="lc-card-footer">
                            <div class="lc-price-block">
                                @if($lc->sale_price)
                                    <span class="course-price">৳{{ number_format($lc->sale_price) }}</span>
                                    @if($lc->regular_price && $lc->regular_price > $lc->sale_price)
                                    <span class="course-old-price">৳{{ number_format($lc->regular_price) }}</span>
                                    @endif
                                @elseif($lc->regular_price)
                                    <span class="course-price">৳{{ number_format($lc->regular_price) }}</span>
                                @else
                                    <span class="course-price" style="font-size:0.88rem;color:#059669;">যোগাযোগ করুন</span>
                                @endif
                            </div>
                            <div class="lc-btn-group">
                                <a href="{{ route('live_course_details', $lc->slug) }}" class="btn-tpe-outline">বিস্তারিত</a>
                                <a href="{{ route('live_course_enroll', $lc->slug) }}" class="btn-tpe-fill" style="padding:8px 14px; font-size:0.78rem;">
                                    <i class="fa-solid fa-pen-to-square"></i> ভর্তি হন
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fa-solid fa-video-slash"></i>
            <h4 style="color:#002147; font-weight:700;">এই মুহূর্তে কোনো লাইভ কোর্স নেই</h4>
            <p class="text-muted">শীঘ্রই নতুন লাইভ কোর্স আসছে। আমাদের সাথে থাকুন।</p>
            <a href="{{ route('website') }}" class="btn-tpe-fill mt-3">হোমে ফিরুন</a>
        </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script>
document.querySelectorAll('.filter-tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.filter-tab').forEach(function(t) { t.classList.remove('active'); });
        this.classList.add('active');

        var filter = this.dataset.filter;
        document.querySelectorAll('.course-col').forEach(function(col) {
            if (filter === 'all' || col.dataset.type === filter) {
                col.classList.remove('hidden');
            } else {
                col.classList.add('hidden');
            }
        });
    });
});
</script>
@endpush
