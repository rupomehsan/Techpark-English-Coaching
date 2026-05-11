@php $meta = ['seo' => ['title' => 'My Profile — TechPark English', 'image' => asset('seo.jpg')]]; @endphp
@extends('frontend.layouts.layout', $meta)
@php $user = $user ?? auth()->user(); @endphp

@push('styles')
<style>
:root { --navy:#001e3c; --navy2:#002d5c; --gold:#fab005; --bg:#f0f4f9; --card:#fff; --border:#e4ecf5; --radius:16px; --shadow:0 4px 24px rgba(0,30,60,0.07); }
.pf-wrap { background:var(--bg); min-height:80vh; padding:40px 0 64px; }

/* Profile hero card */
.pf-hero-card { background:linear-gradient(135deg,var(--navy),var(--navy2),#003b7a); border-radius:var(--radius); padding:28px 28px 24px; margin-bottom:24px; display:flex; align-items:center; gap:22px; position:relative; overflow:hidden; }
.pf-hero-card::before { content:''; position:absolute; top:-30px; right:-30px; width:150px; height:150px; border-radius:50%; background:rgba(250,176,5,0.08); }
.pf-hero-avatar-wrap { position:relative; flex-shrink:0; cursor:pointer; }
.pf-hero-avatar { width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid var(--gold); display:block; }
.pf-hero-avatar-placeholder { width:80px; height:80px; border-radius:50%; background:rgba(250,176,5,0.15); border:3px solid var(--gold); display:inline-flex; align-items:center; justify-content:center; font-size:1.9rem; font-weight:800; color:var(--gold); }
.pf-hero-avatar-edit { position:absolute; bottom:0; right:0; width:24px; height:24px; border-radius:50%; background:var(--gold); display:flex; align-items:center; justify-content:center; font-size:0.6rem; color:#fff; border:2px solid #fff; }
.pf-hero-name { font-size:1.1rem; font-weight:800; color:#fff; margin-bottom:3px; }
.pf-hero-email { font-size:0.78rem; color:rgba(255,255,255,0.5); margin-bottom:10px; }
.pf-hero-badges { display:flex; gap:8px; flex-wrap:wrap; }
.pf-hero-badge { font-size:0.68rem; font-weight:700; padding:3px 12px; border-radius:50px; background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.75); border:1px solid rgba(255,255,255,0.15); }

/* Tab nav */
.pf-tab-nav { display:flex; gap:4px; background:var(--card); border:1px solid var(--border); border-radius:14px; padding:6px; margin-bottom:20px; box-shadow:var(--shadow); overflow-x:auto; scrollbar-width:none; }
.pf-tab-nav::-webkit-scrollbar { display:none; }
.pf-tab-btn { display:flex; align-items:center; gap:7px; padding:10px 16px; border-radius:10px; border:none; background:transparent; color:#6b7a90; font-size:0.82rem; font-weight:600; cursor:pointer; white-space:nowrap; transition:all 0.2s; flex-shrink:0; }
.pf-tab-btn i { font-size:0.78rem; }
.pf-tab-btn:hover { background:#f0f4f9; color:var(--navy); }
.pf-tab-btn.active { background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; box-shadow:0 4px 14px rgba(0,30,60,0.2); }
.pf-tab-btn.active i { color:var(--gold); }

/* Tab panels */
.pf-tab-panel { display:none; }
.pf-tab-panel.active { display:block; }

/* Form card */
.pf-card { background:var(--card); border-radius:var(--radius); border:1px solid var(--border); box-shadow:var(--shadow); overflow:hidden; margin-bottom:16px; }
.pf-card-head { display:flex; align-items:center; gap:12px; padding:16px 22px; border-bottom:1px solid var(--border); background:#fafcff; }
.pf-card-head-ico { width:34px; height:34px; border-radius:9px; background:rgba(0,30,60,0.06); display:flex; align-items:center; justify-content:center; font-size:0.82rem; color:var(--navy2); flex-shrink:0; }
.pf-card-head-title { font-weight:700; color:var(--navy); font-size:0.85rem; text-transform:uppercase; letter-spacing:0.6px; }
.pf-card-body { padding:20px 22px; }
.pf-label { font-size:0.72rem; font-weight:700; color:#6b7a90; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px; display:block; }
.pf-input { width:100%; border:1.5px solid var(--border); border-radius:10px; padding:10px 14px; font-size:0.88rem; color:var(--navy); background:#fff; transition:border-color 0.2s, box-shadow 0.2s; outline:none; }
.pf-input:focus { border-color:#5a9af0; box-shadow:0 0 0 3px rgba(90,154,240,0.12); }
.pf-select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7a90' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; padding-right:32px !important; }
.pf-submit { background:linear-gradient(135deg,var(--navy),var(--navy2)); color:#fff; border:none; padding:12px 32px; border-radius:50px; font-weight:700; font-size:0.88rem; cursor:pointer; transition:all 0.3s; display:inline-flex; align-items:center; gap:8px; }
.pf-submit:hover { background:linear-gradient(135deg,var(--gold),#e09600); box-shadow:0 6px 20px rgba(250,176,5,0.35); }
.pf-avatar-upload-box { display:flex; align-items:center; gap:16px; padding:14px; background:#f7faff; border:1.5px dashed #c8d9f0; border-radius:12px; cursor:pointer; }
.pf-avatar-upload-box:hover { border-color:var(--navy2); background:#eef5ff; }

@media(max-width:767px){
    .pf-hero-card { flex-direction:column; text-align:center; gap:14px; }
    .pf-hero-badges { justify-content:center; }
    .pf-tab-btn { padding:9px 12px; font-size:0.75rem; }
}
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
            {{-- Student Sidebar --}}
            <div class="col-lg-3">
                @include('frontend.components.student_sidebar')
            </div>

            {{-- Main content --}}
            <div class="col-lg-9">

                {{-- Profile hero --}}
                <div class="pf-hero-card">
                    <div class="pf-hero-avatar-wrap" onclick="document.getElementById('image').click()" title="Click to change photo">
                        @if($user->image)
                            <img class="pf-hero-avatar" src="{{ asset($user->image) }}" alt="{{ $user->first_name }}">
                        @else
                            <div class="pf-hero-avatar-placeholder">{{ strtoupper(substr($user->first_name ?? 'U', 0, 1)) }}</div>
                        @endif
                        <div class="pf-hero-avatar-edit"><i class="fa-solid fa-camera"></i></div>
                    </div>
                    <div>
                        <div class="pf-hero-name">{{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) }}</div>
                        <div class="pf-hero-email">{{ $user->email }}</div>
                        <div class="pf-hero-badges">
                            @if(optional($user->studentDetails)->occupation)
                                <span class="pf-hero-badge"><i class="fa-solid fa-briefcase me-1"></i>{{ $user->studentDetails->occupation }}</span>
                            @endif
                            @if(optional($user->address)->city)
                                <span class="pf-hero-badge"><i class="fa-solid fa-location-dot me-1"></i>{{ $user->address->city }}</span>
                            @endif
                            @if(optional($user->studentDetails)->institution)
                                <span class="pf-hero-badge"><i class="fa-solid fa-school me-1"></i>{{ $user->studentDetails->institution }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data" id="profileForm"
                      data-active-tab="{{ $errors->any() ? (old('_tab') ?: 'personal') : 'personal' }}">
                    @csrf
                    <input id="image" name="image" type="file" class="d-none" accept="image/*"
                           onchange="previewAvatar(this)">

                    {{-- Tab navigation --}}
                    <div class="pf-tab-nav" role="tablist">
                        <button type="button" class="pf-tab-btn active" data-tab="personal">
                            <i class="fa-solid fa-user"></i> Personal
                        </button>
                        <button type="button" class="pf-tab-btn" data-tab="contact">
                            <i class="fa-solid fa-phone"></i> Contact
                        </button>
                        <button type="button" class="pf-tab-btn" data-tab="location">
                            <i class="fa-solid fa-location-dot"></i> Location
                        </button>
                        <button type="button" class="pf-tab-btn" data-tab="professional">
                            <i class="fa-solid fa-briefcase"></i> Professional
                        </button>
                        <button type="button" class="pf-tab-btn" data-tab="institutional">
                            <i class="fa-solid fa-school"></i> Institutional
                        </button>
                    </div>

                    {{-- ── Personal ── --}}
                    <div class="pf-tab-panel active" id="tab-personal">
                        <div class="pf-card">
                            <div class="pf-card-head">
                                <div class="pf-card-head-ico"><i class="fa-solid fa-user"></i></div>
                                <span class="pf-card-head-title">Personal Information</span>
                            </div>
                            <div class="pf-card-body">
                                <div class="mb-4">
                                    <label class="pf-label">Profile Picture</label>
                                    <div class="pf-avatar-upload-box" onclick="document.getElementById('image').click()">
                                        <div id="avatarPreviewWrap">
                                            @if($user->image)
                                                <img id="avatarPreview" src="{{ asset($user->image) }}" style="width:56px;height:56px;border-radius:50%;object-fit:cover;border:2px solid var(--gold);" alt="">
                                            @else
                                                <div id="avatarPreview" style="width:56px;height:56px;border-radius:50%;background:rgba(0,30,60,0.08);display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:var(--navy2);">
                                                    <i class="fa-solid fa-camera"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div style="font-weight:700;color:var(--navy);font-size:0.88rem;">Click to upload photo</div>
                                            <div style="font-size:0.72rem;color:#6b7a90;margin-top:2px;">JPG, PNG — max 2MB</div>
                                        </div>
                                    </div>
                                    @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="row gx-3">
                                    <div class="col-md-4 mb-3">
                                        <label class="pf-label">First Name <span class="text-danger">*</span></label>
                                        <input class="pf-input" name="first_name" type="text" value="{{ old('first_name', $user->first_name) }}" placeholder="John">
                                        @error('first_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="pf-label">Last Name</label>
                                        <input class="pf-input" name="last_name" type="text" value="{{ old('last_name', $user->last_name) }}" placeholder="Doe">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="pf-label">Gender</label>
                                        <select class="pf-input pf-select" name="gender">
                                            <option value="">Choose...</option>
                                            @foreach(['Male','Female','Other'] as $g)
                                                <option value="{{ $g }}" {{ old('gender', optional($user->studentDetails)->gender) == $g ? 'selected' : '' }}>{{ $g }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="pf-label">Email</label>
                                        <input class="pf-input" name="email" type="email" value="{{ old('email', $user->email) }}" placeholder="you@example.com">
                                        @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="pf-label">How did you find us?</label>
                                        @php $ref = old('reference_source', optional($user->studentDetails)->reference_source); @endphp
                                        <select class="pf-input pf-select" name="reference_source">
                                            <option value="">Select...</option>
                                            @foreach(['Facebook','Youtube','Organization','Ex-Student','Employee','Telesales','Offline Marketing','Friend','Other'] as $r)
                                                <option value="{{ $r }}" {{ $ref == $r ? 'selected' : '' }}>{{ $r }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="pf-submit">
                                <i class="fa-solid fa-floppy-disk"></i> Save Changes
                            </button>
                        </div>
                    </div>

                    {{-- ── Contact ── --}}
                    <div class="pf-tab-panel" id="tab-contact">
                        @php
                            $phones = json_decode(optional($user->address)->phone_number ?? '[]', true);
                            if (!is_array($phones)) $phones = [];
                        @endphp
                        <div class="pf-card">
                            <div class="pf-card-head">
                                <div class="pf-card-head-ico"><i class="fa-solid fa-phone"></i></div>
                                <span class="pf-card-head-title">Contact Information</span>
                            </div>
                            <div class="pf-card-body">
                                <div class="row gx-3">
                                    <div class="col-md-4 mb-3">
                                        <label class="pf-label">Mobile <span class="text-danger">*</span></label>
                                        <input class="pf-input" name="phone_number" type="text" value="{{ old('phone_number', $phones[0] ?? '') }}" placeholder="01XXXXXXXXX">
                                        @error('phone_number')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="pf-label">WhatsApp</label>
                                        <input class="pf-input" name="whatsapp_number" type="text" value="{{ old('whatsapp_number', $phones[1] ?? '') }}" placeholder="01XXXXXXXXX">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="pf-label">Guardian's Number</label>
                                        <input class="pf-input" name="guardian_number" type="text" value="{{ old('guardian_number', optional($user->studentDetails)->guardian_number) }}" placeholder="Optional">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="pf-submit">
                                <i class="fa-solid fa-floppy-disk"></i> Save Changes
                            </button>
                        </div>
                    </div>

                    {{-- ── Location ── --}}
                    <div class="pf-tab-panel" id="tab-location">
                        <div class="pf-card">
                            <div class="pf-card-head">
                                <div class="pf-card-head-ico"><i class="fa-solid fa-location-dot"></i></div>
                                <span class="pf-card-head-title">Location</span>
                            </div>
                            <div class="pf-card-body">
                                <div class="row gx-3">
                                    @foreach([['country','Country','e.g. Bangladesh'],['state','State / Division','e.g. Dhaka'],['city','City','e.g. Dhaka City'],['post','Post / Zip','e.g. 1200']] as [$field,$label,$ph])
                                    <div class="col-sm-6 col-md-3 mb-3">
                                        <label class="pf-label">{{ $label }}</label>
                                        <input class="pf-input" name="{{ $field }}" type="text" value="{{ old($field, optional($user->address)->$field) }}" placeholder="{{ $ph }}">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="pf-submit">
                                <i class="fa-solid fa-floppy-disk"></i> Save Changes
                            </button>
                        </div>
                    </div>

                    {{-- ── Professional ── --}}
                    <div class="pf-tab-panel" id="tab-professional">
                        <div class="pf-card">
                            <div class="pf-card-head">
                                <div class="pf-card-head-ico"><i class="fa-solid fa-briefcase"></i></div>
                                <span class="pf-card-head-title">Professional Details</span>
                            </div>
                            <div class="pf-card-body">
                                <div class="row gx-3">
                                    @foreach([['occupation','Occupation','e.g. Student / Developer'],['organization','Organization','Organization name'],['designation','Designation','Job title']] as [$field,$label,$ph])
                                    <div class="col-md-4 mb-3">
                                        <label class="pf-label">{{ $label }}</label>
                                        <input class="pf-input" name="{{ $field }}" type="text" value="{{ old($field, optional($user->studentDetails)->$field) }}" placeholder="{{ $ph }}">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="pf-submit">
                                <i class="fa-solid fa-floppy-disk"></i> Save Changes
                            </button>
                        </div>
                    </div>

                    {{-- ── Institutional ── --}}
                    <div class="pf-tab-panel" id="tab-institutional">
                        <div class="pf-card">
                            <div class="pf-card-head">
                                <div class="pf-card-head-ico"><i class="fa-solid fa-school"></i></div>
                                <span class="pf-card-head-title">Institutional Details</span>
                            </div>
                            <div class="pf-card-body">
                                <div class="row gx-3">
                                    @foreach([['institution','Institution','School / College'],['class','Class / Year','Class or year'],['last_certificate_name','Last Certificate','e.g. HSC / Diploma']] as [$field,$label,$ph])
                                    <div class="col-md-4 mb-3">
                                        <label class="pf-label">{{ $label }}</label>
                                        <input class="pf-input" name="{{ $field }}" type="text" value="{{ old($field, optional($user->studentDetails)->$field) }}" placeholder="{{ $ph }}">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="pf-submit">
                                <i class="fa-solid fa-floppy-disk"></i> Save Changes
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Tab switching
(function () {
    const btns   = document.querySelectorAll('.pf-tab-btn');
    const panels = document.querySelectorAll('.pf-tab-panel');

    function activate(tabId) {
        btns.forEach(b => b.classList.toggle('active', b.dataset.tab === tabId));
        panels.forEach(p => p.classList.toggle('active', p.id === 'tab-' + tabId));
        // Persist in URL hash without scroll
        history.replaceState(null, '', '#' + tabId);
    }

    btns.forEach(btn => btn.addEventListener('click', () => activate(btn.dataset.tab)));

    // On load: restore from URL hash or from validation error (read from data attr — no Blade-in-JS escaping issue)
    const hash     = location.hash.replace('#', '');
    const errorTab = document.getElementById('profileForm').dataset.activeTab || 'personal';
    activate(hash && document.getElementById('tab-' + hash) ? hash : errorTab);
})();

// Avatar live preview
function previewAvatar(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const wrap = document.getElementById('avatarPreviewWrap');
        wrap.innerHTML = '<img id="avatarPreview" src="' + e.target.result + '" style="width:56px;height:56px;border-radius:50%;object-fit:cover;border:2px solid var(--gold);" alt="">';
    };
    reader.readAsDataURL(input.files[0]);
}

// Stamp active tab into form so controller can redirect back to same tab
document.getElementById('profileForm').addEventListener('submit', function () {
    const active = document.querySelector('.pf-tab-btn.active');
    if (active) {
        let h = document.createElement('input');
        h.type = 'hidden'; h.name = '_tab'; h.value = active.dataset.tab;
        this.appendChild(h);
    }
});
</script>
@endsection
