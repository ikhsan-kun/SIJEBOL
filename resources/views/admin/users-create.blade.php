<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tambah Pengguna - SI JEBOL Admin</title>
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        chrome: {
                            bg: "#f8fafc",
                            surface: "#ffffff",
                            border: "#e2e8f0",
                            text: "#1e293b",
                            muted: "#64748b",
                            blue: "#2563eb",
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        body { background-color: #f8fafc; color: #1e293b; }
        
        .chrome-input {
            background-color: #f8fafc;
            color: #1e293b;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
        }
        .chrome-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
            background-color: #ffffff;
        }
        .chrome-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
        }
        .chrome-btn {
            background-color: rgba(37, 99, 235, 0.05);
            color: #2563eb;
            border: 1px solid rgba(37, 99, 235, 0.2);
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }
        .chrome-btn:hover { background-color: rgba(37, 99, 235, 0.1); border-color: #2563eb; }
        .chrome-btn-filled {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 8px 24px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
            transition: all 0.2s;
        }
        .chrome-btn-filled:hover { transform: translateY(-1px); box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3); }
    </style>
</head>
<body class="jbl-342 jbl-461 batik-pattern jbl-1134">
    <main class="jbl-461 jbl-1109 jbl-1293 jbl-141 jbl-1285 jbl-181">
        <div class="jbl-576 jbl-1539">
            
            <div class="jbl-1293 jbl-1426 jbl-701 jbl-59">
                <a href="{{ route('admin.users') }}" class="jbl-800 jbl-111 jbl-835 jbl-434 jbl-333 border-chrome-border jbl-1293 jbl-1426 jbl-141 jbl-582 jbl-632 jbl-160">
                    <span class="material-symbols-outlined text-chrome-text">arrow_back</span>
                </a>
                <div>
                    <h1 class="jbl-742 jbl-1397 text-chrome-text">Tambah Pengguna Baru</h1>
                    <p class="jbl-166 text-chrome-muted jbl-1237">Daftarkan akun administrator atau petugas baru ke sistem.</p>
                </div>
            </div>

            @if($errors->any())
            <div class="jbl-454 jbl-156 jbl-656 jbl-333 jbl-1346 jbl-1320">
                <div class="jbl-1293 jbl-1426 jbl-745 jbl-1429">
                    <span class="material-symbols-outlined jbl-18 jbl-1203">error</span>
                    <h3 class="jbl-166 jbl-1397 jbl-719">Terjadi Kesalahan</h3>
                </div>
                <ul class="jbl-1405 jbl-660 jbl-843 jbl-1443 jbl-1003">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="userForm" action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <div class="chrome-card jbl-746 jbl-197">
                    <h3 class="jbl-105 jbl-772 text-chrome-text jbl-454 jbl-613 jbl-1049 border-chrome-border">Informasi Dasar</h3>
                    
                    <div class="jbl-66">
                        <div>
                            <label class="jbl-810 text-chrome-muted jbl-225 jbl-1044">Nama Lengkap</label>
                            <input type="text" name="name" placeholder="Contoh: Budi Santoso" class="chrome-input" required>
                        </div>
                        
                        <div class="jbl-174 jbl-1019 jbl-868 jbl-1485">
                            <div>
                                <label class="jbl-810 text-chrome-muted jbl-225 jbl-1044">NIK (16 Digit)</label>
                                <input type="text" name="nik" placeholder="16 digit NIK" class="chrome-input" required>
                            </div>
                            <div>
                                <label class="jbl-810 text-chrome-muted jbl-225 jbl-1044">Email Instansi</label>
                                <input type="email" name="email" placeholder="nama@tegal.go.id" class="chrome-input" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chrome-card jbl-746 jbl-197">
                    <h3 class="jbl-105 jbl-772 text-chrome-text jbl-454 jbl-613 jbl-1049 border-chrome-border">Pengaturan Akses</h3>
                    
                    <div class="jbl-174 jbl-1019 jbl-868 jbl-1485">
                        <div>
                            <label class="jbl-810 text-chrome-muted jbl-225 jbl-1044">Peran / Role</label>
                            <select name="role" class="chrome-input jbl-434" required>
                                <option value="" disabled selected>Pilih salah satu peran</option>
                                <option value="admin">Admin Pusat</option>
                                <option value="cabang">Cabang / Instansi</option>
                                <option value="masyarakat">Masyarakat Umum</option>
                            </select>
                        </div>
                        <div>
                            <label class="jbl-810 text-chrome-muted jbl-225 jbl-1044">Unit Kerja / Kecamatan</label>
                            <select name="kecamatan" class="chrome-input jbl-434" required>
                                <option value="Pusat" selected>Pusat (Admin)</option>
                                <option value="Tegal Timur">Tegal Timur</option>
                                <option value="Tegal Barat">Tegal Barat</option>
                                <option value="Tegal Selatan">Tegal Selatan</option>
                                <option value="Margadana">Margadana</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="chrome-card jbl-746 jbl-197">
                    <h3 class="jbl-105 jbl-772 text-chrome-text jbl-454 jbl-613 jbl-1049 border-chrome-border">Keamanan Akun</h3>
                    
                    <div class="jbl-174 jbl-1019 jbl-868 jbl-1485">
                        <div>
                            <label class="jbl-810 text-chrome-muted jbl-225 jbl-1044">Kata Sandi</label>
                            <input type="password" name="password" placeholder="Minimal 8 karakter..." class="chrome-input" required>
                        </div>
                        <div>
                            <label class="jbl-810 text-chrome-muted jbl-225 jbl-1044">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi..." class="chrome-input" required>
                        </div>
                    </div>
                </div>

                <div class="jbl-1293 jbl-1171 jbl-985 jbl-423">
                    <a href="{{ route('admin.users') }}" class="chrome-btn">Batal</a>
                    <button type="submit" class="chrome-btn-filled">Simpan Pengguna Baru</button>
                </div>
            </form>
        </div>
    </main>

    <div id="loadingOverlay" class="jbl-524 jbl-1062 jbl-89 jbl-637 jbl-1469 jbl-565 jbl-1541 jbl-1426 jbl-141">
        <div class="jbl-27 jbl-1040 jbl-1571 jbl-935 jbl-49 jbl-835 jbl-19 jbl-870"></div>
        <h2 class="jbl-105 jbl-772 text-chrome-text">Menyimpan Data...</h2>
    </div>

    <script>
        document.getElementById('userForm').addEventListener('submit', function() {
            document.getElementById('loadingOverlay').classList.remove('hidden');
            document.getElementById('loadingOverlay').classList.add('flex');
        });
    </script>
</body>
</html>

