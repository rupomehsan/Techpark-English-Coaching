@php $meta = ['seo' => ['title' => 'Change Password — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
@extends('frontend.layouts.layout', $meta)

@push('styles')
<style>
:root { --navy:#001e3c; --navy2:#002d5c; --gold:#fab005; --bg:#f0f4f9; --card:#fff; --border:#e4ecf5; --radius:16px; --shadow:0 4px 24px rgba(0,30,60,0.07); }
.pf-wrap { background:var(--bg); min-height:80vh; padding:40px 0 64px; }
.pf-card { background:var(--card); border-radius:var(--radius); border:1px solid var(--border); box-shadow:var(--shadow); margin-bottom:20px; overflow:hidden; }
.pf-card-head { display:flex; align-items:center; gap:12px; padding:18px 24px; border-bottom:1px solid var(--border); }
.pf-card-head-ico { width:36px; height:36px; border-radius:10px; background:rgba(0,30,60,0.06); display:flex; align-items:center; justify-content:center; font-size:0.85rem; color:var(--navy2); flex-shrink:0; }
.pf-card-head-title { font-weight:700; color:var(--navy); font-size:0.88rem; text-transform:uppercase; letter-spacing:0.6px; }
.pf-card-body { padding:22px 24px; }
.pf-label { font-size:0.75rem; font-weight:700; color:#6b7a90; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px; display:block; }
.pf-input { width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:0.88rem; color:var(--navy); background:#fff; transition:border-color 0.2s, box-shadow 0.2s; outline:none; }
.pf-input:focus { border-color:#5a9af0; box-shadow:0 0 0 3px rgba(90,154,240,0.12); }
.pf-submit { background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; border:none; padding:13px 36px; border-radius:50px; font-weight:700; font-size:0.88rem; cursor:pointer; transition:all 0.3s; display:inline-flex; align-items:center; gap:8px; }
.pf-submit:hover { background:linear-gradient(135deg,var(--gold),#e09600); box-shadow:0 6px 20px rgba(250,176,5,0.35); }
.pf-hint { font-size:0.75rem; color:#6b7a90; margin-top:5px; }
.strength-bar { height:4px; border-radius:50px; background:#e4ecf5; margin-top:8px; overflow:hidden; }
.strength-fill { height:100%; border-radius:50px; transition:width 0.3s, background 0.3s; width:0; }
</style>
@endpush

@section('contents')
<div class="pf-wrap">
    <div class="container">

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-3">
                @include('frontend.components.student_sidebar')
            </div>

            <div class="col-lg-9">
                <form method="POST" action="{{ route('change.password.update') }}">
                    @csrf
                    <div class="pf-card">
                        <div class="pf-card-head">
                            <div class="pf-card-head-ico"><i class="fa-solid fa-key"></i></div>
                            <span class="pf-card-head-title">Change Password</span>
                        </div>
                        <div class="pf-card-body">
                            <div class="row gx-3">
                                <div class="col-12 mb-4">
                                    <label class="pf-label">Current Password <span class="text-danger">*</span></label>
                                    <input class="pf-input" name="current_password" type="password" placeholder="Enter your current password" autocomplete="current-password">
                                    @error('current_password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="pf-label">New Password <span class="text-danger">*</span></label>
                                    <input class="pf-input" id="new_password" name="password" type="password" placeholder="Min 8 characters" autocomplete="new-password">
                                    <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
                                    <div class="pf-hint" id="strength-text"></div>
                                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="pf-label">Confirm New Password <span class="text-danger">*</span></label>
                                    <input class="pf-input" name="password_confirmation" type="password" placeholder="Repeat new password" autocomplete="new-password">
                                </div>
                            </div>

                            <div style="background:#f0f6ff;border:1px solid #d0e4ff;border-radius:12px;padding:14px 18px;margin-top:8px;">
                                <div style="font-size:0.78rem;font-weight:700;color:var(--navy2);margin-bottom:8px;"><i class="fa-solid fa-shield-halved me-1"></i> Password Tips</div>
                                <ul style="font-size:0.75rem;color:#4a5568;margin:0;padding-left:16px;line-height:1.8;">
                                    <li>At least 8 characters long</li>
                                    <li>Mix uppercase and lowercase letters</li>
                                    <li>Include numbers and symbols for better security</li>
                                    <li>Avoid using your name or common words</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="pf-submit">
                            <i class="fa-solid fa-lock"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('new_password').addEventListener('input', function() {
    const val = this.value;
    const fill = document.getElementById('strength-fill');
    const text = document.getElementById('strength-text');
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const levels = [
        { pct: '0%',   color: '#e4ecf5', label: '' },
        { pct: '25%',  color: '#dc3545', label: 'Weak' },
        { pct: '50%',  color: '#fd7e14', label: 'Fair' },
        { pct: '75%',  color: '#fab005', label: 'Good' },
        { pct: '100%', color: '#00a651', label: 'Strong' },
    ];
    const lvl = levels[score] || levels[0];
    fill.style.width = val.length ? lvl.pct : '0%';
    fill.style.background = lvl.color;
    text.textContent = val.length ? lvl.label : '';
    text.style.color = lvl.color;
});
</script>
@endsection
