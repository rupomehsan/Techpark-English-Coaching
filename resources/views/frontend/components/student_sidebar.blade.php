@php
    $sidebarUser = $user ?? auth()->user();
    $currentRoute = request()->route()->getName();
    $enrolled = 0;
    $enrolledLive = 0;
    try { $enrolled = \App\Modules\Management\CourseManagement\CourseBatchStudent\Models\Model::where('student_id', $sidebarUser->id)->count(); } catch(\Exception $e) {}
    try { $enrolledLive = \App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Models\Model::where('student_id', $sidebarUser->id)->count(); } catch(\Exception $e) {}
@endphp

<div class="student-sidebar">
    {{-- Avatar zone --}}
    <div class="ssb-avatar-zone">
        @if($sidebarUser->image)
            <img class="ssb-avatar" src="{{ asset($sidebarUser->image) }}" alt="{{ $sidebarUser->first_name }}">
        @else
            <div class="ssb-avatar-placeholder">{{ strtoupper(substr($sidebarUser->first_name ?? 'U', 0, 1)) }}</div>
        @endif
        <div class="ssb-name">{{ trim(($sidebarUser->first_name ?? '') . ' ' . ($sidebarUser->last_name ?? '')) }}</div>
        <div class="ssb-email">{{ $sidebarUser->email }}</div>
        <div class="ssb-stats">
            <div class="ssb-stat">
                <div class="ssb-stat-num">{{ $enrolled }}</div>
                <div class="ssb-stat-lbl">Online</div>
            </div>
            <div class="ssb-stat">
                <div class="ssb-stat-num">{{ $enrolledLive }}</div>
                <div class="ssb-stat-lbl">Live</div>
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <ul class="ssb-nav">
        <li>
            <a href="{{ route('profile') }}" class="{{ $currentRoute === 'profile' ? 'active' : '' }}">
                <span class="ssb-ico"><i class="fa-solid fa-user"></i></span>
                <span>Profile</span>
            </a>
        </li>
        <li>
            <a href="{{ route('myCourse') }}" class="{{ in_array($currentRoute, ['myCourse','mycourse_details']) ? 'active' : '' }}">
                <span class="ssb-ico"><i class="fa-solid fa-book-open"></i></span>
                <span>Online Courses</span>
            </a>
        </li>
        <li>
            <a href="{{ route('myLiveCourses') }}" class="{{ $currentRoute === 'myLiveCourses' ? 'active' : '' }}">
                <span class="ssb-ico"><i class="fa-solid fa-chalkboard-user"></i></span>
                <span>Live Courses</span>
            </a>
        </li>
        <li>
            <a href="{{ route('wishlist.view') }}" class="{{ $currentRoute === 'wishlist.view' ? 'active' : '' }}">
                <span class="ssb-ico"><i class="fa-regular fa-heart"></i></span>
                <span>Wishlist</span>
            </a>
        </li>
        <li>
            <a href="{{ route('change.password') }}" class="{{ $currentRoute === 'change.password' ? 'active' : '' }}">
                <span class="ssb-ico"><i class="fa-solid fa-key"></i></span>
                <span>Change Password</span>
            </a>
        </li>
        <li>
            <a href="{{ route('courses') }}">
                <span class="ssb-ico"><i class="fa-solid fa-graduation-cap"></i></span>
                <span>Browse Courses</span>
            </a>
        </li>
        <li class="ssb-divider"></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="ssb-logout">
                    <span class="ssb-ico"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>

<style>
.student-sidebar {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e4ecf5;
    box-shadow: 0 4px 24px rgba(0,30,60,0.07);
    overflow: hidden;
    position: sticky;
    top: 90px;
}
.ssb-avatar-zone {
    background: linear-gradient(135deg, #001e3c 0%, #002d5c 100%);
    padding: 28px 20px 22px;
    text-align: center;
}
.ssb-avatar {
    width: 80px; height: 80px;
    border-radius: 50%; object-fit: cover;
    border: 3px solid #fab005;
    margin-bottom: 10px;
}
.ssb-avatar-placeholder {
    width: 80px; height: 80px;
    border-radius: 50%;
    background: rgba(250,176,5,0.15);
    border: 3px solid #fab005;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 1.8rem; font-weight: 800; color: #fab005;
    margin-bottom: 10px;
}
.ssb-name { font-weight: 800; color: #fff; font-size: 0.95rem; margin-bottom: 3px; }
.ssb-email { font-size: 0.72rem; color: rgba(255,255,255,0.5); word-break: break-all; margin-bottom: 12px; }
.ssb-stats { display: flex; justify-content: center; gap: 16px; }
.ssb-stat { text-align: center; }
.ssb-stat-num { font-size: 1.2rem; font-weight: 800; color: #fab005; line-height: 1; }
.ssb-stat-lbl { font-size: 0.62rem; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 2px; }

.ssb-nav { list-style: none; padding: 8px 0; margin: 0; }
.ssb-nav li a,
.ssb-nav li .ssb-logout {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 20px;
    font-size: 0.85rem; font-weight: 600;
    color: #4a5568; text-decoration: none;
    border-left: 3px solid transparent;
    transition: all 0.2s;
    background: none; border-top: none; border-right: none; border-bottom: none;
    width: 100%; cursor: pointer;
}
.ssb-nav li a:hover,
.ssb-nav li .ssb-logout:hover { color: #001e3c; background: #f7faff; border-left-color: #fab005; }
.ssb-nav li a.active { color: #001e3c; background: #f0f6ff; border-left-color: #002d5c; font-weight: 700; }
.ssb-ico {
    width: 30px; height: 30px;
    border-radius: 8px;
    background: rgba(0,30,60,0.06);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.78rem; color: #002d5c;
    flex-shrink: 0; transition: all 0.2s;
}
.ssb-nav li a:hover .ssb-ico,
.ssb-nav li a.active .ssb-ico { background: rgba(0,30,60,0.12); }
.ssb-nav li a.active .ssb-ico { color: #001e3c; }
.ssb-logout .ssb-ico { color: #dc3545; background: rgba(220,53,69,0.08); }
.ssb-logout { color: #dc3545 !important; }
.ssb-divider { height: 1px; background: #e4ecf5; margin: 6px 16px; list-style: none; }

@media(max-width:991px) {
    .student-sidebar { position: static; margin-bottom: 20px; }
    .ssb-nav { display: flex; flex-wrap: wrap; padding: 8px; gap: 4px; }
    .ssb-nav li { flex: 1; min-width: 120px; }
    .ssb-nav li a, .ssb-nav li .ssb-logout { padding: 8px 12px; border-left: none; border-radius: 10px; font-size: 0.78rem; justify-content: center; text-align: center; flex-direction: column; gap: 4px; }
    .ssb-nav li a.active { background: #e8f0fc; }
    .ssb-divider { display: none; }
    .ssb-ico { width: 26px; height: 26px; margin: 0 auto; }
}
</style>
