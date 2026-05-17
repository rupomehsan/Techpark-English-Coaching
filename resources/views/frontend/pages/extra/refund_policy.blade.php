@php
    $meta = ['seo' => ['title' => 'Refund Policy — TechPark English', 'image' => asset('seo.jpg')]];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
@include('frontend.pages.extra._policy_styles')
@endpush

@section('contents')
@include('frontend.pages.extra._policy_layout', [
    'icon'       => 'fa-rotate-left',
    'badge'      => 'Refund & Return',
    'title'      => 'Refund Policy',
    'subtitle'   => 'আমরা আপনার সন্তুষ্টিকে সর্বোচ্চ অগ্রাধিকার দিই। আমাদের রিফান্ড নীতি সম্পর্কে বিস্তারিত জানুন।',
    'icon_color' => '#38bdf8',
    'content'    => $website_about->description ?? '',
])
@endsection
