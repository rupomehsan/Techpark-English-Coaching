@php $meta = ['seo' => ['title' => 'Register — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
:root { --navy:#001e3c; --navy2:#002d5c; --gold:#fab005; }
.auth-wrap { min-height:100vh; display:flex; align-items:stretch; background:#f0f4f9; }
.auth-left { flex:0 0 42%; background:linear-gradient(145deg,var(--navy) 0%,var(--navy2) 50%,#003b7a 100%); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:60px 50px; position:relative; overflow:hidden; }
.auth-left::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
.auth-left-brand { position:relative; z-index:1; text-align:center; margin-bottom:40px; }
.auth-left-brand .brand-icon { width:72px; height:72px; border-radius:20px; background:rgba(250,176,5,0.15); border:2px solid rgba(250,176,5,0.35); display:inline-flex; align-items:center; justify-content:center; font-size:1.8rem; color:var(--gold); margin-bottom:18px; }
.auth-left-brand h2 { font-size:1.5rem; font-weight:800; color:#fff; margin-bottom:6px; }
.auth-left-brand p { color:rgba(255,255,255,0.5); font-size:0.85rem; }
.auth-steps { position:relative; z-index:1; width:100%; }
.auth-step { display:flex; align-items:flex-start; gap:14px; margin-bottom:20px; }
.auth-step-num { width:32px; height:32px; border-radius:50%; background:rgba(250,176,5,0.15); border:2px solid rgba(250,176,5,0.4); display:flex; align-items:center; justify-content:center; font-size:0.75rem; font-weight:800; color:var(--gold); flex-shrink:0; margin-top:2px; }
.auth-step-text strong { display:block; font-size:0.82rem; font-weight:700; color:#fff; margin-bottom:3px; }
.auth-step-text span { font-size:0.72rem; color:rgba(255,255,255,0.45); line-height:1.5; }
.auth-stats { position:relative; z-index:1; display:flex; gap:10px; margin-top:32px; width:100%; }
.auth-stat-box { flex:1; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); border-radius:12px; padding:14px 10px; text-align:center; }
.auth-stat-box strong { display:block; font-size:1.2rem; font-weight:800; color:var(--gold); }
.auth-stat-box span { font-size:0.65rem; color:rgba(255,255,255,0.45); text-transform:uppercase; letter-spacing:0.5px; }
.auth-right { flex:1; display:flex; align-items:center; justify-content:center; padding:40px 36px; overflow-y:auto; }
.auth-box { width:100%; max-width:460px; padding:8px 0; }
.auth-box-head { margin-bottom:28px; }
.auth-box-head h1 { font-size:1.6rem; font-weight:800; color:var(--navy); margin-bottom:6px; }
.auth-box-head p { color:#6b7a90; font-size:0.88rem; }
.auth-label { font-size:0.73rem; font-weight:700; color:#6b7a90; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px; display:block; }
.auth-input-wrap { position:relative; }
.auth-input-ico { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#9baec4; font-size:0.85rem; pointer-events:none; }
.auth-input { width:100%; border:1.5px solid #e4ecf5; border-radius:12px; padding:11px 14px 11px 40px; font-size:0.88rem; color:var(--navy); background:#fff; transition:border-color 0.2s, box-shadow 0.2s; outline:none; }
.auth-input:focus { border-color:#5a9af0; box-shadow:0 0 0 3px rgba(90,154,240,0.12); }
.auth-input.is-invalid { border-color:#dc3545; }
.auth-toggle-pw { position:absolute; right:14px; top:50%; transform:translateY(-50%); background:none; border:none; color:#9baec4; cursor:pointer; font-size:0.85rem; padding:0; }
.auth-toggle-pw:hover { color:var(--navy2); }
.auth-btn { width:100%; padding:14px; border:none; border-radius:50px; background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; font-weight:700; font-size:0.92rem; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; }
.auth-btn:hover { background:linear-gradient(135deg,var(--gold),#e09600); box-shadow:0 8px 24px rgba(250,176,5,0.35); }
.auth-divider { display:flex; align-items:center; gap:12px; margin:18px 0; color:#9baec4; font-size:0.78rem; }
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
            <h2>Join TechPark English</h2>
            <p>Start learning today — it's free to join</p>
        </div>
        <div class="auth-steps">
            <div class="auth-step">
                <div class="auth-step-num">1</div>
                <div class="auth-step-text">
                    <strong>Create Your Account</strong>
                    <span>Quick registration, no credit card needed</span>
                </div>
            </div>
            <div class="auth-step">
                <div class="auth-step-num">2</div>
                <div class="auth-step-text">
                    <strong>Browse Our Courses</strong>
                    <span>Live classes, recorded videos, and workshops</span>
                </div>
            </div>
            <div class="auth-step">
                <div class="auth-step-num">3</div>
                <div class="auth-step-text">
                    <strong>Start Learning</strong>
                    <span>Access materials anytime, anywhere</span>
                </div>
            </div>
            <div class="auth-step">
                <div class="auth-step-num">4</div>
                <div class="auth-step-text">
                    <strong>Get Certified</strong>
                    <span>Earn a certificate and boost your career</span>
                </div>
            </div>
        </div>
        <div class="auth-stats">
            <div class="auth-stat-box">
                <strong>10K+</strong>
                <span>Students</span>
            </div>
            <div class="auth-stat-box">
                <strong>50+</strong>
                <span>Courses</span>
            </div>
            <div class="auth-stat-box">
                <strong>4.9★</strong>
                <span>Rating</span>
            </div>
        </div>
    </div>

    {{-- Right panel --}}
    <div class="auth-right">
        <div class="auth-box">
            <div class="auth-box-head">
                <h1>Create your account</h1>
                <p>Fill in your details below to get started</p>
            </div>

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li style="font-size:0.85rem;">{{ $e }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('register_sumbit') }}">
                @csrf

                <div class="row gx-3 mb-3">
                    <div class="col-6">
                        <label class="auth-label">First Name <span class="text-danger">*</span></label>
                        <div class="auth-input-wrap">
                            <i class="fa-solid fa-user auth-input-ico"></i>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="auth-input {{ $errors->has('first_name') ? 'is-invalid' : '' }}" placeholder="First name">
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="auth-label">Last Name <span class="text-danger">*</span></label>
                        <div class="auth-input-wrap">
                            <i class="fa-solid fa-user auth-input-ico"></i>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="auth-input {{ $errors->has('last_name') ? 'is-invalid' : '' }}" placeholder="Last name">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="auth-label">Email Address</label>
                    <div class="auth-input-wrap">
                        <i class="fa-solid fa-envelope auth-input-ico"></i>
                        <input type="email" name="email" value="{{ old('email') }}" class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="you@example.com">
                    </div>
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="auth-label">Mobile Number <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fa-solid fa-phone auth-input-ico"></i>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="auth-input {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" placeholder="01XXXXXXXXX">
                    </div>
                    @error('phone_number')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="auth-label">Password <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fa-solid fa-lock auth-input-ico"></i>
                        <input type="password" name="password" id="regPw" class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Min 8 characters">
                        <button type="button" class="auth-toggle-pw" onclick="togglePw('regPw',this)"><i class="fa-regular fa-eye"></i></button>
                    </div>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="auth-btn">
                    <i class="fa-solid fa-user-plus"></i> Create Account
                </button>

                <p style="font-size:0.72rem;color:#9baec4;text-align:center;margin-top:12px;margin-bottom:0;">
                    By registering, you agree to our <a href="{{ route('terms.policy') }}" class="auth-link" style="font-weight:600;">Terms</a> and <a href="{{ route('privacy.policy') }}" class="auth-link" style="font-weight:600;">Privacy Policy</a>
                </p>

                <div class="auth-divider">or</div>

                <p style="text-align:center;font-size:0.85rem;color:#6b7a90;margin:0;">
                    Already have an account? <a href="{{ route('login') }}" class="auth-link">Sign in</a>
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
