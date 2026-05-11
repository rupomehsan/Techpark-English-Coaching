@php $meta = ['seo' => ['title' => 'Verify Code — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
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
.auth-label { font-size:0.73rem; font-weight:700; color:#6b7a90; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:10px; display:block; }
.otp-inputs { display:flex; gap:10px; justify-content:center; margin-bottom:8px; }
.otp-digit { width:52px; height:60px; border:2px solid #e4ecf5; border-radius:12px; text-align:center; font-size:1.6rem; font-weight:800; color:var(--navy); background:#fff; outline:none; transition:border-color 0.2s, box-shadow 0.2s; }
.otp-digit:focus { border-color:#5a9af0; box-shadow:0 0 0 3px rgba(90,154,240,0.12); }
.otp-digit.filled { border-color:var(--navy2); background:#f0f6ff; }
.otp-hidden { position:absolute; opacity:0; pointer-events:none; }
.auth-btn { width:100%; padding:13px; border:none; border-radius:50px; background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; font-weight:700; font-size:0.9rem; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; }
.auth-btn:hover { background:linear-gradient(135deg,var(--gold),#e09600); box-shadow:0 6px 20px rgba(250,176,5,0.35); }
.auth-link { color:var(--navy2); font-weight:700; text-decoration:none; }
.auth-link:hover { color:var(--gold); }
</style>
@endpush

@section('contents')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-card-top">
            <div class="auth-card-ico"><i class="fa-solid fa-shield-halved"></i></div>
            <h2>Enter Verification Code</h2>
            <p>Check your email for the 6-digit code</p>
        </div>
        <div class="auth-card-body">

            @if(session('status'))
            <div class="alert alert-success mb-4" role="alert" style="border-radius:12px;font-size:0.85rem;">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('status') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger mb-4" role="alert" style="border-radius:12px;font-size:0.85rem;">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
            @endif

            <div style="background:#f0f6ff;border:1px solid #d0e4ff;border-radius:12px;padding:14px 18px;margin-bottom:24px;text-align:center;">
                <div style="font-size:0.78rem;color:#4a5568;">Code sent to</div>
                <div style="font-size:0.9rem;font-weight:700;color:var(--navy);">{{ $email }}</div>
            </div>

            <form method="POST" action="{{ route('verify.otp.submit') }}" id="otpForm">
                @csrf

                <div class="mb-4">
                    <label class="auth-label" style="text-align:center;display:block;">Verification Code</label>
                    <div class="otp-inputs" id="otpBoxes">
                        @for($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1" class="otp-digit" data-index="{{ $i }}" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                        @endfor
                    </div>
                    <input type="hidden" name="otp" id="otpValue">
                    <div style="text-align:center;font-size:0.75rem;color:#9baec4;margin-top:6px;" id="otpTimer"></div>
                </div>

                <button type="submit" class="auth-btn mb-4" id="verifyBtn">
                    <i class="fa-solid fa-check-circle"></i> Verify Code
                </button>

                <p style="text-align:center;font-size:0.85rem;color:#6b7a90;margin:0 0 10px;">
                    Didn't receive the code?
                    <a href="{{ route('forgot.password') }}" class="auth-link">Resend</a>
                </p>
                <p style="text-align:center;font-size:0.85rem;color:#6b7a90;margin:0;">
                    <a href="{{ route('login') }}" class="auth-link"><i class="fa-solid fa-arrow-left me-1"></i>Back to Sign In</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
(function () {
    const digits  = document.querySelectorAll('.otp-digit');
    const hidden  = document.getElementById('otpValue');
    const form    = document.getElementById('otpForm');
    const timerEl = document.getElementById('otpTimer');

    // Focus first
    digits[0].focus();

    digits.forEach((inp, idx) => {
        inp.addEventListener('input', () => {
            inp.value = inp.value.replace(/\D/, '');
            inp.classList.toggle('filled', inp.value !== '');
            if (inp.value && idx < 5) digits[idx + 1].focus();
            syncHidden();
        });
        inp.addEventListener('keydown', e => {
            if (e.key === 'Backspace' && !inp.value && idx > 0) {
                digits[idx - 1].value = '';
                digits[idx - 1].classList.remove('filled');
                digits[idx - 1].focus();
                syncHidden();
            }
        });
        inp.addEventListener('paste', e => {
            e.preventDefault();
            const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
            pasted.split('').forEach((ch, i) => { if (digits[i]) { digits[i].value = ch; digits[i].classList.add('filled'); } });
            const next = Math.min(pasted.length, 5);
            digits[next].focus();
            syncHidden();
        });
    });

    function syncHidden() {
        hidden.value = Array.from(digits).map(d => d.value).join('');
    }

    // 15-minute countdown
    let expires = Date.now() + 15 * 60 * 1000;
    function tick() {
        const left = Math.max(0, expires - Date.now());
        const m = String(Math.floor(left / 60000)).padStart(2, '0');
        const s = String(Math.floor((left % 60000) / 1000)).padStart(2, '0');
        timerEl.textContent = left > 0 ? `⏱ Expires in ${m}:${s}` : '⚠ Code expired — request a new one';
        timerEl.style.color = left < 60000 ? '#dc3545' : '#9baec4';
        if (left > 0) setTimeout(tick, 1000);
    }
    tick();

    // Validate all 6 filled before submit
    form.addEventListener('submit', e => {
        if (hidden.value.length !== 6) {
            e.preventDefault();
            digits.forEach(d => d.style.borderColor = d.value ? '' : '#dc3545');
        }
    });
})();
</script>
@endsection
