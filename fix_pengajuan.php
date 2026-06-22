<?php
$content = file_get_contents('resources/views/masyarakat/pengajuan.blade.php');

$target = '<div class="form-grid">
                        <!-- Upload KK (All) -->';

$insert = '                                <select name="hubungan_anak" x-model="formData.hubungan_anak" :required="formData.jenis_layanan === \'KIA\'" class="form-input">
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
                        <span class="form-section-badge" x-text="formData.jenis_layanan === \'KIA\' ? \'3\' : \'2\'"></span>
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
                            <select name="lokasi_pelayanan" x-model="formData.lokasi_pelayanan" @change="formData.kelurahan = \'\'" required class="form-input">
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
                        <span class="form-section-badge" x-text="formData.jenis_layanan === \'KIA\' ? \'4\' : \'3\'"></span>
                        <h3 class="form-section-title" x-text="\'Jenis Pengajuan \' + formData.jenis_layanan"></h3>
                    </div>

                    <div class="radio-group">
                        <template x-for="opsi in getJenisPengajuanOptions()">
                            <label class="radio-label" :style="formData.jenis_pengajuan === opsi ? \'border-color: #003178; background: #f8fafc;\' : \'\'">
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
                        <span class="form-section-badge" x-text="formData.jenis_layanan === \'KIA\' ? \'5\' : \'4\'"></span>
                        <h3 class="form-section-title">Lampiran Dokumen</h3>
                    </div>

                    <div class="form-grid">
                        <!-- Upload KK (All) -->';

$content = str_replace($target, $insert, $content);
file_put_contents('resources/views/masyarakat/pengajuan.blade.php', $content);
echo "Done!\n";
