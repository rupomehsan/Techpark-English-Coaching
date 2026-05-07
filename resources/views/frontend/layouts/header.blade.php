<style>
/* ===== Task 3: Top Bar ===== */
.topbar {
    background: #001830;
    color: rgba(255,255,255,0.7);
    font-size: 0.8rem;
    padding: 8px 0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.topbar-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
}
.topbar-left {
    display: flex;
    align-items: center;
    gap: 20px;
}
.topbar-left a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s;
    font-size: 0.78rem;
}
.topbar-left a:hover { color: #fab005; }
.topbar-left a i { color: #fab005; font-size: 0.72rem; }
.topbar-right {
    display: flex;
    align-items: center;
    gap: 6px;
}
.topbar-follow {
    color: rgba(255,255,255,0.45);
    font-size: 0.72rem;
    margin-right: 4px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.tb-social {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 0.72rem;
    text-decoration: none;
    transition: all 0.25s;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
}
.tb-social:hover { transform: translateY(-2px); color: #fff; }
.tb-social.fb:hover  { background: #1877f2; border-color: #1877f2; }
.tb-social.yt:hover  { background: #ff0000; border-color: #ff0000; }
.tb-social.ig:hover  { background: linear-gradient(135deg, #f09433,#e6683c,#dc2743,#cc2366,#bc1888); border-color: transparent; }
.tb-social.wa:hover  { background: #25d366; border-color: #25d366; }
.tb-social.li:hover  { background: #0a66c2; border-color: #0a66c2; }

/* ===== Sticky Wrapper ===== */
#stickyHeaderWrap {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 1000;
    width: 100%;
}
.topbar {
    transition: max-height 0.3s ease, padding 0.3s ease, opacity 0.3s ease;
    max-height: 60px;
    overflow: hidden;
}
.topbar.topbar-hidden {
    max-height: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    opacity: 0;
}

/* ===== Task 4: Modern Professional Header ===== */
.header_area {
    background: #fff !important;
    box-shadow: 0 2px 20px rgba(0,33,71,0.08) !important;
    position: relative !important;
    transition: box-shadow 0.3s;
}
.header_area.scrolled {
    box-shadow: 0 4px 30px rgba(0,33,71,0.14) !important;
}

/* Logo */
.logo_area a img {
    height: 48px !important;
    width: auto !important;
    transition: transform 0.3s ease !important;
}
.logo_area a:hover img { transform: scale(1.04) !important; }

/* Nav links — modern underline slide effect */
.header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a {
    font-weight: 600 !important;
    font-size: 0.88rem !important;
    color: #2d2d2d !important;
    text-transform: uppercase !important;
    letter-spacing: 0.6px !important;
    padding: 6px 0 !important;
    position: relative !important;
    transition: color 0.25s !important;
}
.header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #002147, #fab005);
    border-radius: 2px;
    transition: width 0.3s ease;
}
.header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a:hover,
.header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a.active_button {
    color: #002147 !important;
}
.header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a:hover::after,
.header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a.active_button::after {
    width: 100% !important;
}
/* Hide old ::before underline from style.css */
.header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a::before {
    display: none !important;
}

/* Login / User button — pill style */
.login_area .login-btn {
    background: linear-gradient(135deg, #002147, #003b7a) !important;
    color: #fff !important;
    border-radius: 50px !important;
    padding: 8px 22px !important;
    font-weight: 700 !important;
    font-size: 0.82rem !important;
    text-decoration: none !important;
    transition: all 0.3s !important;
    letter-spacing: 0.3px;
    display: inline-block;
    box-shadow: 0 4px 12px rgba(0,33,71,0.2);
}
.login_area .login-btn:hover {
    background: linear-gradient(135deg, #fab005, #e09600) !important;
    color: #fff !important;
    box-shadow: 0 6px 18px rgba(250,176,5,0.35) !important;
    transform: translateY(-2px);
}

/* Dropdown */
.dropdown_menu .dropbtn {
    background: linear-gradient(135deg, #002147, #003b7a) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 50px !important;
    padding: 8px 20px !important;
    font-weight: 700 !important;
    font-size: 0.82rem !important;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(0,33,71,0.2);
}
.dropdown_menu .dropbtn:hover {
    background: linear-gradient(135deg, #fab005, #e09600) !important;
    box-shadow: 0 6px 18px rgba(250,176,5,0.35) !important;
    transform: translateY(-2px);
}
.dropdown-content {
    border-radius: 12px !important;
    border: 1px solid rgba(0,33,71,0.08) !important;
    box-shadow: 0 10px 40px rgba(0,33,71,0.12) !important;
    overflow: hidden;
    min-width: 180px;
    margin-top: 8px !important;
}
.dropdown-single-item {
    padding: 10px 18px !important;
    font-size: 0.85rem !important;
    color: #333 !important;
    transition: background 0.2s, color 0.2s !important;
    display: block;
    text-decoration: none;
}
.dropdown-single-item:hover {
    background: #f0f5ff !important;
    color: #002147 !important;
    padding-left: 24px !important;
}

/* Mobile hamburger */
.menu_ber {
    background: #002147 !important;
    color: #fff !important;
    border-radius: 8px !important;
    width: 40px !important;
    height: 40px !important;
    align-items: center !important;
    justify-content: center !important;
    border: none !important;
    transition: background 0.3s !important;
    flex-shrink: 0;
}
@media(max-width: 991.98px) {
    .menu_ber { display: flex !important; }
}
.menu_ber:hover { background: #fab005 !important; }

/* ===== Mobile Sidebar Redesign ===== */
@media (max-width: 991.98px) {
    /* Overlay covers everything including sticky header */
    .header_area .header_area_content .nav_and_login_area {
        position: fixed !important;
        z-index: 1100 !important;
        top: 0 !important;
        left: -100vw !important;
        width: 100vw !important;
        height: 100vh !important;
        visibility: hidden !important;
        opacity: 0 !important;
        transition: left 0.3s ease, opacity 0.3s ease, visibility 0.3s ease !important;
    }
    .header_area .header_area_content .activee_class {
        left: 0 !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Sidebar panel — full width */
    .header_area .header_area_content .nav_and_login_area .full_nav_are {
        background: linear-gradient(175deg, #001830 0%, #002147 55%, #002e60 100%) !important;
        width: 100vw !important;
        height: 100vh !important;
        padding: 0 !important;
        flex-direction: column !important;
        box-shadow: none !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }

    /* Sidebar branding header */
    .sidebar-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        background: rgba(0,0,0,0.25);
        flex-shrink: 0;
    }
    .sidebar-brand-text {
        font-size: 0.85rem;
        font-weight: 700;
        color: #fff;
        letter-spacing: 0.4px;
        line-height: 1.2;
    }
    .sidebar-brand-text span { color: #fab005; }
    .sidebar-brand-tagline {
        font-size: 0.65rem;
        color: rgba(255,255,255,0.45);
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-top: 2px;
    }
    .sidebar-close-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        color: rgba(255,255,255,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .sidebar-close-btn:hover {
        background: rgba(250,176,5,0.2);
        border-color: #fab005;
        color: #fab005;
    }

    /* Nav section label */
    .sidebar-nav-label {
        font-size: 0.62rem;
        font-weight: 700;
        color: rgba(255,255,255,0.3);
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 16px 20px 6px;
    }

    /* Nav list */
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area {
        flex: 1;
    }
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul {
        display: block !important;
        padding: 4px 0 !important;
    }
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li {
        margin: 0 !important;
    }
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a {
        color: rgba(255,255,255,0.82) !important;
        font-size: 0.88rem !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.7px !important;
        padding: 13px 20px !important;
        margin-left: 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        border-left: 3px solid transparent !important;
        transition: all 0.22s !important;
    }
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a::before,
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a::after {
        display: none !important;
    }
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a:hover,
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a.active_button {
        background: rgba(250,176,5,0.1) !important;
        color: #fab005 !important;
        border-left-color: #fab005 !important;
        padding-left: 24px !important;
    }

    /* Sidebar login section */
    .header_area .header_area_content .nav_and_login_area .full_nav_are .login_area {
        display: flex !important;
        padding: 16px 20px 20px !important;
        border-top: 1px solid rgba(255,255,255,0.08) !important;
        flex-direction: column !important;
        gap: 10px !important;
    }
    .header_area .header_area_content .nav_and_login_area .full_nav_are .login_area a,
    .header_area .header_area_content .nav_and_login_area .full_nav_are .login_area .dropbtn {
        width: 100% !important;
        text-align: center !important;
        justify-content: center !important;
        margin-left: 0 !important;
        border: none !important;
        padding: 11px 20px !important;
        border-radius: 50px !important;
        font-weight: 700 !important;
        font-size: 0.84rem !important;
    }

    /* Sidebar footer */
    .sidebar-footer {
        padding: 14px 20px;
        border-top: 1px solid rgba(255,255,255,0.06);
        background: rgba(0,0,0,0.2);
    }
    .sidebar-footer-socials {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    .sidebar-footer-socials a {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        color: rgba(255,255,255,0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.72rem;
        text-decoration: none;
        transition: all 0.2s;
    }
    .sidebar-footer-socials a:hover { background: #fab005; border-color: #fab005; color: #fff; }

    /* Hide overlay — full-width sidebar needs no backdrop */
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul .nav-area_all {
        display: none !important;
    }

    /* Center content in full-width overlay */
    .header_area .header_area_content .nav_and_login_area .full_nav_are .nav-area ul li a {
        max-width: 520px;
        width: 100%;
        margin-left: auto !important;
        margin-right: auto !important;
    }
    .sidebar-nav-label { text-align: center; }
    .sidebar-top {
        max-width: 100%;
        width: 100%;
        box-sizing: border-box;
        padding: 18px 24px;
    }
    .header_area .header_area_content .nav_and_login_area .full_nav_are .login_area {
        max-width: 520px;
        margin-left: auto !important;
        margin-right: auto !important;
        width: 100%;
        box-sizing: border-box;
    }
    .sidebar-footer { width: 100%; }
}

@media(max-width: 767px) {
    .topbar-left { gap: 12px; }
    .topbar-left a span { display: none; }
}

/* Slide-in animation for sidebar */
@media (max-width: 991.98px) {
    .header_area .header_area_content .activee_class .full_nav_are {
        animation: slideInLeft 0.28s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }
    @keyframes slideInLeft {
        from { transform: translateX(-100%); opacity: 0; }
        to   { transform: translateX(0);    opacity: 1; }
    }
}
</style>

<div id="stickyHeaderWrap">
<!-- ===== Task 3: Top Bar (contact left, social right) ===== -->
<div class="topbar" id="topBar">
    <div class="container">
        <div class="topbar-inner">
            <div class="topbar-left">
                <a href="tel:01335119223">
                    <i class="fa-solid fa-phone-volume"></i>
                    <span>01335-119223</span>
                </a>
                <a href="mailto:info@techparkenglish.org">
                    <i class="fa-solid fa-envelope"></i>
                    <span>info@techparkenglish.org</span>
                </a>
            </div>
            <div class="topbar-right">
                <span class="topbar-follow">Follow:</span>
                <a href="https://www.facebook.com/TechParkEnglishFB/" target="_blank" rel="noopener" class="tb-social fb" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.youtube.com/@TechParkEnglish" target="_blank" rel="noopener" class="tb-social yt" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://www.instagram.com/techparkenglish/" target="_blank" rel="noopener" class="tb-social ig" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="tb-social wa" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://www.linkedin.com/company/techparkenglish" target="_blank" rel="noopener" class="tb-social li" aria-label="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ===== Task 4: Modern Professional Header ===== -->
<header class="header_area" id="mainHeader">
    <div class="container">
        <div class="header_area_content">

            <!-- Logo -->
            <div class="logo_area">
                <a href="/">
                    <img class="rounded" src="{{ assetHelper(setting('image')) }}" alt="TechPark English" loading="lazy">
                </a>
            </div>

            <!-- Mobile menu toggle (hidden on large screens) -->
            <button onclick="toggleMobileMenu()" class="menu_ber d-lg-none" id="hamburgerBtn" aria-label="Toggle menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Nav + Login -->
            <div id="active_menu_ber" class="nav_and_login_area">
                <div class="full_nav_are">

                    <!-- Sidebar branding header (mobile only) -->
                    <div class="sidebar-top d-lg-none">
                        <div>
                            <div class="sidebar-brand-text">TechPark <span>English</span></div>
                            <div class="sidebar-brand-tagline">Go Ahead With English</div>
                        </div>
                        <button class="sidebar-close-btn" onclick="active_menu_ber.classList.remove('activee_class')" aria-label="Close menu">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Nav label (mobile only) -->
                    <div class="sidebar-nav-label d-lg-none">Navigation</div>

                    <nav class="nav-area">
                        <ul>
                            <div class="nav-area_all" onclick="active_menu_ber.classList.toggle('activee_class')"></div>
                            <li><a href="/" {{ request()->is('/') ? 'class=active_button' : '' }}><i class="fa-solid fa-house d-lg-none" style="width:16px;opacity:.6;"></i> Home</a></li>
                            <li><a href="/about" {{ request()->is('about') ? 'class=active_button' : '' }}><i class="fa-solid fa-circle-info d-lg-none" style="width:16px;opacity:.6;"></i> About</a></li>
                            <li><a href="/live-courses" {{ request()->is('live-courses') ? 'class=active_button' : '' }}><i class="fa-solid fa-book-open d-lg-none" style="width:16px;opacity:.6;"></i>Our Courses</a></li>
                            <li><a href="/gallery" {{ request()->is('gallery') ? 'class=active_button' : '' }}><i class="fa-solid fa-images d-lg-none" style="width:16px;opacity:.6;"></i> Gallery</a></li>
                            <li><a href="{{ route('videos') }}" {{ request()->is('videos*') ? 'class=active_button' : '' }}><i class="fa-solid fa-play-circle d-lg-none" style="width:16px;opacity:.6;"></i> Videos</a></li>
                            <li><a href="/courses" {{ request()->is('courses*') ? 'class=active_button' : '' }}><i class="fa-solid fa-book d-lg-none" style="width:16px;opacity:.6;"></i> Recorded Courses</a></li>
                            <li><a href="/blog" {{ request()->is('blog*') ? 'class=active_button' : '' }}><i class="fa-solid fa-blog d-lg-none" style="width:16px;opacity:.6;"></i> Blogs</a></li>
                            <li><a href="/contact" {{ request()->is('contact') ? 'class=active_button' : '' }}><i class="fa-solid fa-envelope d-lg-none" style="width:16px;opacity:.6;"></i> Contact</a></li>
                        </ul>
                    </nav>

                    <!-- Auth area -->
                    @guest
                        @if(Route::has('login'))
                            <div class="login_area">
                                <a class="login-btn" href="/login"><i class="fa-regular fa-circle-user me-1"></i> Login</a>
                            </div>
                        @endif
                    @else
                        <div class="login_area">
                            <div class="dropdown dropdown_menu">
                                <button onclick="dropdown_list()" class="dropbtn">
                                    <i class="fa-regular fa-circle-user me-1"></i>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    <i class="fa-solid fa-chevron-down ms-1" style="font-size:0.65rem;"></i>
                                </button>
                                <div id="myDropdown" class="dropdown-content">
                                    <a class="dropdown-single-item" href="{{ route('profile') }}">
                                        <i class="fa-regular fa-user me-2" style="color:#002147;"></i> My Profile
                                    </a>
                                    <a class="dropdown-single-item" href="{{ route('myCourse') }}">
                                        <i class="fa-solid fa-book me-2" style="color:#002147;"></i> My Courses
                                    </a>
                                    <a class="dropdown-single-item" href="{{ route('wishlist.view') }}">
                                        <i class="fa-regular fa-heart me-2" style="color:#002147;"></i> My Wishlist
                                    </a>
                                    <a class="dropdown-single-item" href="javascript:void(0)"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                        style="color:#dc3545 !important;">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest

                    <!-- Sidebar footer with social links (mobile only) -->
                    <div class="sidebar-footer d-lg-none">
                        <div class="sidebar-footer-socials">
                            <a href="https://www.facebook.com/TechParkEnglishFB/" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.youtube.com/@TechParkEnglish" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.instagram.com/techparkenglish/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</header>
</div>{{-- #stickyHeaderWrap --}}

<script>
function toggleMobileMenu() {
    var nav = document.getElementById('active_menu_ber');
    var btn = document.getElementById('hamburgerBtn');
    var icon = btn.querySelector('i');
    var isOpen = nav.classList.toggle('activee_class');
    icon.className = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
    document.body.style.overflow = isOpen ? 'hidden' : '';
}

function closeMobileMenu() {
    var nav = document.getElementById('active_menu_ber');
    var btn = document.getElementById('hamburgerBtn');
    if (nav && btn) {
        nav.classList.remove('activee_class');
        btn.querySelector('i').className = 'fa-solid fa-bars';
        document.body.style.overflow = '';
    }
}

// Sidebar close button (inside sidebar header)
document.addEventListener('DOMContentLoaded', function() {
    var closeBtn = document.querySelector('.sidebar-close-btn');
    if (closeBtn) closeBtn.addEventListener('click', closeMobileMenu);
});

function dropdown_list() {
    document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn') && !event.target.closest('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            if (dropdowns[i].classList.contains('show')) {
                dropdowns[i].classList.remove('show');
            }
        }
    }
};
// Sticky shadow + hide topbar on scroll
window.addEventListener('scroll', function() {
    var h  = document.getElementById('mainHeader');
    var tb = document.getElementById('topBar');
    var scrolled = window.scrollY > 60;
    if (h)  h.classList.toggle('scrolled', window.scrollY > 10);
    if (tb) tb.classList.toggle('topbar-hidden', scrolled);
});
</script>
