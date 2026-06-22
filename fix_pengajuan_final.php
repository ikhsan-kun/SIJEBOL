<?php
$file = file_get_contents('resources/views/masyarakat/pengajuan.blade.php');

// Find start of section 2 grid
$start = strpos($file, '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 24px; margin-bottom: 24px;">');
// Find end of form (</form>)
$end = strpos($file, '</form>');

if ($start === false || $end === false) {
    echo "Markers not found.\n";
    echo "start=" . ($start === false ? "NOT FOUND" : $start) . "\n";
    echo "end=" . ($end === false ? "NOT FOUND" : $end) . "\n";
    exit;
}

$newSections = <<<'HTMLCONTENT'
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 0; margin-bottom: 0;">

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

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 0; margin-bottom: 0;">

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

                <!-- 5. KETERANGAN TAMBAHAN & SUBMIT -->
                <div class="form-card-modern transition-soft" style="margin-bottom: 0;">
                    <div class="form-section-header">
                        <span class="form-section-badge" x-text="formData.jenis_layanan === 'KIA' ? '6' : '5'"></span>
                        <h3 class="form-section-title">Keterangan Tambahan</h3>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <div>
                            <textarea name="keterangan" x-model="formData.keterangan" rows="4" class="form-input" placeholder="Masukkan keterangan (opsional)" style="resize: vertical;"></textarea>
                        </div>

                        <!-- Persetujuan -->
                        <label style="display: flex; gap: 12px; align-items: flex-start; padding: 16px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; cursor: pointer;">
                            <input type="checkbox" name="persetujuan" x-model="formData.persetujuan" required style="margin-top: 4px; width: 18px; height: 18px; accent-color: #d97706;">
                            <p style="margin: 0; font-size: 0.9rem; color: #92400e; font-weight: 600; line-height: 1.5;">Saya menyatakan bahwa data dan dokumen yang saya unggah adalah benar dan dapat dipertanggungjawabkan sesuai hukum yang berlaku.</p>
                        </label>

                        <div style="display: flex; justify-content: flex-end; gap: 16px; margin-top: 16px;">
                            <a href="{{ route('masyarakat.layanan') }}" style="padding: 12px 24px; color: #475569; font-weight: 700; text-decoration: none; border-radius: 8px; transition: all 0.2s ease;">Batal</a>
                            <button type="submit" style="padding: 12px 32px; background: #f59e0b; color: white; border: none; border-radius: 8px; font-weight: 800; font-size: 1rem; display: flex; align-items: center; gap: 8px; cursor: pointer; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3); transition: all 0.2s ease;" onmouseover="this.style.background='#d97706'" onmouseout="this.style.background='#f59e0b'">
                                <span x-show="!isSubmitting">Kirim Pengajuan</span>
                                <span x-show="isSubmitting">Memproses...</span>
                                <span class="material-symbols-outlined" style="font-size: 20px;" x-show="!isSubmitting">send</span>
                            </button>
                        </div>
                    </div>
                </div>

                </div>

            </form>
HTMLCONTENT;

$newFile = substr($file, 0, $start) . $newSections . substr($file, $end + strlen('</form>'));
file_put_contents('resources/views/masyarakat/pengajuan.blade.php', $newFile);
echo "Done!\n";
