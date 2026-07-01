

<?php $__env->startPush('styles'); ?>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; }
        
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .form-card { box-shadow: 0 4px 20px -2px rgba(0,0,0,0.05); }
        

        /* Form Modern Styles */
        .form-card-modern {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border-top: 4px solid #003178;
            padding: 32px;
            margin-bottom: 24px;
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

        .success-modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15,23,42,0.7);
            z-index: 9999;
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding-left: 260px;
        }
        @media (max-width: 1024px) {
            .success-modal-overlay {
                padding-left: 0;
            }
        }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div x-data="formJebol()">
<!-- Header Dinamis -->
            <div class="transition-soft" style="position: relative; margin: -24px -24px 24px -24px; padding: 32px 40px; background-color: #003178; border-bottom: 4px solid #f59e0b; overflow: hidden; color: white;">
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
            <form id="form-jebol" action="<?php echo e(route('pengajuan.store')); ?>" method="POST" style="display: block; width: 100%;" @submit.prevent="submitForm" enctype="multipart/form-data">
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
                                <input type="text" name="nik" value="<?php echo e(auth()->user()->nik); ?>" required class="form-input" placeholder="Masukkan 16 digit NIK petugas" minlength="16" maxlength="16" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
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
                                <input type="text" name="nik" x-model="formData.nik" :required="formData.jenis_layanan !== 'KIA'" class="form-input" placeholder="Masukkan 16 digit NIK" minlength="16" maxlength="16" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
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
                                <input type="text" name="nik_anak" x-model="formData.nik_anak" class="form-input" placeholder="Masukkan NIK anak (jika ada)" minlength="16" maxlength="16" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
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
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 24px;">

                    <!-- 2. DATA WILAYAH -->
                    <div class="form-card-modern transition-soft">
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
                        <div class="form-card-modern transition-soft">
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
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 24px;">

                    <!-- 4. LAMPIRAN DOKUMEN -->
                    <div class="form-card-modern transition-soft">
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
                    <div class="form-card-modern transition-soft">
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

            <!-- Success Ticket Modal -->
            <div x-show="showSuccessModal" style="display: none;" class="success-modal-overlay" x-transition.opacity>
                <div class="transition-soft" style="background: white; border-radius: 20px; padding: 40px; text-align: center; max-width: 450px; width: 90%; box-shadow: 0 20px 40px rgba(0,0,0,0.2);" @click.stop>
                    <div style="width: 80px; height: 80px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto; box-shadow: 0 8px 16px rgba(16,185,129,0.3);">
                        <span class="material-symbols-outlined" style="color: white; font-size: 40px; font-weight: bold;">check</span>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Pengajuan Terkirim!</h3>
                    <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 24px; line-height: 1.5;">Pengajuan layanan <strong style="color: #003178;" x-text="formData.jenis_layanan"></strong> Anda telah berhasil dikirim ke sistem SI JEBOL.</p>
                    
                    <div style="background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 20px; margin-bottom: 32px; position: relative; overflow: hidden;">
                        <div style="position: absolute; left: -10px; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; background: white; border-radius: 50%; border-right: 2px dashed #cbd5e1;"></div>
                        <div style="position: absolute; right: -10px; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; background: white; border-radius: 50%; border-left: 2px dashed #cbd5e1;"></div>
                        <span style="display: block; font-size: 0.85rem; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Nomor Tiket Anda</span>
                        <h4 style="font-size: 1.6rem; font-weight: 900; color: #003178; margin: 0; letter-spacing: 1px;" x-text="nomorTiket"></h4>
                    </div>

                    <a :href="'/masyarakat/cek-status?search=' + nomorTiket" style="display: block; width: 100%; padding: 14px; background: #003178; color: white; border-radius: 10px; font-weight: 700; text-decoration: none; font-size: 1rem; transition: all 0.2s ease; box-shadow: 0 4px 12px rgba(0,49,120,0.3);" onmouseover="this.style.background='#00235a'" onmouseout="this.style.background='#003178'">
                        Lihat Detail Tiket
                    </a>
                </div>
            </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('formJebol', () => ({
            isSubmitting: false,
            showSuccessModal: false,
            nomorTiket: '',
            masterKelurahan: <?php echo json_encode($masterKelurahan ?? [], 15, 512) ?>,
            formData: {
                jenis_layanan: new URLSearchParams(window.location.search).get('layanan') || 'KTP-el',
                nama: '',
                nik: '',
                nomor_kk: '',
                tempat_lahir: '',
                tanggal_lahir: '',
                jenis_kelamin: '',
                phone: '',
                email: '',
                nama_anak: '',
                nik_anak: '',
                tempat_lahir_anak: '',
                tanggal_lahir_anak: '',
                jenis_kelamin_anak: '',
                kategori_pemohon: 'Umum',
                nama_ayah: '',
                nama_ibu: '',
                phone_ortu: '',
                hubungan_anak: 'Ayah',
                jumlah_anak: 1,
                alamat: '',
                provinsi: 'Jawa Tengah',
                lokasi_pelayanan: '',
                kelurahan: '',
                jenis_pengajuan: '',
                keterangan: '',
                persetujuan: false
            },

            init() {
                // Auto select first pengajuan option based on layanan if empty
                const opts = this.getJenisPengajuanOptions();
                if (opts.length > 0 && !this.formData.jenis_pengajuan) {
                    this.formData.jenis_pengajuan = opts[0];
                }
                
                this.$watch('formData.jenis_layanan', (val) => {
                    const newOpts = this.getJenisPengajuanOptions();
                    if(newOpts.length > 0) this.formData.jenis_pengajuan = newOpts[0];
                });
            },

            getHeaderIcon() {
                switch(this.formData.jenis_layanan) {
                    case 'KTP-el': return 'badge';
                    case 'KIA': return 'child_care';
                    case 'IKD': return 'credit_card';
                    default: return 'description';
                }
            },

            getKelurahanList() {
                if (!this.formData.lokasi_pelayanan) return [];
                // Asumsi masterKelurahan memiliki properti kecamatan (nama kecamatan) dan nama (nama kelurahan)
                return this.masterKelurahan
                    .filter(k => k.kecamatan === this.formData.lokasi_pelayanan || k.kecamatan_id == this.formData.lokasi_pelayanan || k.id_kecamatan == this.formData.lokasi_pelayanan || k.kecamatan_nama == this.formData.lokasi_pelayanan || k.nama_kecamatan == this.formData.lokasi_pelayanan)
                    .map(k => k.nama)
                    .sort();
            },

            getJenisPengajuanOptions() {
                switch(this.formData.jenis_layanan) {
                    case 'KTP-el':
                        return ['Baru', 'Perpanjangan', 'KTP-el Rusak', 'KTP-el Hilang', 'Perubahan Data KTP-el'];
                    case 'KIA':
                        return ['Baru', 'Perpanjangan', 'Hilang/Rusak'];
                    case 'IKD':
                        return ['Aktivasi Baru', 'Pindah HP'];
                    default:
                        return ['Baru'];
                }
            },

            async submitForm(e) {
                this.isSubmitting = true;
                
                try {
                    let formElement = e.target;
                    let formData = new FormData(formElement);
                    
                    let response = await fetch(formElement.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });
                    
                    let result = await response.json();
                    
                    if (response.ok && result.success) {
                        this.nomorTiket = result.nomor_tiket;
                        this.showSuccessModal = true;
                    } else {
                        // Use SweetAlert2 instead of native alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Peringatan',
                            text: result.message || 'Terjadi kesalahan pada server',
                            confirmButtonColor: '#003178'
                        });
                        this.isSubmitting = false;
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Koneksi Gagal',
                        text: 'Gagal mengirim data. Silakan periksa koneksi Anda.',
                        confirmButtonColor: '#003178'
                    });
                    this.isSubmitting = false;
                }
            }
        }))
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.masyarakat', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/masyarakat/pengajuan.blade.php ENDPATH**/ ?>