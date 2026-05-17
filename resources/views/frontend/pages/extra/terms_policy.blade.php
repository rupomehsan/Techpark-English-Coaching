@php
    $meta = ['seo' => ['title' => 'Terms & Conditions — TechPark English', 'image' => asset('seo.jpg')]];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
@include('frontend.pages.extra._policy_styles')
@endpush

@section('contents')
@include('frontend.pages.extra._policy_layout', [
    'icon'       => 'fa-scale-balanced',
    'badge'      => 'Legal & Terms',
    'title'      => 'Terms & Conditions',
    'subtitle'   => 'আমাদের সেবা ব্যবহারের আগে এই শর্তাবলী মনোযোগ দিয়ে পড়ুন। এই শর্তগুলি আপনার এবং TechPark English-এর মধ্যে চুক্তি গঠন করে।',
    'icon_color' => '#fab005',
    'content'    => $website_about->description ?? '',
])
@endsection
