@php $meta = ['seo' => ['title' => 'Forgot Password — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
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
.auth-input { width:100%; border:1.5px solid #e4ecf5; border-radius:12px; padding:12px 14px 12px 40px; font-size:0.88rem; color:var(--navy); background:#fff; transition:border-color 0.2s, box-shadow 0.2s; outline:none; }
.auth-input:focus { border-color:#5a9af0; box-shadow:0 0 0 3px rgba(90,154,240,0.12); }
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
            <div class="auth-card-ico"><i class="fa-solid fa-envelope-open-text"></i></div>
            <h2>Forgot Your Password?</h2>
            <p>Enter your email and we'll send a 6-digit verification code</p>
        </div>
        <div class="auth-card-body">

            @if(session('status'))
            <div class="alert alert-success mb-4" role="alert" style="border-radius:12px;font-size:0.85rem;">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('status') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger mb-4" role="alert" style="border-radius:12px;font-size:0.85rem;">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('error') }}
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger mb-4" role="alert" style="border-radius:12px;font-size:0.85rem;">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('forgot.password.submit') }}">
                @csrf

                <div class="mb-4">
                    <label class="auth-label">Email Address</label>
                    <div class="auth-input-wrap">
                        <i class="fa-solid fa-envelope auth-input-ico"></i>
                        <input type="email" name="email" value="{{ old('email') }}" class="auth-input" placeholder="you@example.com" autofocus>
                    </div>
                </div>

                <button type="submit" class="auth-btn mb-4">
                    <i class="fa-solid fa-paper-plane"></i> Send Verification Code
                </button>

                <p style="text-align:center;font-size:0.85rem;color:#6b7a90;margin:0;">
                    Remembered your password? <a href="{{ route('login') }}" class="auth-link">Sign in</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
