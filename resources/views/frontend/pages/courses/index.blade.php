@php
    $meta = [
        'seo' => [
            'title' => 'Courses — TechPark English',
            'image' => asset('seo.jpg'),
        ],
    ];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
/* ===== Page Hero ===== */
.courses-hero { background: linear-gradient(135deg, #001830 0%, #002147 60%, #003b7a 100%); padding: 55px 0 45px; position: relative; overflow: hidden; }
.courses-hero::before { content: ''; position: absolute; top: -80px; right: -60px; width: 350px; height: 350px; background: rgba(250,176,5,0.06); border-radius: 50%; }
.courses-hero::after  { content: ''; position: absolute; bottom: -120px; left: -80px; width: 400px; height: 400px; background: rgba(255,255,255,0.02); border-radius: 50%; }

/* ===== Filter Tabs ===== */
.course-filter-bar { background: #fff; border-bottom: 1px solid #eef2f8; padding: 0; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
.course-filter-inner { display: flex; align-items: center; gap: 0; overflow-x: auto; scrollbar-width: none; }
.course-filter-inner::-webkit-scrollbar { display: none; }
.course-filter-btn { padding: 16px 22px; font-size: 0.85rem; font-weight: 600; color: #555; text-decoration: none; border: none; background: none; white-space: nowrap; cursor: pointer; display: inline-block; transition: all 0.25s; border-bottom: 3px solid transparent; }
.course-filter-btn:hover { color: #002147; }
.course-filter-btn.active { color: #002147; border-bottom-color: #fab005; }

/* ===== Course Card ===== */
.crs-card { background: #fff; border-radius: 18px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.06); transition: all 0.35s ease; border: 1px solid #f0f4f8; display: flex; flex-direction: column; height: 100%; }
.crs-card:hover { transform: translateY(-8px); box-shadow: 0 20px 55px rgba(0,33,71,0.13); border-color: transparent; }
.crs-img-wrap { position: relative; overflow: hidden; }
.crs-img-wrap img { width: 100%; height: 210px; object-fit: cover; display: block; transition: transform 0.45s ease; }
.crs-card:hover .crs-img-wrap img { transform: scale(1.06); }
.crs-img-overlay { position: absolute; top: 12px; left: 12px; right: 12px; display: flex; gap: 6px; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; width: calc(100% - 24px); }
.crs-badge { font-size: 0.68rem; font-weight: 700; letter-spacing: 0.5px; padding: 4px 10px; border-radius: 50px; }
.crs-badge-blue { background: #002147; color: #fff; }
.crs-badge-gold { background: #fab005; color: #fff; }
.crs-countdown { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); padding: 12px 14px 10px; display: flex; align-items: center; justify-content: space-between; }
.crs-countdown .timer { color: #fff; font-size: 0.75rem; display: flex; align-items: center; gap: 5px; }
.crs-countdown .timer i { color: #fab005; }
.crs-body { padding: 22px; flex: 1; display: flex; flex-direction: column; }
.crs-title { font-weight: 700; font-size: 1rem; color: #1a1a2e; margin-bottom: 14px; line-height: 1.4; }
.crs-meta { list-style: none; padding: 0; margin: 0 0 16px; }
.crs-meta li { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: #555; margin-bottom: 7px; }
.crs-meta li i { color: #002147; width: 16px; text-align: center; }
.crs-footer { margin-top: auto; padding-top: 16px; border-top: 1px solid #f0f4f8; display: flex; align-items: center; justify-content: space-between; }
.crs-price { display: flex; align-items: baseline; gap: 6px; }
.crs-price .current { font-size: 1.3rem; font-weight: 800; color: #002147; }
.crs-price .old { font-size: 0.82rem; color: #bbb; text-decoration: line-through; }
.crs-booked { font-size: 0.72rem; color: #888; text-align: right; }
.crs-booked .pct { font-size: 1rem; font-weight: 700; color: #e53e3e; display: block; line-height: 1; }
.btn-crs { background: linear-gradient(135deg, #002147, #003b7a); color: #fff !important; padding: 9px 16px; border-radius: 50px; font-weight: 700; font-size: 0.78rem; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: all 0.3s; white-space: nowrap; }
.btn-crs:hover { background: linear-gradient(135deg, #003b7a, #005ab5); transform: translateY(-1px); box-shadow: 0 6px 18px rgba(0,33,71,0.3); }
.btn-crs i { font-size: 0.7rem; }
.btn-crs-enroll { background: linear-gradient(135deg, #fab005, #e09600) !important; }
.btn-crs-enroll:hover { background: linear-gradient(135deg, #e09600, #c87800) !important; box-shadow: 0 6px 18px rgba(250,176,5,0.4) !important; }

/* ===== Discount Ribbon ===== */
.rc-disc-ribbon { position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, #ff3d00, #d50000); color: #fff; font-size: 0.7rem; font-weight: 800; padding: 5px 12px; border-radius: 50px; box-shadow: 0 3px 12px rgba(213,0,0,0.4); z-index: 2; }

/* ===== Empty State ===== */
.empty-state { text-align: center; padding: 80px 20px; }
.empty-state i { font-size: 4rem; color: #dde3ea; margin-bottom: 20px; }

/* ===== Pagination ===== */
.course-paginate-wrap { margin-top: 50px; }
.course-paginate-wrap .pagination .page-link { border-radius: 8px; margin: 0 3px; border: 1px solid #e2e8f0; color: #002147; font-weight: 600; padding: 8px 14px; transition: all 0.2s; }
.course-paginate-wrap .pagination .page-link:hover { background: #002147; color: #fff; border-color: #002147; }
.course-paginate-wrap .pagination .page-item.active .page-link { background: linear-gradient(135deg, #002147, #003b7a); border-color: transparent; color: #fff; }
</style>
@endpush

@section('contents')

    {{-- Page Hero --}}
    <section class="courses-hero">
        <div class="container position-relative" style="z-index:1;">
            <div class="text-center">
                <span style="background:rgba(250,176,5,0.18); border:1px solid rgba(250,176,5,0.5); color:#fab005; font-size:0.75rem; font-weight:700; padding:6px 18px; border-radius:50px; display:inline-block; margin-bottom:14px; letter-spacing:0.8px; text-transform:uppercase;">সকল কোর্স</span>
                <h1 class="fw-bold text-white mb-3" style="font-size:2.2rem;">আমাদের কোর্স সমূহ</h1>
                <p style="color:rgba(255,255,255,0.65); font-size:0.95rem; max-width:520px; margin:0 auto;">রেসিডেন্সিয়াল ও অনলাইন — যেকোনো মাধ্যমে আপনার ইংরেজি দক্ষতা বিকাশ করুন।</p>
            </div>
        </div>
    </section>

    {{-- Filter Tabs --}}
    <div class="course-filter-bar">
        <div class="container">
            <div class="course-filter-inner">
                <a href="{{ route('courses') }}" class="course-filter-btn {{ !request()->has('slug') ? 'active' : '' }}">
                    <i class="fa-solid fa-grid-2 me-1"></i> সকল কোর্স
                </a>
                @foreach($course_types as $type)
                    <a href="{{ route('courses', ['slug' => $type->slug]) }}"
                       class="course-filter-btn {{ request('slug') === $type->slug ? 'active' : '' }}">
                        {{ $type->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Course Grid --}}
    <section class="py-5" style="background:#f4f7fb;">
        <div class="container py-3">
            @if($courses->count() > 0)
                <div class="row g-4 justify-content-center">
                    @foreach($courses as $course)
                    @php
                        $cc = new App\Http\Controllers\Course\CourseController();
                        $cdata = $cc->course_batch_details($course->id);
                        $courseBatch = $cdata['batch'] ?? null;
                        $tz = $cdata['tz'] ?? 'UTC';
                        $admEnd = $courseBatch->admission_end_date ?? null;
                        $isEnrolled = auth()->check()
                            ? \App\Modules\Management\EnrollInformation\Models\Model::where('student_id', auth()->id())
                                ->where('course_id', $course->id)->exists()
                            : false;
                        $remainingTime = '';
                        if ($admEnd) {
                            $admEndParsed = Carbon\Carbon::parse($admEnd, $tz);
                            $now = Carbon\Carbon::now($tz);
                            if ($now->greaterThanOrEqualTo($admEndParsed)) {
                                $remainingTime = '0 Days';
                            } else {
                                $days  = $admEndParsed->diffInDays($now);
                                $hours = $admEndParsed->diffInHours($now) % 24;
                                $mins  = $admEndParsed->diffInMinutes($now) % 60;
                                $remainingTime = $days > 0 ? $days.' Days' : ($hours > 0 ? $hours.' Hours' : $mins.' Minutes');
                            }
                        }
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="crs-card">
                            <div class="crs-img-wrap">
                                @php
                                    $crs_fallback = 'https://dummyimage.com/600x340/002147/fab005&text='.urlencode($course->title ?? 'Course');
                                    $crsDiscount = 0;
                                    $crsOriginal = $course->regular_price ?? 0;
                                    $crsPrice = $course->sales_price ?? $crsOriginal;
                                    if ($crsOriginal > 0 && $crsPrice < $crsOriginal) {
                                        $crsDiscount = round((($crsOriginal - $crsPrice) / $crsOriginal) * 100);
                                    }
                                @endphp
                                <img src="{{ $course->image ? asset($course->image) : $crs_fallback }}"
                                     alt="{{ $course->title }}" loading="lazy"
                                     onerror="this.onerror=null;this.src='{{ $crs_fallback }}'">
                                <div class="crs-img-overlay">
                                    <span class="crs-badge crs-badge-blue">TechPark English</span>
                                </div>
                                @if($crsDiscount > 0)
                                    <span class="rc-disc-ribbon">{{ $crsDiscount }}% OFF</span>
                                @endif
                            </div>
                            <div class="crs-body">
                                <h3 class="crs-title">{{ $course->title }}</h3>
                                <ul class="crs-meta">
                                    <li><i class="fa-solid fa-layer-group"></i> <strong>মোট মডিউল:</strong> {{ $course->modules_count ?? 0 }}</li>
                                    <li><i class="fa-solid fa-book"></i> <strong>মোট ক্লাস:</strong> {{ $course->classes_count ?? 0 }}</li>
                                    <li><i class="fa-solid fa-video"></i> <strong>মোট ভিডিও:</strong> {{ $course->classes_count ?? 0 }}</li>
                                    <li><i class="fa-solid fa-brain"></i> <strong>মোট কুইজ:</strong> {{ $course->quizzes_count ?? 0 }}</li>
                                    <li><i class="fa-solid fa-flag"></i> <strong>মোট মাইলস্টোন:</strong> {{ $course->milestones_count ?? 0 }}</li>
                                </ul>
                                <div class="crs-footer">
                                    <div class="crs-price">
                                        <span class="current">৳{{ number_format($crsPrice, 0, '.', ',') }}</span>
                                        @if($crsDiscount > 0)
                                            <span class="old">৳{{ number_format($crsOriginal, 0, '.', ',') }}</span>
                                        @endif
                                    </div>
                                    <div style="display:flex;gap:6px;flex-wrap:wrap;justify-content:flex-end;">
                                        <a href="{{ route('course_details', $course->slug) }}" class="btn-crs">
                                            <i class="fa-solid fa-circle-info"></i> বিস্তারিত
                                        </a>
                                        @if($isEnrolled)
                                        <span class="btn-crs btn-crs-enroll" style="opacity:0.65;cursor:not-allowed;pointer-events:none;">
                                            <i class="fa-solid fa-circle-check"></i> ভর্তি হয়েছেন
                                        </span>
                                        @elseif(auth()->check())
                                        <form method="POST" action="{{ route('course.checkout', $course->slug) }}" style="display:contents;">
                                            @csrf
                                            <button type="submit" class="btn-crs btn-crs-enroll" style="border:none;cursor:pointer;">
                                                <i class="fa-solid fa-pen-to-square"></i> ভর্তি হন
                                            </button>
                                        </form>
                                        @else
                                        <a href="{{ route('login') }}" class="btn-crs btn-crs-enroll">
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

                <div class="course-paginate-wrap d-flex justify-content-center">
                    {{ $courses->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fa-solid fa-book-open"></i>
                    <h4 class="fw-bold mb-2" style="color:#002147;">কোনো কোর্স পাওয়া যায়নি</h4>
                    <p class="text-muted">অন্য ক্যাটাগরি দেখুন অথবা পরে আবার চেষ্টা করুন।</p>
                    <a href="{{ route('courses') }}" style="background:#002147; color:#fff; padding:11px 28px; border-radius:50px; font-weight:700; text-decoration:none; display:inline-block; margin-top:10px;">সকল কোর্স দেখুন</a>
                </div>
            @endif
        </div>
    </section>

@endsection
