@php
    $meta = ['seo' => ['title' => 'Privacy Policy — TechPark English', 'image' => asset('seo.jpg')]];
@endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
@include('frontend.pages.extra._policy_styles')
@endpush

@section('contents')
@include('frontend.pages.extra._policy_layout', [
    'icon'       => 'fa-shield-halved',
    'badge'      => 'Privacy & Data',
    'title'      => 'Privacy Policy',
    'subtitle'   => 'আপনার তথ্য আমাদের কাছে সুরক্ষিত। আমরা কীভাবে আপনার ডেটা ব্যবহার করি তা এখানে স্বচ্ছভাবে জানানো হয়েছে।',
    'icon_color' => '#22c55e',
    'content'    => $website_about->description ?? '',
])
@endsection
