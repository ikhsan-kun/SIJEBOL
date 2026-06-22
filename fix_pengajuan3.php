<?php
$content = file_get_contents('resources/views/masyarakat/pengajuan.blade.php');

$target = '<!-- KIA Extras -->
                        <div x-show="formData.jenis_layanan === \'KIA\'" style="display:none;">
                            <div>
                                <label class="form-label">Upload Akta Kelahiran <span>*</span></label>
                                <input type="file" name="file_akta_kelahiran" accept="image/*,.pdf" class="form-input" style="background: white; padding: 8px;" :required="formData.jenis_layanan === \'KIA\'">
                            </div>
                        </div>
                    </div>
                </div>

                        <div>
                            <textarea name="keterangan"';

$insert = '<!-- KIA Extras -->
                        <div x-show="formData.jenis_layanan === \'KIA\'" style="display:none;">
                            <div>
                                <label class="form-label">Upload Akta Kelahiran <span>*</span></label>
                                <input type="file" name="file_akta_kelahiran" accept="image/*,.pdf" class="form-input" style="background: white; padding: 8px;" :required="formData.jenis_layanan === \'KIA\'">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. KETERANGAN TAMBAHAN & SUBMIT -->
                <div class="form-card-modern transition-soft" style="height: 100%; margin-bottom: 0;">
                    <div class="form-section-header">
                        <span class="form-section-badge" x-text="formData.jenis_layanan === \'KIA\' ? \'6\' : \'5\'"></span>
                        <h3 class="form-section-title">Keterangan Tambahan</h3>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <div>
                            <textarea name="keterangan"';

$content = str_replace($target, $insert, $content);
file_put_contents('resources/views/masyarakat/pengajuan.blade.php', $content);
echo "Fixed!\n";
