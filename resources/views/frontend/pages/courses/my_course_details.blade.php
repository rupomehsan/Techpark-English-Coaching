@php $meta = ['seo' => ['title' => $course->title . ' — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
:root { --navy:#001e3c; --navy2:#002d5c; --gold:#fab005; --bg:#f0f4f9; --card:#fff; --border:#e4ecf5; --radius:14px; --shadow:0 4px 24px rgba(0,30,60,0.07); }

/* Top progress bar */
.lp-topbar { background:linear-gradient(135deg,var(--navy),var(--navy2)); padding:14px 0; position:sticky; top:0; z-index:200; box-shadow:0 4px 16px rgba(0,30,60,0.25); }
.lp-topbar-inner { display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
.lp-back { color:rgba(255,255,255,0.7); text-decoration:none; font-size:0.8rem; font-weight:600; display:flex; align-items:center; gap:6px; flex-shrink:0; transition:color 0.2s; }
.lp-back:hover { color:var(--gold); }
.lp-course-name { font-weight:700; color:#fff; font-size:0.9rem; flex:1; min-width:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.lp-prog-wrap { display:flex; align-items:center; gap:10px; flex-shrink:0; }
.lp-prog-bar { width:120px; height:6px; background:rgba(255,255,255,0.15); border-radius:50px; overflow:hidden; }
.lp-prog-fill { height:100%; background:var(--gold); border-radius:50px; transition:width 0.5s; }
.lp-prog-pct { font-size:0.72rem; font-weight:700; color:var(--gold); }

/* Layout */
.lp-layout { display:flex; height:calc(100vh - 120px); min-height:500px; }
.lp-sidebar { width:340px; flex-shrink:0; background:var(--card); border-right:1px solid var(--border); display:flex; flex-direction:column; overflow:hidden; }
.lp-main { flex:1; min-width:0; overflow-y:auto; background:var(--bg); }

/* Sidebar header */
.lp-sb-head { padding:16px 18px; border-bottom:1px solid var(--border); flex-shrink:0; }
.lp-sb-title { font-weight:800; color:var(--navy); font-size:0.88rem; margin-bottom:4px; }
.lp-sb-meta { font-size:0.7rem; color:#6b7a90; display:flex; gap:10px; flex-wrap:wrap; }
.lp-sb-scroll { flex:1; overflow-y:auto; }
.lp-sb-scroll::-webkit-scrollbar { width:4px; }
.lp-sb-scroll::-webkit-scrollbar-track { background:#f0f4f9; }
.lp-sb-scroll::-webkit-scrollbar-thumb { background:#c8d9f0; border-radius:4px; }

/* Sidebar milestone / module */
.lp-milestone { border-bottom:1px solid var(--border); }
.lp-ms-head { display:flex; align-items:center; gap:10px; padding:12px 16px; cursor:pointer; user-select:none; background:#f7faff; transition:background 0.2s; }
.lp-ms-head:hover { background:#eef5ff; }
.lp-ms-badge { width:28px; height:28px; border-radius:8px; background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; display:flex; align-items:center; justify-content:center; font-size:0.65rem; font-weight:800; flex-shrink:0; }
.lp-ms-name { font-weight:700; color:var(--navy); font-size:0.82rem; flex:1; min-width:0; }
.lp-ms-chevron { color:#aaa; font-size:0.65rem; flex-shrink:0; transition:transform 0.3s; }
.lp-milestone.open .lp-ms-chevron { transform:rotate(180deg); }
.lp-ms-body { display:none; }
.lp-milestone.open .lp-ms-body { display:block; }

.lp-module { border-bottom:1px solid #f0f4f8; }
.lp-mod-head { display:flex; align-items:center; gap:8px; padding:10px 16px 10px 28px; cursor:pointer; transition:background 0.2s; }
.lp-mod-head:hover { background:#f7faff; }
.lp-mod-icon { color:#0057b3; font-size:0.72rem; flex-shrink:0; }
.lp-mod-name { font-size:0.8rem; font-weight:600; color:#2d3a4a; flex:1; min-width:0; }
.lp-mod-chevron { color:#aaa; font-size:0.6rem; flex-shrink:0; transition:transform 0.3s; }
.lp-module.open .lp-mod-chevron { transform:rotate(180deg); }
.lp-mod-body { display:none; }
.lp-module.open .lp-mod-body { display:block; }

/* Class rows in sidebar */
.lp-class-row { display:flex; align-items:center; gap:10px; padding:9px 16px 9px 36px; cursor:pointer; transition:background 0.2s; border-left:3px solid transparent; }
.lp-class-row:hover { background:#f7faff; }
.lp-class-row.active { background:#eef5ff; border-left-color:var(--navy2); }
.lp-class-row.done { border-left-color:#00a651; }
.lp-class-dot { width:20px; height:20px; border-radius:50%; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:0.6rem; }
.lp-class-dot.type-live { background:#fff0f0; color:#dc3545; }
.lp-class-dot.type-recorded { background:#eef5ff; color:#0d6efd; }
.lp-class-dot.done-dot { background:#e8fff2; color:#00a651; }
.lp-class-info { flex:1; min-width:0; }
.lp-class-label { font-size:0.6rem; font-weight:700; color:#aaa; text-transform:uppercase; letter-spacing:0.4px; }
.lp-class-name { font-size:0.78rem; font-weight:600; color:#2d3a4a; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.lp-class-row.active .lp-class-name { color:var(--navy); }

/* Quiz row in sidebar */
.lp-quiz-row { display:flex; align-items:center; gap:8px; padding:7px 16px 7px 44px; background:#fffbf0; border-top:1px solid #fef3cd; text-decoration:none; }
.lp-quiz-row:hover { background:#fff3cd; }
.lp-quiz-row i { color:#c07800; font-size:0.7rem; }
.lp-quiz-title { font-size:0.75rem; font-weight:600; color:#8a6200; flex:1; min-width:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

/* Main content */
.lp-video-section { background:#000; }
.lp-video-wrap { position:relative; width:100%; padding-bottom:56.25%; background:#000; }
.lp-video-wrap iframe { position:absolute; inset:0; width:100%; height:100%; border:0; }
#ytPlayerContainer iframe { position:absolute; inset:0; width:100%; height:100%; border:0; }
.lp-no-video { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:12px; }
.lp-no-video i { font-size:3rem; color:rgba(255,255,255,0.15); }
.lp-no-video p { color:rgba(255,255,255,0.35); font-size:0.85rem; }

/* ===== Custom Video Controls ===== */
/* Click-blocker: sits over iframe, passes clicks through except for custom controls */
.yt-click-shield {
    position:absolute; inset:0; z-index:10; cursor:pointer; background:transparent;
}
/* Big center play/pause indicator */
.yt-center-btn {
    position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
    z-index:11; pointer-events:none;
}
.yt-center-icon {
    width:64px; height:64px; border-radius:50%;
    background:rgba(0,0,0,0.55); border:2px solid rgba(255,255,255,0.3);
    display:flex; align-items:center; justify-content:center;
    color:#fff; font-size:1.4rem;
    opacity:0; transform:scale(0.7);
    transition:opacity 0.25s, transform 0.25s;
}
.yt-center-icon.flash { opacity:1; transform:scale(1); }

/* Bottom controls bar */
.yt-controls {
    position:absolute; bottom:0; left:0; right:0; z-index:12;
    background:linear-gradient(transparent, rgba(0,0,0,0.85));
    padding:28px 14px 10px;
    opacity:0; transition:opacity 0.3s;
    pointer-events:none;
}
.lp-video-wrap:hover .yt-controls,
.yt-controls.always-show { opacity:1; pointer-events:all; }

/* Progress / seek bar */
.yt-seek-wrap {
    width:100%; height:4px; background:rgba(255,255,255,0.25);
    border-radius:4px; margin-bottom:10px; cursor:pointer; position:relative;
    transition:height 0.15s;
}
.yt-seek-wrap:hover { height:7px; }
.yt-seek-buf { position:absolute; left:0; top:0; height:100%; background:rgba(255,255,255,0.3); border-radius:4px; }
.yt-seek-fill { position:absolute; left:0; top:0; height:100%; background:#fab005; border-radius:4px; }
.yt-seek-thumb {
    position:absolute; top:50%; right:0; transform:translate(50%,-50%);
    width:12px; height:12px; border-radius:50%; background:#fab005;
    display:none;
}
.yt-seek-wrap:hover .yt-seek-thumb { display:block; }

/* Bottom row */
.yt-ctrl-row { display:flex; align-items:center; gap:10px; }
.yt-btn { background:none; border:none; color:#fff; cursor:pointer; padding:4px 6px; font-size:0.9rem; display:flex; align-items:center; line-height:1; opacity:0.85; transition:opacity 0.2s; }
.yt-btn:hover { opacity:1; }
.yt-time { color:rgba(255,255,255,0.8); font-size:0.72rem; font-weight:600; white-space:nowrap; }
.yt-vol-wrap { display:flex; align-items:center; gap:6px; }
.yt-vol-slider { width:60px; height:3px; cursor:pointer; accent-color:#fab005; }
.yt-spacer { flex:1; }

/* Paused big overlay (center play button) */
.yt-paused-overlay {
    position:absolute; inset:0; z-index:11;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; background:rgba(0,0,0,0.25);
    display:none;
}
.yt-big-play {
    width:72px; height:72px; border-radius:50%;
    background:rgba(0,0,0,0.65); border:2px solid rgba(255,255,255,0.4);
    display:flex; align-items:center; justify-content:center;
    color:#fff; font-size:1.6rem; padding-left:4px;
    transition:transform 0.2s, background 0.2s;
}
.yt-paused-overlay:hover .yt-big-play { transform:scale(1.08); background:rgba(250,176,5,0.75); }

.lp-controls { padding:14px 20px; background:var(--card); border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; }
.lp-ctrl-btn { display:inline-flex; align-items:center; gap:7px; padding:9px 18px; border-radius:50px; font-weight:700; font-size:0.8rem; text-decoration:none; border:none; cursor:pointer; transition:all 0.25s; }
.btn-prev { background:#f0f4f8; color:var(--navy); }
.btn-prev:hover { background:#e2ecf5; }
.btn-next { background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; }
.btn-next:hover { background:linear-gradient(135deg,var(--gold),#e09600); box-shadow:0 5px 16px rgba(250,176,5,0.35); }
.btn-routine { background:rgba(250,176,5,0.12); color:#c07800; border:1px solid rgba(250,176,5,0.3); }
.btn-routine:hover { background:rgba(250,176,5,0.2); }
.lp-now-playing { font-size:0.78rem; font-weight:600; color:var(--navy); flex:1; min-width:0; }
.lp-now-playing small { font-size:0.68rem; color:#6b7a90; font-weight:400; display:block; }

.lp-class-info-card { margin:20px; background:var(--card); border-radius:var(--radius); border:1px solid var(--border); padding:20px 22px; }

/* Routine modal */
.routine-table { width:100%; border-collapse:collapse; font-size:0.82rem; }
.routine-table th { background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; padding:10px 14px; font-weight:600; text-align:left; }
.routine-table td { padding:10px 14px; border-bottom:1px solid var(--border); color:#4a5568; }
.routine-table tr:last-child td { border-bottom:none; }
.routine-table tr:hover td { background:#f7faff; }
.routine-month-head { background:rgba(250,176,5,0.1); border:1px solid rgba(250,176,5,0.25); border-radius:8px; padding:8px 14px; font-weight:700; color:#c07800; font-size:0.82rem; margin:14px 0 8px; }

@media(max-width:991px){
    .lp-layout { flex-direction:column; height:auto; }
    .lp-sidebar { width:100%; height:auto; max-height:360px; border-right:none; border-bottom:1px solid var(--border); }
    .lp-main { overflow-y:visible; }
    .lp-prog-bar { width:80px; }
}
</style>
@endpush

@section('contents')

{{-- Top sticky progress bar --}}
<div class="lp-topbar">
    <div class="container">
        <div class="lp-topbar-inner">
            <a href="{{ route('myCourse') }}" class="lp-back">
                <i class="fa-solid fa-arrow-left"></i> My Courses
            </a>
            <div style="width:1px;height:18px;background:rgba(255,255,255,0.15);flex-shrink:0;"></div>
            <span class="lp-course-name">{{ $course->title }}</span>
            <div class="lp-prog-wrap">
                <div class="lp-prog-bar">
                    <div class="lp-prog-fill" id="topProgressFill" style="width:{{ $progress }}%"></div>
                </div>
                <span class="lp-prog-pct">{{ $progress }}%</span>
            </div>
            <button class="lp-ctrl-btn btn-routine" onclick="document.getElementById('routineModal').classList.add('show')" style="padding:6px 14px; font-size:0.72rem;">
                <i class="fa-solid fa-calendar-days"></i> রুটিন
            </button>
        </div>
    </div>
</div>

{{-- Student Nav strip (visible on large screens as a quick-nav) --}}
<div style="background:#fff; border-bottom:1px solid #e4ecf5; padding:8px 0; display:none;" class="d-lg-block" id="lp-student-strip">
    <div class="container d-flex align-items-center gap-3" style="font-size:0.8rem;">
        @php $sidebarUser = auth()->user(); @endphp
        @if($sidebarUser->image)
            <img src="{{ asset($sidebarUser->image) }}" style="width:28px;height:28px;border-radius:50%;object-fit:cover;border:2px solid #fab005;flex-shrink:0;" alt="">
        @else
            <div style="width:28px;height:28px;border-radius:50%;background:#002d5c;display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:800;color:#fab005;flex-shrink:0;">{{ strtoupper(substr($sidebarUser->first_name ?? 'U',0,1)) }}</div>
        @endif
        <span style="font-weight:700;color:#001e3c;">{{ trim(($sidebarUser->first_name ?? '').' '.($sidebarUser->last_name ?? '')) }}</span>
        <div style="height:16px;width:1px;background:#e4ecf5;"></div>
        <a href="{{ route('myCourse') }}" style="color:#002d5c;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:5px;"><i class="fa-solid fa-book-open" style="font-size:0.72rem;color:#fab005;"></i> My Courses</a>
        <a href="{{ route('profile') }}" style="color:#002d5c;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:5px;"><i class="fa-solid fa-user" style="font-size:0.72rem;color:#fab005;"></i> Profile</a>
        <a href="{{ route('wishlist.view') }}" style="color:#002d5c;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:5px;"><i class="fa-regular fa-heart" style="font-size:0.72rem;color:#fab005;"></i> Wishlist</a>
    </div>
</div>
<style>#lp-student-strip { display:block !important; }</style>

{{-- LMS Layout --}}
<div class="lp-layout">

    {{-- Curriculum Sidebar --}}
    <div class="lp-sidebar">
        <div class="lp-sb-head">
            <div class="lp-sb-title">কোর্স কারিকুলাম</div>
            <div class="lp-sb-meta">
                @php
                    $totalClasses = 0;
                    foreach($course->milestones as $ms) foreach($ms->modules as $mod) $totalClasses += $mod->classes->count();
                @endphp
                <span><i class="fa-solid fa-play me-1" style="color:var(--gold);"></i>{{ $totalClasses }} Classes</span>
                <span><i class="fa-solid fa-layer-group me-1" style="color:#0057b3;"></i>{{ $course->milestones->count() }} Milestones</span>
            </div>
        </div>
        <div class="lp-sb-scroll">
            @foreach($course->milestones as $msIdx => $milestone)
                @if($milestone->modules->count())
                <div class="lp-milestone {{ $msIdx === 0 ? 'open' : '' }}">
                    <div class="lp-ms-head" onclick="this.closest('.lp-milestone').classList.toggle('open')">
                        <div class="lp-ms-badge">{{ $milestone->milestone_no }}</div>
                        <span class="lp-ms-name">{{ $milestone->title }}</span>
                        <i class="fa-solid fa-chevron-down lp-ms-chevron"></i>
                    </div>
                    <div class="lp-ms-body">
                        @foreach($milestone->modules as $modIdx => $module)
                        <div class="lp-module {{ $msIdx === 0 && $modIdx === 0 ? 'open' : '' }}">
                            <div class="lp-mod-head" onclick="this.closest('.lp-module').classList.toggle('open')">
                                <i class="fa-solid fa-cubes lp-mod-icon"></i>
                                <span class="lp-mod-name">{{ $module->module_no }}. {{ $module->title }}</span>
                                <i class="fa-solid fa-chevron-down lp-mod-chevron"></i>
                            </div>
                            <div class="lp-mod-body">
                                @foreach($module->classes as $class)
                                @php $isDone = $class->is_complete; @endphp
                                <div class="lp-class-row {{ $isDone ? 'done' : '' }}"
                                     data-video="{{ $class->class_video_link }}"
                                     data-title="{{ $class->title }}"
                                     data-type="{{ $class->type }}"
                                     data-classno="{{ $class->class_no }}"
                                     onclick="playClass(this, {{ $course->id }}, {{ $milestone->id }}, {{ $module->id }}, {{ $class->id }})">
                                    <div class="lp-class-dot {{ $isDone ? 'done-dot' : ($class->type === 'live' ? 'type-live' : 'type-recorded') }}">
                                        @if($isDone)
                                            <i class="fa-solid fa-check"></i>
                                        @elseif($class->type === 'live')
                                            <i class="fa-solid fa-video"></i>
                                        @else
                                            <i class="fa-solid fa-play"></i>
                                        @endif
                                    </div>
                                    <div class="lp-class-info">
                                        <div class="lp-class-label">Class {{ $class->class_no }} · {{ $class->type === 'live' ? 'Live' : 'Recorded' }}</div>
                                        <div class="lp-class-name">{{ $class->title }}</div>
                                    </div>
                                </div>
                                @if($class->class_quiz && $class->class_quiz->quiz)
                                <a href="{{ route('quiz.show', $class->class_quiz->quiz->slug) }}?courseid={{ $course->id }}&classid={{ $class->id }}"
                                   class="lp-quiz-row"
                                   onclick="courseCompletion({{ $course->id }}, {{ $milestone->id }}, {{ $module->id }}, {{ $class->id }}, '{{ $class->class_quiz->quiz->id }}')">
                                    @if($class->class_quiz->is_complete)
                                        <i class="fa-solid fa-circle-check" style="color:#00a651;"></i>
                                    @else
                                        <i class="fa-solid fa-file-pen"></i>
                                    @endif
                                    <span class="lp-quiz-title">Quiz: {{ $class->class_quiz->quiz->title }}</span>
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- Main area --}}
    <div class="lp-main">
        {{-- Video player --}}
        <div class="lp-video-section">
            <div class="lp-video-wrap" id="videoWrap" oncontextmenu="return false;">
                {{-- YouTube player mounts here --}}
                <div id="ytPlayerContainer" style="position:absolute;inset:0;width:100%;height:100%;background:#000;"></div>
                {{-- Fallback iframe for non-YouTube --}}
                <iframe id="classVideoIframe" src="" allowfullscreen allow="autoplay; encrypted-media; picture-in-picture" style="display:none;"></iframe>
                {{-- Empty state --}}
                <div class="lp-no-video" id="noVideoMsg">
                    <i class="fa-solid fa-circle-play"></i>
                    <p>বাম পাশ থেকে ক্লাস সিলেক্ট করুন</p>
                </div>
                {{-- Click shield: intercepts clicks on iframe, toggles play/pause --}}
                <div class="yt-click-shield" id="ytClickShield" onclick="togglePlayPause()" style="display:none;"></div>
                {{-- Paused overlay with big play button --}}
                <div class="yt-paused-overlay" id="ytPausedOverlay" onclick="resumeVideo()">
                    <div class="yt-big-play"><i class="fa-solid fa-play"></i></div>
                </div>
                {{-- Flash icon on click --}}
                <div class="yt-center-btn" id="ytCenterBtn">
                    <div class="yt-center-icon" id="ytCenterIcon"><i class="fa-solid fa-play" id="ytCenterIconI"></i></div>
                </div>
                {{-- Custom controls bar --}}
                <div class="yt-controls" id="ytCustomControls" style="display:none;">
                    <div class="yt-seek-wrap" id="ytSeekWrap" onmousedown="seekStart(event)" onclick="seekClick(event)">
                        <div class="yt-seek-buf" id="ytSeekBuf" style="width:0%"></div>
                        <div class="yt-seek-fill" id="ytSeekFill" style="width:0%">
                            <div class="yt-seek-thumb"></div>
                        </div>
                    </div>
                    <div class="yt-ctrl-row">
                        <button class="yt-btn" onclick="togglePlayPause()" id="ytPlayBtn"><i class="fa-solid fa-play"></i></button>
                        <span class="yt-time" id="ytTime">0:00 / 0:00</span>
                        <div class="yt-spacer"></div>
                        <div class="yt-vol-wrap">
                            <button class="yt-btn" onclick="toggleMute()" id="ytMuteBtn"><i class="fa-solid fa-volume-high"></i></button>
                            <input type="range" class="yt-vol-slider" id="ytVolSlider" min="0" max="100" value="100" oninput="setVolume(this.value)">
                        </div>
                        <button class="yt-btn" onclick="toggleFullscreen()" title="Fullscreen"><i class="fa-solid fa-expand"></i></button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Controls --}}
        <div class="lp-controls">
            <button class="lp-ctrl-btn btn-prev" onclick="prevVideo()">
                <i class="fa-solid fa-chevron-left"></i> Prev
            </button>
            <div class="lp-now-playing">
                <span id="nowPlayingTitle">—</span>
                <small id="nowPlayingMeta"></small>
            </div>
            <button class="lp-ctrl-btn btn-next" onclick="nextVideo()">
                Next <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        {{-- Class info --}}
        <div class="lp-class-info-card">
            <div style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.6px;color:var(--gold);margin-bottom:8px;">
                <i class="fa-solid fa-circle-info me-1"></i> এই ক্লাস সম্পর্কে
            </div>
            <p style="font-size:0.88rem;color:#4a5568;margin:0;" id="classInfoText">
                বাম পাশের কারিকুলাম থেকে যেকোনো ক্লাসে ক্লিক করে শুরু করুন।
            </p>
        </div>
    </div>
</div>

{{-- Routine Modal --}}
<div id="routineModal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.6); align-items:center; justify-content:center;" onclick="if(event.target===this){this.classList.remove('show');}">
    <div style="background:#fff; border-radius:16px; max-width:700px; width:90%; max-height:80vh; overflow:hidden; display:flex; flex-direction:column; box-shadow:0 20px 60px rgba(0,0,0,0.3);">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 22px;border-bottom:1px solid var(--border); background:linear-gradient(135deg,var(--navy),var(--navy2));">
            <span style="font-weight:700;color:#fff;">ক্লাস রুটিন</span>
            <button onclick="document.getElementById('routineModal').classList.remove('show')" style="background:rgba(255,255,255,0.1);border:none;color:#fff;width:30px;height:30px;border-radius:50%;cursor:pointer;font-size:0.9rem;">✕</button>
        </div>
        <div style="overflow-y:auto;padding:20px;">
            @if(isset($course->routines) && count($course->routines) > 0)
                @foreach($course->routines as $month => $routineItems)
                    <div class="routine-month-head"><i class="fa-solid fa-calendar me-2"></i>{{ $month }}</div>
                    <table class="routine-table">
                        <thead><tr><th>ক্লাস</th><th>তারিখ</th><th>সময়</th><th>টপিক</th></tr></thead>
                        <tbody>
                            @foreach($routineItems as $r)
                            <tr>
                                <td>ক্লাস {{ $r->class?->class_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->date)->format('d M Y, l') }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->time)->format('g:i A') }}</td>
                                <td>{{ $r->class?->type === 'recorded' ? 'রেকর্ডেড: ' : 'লাইভ: ' }}{{ $r->topic }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            @else
                <p style="text-align:center;color:#6b7a90;padding:30px 0;">কোনো রুটিন পাওয়া যায়নি।</p>
            @endif
        </div>
    </div>
</div>

<script>
// Build flat class list
const allClasses = [];
@php
    $allClassesArr = [];
    foreach($course->milestones as $ms) {
        if($ms->modules->count()) {
            foreach($ms->modules as $mod) {
                foreach($mod->classes as $cl) {
                    $allClassesArr[] = $cl;
                }
            }
        }
    }
@endphp
@foreach($allClassesArr as $cl)
allClasses.push({ video: '{{ $cl->class_video_link }}', title: '{{ addslashes($cl->title) }}', type: '{{ $cl->type }}', no: {{ $cl->class_no }} });
@endforeach

let currentIdx = 0;
let ytPlayer   = null;
let ytApiReady = false;
let pendingVideoId = null;
let progressTimer  = null;
let isMuted = false;

function getYtId(url) {
    if (!url) return null;
    let m;
    m = url.match(/[?&]v=([^&#]+)/);            if (m) return m[1];
    m = url.match(/youtu\.be\/([^?&#]+)/);       if (m) return m[1];
    m = url.match(/youtube\.com\/embed\/([^?&#]+)/); if (m) return m[1];
    return null;
}

function onYouTubeIframeAPIReady() {
    ytApiReady = true;
    if (pendingVideoId) { loadYtVideo(pendingVideoId); pendingVideoId = null; }
}

function showCustomControls(show) {
    const ctrl  = document.getElementById('ytCustomControls');
    const shield = document.getElementById('ytClickShield');
    if (ctrl)   ctrl.style.display   = show ? '' : 'none';
    if (shield) shield.style.display = show ? '' : 'none';
}

function onPlayerStateChange(e) {
    const pausedOvr = document.getElementById('ytPausedOverlay');
    const playBtn   = document.getElementById('ytPlayBtn');
    // 0=ended, 1=playing, 2=paused, 3=buffering
    if (e.data === 1 || e.data === 3) {
        pausedOvr.style.display = 'none';
        if (playBtn) playBtn.innerHTML = '<i class="fa-solid fa-pause"></i>';
        startProgressTimer();
    } else {
        pausedOvr.style.display = 'flex';
        if (playBtn) playBtn.innerHTML = '<i class="fa-solid fa-play"></i>';
        stopProgressTimer();
    }
}

function startProgressTimer() {
    stopProgressTimer();
    progressTimer = setInterval(updateProgress, 500);
}
function stopProgressTimer() {
    if (progressTimer) { clearInterval(progressTimer); progressTimer = null; }
}

function updateProgress() {
    if (!ytPlayer || !ytPlayer.getCurrentTime) return;
    try {
        const cur = ytPlayer.getCurrentTime() || 0;
        const dur = ytPlayer.getDuration()    || 1;
        const pct = (cur / dur * 100).toFixed(2);
        const buf = (ytPlayer.getVideoLoadedFraction() * 100).toFixed(2);
        const fill = document.getElementById('ytSeekFill');
        const bufEl = document.getElementById('ytSeekBuf');
        const timeEl = document.getElementById('ytTime');
        if (fill)  fill.style.width  = pct + '%';
        if (bufEl) bufEl.style.width = buf + '%';
        if (timeEl) timeEl.textContent = fmtTime(cur) + ' / ' + fmtTime(dur);
    } catch(e){}
}

function fmtTime(s) {
    s = Math.floor(s);
    const m = Math.floor(s/60), sec = s%60;
    return m + ':' + (sec < 10 ? '0' : '') + sec;
}

function loadYtVideo(videoId) {
    document.getElementById('classVideoIframe').style.display = 'none';
    document.getElementById('noVideoMsg').style.display       = 'none';
    showCustomControls(true);

    if (!ytApiReady) { pendingVideoId = videoId; return; }

    const container = document.getElementById('ytPlayerContainer');
    if (ytPlayer) {
        ytPlayer.loadVideoById(videoId);
        return;
    }
    container.innerHTML = '<div id="ytPlayer" style="width:100%;height:100%;"></div>';
    ytPlayer = new YT.Player('ytPlayer', {
        videoId: videoId,
        width: '100%', height: '100%',
        playerVars: {
            autoplay: 1,
            controls: 0,       // ← hides ALL YouTube UI
            rel: 0,
            modestbranding: 1,
            iv_load_policy: 3,
            showinfo: 0,
            disablekb: 1,
            playsinline: 1,
            fs: 0,             // disable YouTube fullscreen button (we have our own)
            enablejsapi: 1,
        },
        events: { onStateChange: onPlayerStateChange }
    });
}

function togglePlayPause() {
    if (!ytPlayer) return;
    const state = ytPlayer.getPlayerState();
    if (state === 1 || state === 3) {
        ytPlayer.pauseVideo();
        flashIcon('pause');
    } else {
        ytPlayer.playVideo();
        flashIcon('play');
    }
}

function resumeVideo() {
    if (!ytPlayer) return;
    ytPlayer.playVideo();
    document.getElementById('ytPausedOverlay').style.display = 'none';
    flashIcon('play');
}

function flashIcon(type) {
    const icon = document.getElementById('ytCenterIcon');
    const iconI = document.getElementById('ytCenterIconI');
    if (!icon) return;
    iconI.className = type === 'play' ? 'fa-solid fa-play' : 'fa-solid fa-pause';
    icon.classList.add('flash');
    setTimeout(() => icon.classList.remove('flash'), 600);
}

function seekClick(e) {
    if (!ytPlayer || !ytPlayer.getDuration) return;
    const rect = e.currentTarget.getBoundingClientRect();
    const pct  = (e.clientX - rect.left) / rect.width;
    ytPlayer.seekTo(ytPlayer.getDuration() * pct, true);
    updateProgress();
}

let isSeeking = false;
function seekStart(e) { isSeeking = true; seekClick(e); }
document.addEventListener('mouseup',   () => { isSeeking = false; });
document.addEventListener('mousemove', (e) => {
    if (!isSeeking) return;
    const wrap = document.getElementById('ytSeekWrap');
    if (!wrap) return;
    const rect = wrap.getBoundingClientRect();
    const pct  = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
    if (ytPlayer && ytPlayer.getDuration) ytPlayer.seekTo(ytPlayer.getDuration() * pct, true);
    updateProgress();
});

function toggleMute() {
    if (!ytPlayer) return;
    isMuted = !isMuted;
    isMuted ? ytPlayer.mute() : ytPlayer.unMute();
    const btn = document.getElementById('ytMuteBtn');
    if (btn) btn.innerHTML = isMuted
        ? '<i class="fa-solid fa-volume-xmark"></i>'
        : '<i class="fa-solid fa-volume-high"></i>';
}

function setVolume(val) {
    if (ytPlayer) { ytPlayer.setVolume(val); if (val > 0 && isMuted) { ytPlayer.unMute(); isMuted = false; } }
    const btn = document.getElementById('ytMuteBtn');
    if (btn) btn.innerHTML = val == 0 ? '<i class="fa-solid fa-volume-xmark"></i>' : '<i class="fa-solid fa-volume-high"></i>';
}

function toggleFullscreen() {
    const wrap = document.getElementById('videoWrap');
    if (!document.fullscreenElement) {
        wrap.requestFullscreen().catch(()=>{});
    } else {
        document.exitFullscreen();
    }
}

function playNonYt(url) {
    if (ytPlayer) { try { ytPlayer.destroy(); } catch(e){} ytPlayer = null; }
    document.getElementById('ytPlayerContainer').innerHTML = '';
    showCustomControls(false);
    document.getElementById('ytPausedOverlay').style.display = 'none';
    const iframe = document.getElementById('classVideoIframe');
    iframe.src = url;
    iframe.style.display = '';
    document.getElementById('noVideoMsg').style.display = 'none';
}

function playClass(el, courseId, msId, modId, classId) {
    const video = el.dataset.video;
    const title = el.dataset.title;
    const type  = el.dataset.type;
    const no    = el.dataset.classno;

    document.querySelectorAll('.lp-class-row').forEach(r => r.classList.remove('active'));
    el.classList.add('active');
    currentIdx = allClasses.findIndex(c => c.title === title && c.no == no);

    if (video) {
        const ytId = getYtId(video);
        if (ytId) { loadYtVideo(ytId); } else { playNonYt(video); }
    } else {
        if (ytPlayer) { try { ytPlayer.destroy(); } catch(e){} ytPlayer = null; }
        document.getElementById('ytPlayerContainer').innerHTML = '';
        document.getElementById('classVideoIframe').style.display = 'none';
        showCustomControls(false);
        document.getElementById('noVideoMsg').style.display = 'flex';
    }

    document.getElementById('nowPlayingTitle').textContent = title;
    document.getElementById('nowPlayingMeta').textContent  = `Class ${no} · ${type === 'live' ? 'Live Class' : 'Recorded'}`;
    document.getElementById('classInfoText').textContent   = title;
    document.querySelector('.lp-main').scrollTo({ top: 0, behavior: 'smooth' });
    courseCompletion(courseId, msId, modId, classId);
}

function nextVideo() {
    if (currentIdx < allClasses.length - 1) {
        currentIdx++;
        const rows = document.querySelectorAll('.lp-class-row');
        if (rows[currentIdx]) rows[currentIdx].click();
    }
}
function prevVideo() {
    if (currentIdx > 0) {
        currentIdx--;
        const rows = document.querySelectorAll('.lp-class-row');
        if (rows[currentIdx]) rows[currentIdx].click();
    }
}

function courseCompletion(courseId, mileStoneId, moduleId, classId, quizId) {
    fetch('/course_completion', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: JSON.stringify({ course_id: courseId, milestone_id: mileStoneId, module_id: moduleId, class_id: classId, quiz_id: quizId })
    }).catch(() => {});
}

// Modal show/hide
document.getElementById('routineModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('show');
});
const routineObserver = new MutationObserver(function(muts) {
    muts.forEach(m => {
        if (m.attributeName === 'class') {
            const el = document.getElementById('routineModal');
            el.style.display = el.classList.contains('show') ? 'flex' : 'none';
        }
    });
});
routineObserver.observe(document.getElementById('routineModal'), { attributes: true });

// Load YouTube IFrame API
(function() {
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    var first = document.getElementsByTagName('script')[0];
    first.parentNode.insertBefore(tag, first);
})();

// Auto-play first class
document.addEventListener('DOMContentLoaded', function() {
    @php
        $firstClassForPage = null;
        foreach($course->milestones as $ms) {
            if($ms->modules->count()) {
                foreach($ms->modules as $mod) {
                    if($mod->classes->count()) {
                        $firstClassForPage = $mod->classes->first();
                        break 2;
                    }
                }
            }
        }
    @endphp
    @if($firstClassForPage && $firstClassForPage->class_video_link)
    const firstRow = document.querySelector('.lp-class-row');
    if (firstRow) firstRow.click();
    @endif
});
</script>
@endsection
