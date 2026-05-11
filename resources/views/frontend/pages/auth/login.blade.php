@php $meta = ['seo' => ['title' => 'Login — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
:root { --navy:#001e3c; --navy2:#002d5c; --gold:#fab005; }
.auth-wrap { min-height:100vh; display:flex; align-items:stretch; background:#f0f4f9; }
.auth-left { flex:0 0 46%; background:linear-gradient(145deg,var(--navy) 0%,var(--navy2) 50%,#003b7a 100%); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:60px 56px; position:relative; overflow:hidden; }
.auth-left::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
.auth-left-brand { position:relative; z-index:1; text-align:center; margin-bottom:48px; }
.auth-left-brand .brand-icon { width:72px; height:72px; border-radius:20px; background:rgba(250,176,5,0.15); border:2px solid rgba(250,176,5,0.35); display:inline-flex; align-items:center; justify-content:center; font-size:1.8rem; color:var(--gold); margin-bottom:18px; }
.auth-left-brand h2 { font-size:1.5rem; font-weight:800; color:#fff; margin-bottom:6px; }
.auth-left-brand p { color:rgba(255,255,255,0.5); font-size:0.85rem; }
.auth-features { position:relative; z-index:1; width:100%; }
.auth-feature-item { display:flex; align-items:center; gap:14px; padding:14px 18px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08); border-radius:14px; margin-bottom:10px; }
.auth-feature-ico { width:38px; height:38px; border-radius:10px; background:rgba(250,176,5,0.15); display:flex; align-items:center; justify-content:center; color:var(--gold); font-size:0.9rem; flex-shrink:0; }
.auth-feature-text strong { display:block; font-size:0.82rem; font-weight:700; color:#fff; margin-bottom:2px; }
.auth-feature-text span { font-size:0.72rem; color:rgba(255,255,255,0.45); }
.auth-right { flex:1; display:flex; align-items:center; justify-content:center; padding:48px 40px; }
.auth-box { width:100%; max-width:440px; }
.auth-box-head { margin-bottom:32px; }
.auth-box-head h1 { font-size:1.7rem; font-weight:800; color:var(--navy); margin-bottom:6px; }
.auth-box-head p { color:#6b7a90; font-size:0.88rem; }
.auth-label { font-size:0.73rem; font-weight:700; color:#6b7a90; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px; display:block; }
.auth-input-wrap { position:relative; }
.auth-input-ico { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#9baec4; font-size:0.85rem; pointer-events:none; }
.auth-input { width:100%; border:1.5px solid #e4ecf5; border-radius:12px; padding:12px 14px 12px 40px; font-size:0.88rem; color:var(--navy); background:#fff; transition:border-color 0.2s, box-shadow 0.2s; outline:none; }
.auth-input:focus { border-color:#5a9af0; box-shadow:0 0 0 3px rgba(90,154,240,0.12); }
.auth-input.is-invalid { border-color:#dc3545; }
.auth-toggle-pw { position:absolute; right:14px; top:50%; transform:translateY(-50%); background:none; border:none; color:#9baec4; cursor:pointer; font-size:0.85rem; padding:0; }
.auth-toggle-pw:hover { color:var(--navy2); }
.auth-btn { width:100%; padding:14px; border:none; border-radius:50px; background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; font-weight:700; font-size:0.92rem; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; }
.auth-btn:hover { background:linear-gradient(135deg,var(--gold),#e09600); box-shadow:0 8px 24px rgba(250,176,5,0.35); }
.auth-divider { display:flex; align-items:center; gap:12px; margin:20px 0; color:#9baec4; font-size:0.78rem; }
.auth-divider::before,.auth-divider::after { content:''; flex:1; height:1px; background:#e4ecf5; }
.auth-link { color:var(--navy2); font-weight:700; text-decoration:none; }
.auth-link:hover { color:var(--gold); }
@media(max-width:991px) { .auth-left { display:none; } .auth-wrap { min-height:auto; padding:40px 0; } .auth-right { padding:24px 16px; } }
</style>
@endpush

@section('contents')
<div class="auth-wrap">
    {{-- Left panel --}}
    <div class="auth-left">
        <div class="auth-left-brand">
            <div class="brand-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <h2>TechPark English</h2>
            <p>Your journey to fluent English starts here</p>
        </div>
        <div class="auth-features">
            <div class="auth-feature-item">
                <div class="auth-feature-ico"><i class="fa-solid fa-video"></i></div>
                <div class="auth-feature-text">
                    <strong>Live & Recorded Classes</strong>
                    <span>Learn at your own pace, anytime</span>
                </div>
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-ico"><i class="fa-solid fa-certificate"></i></div>
                <div class="auth-feature-text">
                    <strong>Earn Certificates</strong>
                    <span>Recognized credentials on completion</span>
                </div>
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-ico"><i class="fa-solid fa-users"></i></div>
                <div class="auth-feature-text">
                    <strong>Expert Instructors</strong>
                    <span>Learn from the best in the field</span>
                </div>
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-ico"><i class="fa-solid fa-chart-line"></i></div>
                <div class="auth-feature-text">
                    <strong>Track Your Progress</strong>
                    <span>Detailed reports and analytics</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right panel --}}
    <div class="auth-right">
        <div class="auth-box">
            <div class="auth-box-head">
                <h1>Welcome back <i class="fa-solid fa-hand-wave" style="color:var(--gold);font-size:1.4rem;"></i></h1>
                <p>Sign in to continue your learning journey</p>
            </div>

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('status') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('login_sumbit') }}">
                @csrf

                <div class="mb-4">
                    <label class="auth-label">Email or Mobile Number</label>
                    <div class="auth-input-wrap">
                        <i class="fa-solid fa-envelope auth-input-ico"></i>
                        <input type="text" name="email" value="{{ old('email') }}" class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter email or mobile">
                    </div>
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="auth-label">Password</label>
                    <div class="auth-input-wrap">
                        <i class="fa-solid fa-lock auth-input-ico"></i>
                        <input type="password" name="password" id="loginPw" class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter password">
                        <button type="button" class="auth-toggle-pw" onclick="togglePw('loginPw',this)"><i class="fa-regular fa-eye"></i></button>
                    </div>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label style="display:flex;align-items:center;gap:8px;font-size:0.82rem;color:#6b7a90;cursor:pointer;">
                        <input type="checkbox" name="remember" style="accent-color:var(--navy2);width:15px;height:15px;"> Remember me
                    </label>
                    <a href="{{ route('forgot.password') }}" class="auth-link" style="font-size:0.82rem;">Forgot password?</a>
                </div>

                <button type="submit" class="auth-btn">
                    <i class="fa-solid fa-right-to-bracket"></i> Sign In
                </button>

                <div class="auth-divider">or</div>

                <p style="text-align:center;font-size:0.85rem;color:#6b7a90;margin:0;">
                    Don't have an account? <a href="{{ route('register') }}" class="auth-link">Create one free</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
function togglePw(id, btn) {
    const inp = document.getElementById(id);
    const isText = inp.type === 'text';
    inp.type = isText ? 'password' : 'text';
    btn.innerHTML = isText ? '<i class="fa-regular fa-eye"></i>' : '<i class="fa-regular fa-eye-slash"></i>';
}
</script>
@endsection
