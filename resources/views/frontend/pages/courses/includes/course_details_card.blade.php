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

        {{-- ===== Timer ===== --}}
        <div class="course_info_time">
            <span class="time_have_title">Enrollment closes in</span>
            <ul class="timer">
                <li class="d-none">
                    <div class="amount" data-years></div>
                    <div class="timer-label">Yrs</div>
                </li>
                <li>
                    <div class="amount" data-days></div>
                    <div class="timer-label">Days</div>
                </li>
                <li class="timer-sep">:</li>
                <li>
                    <div class="amount" data-hours></div>
                    <div class="timer-label">Hrs</div>
                </li>
                <li class="timer-sep">:</li>
                <li>
                    <div class="amount" data-minutes></div>
                    <div class="timer-label">Min</div>
                </li>
                <li class="timer-sep">:</li>
                <li>
                    <div class="amount" data-seconds></div>
                    <div class="timer-label">Sec</div>
                </li>
            </ul>

            @if ($batch_info?->show_percentage_on_cards == 'yes')
                @php $pct = $batch_info->booked_percent ?? 0; @endphp
                <div class="cic-booked-bar-wrap">
                    <div class="cic-booked-bar-row">
                        <span class="cic-booked-label"><i class="fa-solid fa-users me-1"></i>Seats Booked</span>
                        <span class="cic-booked-pct">{{ $pct }}%</span>
                    </div>
                    <div class="cic-booked-track">
                        <div class="cic-booked-fill" style="width:{{ min($pct,100) }}%"></div>
                    </div>
                </div>
            @endif
        </div>

        {{-- ===== Price ===== --}}
        <div class="cic-price-row">
            @if ($batch_info)
                <div class="cic-price-block">
                    <del class="cic-old-price">৳{{ number_format($batch_info->course_price ?? 0, 0, '.', ',') }}</del>
                    <div class="cic-new-price">৳{{ number_format($batch_info->after_discount_price ?? 0, 0, '.', ',') }}</div>
                </div>
                @php
                    $orig = $batch_info->course_price ?? 0;
                    $disc = $batch_info->after_discount_price ?? 0;
                    $save = $orig > 0 ? round(($orig - $disc) / $orig * 100) : 0;
                @endphp
                @if($save > 0)
                    <div class="cic-discount-badge">{{ $save }}% OFF</div>
                @endif
            @else
                <div class="cic-price-block">
                    <div class="cic-new-price">৳{{ number_format($batch_info->course_price ?? 0, 0, '.', ',') }}</div>
                </div>
            @endif
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

                {{-- Wishlist button --}}
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


            {{-- Batch Info Card --}}
            <div class="batch-info-card">

                {{-- Header row --}}
                <div class="batch-header">
                    <div class="batch-badge">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <div class="batch-label">Current Batch</div>
                        <div class="batch-name">{{ $batch_info->batch_name }}</div>
                    </div>
                </div>

                {{-- Admission dates --}}
                <div class="batch-dates-grid">
                    <div class="batch-date-item batch-date-start">
                        <div class="batch-date-icon">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <div class="batch-date-body">
                            <div class="batch-date-label">Admission Opens</div>
                            <div class="batch-date-value">{{ \Carbon\Carbon::parse($batch_info->admission_start_date)->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div class="batch-date-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="batch-date-item batch-date-end">
                        <div class="batch-date-icon">
                            <i class="fa-regular fa-calendar-xmark"></i>
                        </div>
                        <div class="batch-date-body">
                            <div class="batch-date-label">Admission Closes</div>
                            <div class="batch-date-value">{{ \Carbon\Carbon::parse($batch_info->admission_end_date)->format('d M Y') }}</div>
                            <div class="batch-date-time">{{ \Carbon\Carbon::parse($batch_info->admission_end_date)->format('g:i A') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Class details --}}
                <div class="batch-meta">
                    <div class="batch-meta-item">
                        <i class="fa-solid fa-flag-checkered"></i>
                        <div>
                            <div class="batch-meta-label">First Class</div>
                            <div class="batch-meta-value">{{ \Carbon\Carbon::parse($batch_info->first_class_date)->format('d M Y, l') }}</div>
                        </div>
                    </div>
                    <div class="batch-meta-item">
                        <i class="fa-solid fa-calendar-week"></i>
                        <div>
                            <div class="batch-meta-label">Class Days</div>
                            <div class="batch-meta-value">{{ $batch_info->class_days }}</div>
                        </div>
                    </div>
                    <div class="batch-meta-item">
                        <i class="fa-regular fa-clock"></i>
                        <div>
                            <div class="batch-meta-label">Class Time</div>
                            <div class="batch-meta-value">{{ \Carbon\Carbon::parse($batch_info->class_start_time)->format('g:i A') }} – {{ \Carbon\Carbon::parse($batch_info->class_end_time)->format('g:i A') }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Requirements --}}
    @if($data->course_essential_requirements && count($data->course_essential_requirements) > 0)
    <div style="padding:0 16px 16px;">
        <div style="font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#6b7a90; margin-bottom:10px; display:flex; align-items:center; gap:8px;">
            <i class="fa-solid fa-circle-exclamation" style="color:#fab005;"></i> কোর্স করার পূর্বশর্ত
        </div>
        <div style="display:flex; flex-direction:column; gap:6px;">
            @foreach($data->course_essential_requirements as $req)
            <div style="display:flex; align-items:flex-start; gap:9px; background:#f7faff; border:1px solid #e4ecf5; border-radius:8px; padding:9px 12px;">
                <div style="width:20px; height:20px; border-radius:50%; background:rgba(250,176,5,0.15); display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px;">
                    <i class="fa-solid fa-check" style="font-size:0.55rem; color:#c07800;"></i>
                </div>
                <span style="font-size:0.82rem; color:#2d3a4a; font-weight:500; line-height:1.4;">{{ $req->title }}</span>
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
    <div style="margin:0 16px 16px; border-radius:14px; overflow:hidden; border:1px solid #dce8f5;">
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

<script src="/js/plugins/countdown.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const timerElement = document.querySelector('.timer');

        // Function to convert numbers to Bengali numerals
        function convertToBangla(number) {
            const banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            return number.toString().split('').map(digit => banglaDigits[digit] || digit).join('');
        }
        @if ($formattedDate)
            timezz(timerElement, {
                date: "{{ $formattedDate }}",
                pause: false,
                stopOnZero: true,
                update(event) {
                    if (event.total <= 0) {
                        document.querySelector("[data-days]").innerText = "০";
                        document.querySelector("[data-hours]").innerText = "০";
                        document.querySelector("[data-minutes]").innerText = "০";
                        document.querySelector("[data-seconds]").innerText = "০";
                    } else {
                        const daysElement = document.querySelector("[data-days]");
                        const hoursElement = document.querySelector("[data-hours]");
                        const minutesElement = document.querySelector("[data-minutes]");
                        const secondsElement = document.querySelector("[data-seconds]");

                        //  if (daysElement) daysElement.innerText = convertToBangla(event.days);
                        //  if (hoursElement) hoursElement.innerText = convertToBangla(event.hours);
                        //  if (minutesElement) minutesElement.innerText = convertToBangla(event.minutes);
                        //  if (secondsElement) secondsElement.innerText = convertToBangla(event.seconds);
                    }
                },
            });
        @endif

    });
</script>

{{-- Include frontend.js for showVideo function --}}
<script src="{{ asset('js/frontend.js') }}"></script>

{{-- Video Modal --}}
<div class="modal fade" id="story_modal" tabindex="-1" aria-labelledby="storyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Video content will be inserted here -->
            </div>
        </div>
    </div>
</div>

<style>
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
