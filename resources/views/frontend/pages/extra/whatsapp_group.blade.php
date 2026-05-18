@php
    $wa_link       = ($course && $course->whatsapp_group_link) ? $course->whatsapp_group_link : 'https://chat.whatsapp.com/Ij4HudUwPlK4nB7W2n4ufI?s=cl&p=a&mlu=1';
    $course_name   = $course ? $course->title : null;
    $page_title    = $course_name ? $course_name . ' — WhatsApp Group' : 'WhatsApp Group — TechPark English';
    $meta = ['seo' => ['title' => $page_title, 'image' => asset('seo.jpg')]];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
.wa-page {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 16px;
    background: #f0faf3;
}
.wa-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 40px rgba(37,211,102,0.12);
    padding: 52px 40px 44px;
    max-width: 480px;
    width: 100%;
    text-align: center;
}
.wa-icon-wrap {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #25d366;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    box-shadow: 0 4px 20px rgba(37,211,102,0.35);
}
.wa-icon-wrap i {
    font-size: 2.4rem;
    color: #fff;
}
.wa-title {
    font-size: 1.6rem;
    font-weight: 800;
    color: #1a1a2e;
    margin-bottom: 12px;
}
.wa-subtitle {
    font-size: 0.96rem;
    color: #6b7280;
    margin-bottom: 32px;
    line-height: 1.6;
}
.wa-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #25d366;
    color: #fff !important;
    font-size: 1rem;
    font-weight: 700;
    padding: 16px 36px;
    border-radius: 50px;
    text-decoration: none !important;
    box-shadow: 0 4px 18px rgba(37,211,102,0.4);
    transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
}
.wa-btn:hover {
    background: #1ebe5d;
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(37,211,102,0.45);
}
.wa-btn i {
    font-size: 1.2rem;
}
.wa-note {
    margin-top: 22px;
    font-size: 0.8rem;
    color: #9ca3af;
}
</style>
@endpush

@section('contents')

{{-- Breadcrumb --}}


<div class="wa-page">
    <div class="wa-card">
        <div class="wa-icon-wrap">
            <i class="fa-brands fa-whatsapp"></i>
        </div>
        @if($course_name)
            <h1 class="wa-title"> <strong>{{ $course_name }}</strong>- ব্যাচের গ্রুপে জয়েন করুন <br></h1>
            <p class="wa-subtitle">
            {{ $course_name ?? "TechPark English" }} ব্যাচের ফ্রি ক্লাসের লিংক কেবল এই গ্রুপেই শেয়ার করা হবে।ফ্রি ক্লাসের লিংক পেতে ও কোর্স সম্পর্কে বিস্তারিত জানতে গ্রুপে জয়েন করুন।
            </p>
        @else
            <h1 class="wa-title"> <strong>Spoken English With Phonetics (SSC Special) ব্যাচের গ্রুপে যুক্ত হোন <br></h1>
            <p class="wa-subtitle">
              Spoken English With Phonetics (SSC Special) ব্যাচের ফ্রি ক্লাসের লিংক কেবল এই গ্রুপেই শেয়ার করা হবে।ফ্রি ক্লাসের লিংক পেতে ও কোর্স সম্পর্কে বিস্তারিত জানতে গ্রুপে যুক্ত হোন।
            </p>
        @endif

        <a href="{{ $wa_link }}" target="_blank" rel="noopener noreferrer" class="wa-btn">
            <i class="fa-brands fa-whatsapp"></i>
            Join WhatsApp Group
        </a>
        <p class="wa-note">
            <i class="fa-solid fa-lock me-1"></i>
            লিংকে ক্লিক করলে সরাসরি WhatsApp খুলবে।
        </p>
    </div>
</div>

@endsection
