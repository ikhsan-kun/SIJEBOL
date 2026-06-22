<?php
$js = file_get_contents('resources/views/masyarakat/pengajuan.blade.php');
// Extract JS part (from <script> to </html>)
$scriptStart = strpos($js, '<script>
        lucide.createIcons();');
$jsContent = substr($js, $scriptStart);

$html = <<<'BLADE'
<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Form Pengajuan JEBOL</title>
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#003178",
                        "primary-light": "#e0eaff",
                        "background": "#f8faff",
                        "success": "#10b981",
                        "outline": "#94a3b8",
                        "outline-variant": "#e2e8f0"
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; }
        body { font-family: 'Inter', sans-serif; }
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .form-card { box-shadow: 0 4px 20px -2px rgba(0,0,0,0.05); }
        .main-content {
            flex-grow: 1;
            margin-left: 260px;
            padding: 80px 0 0 0;
            background: transparent;
            min-width: 0;
            transition: all 0.3s ease;
            display: flex; flex-direction: column; min-height: 100vh;
        }

        /* Form Modern Styles */
        .form-card-modern {
            background: white;
            border-radius: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border-top: 4px solid #003178;
            border-bottom: 1px solid #e2e8f0;
            padding: 40px;
            margin: 0;
        }

        .form-section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-section-badge {
            background: #003178;
            color: white;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .form-section-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 8px;
        }

        .form-label span {
            color: #ef4444;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #1e293b;
            background: #f8fafc;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: #003178;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 49, 120, 0.1);
        }

        .radio-group {
            display: flex;
            gap: 12px;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 10px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            font-size: 0.9rem;
            font-weight: 600;
            color: #475569;
            transition: all 0.2s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .radio-label:hover {
            background: #f1f5f9;
        }

        .radio-label input[type="radio"]:checked + span {
            color: #003178;
        }
    </style>
</head>
<body class="bg-background jbl-386 jbl-342 jbl-461 jbl-1293 jbl-1541 jbl-680 jbl-1424 jbl-415"
      x-data="jebolForm()">

    <div class="dashboard-layout jbl-1293">
        @include('partials.sidebar-masyarakat')

        <main class="main-content">

            <!-- Header Dinamis -->
            <div class="transition-soft" :class="themeClass.headerBg" style="position: relative; padding: 40px; background-color: #003178; border-bottom: 4px solid #f59e0b; overflow: hidden; color: white;">
                <!-- Background Overlay -->
                <div style="position: absolute; inset: 0; background-image: url('{{ asset('images/batik-tegal-premium.jpg') }}'); background-size: 400px; opacity: 0.1; z-index: 0;"></div>
                
                <div style="position: relative; z-index: 10; display: flex; align-items: flex-start; gap: 24px;">
                    <div style="background: rgba(255,255,255,0.2); width: 64px; height: 64px; border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <span class="material-symbols-outlined" style="font-size: 32px;" x-text="getHeaderIcon()"></span>
                    </div>
                    <div>
                        <h1 style="margin: 0; font-size: 2rem; font-weight: 800; line-height: 1.2;">Form Pengajuan</h1>
                        <h2 style="margin: 4px 0 12px 0; font-size: 1.25rem; font-weight: 700; color: #f59e0b;" x-text="formData.jenis_layanan + ' JEBOL'"></h2>
                        <p style="margin: 0; font-size: 0.95rem; opacity: 0.9; max-width: 600px; line-height: 1.5;">
                            Lengkapi form berikut untuk mendaftarkan layanan <strong x-text="formData.jenis_layanan"></strong> melalui mobil keliling JEBOL Disdukcapil Kota Tegal.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Start -->
            <form id="form-jebol" style="display: block; width: 100%;" @submit.prevent="submitForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jenis_layanan" :value="formData.jenis_layanan">

                <!-- 1. DATA PEMOHON -->
                <div class="form-card-modern transition-soft">
                    <div class="form-section-header">
                        <span class="form-section-badge">1</span>
                        <h3 class="form-section-title">Data Pemohon</h3>
                    </div>

                    <!-- KTP-el / IKD Pemohon Fields -->
                    <div class="form-grid" x-show="formData.jenis_layanan === 'KTP-el' || formData.jenis_layanan === 'IKD'">
                        <div>
                            <label class="form-label">Nama Lengkap <span>*</span></label>
                            <input type="text" name="nama" x-model="formData.nama" :required="formData.jenis_layanan !== 'KIA'" class="form-input" placeholder="Masukkan nama lengkap">
                        </div>
                        <div>
                            <label class="form-label">NIK <span>*</span></label>
                            <input type="number" name="nik" x-model="formData.nik" :required="formData.jenis_layanan !== 'KIA'" class="form-input" placeholder="Masukkan 16 digit NIK">
                        </div>
                        <div x-show="formData.jenis_layanan === 'KTP-el'">
                            <label class="form-label">Nomor KK <span>*</span></label>
                            <input type="number" name="nomor_kk" x-model="formData.nomor_kk" :required="formData.jenis_layanan === 'KTP-el'" class="form-input" placeholder="Masukkan Nomor KK">
                        </div>
                        <div>
                            <label class="form-label">Tempat Lahir <span>*</span></label>
                            <input type="text" name="tempat_lahir" x-model="formData.tempat_lahir" :required="formData.jenis_layanan !== 'KIA'" class="form-input" placeholder="Masukkan tempat lahir">
                        </div>
                        <div>
                            <label class="form-label">Tanggal Lahir <span>*</span></label>
                            <input type="date" name="tanggal_lahir" x-model="formData.tanggal_lahir" :required="formData.jenis_layanan !== 'KIA'" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Jenis Kelamin <span>*</span></label>
                            <select name="jenis_kelamin" x-model="formData.jenis_kelamin" :required="formData.jenis_layanan !== 'KIA'" class="form-input">
                                <option value="">Pilih jenis kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Nomor HP/WhatsApp <span>*</span></label>
                            <input type="tel" name="phone" x-model="formData.phone" :required="formData.jenis_layanan !== 'KIA'" class="form-input" placeholder="08xxxxxxxxxx">
                        </div>
                        <div x-show="formData.jenis_layanan === 'IKD'">
                            <label class="form-label">Email Aktif</label>
                            <input type="email" name="email" x-model="formData.email" :required="formData.jenis_layanan === 'IKD'" class="form-input" placeholder="example@mail.com">
                        </div>
                    </div>

                    <!-- KIA Anak Fields -->
                    <div class="form-grid" x-show="formData.jenis_layanan === 'KIA'" style="display:none;">
                        <div>
                            <label class="form-label">Nama Lengkap Anak <span>*</span></label>
                            <input type="text" name="nama_anak" x-model="formData.nama_anak" :required="formData.jenis_layanan === 'KIA'" class="form-input" placeholder="Masukkan nama lengkap anak">
                        </div>
                        <div>
                            <label class="form-label">NIK Anak (jika ada)</label>
                            <input type="number" name="nik_anak" x-model="formData.nik_anak" class="form-input" placeholder="Masukkan NIK anak (jika ada)">
                        </div>
                        <div>
                            <label class="form-label">Tempat Lahir <span>*</span></label>
                            <input type="text" name="tempat_lahir_anak" x-model="formData.tempat_lahir_anak" :required="formData.jenis_layanan === 'KIA'" class="form-input" placeholder="Masukkan tempat lahir">
                        </div>
                        <div>
                            <label class="form-label">Tanggal Lahir <span>*</span></label>
                            <input type="date" name="tanggal_lahir_anak" x-model="formData.tanggal_lahir_anak" :required="formData.jenis_layanan === 'KIA'" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Jenis Kelamin <span>*</span></label>
                            <select name="jenis_kelamin_anak" x-model="formData.jenis_kelamin_anak" :required="formData.jenis_layanan === 'KIA'" class="form-input">
                                <option value="">Pilih jenis kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kategori Pemohon (Hanya KTP-el) -->
                    <div style="margin-top: 24px;" x-show="formData.jenis_layanan === 'KTP-el'">
                        <label class="form-label">Kategori Pemohon (Prioritas) <span>*</span></label>
                        <div class="radio-group">
                            <template x-for="kat in ['Umum', 'Lansia', 'ODGJ', 'Disabilitas', 'Sakit']">
                                <label class="radio-label" :style="formData.kategori_pemohon === kat ? 'border-color: #003178; background: #f8fafc;' : ''">
                                    <input type="radio" name="kategori_pemohon" :value="kat" x-model="formData.kategori_pemohon" style="accent-color: #003178;">
                                    <span x-text="kat"></span>
                                </label>
                            </template>
                        </div>
                    </div>

                    <!-- Data Orang Tua / Wali (Hanya KIA) -->
                    <div style="margin-top: 24px;" x-show="formData.jenis_layanan === 'KIA'" style="display:none;">
                        <h4 style="font-size: 1.05rem; font-weight: 700; color: #003178; display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                            <span class="material-symbols-outlined">family_restroom</span>
                            Data Orang Tua / Wali
                        </h4>
                        <div class="form-grid">
                            <div>
                                <label class="form-label">Nama Ayah <span>*</span></label>
                                <input type="text" name="nama_ayah" x-model="formData.nama_ayah" :required="formData.jenis_layanan === 'KIA'" class="form-input" placeholder="Masukkan nama ayah">
                            </div>
                            <div>
                                <label class="form-label">Nama Ibu <span>*</span></label>
                                <input type="text" name="nama_ibu" x-model="formData.nama_ibu" :required="formData.jenis_layanan === 'KIA'" class="form-input" placeholder="Masukkan nama ibu">
                            </div>
                            <div>
                                <label class="form-label">Nomor HP/WhatsApp <span>*</span></label>
                                <input type="tel" name="phone_ortu" x-model="formData.phone_ortu" :required="formData.jenis_layanan === 'KIA'" class="form-input" placeholder="08xxxxxxxxxx">
                            </div>
                            <div>
                                <label class="form-label">Hubungan dengan Anak <span>*</span></label>
                                <select name="hubungan_anak" x-model="formData.hubungan_anak" :required="formData.jenis_layanan === 'KIA'" class="form-input">
                                    <option value="Ayah">Ayah</option>
                                    <option value="Ibu">Ibu</option>
                                    <option value="Wali">Wali / Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ROW: 2 & 3 side by side -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 0;">

                    <!-- 2. DATA WILAYAH -->
                    <div class="form-card-modern transition-soft" style="margin-bottom: 0;">
                        <div class="form-section-header">
                            <span class="form-section-badge" x-text="formData.jenis_layanan === 'KIA' ? '3' : '2'"></span>
                            <h3 class="form-section-title">Data Wilayah</h3>
                        </div>
                        
                        <div style="margin-bottom: 24px;">
                            <label class="form-label">Alamat Lengkap <span>*</span></label>
                            <input type="text" name="alamat" x-model="formData.alamat" required class="form-input" placeholder="Masukkan alamat lengkap">
                        </div>
                        
                        <div class="form-grid">
                            <div>
                                <label class="form-label">Provinsi <span>*</span></label>
                                <select name="provinsi" x-model="formData.provinsi" required class="form-input">
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Kecamatan <span>*</span></label>
                                <select name="lokasi_pelayanan" x-model="formData.lokasi_pelayanan" @change="formData.kelurahan = ''" required class="form-input">
                                    <option value="">Pilih kecamatan</option>
                                    @foreach($masterKecamatan as $kec)
                                        <option value="{{ $kec->nama }}">{{ $kec->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Kelurahan/Desa <span>*</span></label>
                                <select name="kelurahan" x-model="formData.kelurahan" required class="form-input">
                                    <option value="">Pilih kelurahan/desa</option>
                                    <template x-for="kel in getKelurahanList()">
                                        <option :value="kel" x-text="kel" :selected="formData.kelurahan === kel"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 3. JENIS PENGAJUAN -->
                    <div class="form-card-modern transition-soft" style="margin-bottom: 0;">
                        <div class="form-section-header">
                            <span class="form-section-badge" x-text="formData.jenis_layanan === 'KIA' ? '4' : '3'"></span>
                            <h3 class="form-section-title" x-text="'Jenis Pengajuan ' + formData.jenis_layanan"></h3>
                        </div>

                        <div class="radio-group">
                            <template x-for="opsi in getJenisPengajuanOptions()">
                                <label class="radio-label" :style="formData.jenis_pengajuan === opsi ? 'border-color: #003178; background: #f8fafc;' : ''">
                                    <input type="radio" name="jenis_pengajuan" :value="opsi" x-model="formData.jenis_pengajuan" style="accent-color: #003178;">
                                    <span x-text="opsi"></span>
                                </label>
                            </template>
                        </div>
                    </div>

                </div>

                <!-- ROW: 4 & 5 side by side -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 0;">

                    <!-- 4. LAMPIRAN DOKUMEN -->
                    <div class="form-card-modern transition-soft" style="margin-bottom: 0;">
                        <div class="form-section-header">
                            <span class="form-section-badge" x-text="formData.jenis_layanan === 'KIA' ? '5' : '4'"></span>
                            <h3 class="form-section-title">Lampiran Dokumen</h3>
                        </div>

                        <div class="form-grid">
                            <!-- Upload KK (All) -->
                            <div>
                                <label class="form-label">Upload Kartu Keluarga (KK) <span>*</span></label>
                                <input type="file" name="file_kk" required accept="image/*,.pdf" class="form-input" style="background: white; padding: 8px;">
                            </div>

                            <!-- KTP-el Extras -->
                            <div x-show="formData.jenis_layanan === 'KTP-el'">
                                <div x-show="formData.jenis_pengajuan === 'KTP-el Rusak' || formData.jenis_pengajuan === 'Perubahan Data KTP-el'">
                                    <label class="form-label">Upload KTP lama <span style="color: #64748b; font-weight: normal;">(jika rusak/perubahan data)</span> <span>*</span></label>
                                    <input type="file" name="file_ktp_lama" accept="image/*,.pdf" class="form-input" style="background: white; padding: 8px;" :required="formData.jenis_pengajuan === 'KTP-el Rusak' || formData.jenis_pengajuan === 'Perubahan Data KTP-el'">
                                </div>
                                <div style="margin-top: 16px;" x-show="formData.jenis_pengajuan === 'KTP-el Hilang'">
                                    <label class="form-label">Upload Surat Kehilangan <span style="color: #64748b; font-weight: normal;">(jika hilang)</span> <span>*</span></label>
                                    <input type="file" name="file_surat_kehilangan" accept="image/*,.pdf" class="form-input" style="background: white; padding: 8px;" :required="formData.jenis_pengajuan === 'KTP-el Hilang'">
                                </div>
                            </div>

                            <!-- KIA Extras -->
                            <div x-show="formData.jenis_layanan === 'KIA'" style="display:none;">
                                <div>
                                    <label class="form-label">Upload Akta Kelahiran <span>*</span></label>
                                    <input type="file" name="file_akta_kelahiran" accept="image/*,.pdf" class="form-input" style="background: white; padding: 8px;" :required="formData.jenis_layanan === 'KIA'">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. KETERANGAN TAMBAHAN -->
                    <div class="form-card-modern transition-soft" style="margin-bottom: 0;">
                        <div class="form-section-header">
                            <span class="form-section-badge" x-text="formData.jenis_layanan === 'KIA' ? '6' : '5'"></span>
                            <h3 class="form-section-title">Keterangan Tambahan</h3>
                        </div>
                        <textarea name="keterangan" x-model="formData.keterangan" rows="6" class="form-input" placeholder="Masukkan keterangan (opsional)" style="resize: vertical; width: 100%;"></textarea>
                    </div>

                </div>

                <!-- Persetujuan & Submit — full width -->
                <div class="form-card-modern transition-soft">
                    <label style="display: flex; gap: 12px; align-items: flex-start; padding: 16px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; cursor: pointer; margin-bottom: 24px;">
                        <input type="checkbox" name="persetujuan" x-model="formData.persetujuan" required style="margin-top: 4px; width: 18px; height: 18px; flex-shrink: 0; accent-color: #d97706;">
                        <p style="margin: 0; font-size: 0.9rem; color: #92400e; font-weight: 600; line-height: 1.5;">Saya menyatakan bahwa data dan dokumen yang saya unggah adalah benar dan dapat dipertanggungjawabkan sesuai hukum yang berlaku.</p>
                    </label>
                    <div style="display: flex; justify-content: flex-end; gap: 16px;">
                        <a href="{{ route('masyarakat.layanan') }}" style="padding: 12px 24px; color: #475569; font-weight: 700; text-decoration: none; border-radius: 8px; transition: all 0.2s ease;">Batal</a>
                        <button type="submit" style="padding: 12px 32px; background: #f59e0b; color: white; border: none; border-radius: 8px; font-weight: 800; font-size: 1rem; display: flex; align-items: center; gap: 8px; cursor: pointer; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3); transition: all 0.2s ease;" onmouseover="this.style.background='#d97706'" onmouseout="this.style.background='#f59e0b'">
                            <span x-show="!isSubmitting">Kirim Pengajuan</span>
                            <span x-show="isSubmitting">Memproses...</span>
                            <span class="material-symbols-outlined" style="font-size: 20px;" x-show="!isSubmitting">send</span>
                        </button>
                    </div>
                </div>

            </form>

            <!-- Global Footer -->
            <div style="margin-top: auto; padding: 24px; background: white; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748b;">
                <div>&copy; 2026 Dinas Kependudukan dan Pencatatan Sipil Kota Tegal. All rights reserved.</div>
                <div style="display:flex; gap:16px;">
                    <a href="#" style="color:#64748b; text-decoration:none;">Kebijakan Privasi</a>
                    <a href="#" style="color:#64748b; text-decoration:none;">Syarat &amp; Ketentuan</a>
                </div>
            </div>
        </main>
    </div>

BLADE;

file_put_contents('resources/views/masyarakat/pengajuan.blade.php', $html . "\n    " . $jsContent);
echo "Done!\n";
