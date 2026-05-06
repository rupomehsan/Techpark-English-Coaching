@php
    $site_name   = 'TechPark English';
    $site_url    = url('');
    $current_url = url()->current();
    $seo_title   = $seo->title       ?? $site_name;
    $seo_desc    = $seo->description ?? 'TechPark English — বাংলাদেশের অন্যতম সেরা ইংরেজি শিক্ষা প্রতিষ্ঠান। রেসিডেন্সিয়াল কোর্স, IELTS প্রস্তুতি ও স্পোকেন ইংলিশে দক্ষতা অর্জন করুন।';
    $seo_image   = $seo->image       ?? asset('seo.jpg');
    $seo_keywords = $seo->keywords   ?? 'TechPark English, ইংরেজি শিক্ষা, IELTS, Spoken English, English course Bangladesh';
    $favicon     = asset('fabicon.png');
@endphp

{{-- ══ Charset & Viewport ══ --}}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

{{-- ══ Favicon — all platforms ══ --}}
<link rel="icon" type="image/png" sizes="32x32" href="{{ $favicon }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ $favicon }}">
<link rel="shortcut icon" href="{{ $favicon }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ $favicon }}">
<meta name="msapplication-TileImage" content="{{ $favicon }}">
<meta name="msapplication-TileColor" content="#002147">
<meta name="theme-color" content="#002147">

{{-- ══ Canonical ══ --}}
<link rel="canonical" href="{{ $current_url }}">

{{-- ══ Primary SEO ══ --}}
<title>{{ $seo_title }}</title>
<meta name="description" content="{{ $seo_desc }}">
<meta name="keywords" content="{{ $seo_keywords }}">
<meta name="robots" content="index, follow, max-image-preview:large">
<meta name="author" content="{{ $site_name }}">
<meta name="copyright" content="{{ $site_url }}">

{{-- ══ Open Graph — Facebook · WhatsApp · LinkedIn · Telegram ══ --}}
<meta property="og:type"               content="website">
<meta property="og:site_name"          content="{{ $site_name }}">
<meta property="og:title"              content="{{ $seo_title }}">
<meta property="og:description"        content="{{ $seo_desc }}">
<meta property="og:url"                content="{{ $current_url }}">
<meta property="og:image"              content="{{ $seo_image }}">
<meta property="og:image:secure_url"   content="{{ $seo_image }}">
<meta property="og:image:type"         content="image/jpeg">
<meta property="og:image:width"        content="1200">
<meta property="og:image:height"       content="630">
<meta property="og:image:alt"          content="{{ $seo_title }}">
<meta property="og:locale"             content="bn_BD">
<meta property="og:locale:alternate"   content="en_US">

{{-- ══ Twitter / X Card ══ --}}
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:site"        content="@TechParkEnglish">
<meta name="twitter:title"       content="{{ $seo_title }}">
<meta name="twitter:description" content="{{ $seo_desc }}">
<meta name="twitter:image"       content="{{ $seo_image }}">
<meta name="twitter:image:alt"   content="{{ $seo_title }}">

{{-- ══ Misc / Crawlers ══ --}}
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized"  content="320">
<meta name="rating"           content="General">
<meta name="distribution"     content="Global">
<meta name="coverage"         content="Worldwide">
<meta name="identifier-URL"   content="{{ $site_url }}">
<meta name="developer"        content="Tech Park IT Limited">
<meta name="developer-email"  content="developer@techparkit.org">

{{-- ══ JSON-LD — Organisation structured data ══ --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "{{ $site_name }}",
  "url": "{{ $site_url }}",
  "logo": "{{ $favicon }}",
  "image": "{{ $seo_image }}",
  "description": "{{ $seo_desc }}",
  "sameAs": [
    "https://www.facebook.com/TechParkEnglishFB/",
    "https://www.youtube.com/@TechParkEnglish",
    "https://www.instagram.com/techparkenglish/",
    "https://www.linkedin.com/company/techparkenglish"
  ],
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+8801335119223",
    "contactType": "customer service",
    "availableLanguage": ["Bengali", "English"]
  }
}
</script>
