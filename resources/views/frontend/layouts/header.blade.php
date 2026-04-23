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

/* ===== Task 4: Modern Professional Header ===== */
.header_area {
    background: #fff !important;
    box-shadow: 0 2px 20px rgba(0,33,71,0.08) !important;
    position: sticky !important;
    top: 0;
    z-index: 1000;
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

/* Mobile hamburger — only display on mobile, let d-lg-none handle desktop */
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
}
@media(max-width: 991.98px) {
    .menu_ber { display: flex !important; }
}
.menu_ber:hover { background: #fab005 !important; }

/* Extra login area (mobile visible) */
.extra_login_area a {
    color: #002147 !important;
    font-weight: 600 !important;
    font-size: 0.82rem !important;
    text-decoration: none !important;
}

@media(max-width: 767px) {
    .topbar-left { gap: 12px; }
    .topbar-left a span { display: none; }
}
</style>

<!-- ===== Task 3: Top Bar (contact left, social right) ===== -->
<div class="topbar">
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

            @guest
                @if(Route::has('login'))
                    <div class="extra_login_area d-lg-none">
                        <a href="/login"><i class="fa-regular fa-circle-user me-1"></i> Login</a>
                    </div>
                @endif
            @else
                <div class="extra_login_area d-lg-none">
                    <a href="{{ route('myCourse') }}">
                        <i class="fa-regular fa-circle-user fa-lg me-1"></i>
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </a>
                </div>
            @endguest

            <!-- Mobile menu toggle (hidden on large screens) -->
            <button onclick="active_menu_ber.classList.toggle('activee_class')" class="menu_ber d-lg-none" aria-label="Toggle menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Nav + Login -->
            <div id="active_menu_ber" class="nav_and_login_area">
                <div class="full_nav_are">
                    <nav class="nav-area">
                        <ul>
                            <div class="nav-area_all" onclick="active_menu_ber.classList.toggle('activee_class')"></div>
                            <li><a href="/" {{ request()->is('/') ? 'class=active_button' : '' }}>Home</a></li>
                            <li><a href="/about" {{ request()->is('about') ? 'class=active_button' : '' }}>About</a></li>
                            <li><a href="/courses" {{ request()->is('courses*') ? 'class=active_button' : '' }}>Courses</a></li>
                            <li><a href="/gallery" {{ request()->is('gallery') ? 'class=active_button' : '' }}>Gallery</a></li>
                            <li><a href="{{ route('videos') }}" {{ request()->is('videos*') ? 'class=active_button' : '' }}>Video</a></li>
                            <li><a href="/contact" {{ request()->is('contact') ? 'class=active_button' : '' }}>Contact</a></li>
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
                </div>
            </div>

        </div>
    </div>
</header>

<script>
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
// Sticky shadow on scroll
window.addEventListener('scroll', function() {
    var h = document.getElementById('mainHeader');
    if (h) h.classList.toggle('scrolled', window.scrollY > 10);
});
</script>
