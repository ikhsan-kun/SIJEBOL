<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Form Pengajuan JEBOL</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/custom-style.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
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
        body { font-family: 'Inter', sans-serif; background: #001f5b; }
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .form-card { box-shadow: 0 4px 20px -2px rgba(0,0,0,0.05); }
        .main-content {
            flex-grow: 1;
            margin-left: 260px;
            padding: 80px 0 0 0;
            background: #001f5b;
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
            gap: 8px;
            flex-wrap: nowrap;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            padding: 7px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: white;
            font-size: 0.8rem;
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
        <?php echo $__env->make('partials.sidebar-masyarakat', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <main class="main-content">

            <!-- Header Dinamis -->
            <div class="transition-soft" style="position: relative; padding: 32px 40px; background-color: #003178; border-bottom: 4px solid #f59e0b; overflow: hidden; color: white;">
                <!-- Background Overlay -->
                <div style="position: absolute; inset: 0; background-image: url('<?php echo e(asset('images/batik-tegal-premium.jpg')); ?>'); background-size: 400px; opacity: 0.08; z-index: 0;"></div>
                
                <div style="position: relative; z-index: 10; display: flex; align-items: flex-start; gap: 24px;">
                    <div style="background: rgba(255,255,255,0.15); width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <span class="material-symbols-outlined" style="font-size: 28px; color: white;" x-text="getHeaderIcon()"></span>
                    </div>
                    <div>
                        <h1 style="margin: 0; font-size: 1.6rem; font-weight: 800; line-height: 1.2; color: white;">Form Pengajuan</h1>
                        <h2 style="margin: 4px 0 8px 0; font-size: 1.05rem; font-weight: 700; color: #f59e0b;" x-text="formData.jenis_layanan + ' JEBOL'"></h2>
                        <p style="margin: 0; font-size: 0.9rem; color: rgba(255,255,255,0.8); max-width: 600px; line-height: 1.5;">
                            Lengkapi form berikut untuk mendaftarkan layanan <strong style="color: white;" x-text="formData.jenis_layanan"></strong> melalui mobil keliling JEBOL Disdukcapil Kota Tegal.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Start -->
            <form id="form-jebol" style="display: block; width: 100%;" @submit.prevent="submitForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="jenis_layanan" :value="formData.jenis_layanan">

                <!-- 1. DATA PEMOHON / SEKOLAH -->
                <?php if(auth()->user() && auth()->user()->tipe_pendaftar === 'sekolah'): ?>
                    <div class="form-card-modern transition-soft">
                        <div class="form-section-header">
                            <span class="form-section-badge">1</span>
                            <h3 class="form-section-title">Data Sekolah & Petugas Penghubung (PIC)</h3>
                        </div>

                        <div class="form-grid">
                            <div>
                                <label class="form-label">Nama Sekolah <span>*</span></label>
                                <input type="text" name="nama_sekolah" value="<?php echo e(auth()->user()->school); ?>" readonly class="form-input" style="background-color: #e2e8f0; cursor: not-allowed;" placeholder="Nama Sekolah">
                            </div>
                            <div>
                                <label class="form-label">Nama Petugas Penghubung (PIC) <span>*</span></label>
                                <input type="text" name="nama" value="<?php echo e(auth()->user()->nama ?? auth()->user()->name); ?>" required class="form-input" placeholder="Masukkan nama petugas sekolah">
                            </div>
                            <div>
                                <label class="form-label">NIK Petugas <span>*</span></label>
                                <input type="number" name="nik" value="<?php echo e(auth()->user()->nik); ?>" required class="form-input" placeholder="Masukkan 16 digit NIK petugas">
                            </div>
                            <div>
                                <label class="form-label">Nomor WhatsApp Petugas (PIC) <span>*</span></label>
                                <input type="tel" name="phone" value="<?php echo e(auth()->user()->no_hp ?? auth()->user()->phone); ?>" required class="form-input" placeholder="08xxxxxxxxxx">
                            </div>
                            <div>
                                <label class="form-label">Jumlah Anak/Siswa yang Diajukan <span>*</span></label>
                                <input type="number" name="jumlah_anak" x-model="formData.jumlah_anak" min="1" required class="form-input" placeholder="Masukkan total jumlah anak/siswa">
                                <small style="color: var(--text-muted); font-size: 0.8rem; margin-top: 4px; display: block;">Masukkan total anak/siswa yang didaftarkan pada pengajuan kolektif ini.</small>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
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
                <?php endif; ?>

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
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
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
                                    <?php $__currentLoopData = $masterKecamatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kec->nama); ?>"><?php echo e($kec->nama); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <?php if(auth()->user() && auth()->user()->tipe_pendaftar === 'sekolah'): ?>
                        <input type="hidden" name="jenis_pengajuan" value="Sekolah">
                    <?php else: ?>
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
                    <?php endif; ?>

                </div>

                <!-- ROW: 4 & 5 side by side -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 0;">

                    <!-- 4. LAMPIRAN DOKUMEN -->
                    <div class="form-card-modern transition-soft" style="margin-bottom: 0;">
                        <div class="form-section-header">
                            <span class="form-section-badge" x-text="formData.jenis_layanan === 'KIA' ? '5' : '4'"></span>
                            <h3 class="form-section-title">Lampiran Dokumen</h3>
                        </div>

                        <?php if(auth()->user() && auth()->user()->tipe_pendaftar === 'sekolah'): ?>
                            <div class="form-grid">
                                <div style="grid-column: span 2;">
                                    <label class="form-label">Upload Surat Pengantar Permohonan Kolektif dari Sekolah <span>*</span></label>
                                    <input type="file" name="file_surat_pengantar" required accept="image/*,.pdf" class="form-input" style="background: white; padding: 8px;">
                                    <small style="color: #64748b; font-size: 0.8rem; margin-top: 4px; display: block;">Format PDF atau Gambar, maksimal 2MB. <a href="<?php echo e(asset('templates/template_surat_pengantar_kolektif.rtf')); ?>" download style="color: #003178; font-weight: 700; text-decoration: underline;">Unduh Template Surat (Siap Cetak)</a></small>
                                </div>
                            </div>
                        <?php else: ?>
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
                        <?php endif; ?>
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
                        <a href="<?php echo e(route('masyarakat.layanan')); ?>" style="padding: 12px 24px; color: #475569; font-weight: 700; text-decoration: none; border-radius: 8px; transition: all 0.2s ease;">Batal</a>
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

    <script>
        lucide.createIcons();

        function jebolForm() {
            return {
                isSubmitting: false,
                formData: {
                    jenis_layanan: '<?php echo e(request("layanan") ?? "KTP-el"); ?>',

                    // Common
                    nama: '<?php echo e(auth()->user()->nama ?? auth()->user()->name ?? ""); ?>',
                    nik: '<?php echo e(auth()->user()->nik ?? ""); ?>',
                    nomor_kk: '',
                    jumlah_anak: 1,
                    tempat_lahir: '',
                    tanggal_lahir: '',
                    jenis_kelamin: '',
                    phone: '<?php echo e(auth()->user()->no_hp ?? auth()->user()->phone ?? ""); ?>',
                    email: '<?php echo e(auth()->user()->email ?? ""); ?>',
                    
                    // Wilayah
                    alamat: '<?php echo e(auth()->user()->alamat ?? ""); ?>',
                    provinsi: 'Jawa Tengah',
                    lokasi_pelayanan: '',
                    kelurahan: '',
                    
                    // KTP-el
                    kategori_pemohon: 'Umum',
                    jenis_pengajuan: '',
                    
                    // KIA
                    nama_anak: '',
                    nik_anak: '',
                    tempat_lahir_anak: '',
                    tanggal_lahir_anak: '',
                    jenis_kelamin_anak: '',
                    nama_ayah: '',
                    nama_ibu: '',
                    phone_ortu: '',
                    hubungan_anak: 'Ayah',

                    keterangan: '',
                    persetujuan: false
                },

                init() {
                    <?php if(auth()->user() && auth()->user()->tipe_pendaftar === 'sekolah'): ?>
                        this.formData.jenis_pengajuan = 'Sekolah';
                    <?php else: ?>
                        // Set default jenis pengajuan
                        if (this.formData.jenis_layanan === 'KTP-el') this.formData.jenis_pengajuan = 'KTP-el Baru';
                        else if (this.formData.jenis_layanan === 'IKD') this.formData.jenis_pengajuan = 'Pembuatan IKD Baru';
                        else if (this.formData.jenis_layanan === 'KIA') this.formData.jenis_pengajuan = 'KIA Baru';
                    <?php endif; ?>
                },

                get themeClass() {
                    return {
                        headerBg: 'bg-primary border-b-4 border-blue-900',
                        textMain: 'text-primary',
                        badgeBg: 'bg-primary',
                        borderTop: 'border-t-primary',
                        focusRing: 'focus:border-primary focus:ring-primary/20',
                        radioColor: 'text-primary focus:ring-primary',
                        btnBg: 'bg-primary hover:bg-blue-900',
                        iconText: 'text-primary',
                        decor1: 'bg-blue-800',
                        decor2: 'bg-blue-700'
                    };
                },

                getHeaderIcon() {
                    if (this.formData.jenis_layanan === 'KTP-el') return 'badge';
                    if (this.formData.jenis_layanan === 'IKD') return 'security';
                    if (this.formData.jenis_layanan === 'KIA') return 'face';
                    return 'description';
                },

                getKelurahanList() {
                        <?php
                            $kelMap = [];
                            foreach($masterKelurahan as $kel) {
                                if ($kel->kecamatan_nama) {
                                    $kelMap[$kel->kecamatan_nama][] = $kel->nama;
                                }
                            }
                        ?>
                        const data = <?php echo json_encode($kelMap, 15, 512) ?>;
                    return data[this.formData.lokasi_pelayanan] || [];
                },

                getJenisPengajuanOptions() {
                    if (this.formData.jenis_layanan === 'KTP-el') {
                        return ['KTP-el Baru', 'KTP-el Hilang', 'KTP-el Rusak', 'Perubahan Data KTP-el'];
                    } else if (this.formData.jenis_layanan === 'IKD') {
                        return ['Pembuatan IKD Baru', 'Aktivasi Ulang IKD', 'Perubahan Data IKD'];
                    } else if (this.formData.jenis_layanan === 'KIA') {
                        return ['KIA Baru', 'KIA Hilang', 'KIA Rusak', 'Perubahan Data KIA'];
                    }
                    return [];
                },

                submitForm() {
                    if (!this.formData.persetujuan) {
                        Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Anda wajib menyetujui pernyataan.' });
                        return;
                    }

                    this.isSubmitting = true;
                    let formElement = document.getElementById('form-jebol');
                    let fd = new FormData(formElement);

                    fetch('<?php echo e(route("pengajuan.store")); ?>', {
                        method: 'POST',
                        body: fd,
                        headers: { 
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(async res => {
                        const data = await res.json();
                        if (!res.ok) {
                            if (res.status === 422) {
                                let errorMsgs = [];
                                for (let key in data.errors) {
                                    errorMsgs.push(data.errors[key][0]);
                                }
                                throw new Error(errorMsgs.join('<br>'));
                            }
                            throw new Error(data.message || 'Terjadi kesalahan server.');
                        }
                        return data;
                    })
                    .then(data => {
                        this.isSubmitting = false;
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pengajuan Berhasil!',
                                html: `<p>Nomor Tiket Anda:</p><p class="jbl-742 jbl-586 jbl-1305">${data.nomor_tiket}</p>`,
                                confirmButtonText: 'Selesai',
                                confirmButtonColor: '#2563eb'
                            }).then(() => {
                                window.location.href = "<?php echo e(route('masyarakat.cek-status')); ?>";
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
                        }
                    })
                    .catch(err => {
                        this.isSubmitting = false;
                        Swal.fire({ icon: 'error', title: 'Periksa Kembali', html: err.message });
                    });
                }
            }
        }
    </script>
</body>
</html>
<?php /**PATH D:\laragon\www\jeboll\resources\views/masyarakat/pengajuan.blade.php ENDPATH**/ ?>