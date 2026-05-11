@php $meta = ['seo' => ['title' => 'Reset Password — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
:root { --navy:#001e3c; --navy2:#002d5c; --gold:#fab005; }
.auth-wrap { min-height:100vh; display:flex; align-items:center; justify-content:center; background:#f0f4f9; padding:40px 16px; }
.auth-card { width:100%; max-width:480px; background:#fff; border-radius:20px; border:1px solid #e4ecf5; box-shadow:0 8px 40px rgba(0,30,60,0.10); overflow:hidden; }
.auth-card-top { background:linear-gradient(135deg,var(--navy),var(--navy2)); padding:36px 40px 32px; text-align:center; }
.auth-card-ico { width:64px; height:64px; border-radius:18px; background:rgba(250,176,5,0.15); border:2px solid rgba(250,176,5,0.35); display:inline-flex; align-items:center; justify-content:center; font-size:1.6rem; color:var(--gold); margin-bottom:16px; }
.auth-card-top h2 { font-size:1.3rem; font-weight:800; color:#fff; margin-bottom:6px; }
.auth-card-top p { color:rgba(255,255,255,0.5); font-size:0.83rem; margin:0; }
.auth-card-body { padding:32px 40px; }
.auth-label { font-size:0.73rem; font-weight:700; color:#6b7a90; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px; display:block; }
.auth-input-wrap { position:relative; }
.auth-input-ico { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#9baec4; font-size:0.85rem; pointer-events:none; }
.auth-input { width:100%; border:1.5px solid #e4ecf5; border-radius:12px; padding:12px 44px 12px 40px; font-size:0.88rem; color:var(--navy); background:#fff; transition:border-color 0.2s, box-shadow 0.2s; outline:none; }
.auth-input:focus { border-color:#5a9af0; box-shadow:0 0 0 3px rgba(90,154,240,0.12); }
.auth-toggle-pw { position:absolute; right:14px; top:50%; transform:translateY(-50%); background:none; border:none; color:#9baec4; cursor:pointer; font-size:0.85rem; padding:0; }
.auth-toggle-pw:hover { color:var(--navy2); }
.auth-btn { width:100%; padding:13px; border:none; border-radius:50px; background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; font-weight:700; font-size:0.9rem; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; }
.auth-btn:hover { background:linear-gradient(135deg,var(--gold),#e09600); box-shadow:0 6px 20px rgba(250,176,5,0.35); }
.strength-bar { height:4px; border-radius:50px; background:#e4ecf5; margin-top:8px; overflow:hidden; }
.strength-fill { height:100%; border-radius:50px; transition:width 0.3s, background 0.3s; width:0; }
.auth-link { color:var(--navy2); font-weight:700; text-decoration:none; }
.auth-link:hover { color:var(--gold); }
</style>
@endpush

@section('contents')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-card-top">
            <div class="auth-card-ico"><i class="fa-solid fa-key"></i></div>
            <h2>Set New Password</h2>
            <p>Create a strong password for <strong style="color:rgba(255,255,255,0.8);">{{ $email }}</strong></p>
        </div>
        <div class="auth-card-body">

            @if($errors->any())
            <div class="alert alert-danger mb-4" role="alert" style="border-radius:12px;font-size:0.85rem;">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('reset.password.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="auth-label">New Password <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fa-solid fa-lock auth-input-ico"></i>
                        <input type="password" name="password" id="newPw" class="auth-input" placeholder="Min 8 characters" autocomplete="new-password" autofocus>
                        <button type="button" class="auth-toggle-pw" onclick="togglePw('newPw',this)"><i class="fa-regular fa-eye"></i></button>
                    </div>
                    <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
                    <div style="font-size:0.72rem;margin-top:4px;" id="strength-text"></div>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="auth-label">Confirm Password <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fa-solid fa-lock auth-input-ico"></i>
                        <input type="password" name="password_confirmation" id="confPw" class="auth-input" placeholder="Repeat new password" autocomplete="new-password">
                        <button type="button" class="auth-toggle-pw" onclick="togglePw('confPw',this)"><i class="fa-regular fa-eye"></i></button>
                    </div>
                </div>

                <button type="submit" class="auth-btn mb-4">
                    <i class="fa-solid fa-lock"></i> Set New Password
                </button>

                <p style="text-align:center;font-size:0.85rem;color:#6b7a90;margin:0;">
                    <a href="{{ route('login') }}" class="auth-link"><i class="fa-solid fa-arrow-left me-1"></i>Back to Sign In</a>
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
document.getElementById('newPw').addEventListener('input', function () {
    const val = this.value;
    const fill = document.getElementById('strength-fill');
    const text = document.getElementById('strength-text');
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const colors = ['#e4ecf5', '#dc3545', '#fd7e14', '#fab005', '#00a651'];
    const pcts   = ['0%', '25%', '50%', '75%', '100%'];
    const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
    fill.style.width      = val.length ? pcts[score]   : '0%';
    fill.style.background = colors[score];
    text.textContent      = val.length ? labels[score] : '';
    text.style.color      = colors[score];
});
</script>
@endsection
