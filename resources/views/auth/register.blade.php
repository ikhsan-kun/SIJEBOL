@php
    $schools = \App\Models\School::orderBy('nama_sekolah')->pluck('nama_sekolah');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun Baru | SI JEBOL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #003178;
            background-image: linear-gradient(rgba(0, 49, 120, 0.92), rgba(0, 49, 120, 0.85)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 20px;
        }

        .page-wrap {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 18px;
            padding: 28px 24px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.35);
            overflow: hidden;
        }

        /* ---- Brand ---- */
        .brand-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .brand-logo-circle {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            border: 2px solid #c3d3f0;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 10px;
            box-shadow: 0 4px 16px rgba(0,49,120,0.12);
        }
        .brand-logo-circle img { width: 50px; height: 50px; object-fit: contain; }
        .brand-name { font-size: 1.2rem; font-weight: 800; color: #0f172a; }
        .brand-sub {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #6b7280;
            margin-top: 2px;
        }

        /* ---- Heading ---- */
        .main-heading {
            text-align: center;
            margin-bottom: 20px;
        }
        .main-heading h1 {
            font-size: 1.45rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
        }
        .main-heading p {
            font-size: 0.82rem;
            color: #475569;
            line-height: 1.5;
        }
        .main-heading p strong { color: #003178; }

        /* ---- Step indicator ---- */
        .step-badge {
            display: inline-flex;
            align-items: center;
            background: #003178;
            color: white;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 8px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 16px;
        }

        /* ---- Form ---- */
        .field-group { margin-bottom: 12px; }
        .field-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
        }
        .input-wrap {
            display: flex;
            align-items: center;
            border: 1.5px solid #dde3f0;
            border-radius: 10px;
            background: white;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
            min-width: 0;
        }
        .input-wrap:focus-within {
            border-color: #003178;
            box-shadow: 0 0 0 3px rgba(0,49,120,0.1);
        }
        .input-icon-box {
            display: flex; align-items: center; justify-content: center;
            padding: 0 8px; color: #94a3b8;
        }
        .input-icon-box svg { width: 15px; height: 15px; }
        .field-input {
            flex: 1;
            border: none; outline: none;
            padding: 8px 6px 8px 0;
            font-size: 0.72rem;
            color: #1e293b;
            background: transparent;
            font-family: 'Inter', sans-serif;
            min-width: 0;
        }
        .field-input::placeholder { color: #b0bac8; }
        .toggle-btn {
            background: none; border: none; cursor: pointer;
            padding: 0 10px; color: #94a3b8;
            display: flex; align-items: center;
        }
        .toggle-btn svg { width: 18px; height: 18px; }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 12px;
        }
        .field-row > div { min-width: 0; overflow: hidden; }

        /* Terms */
        .terms-box {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 18px;
            padding: 12px;
            border: 1.5px solid #dde3f0;
            border-radius: 10px;
            background: #f9fafb;
            cursor: pointer;
        }
        .terms-box input[type="checkbox"] {
            width: 16px; height: 16px; margin-top: 2px;
            accent-color: #003178; flex-shrink: 0; cursor: pointer;
        }
        .terms-box p { font-size: 0.8rem; color: #475569; line-height: 1.5; }
        .terms-box p a { color: #003178; font-weight: 600; text-decoration: none; }
        .terms-box p a:hover { text-decoration: underline; }

        /* Button */
        .btn-next {
            width: 100%;
            padding: 16px;
            background: #003178;
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background 0.2s, transform 0.1s;
            font-family: 'Inter', sans-serif;
            margin-bottom: 18px;
            box-shadow: 0 4px 16px rgba(0,49,120,0.25);
        }
        .btn-next:hover { background: #002060; }
        .btn-next:active { transform: scale(0.98); }
        .btn-next svg { width: 18px; height: 18px; }

        .login-link {
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
        }
        .login-link a { color: #003178; font-weight: 700; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }

        /* Alert */
        .alert-err {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            border-radius: 10px;
            padding: 12px 16px;
            color: #dc2626;
            font-size: 0.85rem;
            margin-bottom: 16px;
        }
        .ferr { font-size: 0.73rem; color: #dc2626; margin-top: 4px; }

        /* Step 2 */
        .step2 { display: none; }
        .back-btn {
            background: none; border: none; cursor: pointer;
            color: #003178; font-size: 0.85rem; font-weight: 600;
            display: flex; align-items: center; gap: 6px;
            margin-bottom: 16px; font-family: 'Inter', sans-serif;
        }
        .back-btn svg { width: 16px; height: 16px; }

        .select-wrap {
            display: flex;
            align-items: center;
            border: 1.5px solid #dde3f0;
            border-radius: 12px;
            background: white;
            overflow: hidden;
            transition: border-color 0.2s;
        }
        .select-wrap:focus-within {
            border-color: #003178;
            box-shadow: 0 0 0 3px rgba(0,49,120,0.1);
        }
        .field-select {
            flex: 1; border: none; outline: none;
            padding: 13px 12px 13px 14px;
            font-size: 0.9rem; color: #1e293b;
            background: transparent; font-family: 'Inter', sans-serif;
            appearance: none; cursor: pointer;
        }

        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.8rem;
            color: #1d4ed8;
            margin-bottom: 20px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
<div class="page-wrap">

    {{-- Brand --}}
    <div class="brand-top">
        <div class="brand-logo-circle">
            <img src="{{ asset('images/logo-tegal.png') }}" alt="Logo Kota Tegal">
        </div>
        <div class="brand-name">SI JEBOL</div>
        <div class="brand-sub">Kota Tegal</div>
    </div>

    <div class="main-heading">
        <h1>Register Akun Baru</h1>
        <p>Register sebagai Masyarakat Umum untuk mulai menggunakan layanan SI JEBOL.</p>
    </div>

    @if($errors->any())
        <div class="alert-err">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('register') }}" method="POST" id="regForm">
        @csrf

        {{-- ===== STEP 1 ===== --}}
        <div id="step1">

            {{-- Nama --}}
            <div class="field-group">
                <label class="field-label">Nama Lengkap Sesuai KTP</label>
                <div class="input-wrap">
                    <span class="input-icon-box"><i data-lucide="user"></i></span>
                    <input class="field-input" type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                </div>
                @error('name')<div class="ferr">{{ $message }}</div>@enderror
            </div>

            {{-- NIK --}}
            <div class="field-group">
                <label class="field-label">Nomor Induk Kependudukan (NIK)</label>
                <div class="input-wrap">
                    <span class="input-icon-box"><i data-lucide="credit-card"></i></span>
                    <input class="field-input" type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit angka NIK" maxlength="16" required oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                </div>
                @error('nik')<div class="ferr">{{ $message }}</div>@enderror
            </div>

            {{-- Email + Phone --}}
            <div class="field-row">
                <div>
                    <label class="field-label">Email Address</label>
                    <div class="input-wrap">
                        <span class="input-icon-box"><i data-lucide="mail"></i></span>
                        <input class="field-input" type="email" name="email" value="{{ old('email') }}" placeholder="contoh@gmail.com" required>
                    </div>
                    @error('email')<div class="ferr" style="font-size:0.7rem;">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="field-label">Phone Number</label>
                    <div class="input-wrap">
                        <span class="input-icon-box"><i data-lucide="smartphone"></i></span>
                        <input class="field-input" type="tel" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                    </div>
                    @error('phone')<div class="ferr" style="font-size:0.7rem;">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Tipe Pendaftar --}}
            <div class="field-group">
                <label class="field-label">Tipe Pendaftaran</label>
                <div class="input-wrap">
                    <span class="input-icon-box"><i data-lucide="users"></i></span>
                    <select class="field-input" name="tipe_pendaftar" id="tipePendaftar" style="padding-right: 24px; width: 100%; border: none; background: transparent; outline: none; cursor: pointer;" onchange="toggleTipePendaftar()" required>
                        <option value="kecamatan" {{ old('tipe_pendaftar') == 'kecamatan' ? 'selected' : '' }}>Warga Umum / Kecamatan</option>
                        <option value="sekolah" {{ old('tipe_pendaftar') == 'sekolah' ? 'selected' : '' }}>Pendaftar Sekolah / Instansi Pendidikan</option>
                    </select>
                </div>
                @error('tipe_pendaftar')<div class="ferr">{{ $message }}</div>@enderror
            </div>

            {{-- Kecamatan --}}
            <div class="field-group" id="fieldKecamatan" style="display: {{ old('tipe_pendaftar', 'kecamatan') == 'kecamatan' ? 'block' : 'none' }};">
                <label class="field-label">Kecamatan Asal</label>
                <div class="input-wrap" style="position: relative; overflow: visible !important;">
                    <span class="input-icon-box"><i data-lucide="map-pin"></i></span>
                    <input class="field-input" type="text" name="kecamatan" id="kecamatanInput" value="{{ old('kecamatan') }}" placeholder="Masukkan atau pilih kecamatan asal" autocomplete="off" onfocus="showKecamatanSuggestions()" oninput="filterKecamatanSuggestions()">
                    <!-- Custom Suggestions Container -->
                    <div id="kecamatanSuggestions" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1.5px solid #dde3f0; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-height: 200px; overflow-y: auto; z-index: 999; margin-top: 4px;">
                    </div>
                </div>
                @error('kecamatan')<div class="ferr">{{ $message }}</div>@enderror
            </div>

            {{-- Nama Sekolah --}}
            <div class="field-group" id="fieldSekolah" style="display: {{ old('tipe_pendaftar') == 'sekolah' ? 'block' : 'none' }};">
                <label class="field-label">Nama Sekolah</label>
                <div class="input-wrap" style="position: relative; overflow: visible !important;">
                    <span class="input-icon-box"><i data-lucide="school"></i></span>
                    <input class="field-input" type="text" name="nama_sekolah" id="schoolInput" value="{{ old('nama_sekolah') }}" placeholder="Masukkan atau pilih nama sekolah asal" autocomplete="off" onfocus="showSchoolSuggestions()" oninput="filterSchoolSuggestions()">
                    <!-- Custom Suggestions Container -->
                    <div id="schoolSuggestions" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1.5px solid #dde3f0; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-height: 200px; overflow-y: auto; z-index: 999; margin-top: 4px;">
                    </div>
                </div>
                @error('nama_sekolah')<div class="ferr">{{ $message }}</div>@enderror
            </div>

            {{-- Password --}}
            <div class="field-row">
                <div>
                    <label class="field-label">Password</label>
                    <div class="input-wrap">
                        <span class="input-icon-box"><i data-lucide="lock"></i></span>
                        <input class="field-input" type="password" name="password" id="pw1" placeholder="Password" required minlength="4">
                        <button type="button" class="toggle-btn" onclick="togglePw('pw1',this)"><i data-lucide="eye"></i></button>
                    </div>
                    @error('password')<div class="ferr" style="font-size:0.7rem;">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="field-label">Konfirmasi</label>
                    <div class="input-wrap">
                        <span class="input-icon-box"><i data-lucide="shield-check"></i></span>
                        <input class="field-input" type="password" name="password_confirmation" id="pw2" placeholder="Ulangi" required minlength="4">
                        <button type="button" class="toggle-btn" onclick="togglePw('pw2',this)"><i data-lucide="eye"></i></button>
                    </div>
                </div>
            </div>

            {{-- Terms --}}
            <label class="terms-box">
                <input type="checkbox" name="terms" id="terms" required>
                <p>Saya menyetujui <a href="#">Syarat &amp; Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> yang berlaku di SI JEBOL Kota Tegal.</p>
            </label>

            {{-- Submit --}}
            <button type="submit" class="btn-next">
                Selesaikan Registrasi
                <i data-lucide="arrow-right"></i>
            </button>
        </div>

        <div class="login-link">
            Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </form>
</div>

<script>
    lucide.createIcons();

    function togglePw(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.setAttribute('data-lucide', input.type === 'password' ? 'eye' : 'eye-off');
        lucide.createIcons();
    }

    function toggleTipePendaftar() {
        const tipe = document.getElementById('tipePendaftar').value;
        document.getElementById('fieldKecamatan').style.display = tipe === 'kecamatan' ? 'block' : 'none';
        document.getElementById('fieldSekolah').style.display = tipe === 'sekolah' ? 'block' : 'none';
    }

    let allSchools = @json($schools);
    if (!allSchools || allSchools.length === 0) {
        allSchools = [
            "SMAN 1 Tegal",
            "SMAN 2 Tegal",
            "SMAN 3 Tegal",
            "SMAN 4 Tegal",
            "SMKN 1 Tegal",
            "SMKN 2 Tegal",
            "SMKN 3 Tegal",
            "SMA Muhammadiyah Tegal",
            "SMA Al-Irsyad Tegal",
            "SMPN 1 Tegal",
            "SMPN 2 Tegal",
            "SMPN 3 Tegal",
            "TK AISYIYAH BUSTANUL ATHFAL II",
            "TK AISYIYAH BUSTANUL ATHFAL VIII",
            "TK AL KHAIRIYYAH",
            "TK AL-IRSYAD AL-ISLAMIYAH",
            "TK ASSYIFA",
            "TK BAGYA WACANA",
            "TK ELKANA",
            "TK GLOBAL INBYRA SCHOOL",
            "TK HANG TUAH 16",
            "TK PIUS"
        ];
    }

    // Sort schools alphabetically
    allSchools.sort();

    function showSchoolSuggestions() {
        filterSchoolSuggestions();
    }

    function filterSchoolSuggestions() {
        const input = document.getElementById('schoolInput');
        const filter = input.value.toLowerCase();
        const container = document.getElementById('schoolSuggestions');
        
        // Filter schools
        const matches = allSchools.filter(school => school.toLowerCase().includes(filter));
        
        if (matches.length > 0) {
            let html = '';
            matches.forEach(school => {
                html += `<div style="padding: 10px 14px; font-size: 0.8rem; color: #1e293b; cursor: pointer; border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" class="suggestion-item" onclick="selectSchool('${school.replace(/'/g, "\\'")}')" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">${school}</div>`;
            });
            container.innerHTML = html;
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    }

    function selectSchool(val) {
        document.getElementById('schoolInput').value = val;
        document.getElementById('schoolSuggestions').style.display = 'none';
    }

    const allKecamatans = [
        "Kecamatan Tegal Barat",
        "Kecamatan Tegal Timur",
        "Kecamatan Tegal Selatan",
        "Kecamatan Margadana"
    ];

    function showKecamatanSuggestions() {
        filterKecamatanSuggestions();
    }

    function filterKecamatanSuggestions() {
        const input = document.getElementById('kecamatanInput');
        const filter = input.value.toLowerCase();
        const container = document.getElementById('kecamatanSuggestions');
        
        // Filter kecamatans
        const matches = allKecamatans.filter(kec => kec.toLowerCase().includes(filter));
        
        if (matches.length > 0) {
            let html = '';
            matches.forEach(kec => {
                html += `<div style="padding: 10px 14px; font-size: 0.8rem; color: #1e293b; cursor: pointer; border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" class="suggestion-item" onclick="selectKecamatan('${kec}')" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">${kec}</div>`;
            });
            container.innerHTML = html;
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    }

    function selectKecamatan(val) {
        document.getElementById('kecamatanInput').value = val;
        document.getElementById('kecamatanSuggestions').style.display = 'none';
    }

    // Hide dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        // School suggestions close
        const input = document.getElementById('schoolInput');
        const container = document.getElementById('schoolSuggestions');
        if (input && container && !input.contains(e.target) && !container.contains(e.target)) {
            container.style.display = 'none';
        }

        // Kecamatan suggestions close
        const kecInput = document.getElementById('kecamatanInput');
        const kecContainer = document.getElementById('kecamatanSuggestions');
        if (kecInput && kecContainer && !kecInput.contains(e.target) && !kecContainer.contains(e.target)) {
            kecContainer.style.display = 'none';
        }
    });

    // Pre-check pendaftar type on error return
    document.addEventListener("DOMContentLoaded", function() {
        toggleTipePendaftar();
    });
</script>
</body>
</html>