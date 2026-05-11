@extends('frontend.layouts.layout', ['seo' => ['title' => 'Enrollment Successful — TechPark English']])

@section('contents')
<section style="min-height:70vh; background:#f0f4f9; display:flex; align-items:center; padding:60px 0;">
    <div class="container">
        <div style="max-width:520px; margin:0 auto; background:#fff; border-radius:20px; border:1px solid #e4ecf5; box-shadow:0 12px 48px rgba(0,30,60,0.1); overflow:hidden; text-align:center;">

            {{-- Top bar --}}
            <div style="background:linear-gradient(135deg,#001e3c,#003b7a); padding:36px 30px 28px;">
                <div style="width:72px; height:72px; border-radius:50%; background:rgba(250,176,5,0.2); border:2px solid rgba(250,176,5,0.5); display:inline-flex; align-items:center; justify-content:center; margin-bottom:16px;">
                    <i class="fa-solid fa-circle-check" style="font-size:2rem; color:#fab005;"></i>
                </div>
                <h1 style="font-size:1.5rem; font-weight:800; color:#fff; margin:0 0 6px;">Payment Successful!</h1>
                <p style="color:rgba(255,255,255,0.6); font-size:0.88rem; margin:0;">আপনার পেমেন্ট সফলভাবে সম্পন্ন হয়েছে।</p>
            </div>

            {{-- Course info --}}
            <div style="padding:28px 30px;">
                <div style="background:#f7faff; border:1px solid #e4ecf5; border-radius:12px; padding:16px 20px; margin-bottom:24px; display:flex; align-items:center; gap:14px; text-align:left;">
                    @if($course->image)
                        <img src="{{ asset($course->image) }}" alt="{{ $course->title }}" style="width:60px; height:60px; border-radius:10px; object-fit:cover; flex-shrink:0;">
                    @endif
                    <div>
                        <div style="font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#fab005; margin-bottom:3px;">Enrolled Course</div>
                        <div style="font-weight:700; color:#001e3c; font-size:0.95rem; line-height:1.3;">{{ $course->title }}</div>
                    </div>
                </div>

                <div style="display:flex; flex-direction:column; gap:10px; margin-bottom:28px; text-align:left;">
                    <div style="display:flex; align-items:center; gap:10px; font-size:0.85rem; color:#4a5568;">
                        <i class="fa-solid fa-user-check" style="color:#00a651; width:18px; text-align:center;"></i>
                        <span>আপনি এখন কোর্সটিতে এনরোল্ড হয়েছেন।</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; font-size:0.85rem; color:#4a5568;">
                        <i class="fa-solid fa-envelope" style="color:#0057b3; width:18px; text-align:center;"></i>
                        <span>একটি নিশ্চিতকরণ ইমেইল পাঠানো হয়েছে।</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; font-size:0.85rem; color:#4a5568;">
                        <i class="fa-solid fa-play-circle" style="color:#fab005; width:18px; text-align:center;"></i>
                        <span>My Course থেকে এখনই কোর্স শুরু করুন।</span>
                    </div>
                </div>

                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    <a href="{{ url('my-course', $course->slug) }}"
                       style="flex:1; min-width:150px; background:linear-gradient(135deg,#001e3c,#003b7a); color:#fff; padding:13px 20px; border-radius:50px; font-weight:700; font-size:0.85rem; text-decoration:none; display:inline-flex; align-items:center; justify-content:center; gap:8px; transition:all 0.3s;">
                        <i class="fa-solid fa-play"></i> কোর্স শুরু করুন
                    </a>
                    <a href="{{ route('courses') }}"
                       style="flex:1; min-width:130px; background:#f0f4f9; color:#001e3c; padding:13px 20px; border-radius:50px; font-weight:700; font-size:0.85rem; text-decoration:none; display:inline-flex; align-items:center; justify-content:center; gap:8px; border:1px solid #e4ecf5; transition:all 0.3s;">
                        <i class="fa-solid fa-grid-2"></i> সকল কোর্স
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
