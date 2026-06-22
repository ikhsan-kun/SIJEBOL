<?php
$content = <<<'EOD'
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
                            <input type="date" name="tanggal_lahir_anak" x-model="formData.tanggal_lahir_anak" :required="formData.jenis_layanan === 'KIA'" class="jbl-1539 jbl-181 jbl-12 jbl-1134 jbl-333 jbl-121 jbl-538 jbl-166 jbl-1029 jbl-456 jbl-85 transition-soft" :class="themeClass.focusRing">
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

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 24px; margin-bottom: 24px;">

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
                <div class="form-card-modern transition-soft" style="height: 100%; margin-bottom: 0;">
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

                <!-- 4. LAMPIRAN DOKUMEN -->
                <div class="form-card-modern transition-soft">
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
EOD;

$file = file_get_contents('resources/views/masyarakat/pengajuan.blade.php');

$startMarker = '<!-- 1. DATA PEMOHON -->';
$endMarker = '<!-- 5. KETERANGAN TAMBAHAN & SUBMIT -->';

$startPos = strpos($file, $startMarker);
$endPos = strpos($file, $endMarker);

if ($startPos !== false && $endPos !== false) {
    $newFile = substr($file, 0, $startPos) . $content . substr($file, $endPos + strlen('<!-- 5. KETERANGAN TAMBAHAN -->'));
    file_put_contents('resources/views/masyarakat/pengajuan.blade.php', $newFile);
    echo "Fixed!\n";
} else {
    echo "Markers not found.\n";
}
?>
