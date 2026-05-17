{{-- Variables: $icon, $badge, $title, $subtitle, $icon_color, $content --}}

{{-- Hero --}}
<div class="pol-hero">
    <div class="container">
        <div class="pol-hero-inner">
            <div class="pol-icon-wrap">
                <i class="fa-solid {{ $icon }}" style="color:{{ $icon_color }};"></i>
            </div>
            <div class="pol-hero-text">
                <div class="pol-badge"><i class="fa-solid {{ $icon }} me-1"></i>{{ $badge }}</div>
                <h1 class="pol-hero-title">{{ $title }}</h1>
                <p class="pol-hero-sub">{{ $subtitle }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Breadcrumb --}}
<div class="pol-breadcrumb">
    <div class="container">
        <a href="{{ route('website') }}"><i class="fa-solid fa-house me-1" style="font-size:0.7rem;"></i>Home</a>
        <span>/</span>
        <span class="current">{{ $title }}</span>
    </div>
</div>

{{-- Body --}}
<div class="pol-body">
    <div class="container">
        <div class="row g-4">

            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="pol-card">
                    <div class="pol-card-head">
                        <div class="pol-card-head-icon">
                            <i class="fa-solid {{ $icon }}"></i>
                        </div>
                        <div>
                            <div class="pol-card-head-text">{{ $title }}</div>
                            <div class="pol-card-head-sub">TechPark English — Official Document</div>
                        </div>
                    </div>
                    <div class="pol-card-body">
                        <div class="pol-prose">
                            {!! $content !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Other Policies --}}
                <div class="pol-sidebar-card">
                    <div class="pol-sidebar-card-head">
                        <i class="fa-solid fa-folder-open"></i> Other Policies
                    </div>
                    <div class="pol-sidebar-card-body" style="padding:10px 0;">
                        @php
                            $pol_links = [
                                ['route' => 'privacy.policy', 'icon' => 'fa-shield-halved', 'label' => 'Privacy Policy',    'color' => '#22c55e'],
                                ['route' => 'terms.policy',   'icon' => 'fa-scale-balanced','label' => 'Terms & Conditions', 'color' => '#fab005'],
                                ['route' => 'refund.policy',  'icon' => 'fa-rotate-left',   'label' => 'Refund Policy',      'color' => '#38bdf8'],
                            ];
                        @endphp
                        @foreach($pol_links as $pl)
                            @php $isActive = request()->routeIs($pl['route']); @endphp
                            <a href="{{ route($pl['route']) }}"
                               style="display:flex;align-items:center;gap:12px;padding:11px 18px;text-decoration:none;
                                      background:{{ $isActive ? '#eef3fc' : 'transparent' }};
                                      border-left:3px solid {{ $isActive ? '#002147' : 'transparent' }};
                                      transition:all 0.2s;"
                               onmouseover="if(!{{ $isActive ? 'true' : 'false' }})this.style.background='#f7faff'"
                               onmouseout="if(!{{ $isActive ? 'true' : 'false' }})this.style.background='transparent'">
                                <div style="width:30px;height:30px;border-radius:8px;background:rgba(0,33,71,0.07);
                                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fa-solid {{ $pl['icon'] }}" style="color:{{ $pl['color'] }};font-size:0.75rem;"></i>
                                </div>
                                <span style="font-size:0.83rem;font-weight:{{ $isActive ? '700' : '600' }};
                                             color:{{ $isActive ? '#002147' : '#4a5568' }};">{{ $pl['label'] }}</span>
                                @if($isActive)
                                    <i class="fa-solid fa-chevron-right ms-auto" style="font-size:0.6rem;color:#002147;"></i>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Contact CTA --}}
                @php
                    $pol_phones = setting('phone_numbers', true);
                    if (is_array($pol_phones) && isset($pol_phones[0]['setting_values'])) $pol_phones = $pol_phones[0]['setting_values'];
                    $pol_num = !empty($pol_phones) ? (is_array($pol_phones[0]) ? ($pol_phones[0]['value'] ?? '') : $pol_phones[0]) : '';
                @endphp
                <div class="pol-cta">
                    <div style="width:50px;height:50px;border-radius:50%;background:rgba(250,176,5,0.15);border:1px solid rgba(250,176,5,0.3);
                                display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                        <i class="fa-solid fa-headset" style="color:#fab005;font-size:1.2rem;"></i>
                    </div>
                    <div style="font-size:0.88rem;font-weight:700;color:#fff;margin-bottom:8px;">কোনো প্রশ্ন আছে?</div>
                    <p>আমাদের নীতিমালা সম্পর্কে যেকোনো প্রশ্নে আমাদের সাথে যোগাযোগ করুন।</p>
                    @if($pol_num)
                    <a href="tel:{{ $pol_num }}">
                        <i class="fa-solid fa-phone"></i> Call Us
                    </a>
                    @endif
                    <div style="margin-top:10px;">
                        <a href="{{ route('contact') }}" style="color:rgba(255,255,255,0.55);font-size:0.78rem;text-decoration:none;font-weight:600;">
                            <i class="fa-solid fa-envelope me-1"></i> Contact Page
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
