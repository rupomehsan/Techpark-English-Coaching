<div class="course_info">
    @php
        $batch_info = $batch_details;
    @endphp
    <div class="course_info_div">

        {{-- ===== Thumbnail + Play Button ===== --}}
        <div class="cic-thumb" onclick="showVideo(`{{ optional($data)->intro_video }}`)" role="button" aria-label="Watch intro video">
            <img class="cic-thumb-img" src="{{ assetHelper(optional($data)->image) }}" alt="{{ optional($data)->title }}" loading="lazy">
            <div class="cic-thumb-overlay"></div>
            <div class="cic-play-btn">
                <div class="cic-play-ring"></div>
                <i class="fa-solid fa-play cic-play-icon"></i>
            </div>
            <div class="cic-thumb-label">
                <i class="fa-solid fa-video me-1"></i> Watch Intro
            </div>
        </div>

        {{-- ===== Seats booked bar ===== --}}
        @if ($batch_info?->show_percentage_on_cards == 'yes')
            @php $pct = $batch_info->booked_percent ?? 0; @endphp
            <div class="cic-booked-bar-wrap" style="padding:10px 16px;">
                <div class="cic-booked-bar-row">
                    <span class="cic-booked-label"><i class="fa-solid fa-users me-1"></i>Seats Booked</span>
                    <span class="cic-booked-pct">{{ $pct }}%</span>
                </div>
                <div class="cic-booked-track">
                    <div class="cic-booked-fill" style="width:{{ min($pct,100) }}%"></div>
                </div>
            </div>
        @endif

        {{-- ===== Price ===== --}}
        @php
            $orig = $data->regular_price ?? 0;
            $disc = $data->sales_price ?? 0;
            $save = $orig > 0 && $disc > 0 ? round(($orig - $disc) / $orig * 100) : 0;
        @endphp
        <div class="cic-price-row">
            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 10px;">
                @if($orig > 0)
                    <div class="cic-price-block">
                        @if($disc > 0 && $disc < $orig)
                            <del class="cic-old-price">৳{{ number_format($orig, 0, '.', ',') }}</del>
                            <div class="cic-new-price">৳{{ number_format($disc, 0, '.', ',') }}</div>
                        @else
                            <div class="cic-new-price">৳{{ number_format($orig, 0, '.', ',') }}</div>
                        @endif
                    </div>
                    @if($save > 0)
                        <div class="cic-discount-badge">{{ $save }}% OFF</div>
                    @endif
                @endif

                {{-- Wishlist button (right side) --}}
                <div style="margin-left: auto;">
                    @if(Auth::check())
                        @if($data->is_in_wishlist)
                            <form id="wl-remove-{{ $data->id }}" action="{{ route('wishlist.remove', $data->id) }}" method="POST" style="display:none;">@csrf</form>
                            <button type="button" onclick="document.getElementById('wl-remove-{{ $data->id }}').submit();" class="wl-btn wl-btn-active" title="Wishlist থেকে সরান">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        @else
                            <form id="wl-add-{{ $data->id }}" action="{{ route('wishlist.add', $data->id) }}" method="POST" style="display:none;">@csrf</form>
                            <button type="button" onclick="document.getElementById('wl-add-{{ $data->id }}').submit();" class="wl-btn" title="Wishlist এ যোগ করুন">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="wl-btn" title="Wishlist এ যোগ করুন">
                            <i class="fa-regular fa-heart"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="admit_course">
            <div class="d-flex align-items-center gap-2">
                {{-- Enroll / View button --}}
                <div style="flex-grow:1;">
                    @if($check_enrolled)
                        <div class="admit_course_title_and_icon" style="opacity:0.7;cursor:not-allowed;background:linear-gradient(135deg,#00a651,#007a3d);">
                            <div class="admit_course_title"><i class="fa-solid fa-circle-check me-1"></i>Enrolled</div>
                            <div class="admit_course_icon"><i class="fa-solid fa-check"></i></div>
                        </div>
                        <a href="{{ route('mycourse_details', $data->slug) }}" style="display:block;text-align:center;font-size:0.78rem;color:var(--gold);font-weight:700;text-decoration:none;margin-top:6px;">
                            <i class="fa-solid fa-play me-1"></i>Go to Course
                        </a>
                    @elseif(Auth::check())
                        <form method="POST" action="{{ route('course.checkout', $data->slug) }}" style="display:contents;">
                            @csrf
                            <button type="submit" class="admit_course_title_and_icon" style="border:none; width:100%; cursor:pointer;">
                                <div class="admit_course_title">Enroll in Course</div>
                                <div class="admit_course_icon"><i class="fa-solid fa-lock-open"></i></div>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}?redirect={{ urlencode(route('course_details', $data->slug)) }}"
                           class="admit_course_title_and_icon">
                            <div class="admit_course_title">Login to Enroll</div>
                            <div class="admit_course_icon"><i class="fa-solid fa-right-to-bracket"></i></div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
            </div>

            <style>
            .wl-btn {
                width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0;
                background: #f0f4f8; border: 1.5px solid #dce4f0;
                color: #6b7a90; font-size: 0.82rem;
                display: inline-flex; align-items: center; justify-content: center;
                cursor: pointer; text-decoration: none;
                transition: all 0.25s ease;
            }
            .wl-btn:hover { background: #ffe4e4; border-color: #ffaaaa; color: #e63946; }
            .wl-btn.wl-btn-active { background: #ffe4e4; border-color: #ffaaaa; color: #e63946; }
            </style>


            {{-- Course Statistics Card --}}
            <div class="batch-info-card">

                {{-- Header row --}}
                <div class="batch-header">
                    <div class="batch-badge">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                    <div>
                        <div class="batch-label">কোর্স ওভারভিউ</div>
                        <div class="batch-name">এক নজরে</div>
                    </div>
                </div>

                {{-- Course Statistics --}}
                <div class="batch-meta">
                    <div class="batch-meta-item">
                        <i class="fa-solid fa-layer-group"></i>
                        <div>
                            <div class="batch-meta-label">মোট মডিউল</div>
                            <div class="batch-meta-value">{{ $data->modules_count ?? 0 }}</div>
                        </div>
                    </div>
                    <div class="batch-meta-item">
                        <i class="fa-solid fa-book"></i>
                        <div>
                            <div class="batch-meta-label">মোট ক্লাস</div>
                            <div class="batch-meta-value">{{ $data->classes_count ?? 0 }}</div>
                        </div>
                    </div>
                    <div class="batch-meta-item">
                        <i class="fa-solid fa-video"></i>
                        <div>
                            <div class="batch-meta-label">মোট ভিডিও</div>
                            <div class="batch-meta-value">{{ $data->classes_count ?? 0 }}</div>
                        </div>
                    </div>
                    <div class="batch-meta-item">
                        <i class="fa-solid fa-brain"></i>
                        <div>
                            <div class="batch-meta-label">মোট কুইজ</div>
                            <div class="batch-meta-value">{{ $data->quizzes_count ?? 0 }}</div>
                        </div>
                    </div>
                    <div class="batch-meta-item">
                        <i class="fa-solid fa-flag"></i>
                        <div>
                            <div class="batch-meta-label">মোট মাইলস্টোন</div>
                            <div class="batch-meta-value">{{ $data->milestones_count ?? 0 }}</div>
                        </div>
                    </div>
                </div>

            </div>
              {{-- Requirements/Prerequisites --}}
    @if($data->course_essential_requirements && count($data->course_essential_requirements) > 0)
    <div class="prereq-card">
        {{-- Header --}}
        <div class="prereq-header">
            <div class="prereq-badge">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <div>
                <div class="prereq-label">প্রয়োজনীয়তা</div>
                <div class="prereq-title">কোর্স করার পূর্বশর্ত</div>
            </div>
        </div>

        {{-- Requirements List --}}
        <div class="prereq-items">
            @foreach($data->course_essential_requirements as $req)
            <div class="prereq-item">
                <div class="prereq-check">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="prereq-text">{{ $req->title }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
       {{-- Hotline --}}
    @php
        $phone_numbers = setting('phone_numbers', true);
        if (is_array($phone_numbers) && isset($phone_numbers[0]['setting_values'])) {
            $phone_numbers = $phone_numbers[0]['setting_values'];
        }
    @endphp
    <div class="mt-3" style="border-radius:14px; overflow:hidden; border:1px solid #dce8f5;">
        <div style="background:linear-gradient(135deg,#001e3c,#002d5c); padding:16px 18px; text-align:center;">
            <div style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:50%; background:rgba(250,176,5,0.15); border:1px solid rgba(250,176,5,0.35); margin-bottom:10px;">
                <i class="fa-solid fa-headset" style="color:#fab005; font-size:1rem;"></i>
            </div>
            <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:rgba(255,255,255,0.5); margin-bottom:10px;">যেকোনো সহায়তায় কল করুন</div>
            @foreach($phone_numbers as $item)
                @php $phone_number = is_array($item) ? $item['value'] ?? '' : $item; @endphp
                <a href="tel:{{ $phone_number }}" style="display:flex; align-items:center; justify-content:center; gap:8px; background:rgba(250,176,5,0.12); border:1px solid rgba(250,176,5,0.3); border-radius:50px; padding:9px 18px; text-decoration:none; margin-bottom:7px; transition:all 0.25s;"
                   onmouseover="this.style.background='rgba(250,176,5,0.22)'" onmouseout="this.style.background='rgba(250,176,5,0.12)'">
                    <i class="fa-solid fa-phone" style="color:#fab005; font-size:0.8rem;"></i>
                    <span style="color:#fab005; font-weight:700; font-size:0.9rem; letter-spacing:0.3px;">{{ $phone_number }}</span>
                </a>
            @endforeach
        </div>
        <div style="background:#fffbf0; padding:10px 18px; display:flex; align-items:center; justify-content:center; gap:7px; border-top:1px solid #fef3cd;">
            <i class="fa-regular fa-clock" style="color:#c07800; font-size:0.78rem;"></i>
            <span style="font-size:0.75rem; font-weight:600; color:#c07800;">সকাল ১০টা থেকে রাত ৮টা</span>
        </div>
    </div>
        </div>
    </div>



    <style>
    .prereq-card {
        margin-top: 14px;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #dce8ff;
        background: #fff;
    }

    .prereq-header {
        display: flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #003b7a 0%, #0057b3 100%);
        padding: 12px 16px;
    }

    .prereq-badge {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(250, 176, 5, 0.2);
        border: 1px solid rgba(250, 176, 5, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fab005;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .prereq-label {
        font-size: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, 0.55);
        font-weight: 600;
    }

    .prereq-title {
        font-size: 0.88rem;
        font-weight: 700;
        color: #fff;
        margin-top: 1px;
    }

    .prereq-items {
        padding: 12px 16px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .prereq-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 8px 0;
    }

    .prereq-check {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        background: rgba(0, 86, 179, 0.12);
        color: #0057b3;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.65rem;
        flex-shrink: 0;
        margin-top: 2px;
        font-weight: 700;
    }

    .prereq-text {
        font-size: 0.78rem;
        color: #2d3a4a;
        font-weight: 500;
        line-height: 1.5;
    }
    </style>


</div>

{{-- Include frontend.js for showVideo function --}}
<script src="{{ asset('js/frontend.js') }}"></script>

{{-- Video Modal --}}
<div class="modal fade" id="story_modal" tabindex="-1" aria-labelledby="storyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!-- Video content will be inserted here -->
            </div>
        </div>
    </div>
</div>

<style>
    /* Center modal vertically and horizontally */
    .modal.fade.show .modal-dialog {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    #story_modal .modal-dialog {
        max-width: 80vw !important;
    }

    #story_modal .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        background: #000;
        width: 80vw;
        height: 85vh;
    }

    #story_modal .modal-body {
        padding: 0;
        border-radius: 12px;
        overflow: hidden;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #story_modal .modal-body iframe {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    }

    #story_modal .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(4px);
    }

    .course_details_area .course_details_part .course_info .course_info_div .admit_course .admit_course_title_and_icon .admit_course_icon.wishlist-icon {
        width: 24px;
        height: 30px;
        color: #fff;
    }

    .admit_course_icon.wishlist-icon {
        width: 24px;
        height: 30px !important;
        color: #fff;
    }
</style>
