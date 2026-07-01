<?php $__env->startSection('title', 'Detail Pengajuan #' . $permohonan->id_pengajuan . ' - SI JEBOL Admin'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 36px 48px;
        position: relative;
        overflow: hidden;
        margin: -2rem -2rem 32px -2rem;
        box-shadow: 0 10px 30px rgba(0, 49, 120, 0.15);
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        border-bottom: 6px solid var(--accent, #f59e0b);
    }

    .page-header::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url('<?php echo e(asset("images/batik-tegal-premium.jpg")); ?>');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        mix-blend-mode: overlay;
        pointer-events: none;
    }

    .header-content { position: relative; z-index: 10; }
    .header-title { font-size: 1.8rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.5px; display: flex; align-items: center; gap: 12px; }
    .header-subtitle { font-size: 0.95rem; color: rgba(255,255,255,0.8); margin: 0; font-weight: 500; }

    .header-actions {
        position: relative;
        z-index: 10;
        display: flex;
        gap: 12px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        text-decoration: none;
    }

    .btn-light-outline {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        backdrop-filter: blur(5px);
    }
    .btn-light-outline:hover { background: rgba(255,255,255,0.2); }

    .btn-white { background: white; color: var(--primary); }
    .btn-white:hover { background: #f8fafc; transform: translateY(-2px); }

    .main-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    .side-by-side-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    @media (max-width: 1024px) {
        .main-grid { grid-template-columns: 1fr; }
        .side-by-side-grid { grid-template-columns: 1fr !important; }
    }

    @media (max-width: 1024px) { .main-grid { grid-template-columns: 1fr; } }

    .panel-box {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        height: 100%;
    }

    .section-header {
        font-size: 0.8rem;
        font-weight: 800;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 20px;
    }

    .badge-letter {
        background: var(--primary);
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 6px;
        display: grid;
        place-items: center;
        font-size: 0.8rem;
        font-weight: 800;
        flex-shrink: 0;
    }

    .info-list { display: flex; flex-direction: column; gap: 16px; }
    
    .info-row { display: flex; flex-direction: column; gap: 4px; }
    .info-label { font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
    .info-value { font-size: 0.95rem; font-weight: 600; color: var(--text-main); }
    
    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .badge-menunggu { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
    .badge-terverifikasi { background: #e0e7ff; color: #4338ca; border: 1px solid #c7d2fe; }
    .badge-terjadwal { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .badge-diproses { background: #f3e8ff; color: #7e22ce; border: 1px solid #e9d5ff; }
    .badge-selesai { background: #ecfdf5; color: #10b981; border: 1px solid #a7f3d0; }
    .badge-ditolak { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    /* Timeline */
    .timeline-item {
        position: relative;
        padding-left: 32px;
        padding-bottom: 24px;
    }
    .timeline-item:last-child { padding-bottom: 0; }
    .timeline-line {
        position: absolute;
        left: 11px;
        top: 24px;
        bottom: 0;
        width: 2px;
        background: #e2e8f0;
    }
    .timeline-item:last-child .timeline-line { display: none; }
    .timeline-dot {
        position: absolute;
        left: 0;
        top: 0;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: white;
        border: 2px solid #e2e8f0;
        color: #94a3b8;
    }
    .timeline-item.done .timeline-dot {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }
    .timeline-item.active .timeline-dot {
        border-color: #fbbf24;
        box-shadow: 0 0 0 4px #fef3c7;
    }
    
    .timeline-content {
        padding-top: 2px;
    }
    .timeline-title { font-weight: 700; font-size: 0.95rem; margin: 0 0 4px 0; color: var(--text-main); }
    .timeline-desc { font-size: 0.85rem; color: var(--text-muted); margin: 0; }

    /* Actions buttons */
    .action-btn {
        width: 100%;
        padding: 16px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 16px;
        border: 1px solid #e2e8f0;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
        text-align: left;
        margin-bottom: 12px;
    }
    .action-btn:hover { background: #f8fafc; border-color: #cbd5e1; transform: translateY(-2px); }
    
    .action-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        color: white;
    }
    
    .action-title { font-weight: 700; font-size: 1rem; color: var(--text-main); margin: 0; }
    .action-desc { font-size: 0.8rem; color: var(--text-muted); margin: 0; }

    /* Modals */
    .modal-backdrop {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: none;
        place-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-backdrop.show { display: grid; opacity: 1; }

    .modal-content {
        background: white;
        border-radius: 20px;
        width: 100%;
        max-width: 550px;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .modal-backdrop.show .modal-content { transform: scale(1); opacity: 1; }

    .modal-header {
        background: var(--primary);
        color: white;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title { font-size: 1.1rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 10px;}
    .modal-close { background: none; border: none; font-size: 1.5rem; color: rgba(255,255,255,0.7); cursor: pointer; line-height: 1; }
    .modal-close:hover { color: white; }

    .modal-body { padding: 24px; }
    
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--text-main); margin-bottom: 8px; }
    .form-control { width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #cbd5e1; font-family: inherit; font-size: 0.95rem; outline: none; }
    .form-control:focus { border-color: var(--primary); }
    
    .modal-footer { display: flex; justify-content: flex-end; gap: 12px; padding: 20px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; }

    .btn-primary { background: var(--primary); color: white; }
    .btn-outline { background: white; border: 1px solid #cbd5e1; color: var(--text-main); }
    .btn-success { background: #10b981; color: white; }
    .btn-danger { background: #dc2626; color: white; }

    @media print { .no-print{display:none!important} body{background:white!important} .panel-box{box-shadow:none;border:1px solid #ddd;} }
</style>

<?php
    $statusMap = [
        'pending'             => ['label'=>'Pending','class'=>'badge-menunggu','icon'=>'clock'],
        'menunggu_verifikasi' => ['label'=>'Menunggu Verifikasi','class'=>'badge-menunggu','icon'=>'clock'],
        'terverifikasi'       => ['label'=>'Terverifikasi','class'=>'badge-terverifikasi','icon'=>'check-circle'],
        'terjadwal'           => ['label'=>'Terjadwal','class'=>'badge-terjadwal','icon'=>'calendar'],
        'diproses'            => ['label'=>'Diproses','class'=>'badge-diproses','icon'=>'refresh-cw'],
        'selesai'             => ['label'=>'Selesai','class'=>'badge-selesai','icon'=>'check-square'],
        'ditolak'             => ['label'=>'Ditolak','class'=>'badge-ditolak','icon'=>'x-circle'],
    ];
    $st = $statusMap[$permohonan->status] ?? ['label'=>ucfirst($permohonan->status),'class'=>'badge-menunggu','icon'=>'info'];
    
    $isIkd  = str_contains(strtoupper($permohonan->jenis_layanan), 'IKD');
    $isKtp  = str_contains(strtoupper($permohonan->jenis_layanan), 'KTP');
    $isKia  = str_contains(strtoupper($permohonan->jenis_layanan), 'KIA');
?>

<div class="page-header">
    <div class="header-content">
        <h1 class="header-title">
            <i data-lucide="file-text" style="width: 32px; height: 32px; color: #fbbf24;"></i>
            Detail Pengajuan
        </h1>
        <p class="header-subtitle">SI JEBOL / Verifikasi / #<?php echo e($permohonan->id_pengajuan); ?></p>
    </div>
    <div class="header-actions no-print">
        <a href="<?php echo e(route('admin.permohonan')); ?>" class="btn btn-light-outline">
            <i data-lucide="arrow-left" style="width: 18px;"></i> Kembali
        </a>
    </div>
</div>

<div class="main-grid">
    <!-- Kolom Kiri -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        
        <!-- SECTION B: DATA PEMOHON -->
        <?php if(strtolower($permohonan->jenis_pengajuan) === 'sekolah' || ($permohonan->masyarakat && $permohonan->masyarakat->tipe_pendaftar === 'sekolah')): ?>
            <?php
                $detail = json_decode($permohonan->detail_pengajuan, true) ?? [];
                $namaSekolah = $detail['nama_sekolah'] ?? $permohonan->masyarakat->school ?? '—';
                $namaPic = $detail['nama'] ?? $permohonan->masyarakat->nama ?? '—';
                $nikPic = $detail['nik'] ?? $permohonan->masyarakat->nik ?? '—';
                $phonePic = $detail['phone'] ?? $permohonan->masyarakat->no_hp ?? '—';
                $emailPic = $permohonan->masyarakat->email ?? '—';
                $jumlahAnak = $detail['jumlah_anak'] ?? 1;
                $alamatSekolah = $detail['alamat'] ?? $permohonan->masyarakat->alamat ?? '—';
            ?>
            <div class="panel-box">
                <div class="section-header">
                    Data Sekolah & Petugas (PIC)
                    <span style="margin-left: auto; font-size: 0.7rem; color: #f59e0b; background: #fffbeb; padding: 4px 8px; border-radius: 6px;">Tidak dapat diubah</span>
                </div>
                
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding: 16px; background: #f8fafc; border-radius: 12px;">
                    <div style="width: 48px; height: 48px; background: var(--primary); color: white; border-radius: 12px; display: grid; place-items: center; font-size: 1.2rem; font-weight: 800;">
                        <i data-lucide="school"></i>
                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 1.1rem; color: var(--text-main);"><?php echo e(strtoupper($namaSekolah)); ?></div>
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Jumlah Siswa Diajukan: <?php echo e($jumlahAnak); ?> Orang</div>
                    </div>
                </div>

                <div class="info-list">
                    <div class="info-grid">
                        <div class="info-row">
                            <span class="info-label">Nama Petugas (PIC)</span>
                            <span class="info-value"><?php echo e($namaPic); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">NIK Petugas</span>
                            <span class="info-value"><?php echo e($nikPic); ?></span>
                        </div>
                    </div>
                    <div class="info-grid">
                        <div class="info-row">
                            <span class="info-label">Nomor WhatsApp</span>
                            <span class="info-value"><?php echo e($phonePic); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value"><?php echo e($emailPic); ?></span>
                        </div>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Alamat Sekolah</span>
                        <span class="info-value"><?php echo e($alamatSekolah); ?></span>
                    </div>

                    <div style="margin-top: 12px;">
                        <span class="info-label" style="display: block; margin-bottom: 12px;">Lampiran Dokumen</span>
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <?php if($permohonan->file_surat_pengantar): ?>
                            <a href="#" onclick="openDocumentModal('<?php echo e(asset('storage/' . $permohonan->file_surat_pengantar)); ?>', 'Surat Pengantar Sekolah'); return false;" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; text-decoration: none; color: inherit; background: white; transition: all 0.2s;">
                                <div style="background: #eff6ff; color: #3b82f6; padding: 8px; border-radius: 8px;"><i data-lucide="file-text"></i></div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 700; font-size: 0.9rem;">Surat Pengantar Sekolah</div>
                                    <div style="font-size: 0.8rem; color: #3b82f6;">Lihat Dokumen →</div>
                                </div>
                            </a>
                            <?php else: ?>
                            <div style="padding: 16px; background: #f8fafc; border-radius: 12px; text-align: center; color: var(--text-muted); font-size: 0.9rem; font-weight: 500;">
                                Tidak ada surat pengantar sekolah yang dilampirkan
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="panel-box">
                <div class="section-header">
                    Data Pemohon
                    <span style="margin-left: auto; font-size: 0.7rem; color: #f59e0b; background: #fffbeb; padding: 4px 8px; border-radius: 6px;">Tidak dapat diubah</span>
                </div>
                
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding: 16px; background: #f8fafc; border-radius: 12px;">
                    <div style="width: 48px; height: 48px; background: var(--primary); color: white; border-radius: 50%; display: grid; place-items: center; font-size: 1.2rem; font-weight: 800;">
                        <?php echo e(strtoupper(substr($permohonan->masyarakat->nama ?? 'W', 0, 1))); ?>

                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 1.1rem; color: var(--text-main);"><?php echo e(strtoupper($permohonan->masyarakat->nama ?? 'Warga')); ?></div>
                        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">NIK: <?php echo e($permohonan->masyarakat->nik ?? $permohonan->nik ?? '-'); ?></div>
                    </div>
                </div>

                <div class="info-list">
                    <div class="info-grid">
                        <div class="info-row">
                            <span class="info-label">Nomor HP</span>
                            <span class="info-value"><?php echo e($permohonan->no_hp ?? $permohonan->masyarakat->no_hp ?? '-'); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value"><?php echo e($permohonan->masyarakat->email ?? '-'); ?></span>
                        </div>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Alamat</span>
                        <span class="info-value"><?php echo e($permohonan->alamat ?? $permohonan->masyarakat->alamat ?? '-'); ?></span>
                    </div>

                    <div style="margin-top: 12px;">
                        <span class="info-label" style="display: block; margin-bottom: 12px;">Lampiran Dokumen</span>
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <?php if($permohonan->file_ktp): ?>
                            <a href="#" onclick="openDocumentModal('<?php echo e(asset('storage/' . $permohonan->file_ktp)); ?>', 'Berkas KTP'); return false;" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; text-decoration: none; color: inherit; background: white; transition: all 0.2s;">
                                <div style="background: #eff6ff; color: #3b82f6; padding: 8px; border-radius: 8px;"><i data-lucide="file-image"></i></div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 700; font-size: 0.9rem;">Berkas KTP</div>
                                    <div style="font-size: 0.8rem; color: #3b82f6;">Lihat Dokumen →</div>
                                </div>
                            </a>
                            <?php endif; ?>
                            <?php if($permohonan->file_kk): ?>
                            <a href="#" onclick="openDocumentModal('<?php echo e(asset('storage/' . $permohonan->file_kk)); ?>', 'Kartu Keluarga'); return false;" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; text-decoration: none; color: inherit; background: white; transition: all 0.2s;">
                                <div style="background: #eff6ff; color: #3b82f6; padding: 8px; border-radius: 8px;"><i data-lucide="users"></i></div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 700; font-size: 0.9rem;">Kartu Keluarga</div>
                                    <div style="font-size: 0.8rem; color: #3b82f6;">Lihat Dokumen →</div>
                                </div>
                            </a>
                            <?php endif; ?>
                            <?php if(!$permohonan->file_ktp && !$permohonan->file_kk): ?>
                            <div style="padding: 16px; background: #f8fafc; border-radius: 12px; text-align: center; color: var(--text-muted); font-size: 0.9rem; font-weight: 500;">
                                Tidak ada dokumen yang dilampirkan
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- SECTION C: DATA LAYANAN -->
        <div class="panel-box">
            <div class="section-header">
                Data Layanan Terperinci
            </div>

            <?php if(strtolower($permohonan->jenis_pengajuan) === 'sekolah' || ($permohonan->masyarakat && $permohonan->masyarakat->tipe_pendaftar === 'sekolah')): ?>
                <!-- Tampilan Kolektif Sekolah (Hanya yang penting saja) -->
                <div class="info-list">
                    <div class="info-row">
                        <span class="info-label">Jenis Layanan Kolektif</span>
                        <div style="display: flex; gap: 8px; margin-top: 8px;">
                            <?php if($isKtp): ?>
                            <span style="background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 0.85rem;">KTP-el (Kartu Tanda Penduduk)</span>
                            <?php endif; ?>
                            <?php if($isIkd): ?>
                            <span style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 0.85rem;">IKD (Identitas Kependudukan Digital)</span>
                            <?php endif; ?>
                            <?php if($isKia): ?>
                            <span style="background: #fff7ed; color: #9a3412; border: 1px solid #ffedd5; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 0.85rem;">KIA (Kartu Identitas Anak)</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="info-grid" style="margin-top: 12px;">
                        <div class="info-row">
                            <span class="info-label">Total Peserta Siswa</span>
                            <span class="info-value" style="font-size: 1.1rem; font-weight: 800; color: var(--primary);"><?php echo e($permohonan->jumlah_orang ?? '-'); ?> Orang</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Jumlah Petugas</span>
                            <span class="info-value" style="font-size: 1.1rem; font-weight: 800; color: var(--primary);"><?php echo e($permohonan->jumlah_petugas ? $permohonan->jumlah_petugas . ' Orang' : 'Belum Ditentukan'); ?></span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Tampilan Warga/Perseorangan -->
                <?php if($isIkd): ?>
                <div style="margin-bottom: 24px;">
                    <div style="background: #f8fafc; padding: 12px 16px; border-radius: 10px; display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="background: white; padding: 4px 8px; border-radius: 6px; font-weight: 800; font-size: 0.8rem; border: 1px solid #e2e8f0;">IKD</div>
                        <div style="font-weight: 600; font-size: 0.9rem;">Identitas Kependudukan Digital</div>
                    </div>
                    <div class="info-list">
                        <div class="info-row"><span class="info-label">Jenis Layanan</span><span class="info-value">Aktivasi IKD</span></div>
                        <div class="info-grid">
                            <div class="info-row"><span class="info-label">Tipe Smartphone</span><span class="info-value"><?php echo e($permohonan->tipe_smartphone ?? 'Android / iPhone'); ?></span></div>
                            <div class="info-row"><span class="info-label">Jumlah Orang</span><span class="info-value"><?php echo e($permohonan->jumlah_orang ?? '-'); ?> Orang</span></div>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status Aktivasi</span>
                            <span style="font-weight: 700; color: var(--primary);"><?php echo e($permohonan->status_ikd ?? 'Belum Aktivasi'); ?></span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($isKtp): ?>
                <div style="margin-bottom: 24px; border-top: 1px solid #e2e8f0; padding-top: 24px;">
                    <div style="background: #f8fafc; padding: 12px 16px; border-radius: 10px; display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="background: white; padding: 4px 8px; border-radius: 6px; font-weight: 800; font-size: 0.8rem; border: 1px solid #e2e8f0;">KTP-el</div>
                        <div style="font-weight: 600; font-size: 0.9rem;">Kartu Tanda Penduduk</div>
                    </div>
                    <div class="info-list">
                        <div class="info-row"><span class="info-label">Jenis Pengajuan</span><span class="info-value"><?php echo e($permohonan->jenis_pengajuan ?? 'Baru / Hilang / Rusak'); ?></span></div>
                        <div class="info-row"><span class="info-label">Keterangan</span><span class="info-value"><?php echo e($permohonan->keterangan_ktp ?? '-'); ?></span></div>
                        <div class="info-row">
                            <span class="info-label">Status Perekaman</span>
                            <span style="font-weight: 700; color: #d97706;">Belum Perekaman</span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($isKia): ?>
                <div style="margin-bottom: 24px; border-top: 1px solid #e2e8f0; padding-top: 24px;">
                    <div style="background: #f8fafc; padding: 12px 16px; border-radius: 10px; display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="background: white; padding: 4px 8px; border-radius: 6px; font-weight: 800; font-size: 0.8rem; border: 1px solid #e2e8f0;">KIA</div>
                        <div style="font-weight: 600; font-size: 0.9rem;">Kartu Identitas Anak</div>
                    </div>
                    <div class="info-list">
                        <?php
                            $detailKIA = json_decode($permohonan->detail_pengajuan, true) ?? [];
                        ?>
                        <div class="info-grid">
                            <div class="info-row"><span class="info-label">NIK Anak</span><span class="info-value"><?php echo e($permohonan->nik_anak ?? $detailKIA['nik_anak'] ?? '-'); ?></span></div>
                            <div class="info-row"><span class="info-label">Nama Anak</span><span class="info-value"><?php echo e($permohonan->nama_anak ?? $detailKIA['nama_anak'] ?? '-'); ?></span></div>
                        </div>
                        <div class="info-row"><span class="info-label">Nama Orang Tua</span><span class="info-value"><?php echo e($permohonan->masyarakat->nama ?? '-'); ?></span></div>
                    </div>
                </div>
                <?php endif; ?>

                <div style="margin-top: 24px; padding-top: 20px; border-top: 2px dashed #e2e8f0;">
                    <div class="info-grid">
                        <div class="info-row"><span class="info-label">Jumlah Petugas</span><span class="info-value"><?php echo e($permohonan->jumlah_petugas ? $permohonan->jumlah_petugas . ' Orang' : 'Belum Ditentukan'); ?></span></div>
                        <div class="info-row"><span class="info-label">Total Peserta</span><span class="info-value"><?php echo e($permohonan->jumlah_orang ?? '-'); ?> Orang</span></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div> <!-- End Kolom Kiri -->

    <!-- Kolom Kanan -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        
        <!-- SECTION A: INFORMASI PENGAJUAN -->
        <div class="panel-box">
            <div class="section-header">
                Informasi Pengajuan
            </div>
            <div class="info-list">
                <div class="info-row">
                    <span class="info-label">Nomor Pengajuan</span>
                    <span class="info-value" style="color: var(--primary); font-size: 1.1rem; font-weight: 800;">
                        <?php echo e($permohonan->nomor_tiket ?? ('#JB-' . str_pad($permohonan->id_pengajuan, 4, '0', STR_PAD_LEFT))); ?>

                    </span>
                </div>
                <div class="info-grid">
                    <div class="info-row">
                        <span class="info-label">Tanggal Pengajuan</span>
                        <span class="info-value"><?php echo e($permohonan->tanggal_pengajuan ? $permohonan->tanggal_pengajuan->translatedFormat('d F Y') : '-'); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <div>
                            <span class="status-badge <?php echo e($st['class']); ?>">
                                <i data-lucide="<?php echo e($st['icon']); ?>" style="width: 14px;"></i> <?php echo e($st['label']); ?>

                            </span>
                        </div>
                    </div>
                </div>
                <div class="info-row">
                    <span class="info-label">Jenis Layanan</span>
                    <span class="info-value"><?php echo e($permohonan->jenis_layanan); ?></span>
                </div>
                <div class="info-grid">
                    <div class="info-row">
                        <span class="info-label">Lokasi JEBOL</span>
                        <span class="info-value"><?php echo e($permohonan->lokasi->nama_lokasi ?? $permohonan->lokasi_pelayanan ?? '-'); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jadwal Pelayanan</span>
                        <span class="info-value">
                            <?php
                                $jadwalText = '-';
                                $dtl = json_decode($permohonan->detail_pengajuan, true) ?? [];
                                $jadwalConfirmed = \App\Models\JadwalJebol::where('nama_kegiatan', 'Layanan Tiket ' . $permohonan->id_pengajuan)->first();
                                
                                if ($jadwalConfirmed) {
                                    $jadwalText = \Carbon\Carbon::parse($jadwalConfirmed->tanggal_pelayanan)->translatedFormat('d F Y');
                                } elseif (!empty($dtl['usulan_tanggal'])) {
                                    $jadwalText = '<span style="color: #0369a1; background: #e0f2fe; padding: 2px 6px; border-radius: 4px; font-size: 0.75rem; font-weight: 700; margin-right: 6px;">USULAN</span>' . \Carbon\Carbon::parse($dtl['usulan_tanggal'])->translatedFormat('d F Y');
                                } elseif ($permohonan->tanggal_kedatangan) {
                                    $jadwalText = \Carbon\Carbon::parse($permohonan->tanggal_kedatangan)->translatedFormat('d F Y');
                                } else {
                                    $jadwalText = '<span style="color: var(--text-muted); font-style: italic;">Belum Dijadwalkan</span>';
                                }
                            ?>
                            <?php echo $jadwalText; ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="side-by-side-grid">
            <!-- SECTION D: CATATAN & AKSI ADMIN -->
            <div class="panel-box no-print" style="background: #f8fafc; height: 100%;">
                <div class="section-header">
                    Catatan & Aksi Admin
                </div>

                <?php if($permohonan->keterangan && $permohonan->status != 'ditolak' && $permohonan->status != 'menunggu_verifikasi' && $permohonan->status != 'pending'): ?>
                <div style="background: white; border: 1px solid #bfdbfe; padding: 16px; border-radius: 12px; margin-bottom: 24px;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: var(--primary); text-transform: uppercase; margin-bottom: 8px;">Catatan Tersimpan:</div>
                    <div style="font-style: italic; font-weight: 500; color: #1e3a8a;">"<?php echo e($permohonan->keterangan); ?>"</div>
                </div>
                <?php endif; ?>

                <?php if(in_array(trim(strtolower(auth()->user()->role ?? '')), ['admin', 'admin pusat', 'cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])): ?>
                
                    <form id="statusForm" action="<?php echo e(route('admin.permohonan.status', $permohonan->id_pengajuan)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="status" id="statusInput">
                        <input type="hidden" name="keterangan" id="keteranganInput">
                        <input type="hidden" name="jumlah_realisasi" id="realisasiInput">
                        <input type="hidden" name="jumlah_petugas" id="petugasInput">
                        <input type="hidden" name="jumlah_ikd" id="ikdInput">
                        <input type="hidden" name="jumlah_kia" id="kiaInput">
                        
                        <input type="hidden" name="jadwal_tanggal" id="jadwalTanggalInput">
                        <input type="hidden" name="jadwal_waktu_mulai" id="jadwalWaktuMulaiInput">
                        <input type="hidden" name="jadwal_waktu_selesai" id="jadwalWaktuSelesaiInput">
                        <input type="hidden" name="lokasi_pelayanan" id="lokasiPelayananInput">
                        <input type="hidden" name="jumlah_petugas" id="jumlahPetugasInput">
                    </form>

                    <div style="display: flex; flex-direction: column; gap: 4px;">
                        
                        
                        <?php if($permohonan->status == 'menunggu_verifikasi' || $permohonan->status == 'pending'): ?>
                        <div style="margin-bottom: 20px;">
                            <div style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 16px; border-radius: 12px; margin-bottom: 16px;">
                                <div style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Catatan Tersedia:</div>
                                <div style="font-size: 0.9rem; font-weight: 600; color: #334155;"><?php echo e($permohonan->keterangan ?? '-'); ?></div>
                            </div>

                            <div style="background: white; border: 1px solid #e2e8f0; padding: 16px; border-radius: 12px; margin-bottom: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                                <div style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.5px;">Contoh Isi Catatan:</div>
                                <ul style="margin: 0; padding-left: 20px; font-size: 0.85rem; color: #64748b; line-height: 1.6; font-weight: 500;">
                                    <li>Data valid.</li>
                                    <li>Nomor HP tidak aktif.</li>
                                    <li>Pemohon harap membawa KTP asli saat pelayanan.</li>
                                </ul>
                            </div>

                            <div style="margin-bottom: 20px;">
                                <div style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.5px;">Alur Perubahan Status:</div>
                                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <span style="background: #cbd5e1; border: 1px solid #94a3b8; color: #1e293b; padding: 6px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;"><?php echo e($permohonan->status == 'pending' ? 'Pending' : 'Menunggu Verifikasi'); ?></span>
                                    <i data-lucide="chevron-right" style="width: 16px; height: 16px; color: #94a3b8;"></i>
                                    <span style="background: #f8fafc; border: 1px solid #e2e8f0; color: #94a3b8; padding: 6px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Terverifikasi</span>
                                    <i data-lucide="chevron-right" style="width: 16px; height: 16px; color: #94a3b8;"></i>
                                    <span style="background: #f8fafc; border: 1px solid #e2e8f0; color: #94a3b8; padding: 6px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Siap Dijadwalkan</span>
                                </div>
                            </div>

                            <div style="display: flex; gap: 12px; width: 100%;">
                                <button type="button" onclick="openApprovalModal()" style="flex: 1; display: flex; align-items: center; gap: 12px; padding: 16px; background: #374151; border: none; border-radius: 12px; color: white; cursor: pointer; text-align: left; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" onmouseover="this.style.background='#1f2937'" onmouseout="this.style.background='#374151'">
                                    <div style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.1); flex-shrink: 0;">
                                        <i data-lucide="check-circle" style="color: white; width: 20px; height: 20px;"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0 0 2px 0; font-size: 0.95rem; font-weight: 700; color: white;">Verifikasi</h4>
                                        <p style="margin: 0; font-size: 0.75rem; color: #9ca3af; font-weight: 400;">Approve Data Permohonan</p>
                                    </div>
                                </button>
                                
                                <button type="button" onclick="openRejectionModal()" style="flex: 1; display: flex; align-items: center; gap: 12px; padding: 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; color: #374151; cursor: pointer; text-align: left; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                                    <div style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: #fee2e2; flex-shrink: 0;">
                                        <i data-lucide="x-circle" style="color: #ef4444; width: 20px; height: 20px;"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0 0 2px 0; font-size: 0.95rem; font-weight: 700; color: #1f2937;">Tolak Pengajuan</h4>
                                        <p style="margin: 0; font-size: 0.75rem; color: #6b7280; font-weight: 400;">Batalkan & Beri Alasan</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>

                        
                        <?php if($permohonan->status == 'terverifikasi'): ?>
                        <button onclick="openRejectionModal()" class="action-btn">
                            <div class="action-icon" style="background: #dc2626;"><i data-lucide="x-circle"></i></div>
                            <div>
                                <h4 class="action-title">Tolak Pengajuan</h4>
                                <p class="action-desc">Batalkan dan beri alasan kepada pemohon</p>
                            </div>
                        </button>
                        <?php endif; ?>
                        
                        
                        <?php if($permohonan->status == 'terverifikasi' && strtolower($permohonan->jenis_pengajuan) === 'sekolah'): ?>
                        <button onclick="openScheduleModal()" class="action-btn">
                            <div class="action-icon" style="background: #f59e0b;"><i data-lucide="calendar"></i></div>
                            <div>
                                <h4 class="action-title">Jadwalkan Pelayanan</h4>
                                <p class="action-desc">Tetapkan jadwal untuk sekolah ini</p>
                            </div>
                        </button>
                        <?php endif; ?>
                        
                        
                        <?php if($permohonan->status == 'terverifikasi' && strtolower($permohonan->jenis_pengajuan) !== 'sekolah'): ?>
                        <div style="background: #eff6ff; border: 1px solid #bfdbfe; padding: 16px; border-radius: 12px; display: flex; gap: 16px; align-items: center; margin-bottom: 12px;">
                            <i data-lucide="info" style="color: #3b82f6; width: 24px; height: 24px;"></i>
                            <div>
                                <h4 style="margin: 0 0 4px 0; font-size: 0.95rem; font-weight: 700; color: #1e3a8a;">Menunggu Penjadwalan Lokasi</h4>
                                <p style="margin: 0; font-size: 0.85rem; color: #3b82f6;">Data valid. Silakan buat Jadwal Masal di menu Monitoring Lokasi.</p>
                            </div>
                        </div>
                        <?php endif; ?>

                        
                        <?php if($permohonan->status == 'terjadwal'): ?>
                        <button onclick="openProcessingModal()" class="action-btn">
                            <div class="action-icon" style="background: #8b5cf6;"><i data-lucide="refresh-cw"></i></div>
                            <div>
                                <h4 class="action-title">Mulai Proses</h4>
                                <p class="action-desc">Ubah status menjadi sedang diproses di lapangan</p>
                            </div>
                        </button>
                        <?php endif; ?>

                        
                        <?php if($permohonan->status == 'diproses'): ?>
                        <button onclick="openCompletionModal()" class="action-btn">
                            <div class="action-icon" style="background: #0ea5e9;"><i data-lucide="check-square"></i></div>
                            <div>
                                <h4 class="action-title">Selesaikan Layanan</h4>
                                <p class="action-desc">Input hasil realisasi layanan</p>
                            </div>
                        </button>
                        <?php endif; ?>
                        
                        
                        <?php if(in_array($permohonan->status, ['selesai','ditolak'])): ?>
                        <div style="background: white; border: 1px solid #e2e8f0; padding: 16px; border-radius: 12px; text-align: center; color: var(--text-muted); font-weight: 600; font-size: 0.9rem;">
                            Pengajuan ini telah ditutup (<?php echo e(strtoupper($permohonan->status)); ?>).
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- SECTION E: RIWAYAT STATUS -->
            <div class="panel-box" style="height: 100%;">
                <div class="section-header">
                    Riwayat Status Pengajuan
                </div>
                
                <?php
                    $allStatus = [
                        ['key'=>'menunggu_verifikasi','label'=>'Menunggu Verifikasi','icon'=>'clock','desc'=>'Pengajuan diterima sistem, menunggu pemeriksaan admin.'],
                        ['key'=>'terverifikasi','label'=>'Terverifikasi','icon'=>'check-circle','desc'=>'Data dan dokumen telah diverifikasi oleh admin.'],
                        ['key'=>'terjadwal','label'=>'Terjadwal','icon'=>'calendar','desc'=>'Jadwal pelayanan JEBOL telah ditetapkan.'],
                        ['key'=>'diproses','label'=>'Diproses','icon'=>'refresh-cw','desc'=>'Petugas sedang melaksanakan pelayanan di lokasi.'],
                        ['key'=>'selesai','label'=>'Selesai','icon'=>'check-square','desc'=>'Layanan telah selesai dilaksanakan.'],
                    ];
                    $statusOrder  = ['pending'=>0,'menunggu_verifikasi'=>0,'terverifikasi'=>1,'terjadwal'=>2,'diproses'=>3,'selesai'=>4,'ditolak'=>99];
                    
                    $currentOrder = $statusOrder[$permohonan->status] ?? 0;
                ?>

                <?php if($permohonan->status == 'ditolak'): ?>
                    <div style="background: #fef2f2; border: 1px solid #fecaca; padding: 20px; border-radius: 12px; text-align: center;">
                        <i data-lucide="x-circle" style="width: 48px; height: 48px; color: #dc2626; margin-bottom: 12px;"></i>
                        <h3 style="font-size: 1.1rem; font-weight: 800; color: #991b1b; margin: 0 0 8px 0;">Pengajuan Ditolak</h3>
                        <p style="font-size: 0.9rem; color: #dc2626; margin: 0;"><?php echo e($permohonan->tanggal_pengajuan ? $permohonan->tanggal_pengajuan->translatedFormat('d F Y') : '-'); ?></p>
                        <?php if($permohonan->keterangan): ?>
                        <div style="margin-top: 16px; padding: 12px; background: white; border-radius: 8px; color: #7f1d1d; font-style: italic; font-size: 0.9rem;">
                            "<?php echo e($permohonan->keterangan); ?>"
                        </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div style="padding-top: 12px;">
                        <?php $__currentLoopData = $allStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $sOrder    = $statusOrder[$s['key']] ?? 0;
                            $isDone    = $sOrder <= $currentOrder;
                            $isCurrent = $s['key'] == $permohonan->status;
                        ?>
                        <div class="timeline-item <?php echo e($isDone ? 'done' : ''); ?> <?php echo e($isCurrent ? 'active' : ''); ?>">
                            <div class="timeline-line"></div>
                            <div class="timeline-dot">
                                <i data-lucide="<?php echo e($s['icon']); ?>" style="width: 12px; height: 12px;"></i>
                            </div>
                            <div class="timeline-content">
                                <h4 class="timeline-title" style="color: <?php echo e($isCurrent ? 'var(--primary)' : ($isDone ? 'var(--text-main)' : 'var(--text-muted)')); ?>"><?php echo e($s['label']); ?></h4>
                                <p class="timeline-desc"><?php echo e($s['desc']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div> <!-- End Kolom Kanan -->
</div>

<!-- MODAL: VERIFIKASI -->
<div id="approvalModal" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i data-lucide="check-circle" style="width: 20px;"></i> Verifikasi Pengajuan</h3>
            <button type="button" class="modal-close" onclick="closeApprovalModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p style="font-size: 0.95rem; color: var(--text-muted); margin-bottom: 20px;">Menyetujui pengajuan berarti memvalidasi kelengkapan berkas pemohon.</p>
            <div class="form-group">
                <label>Catatan Verifikasi (Opsional)</label>
                <textarea id="approvalNote" rows="3" class="form-control" placeholder="Contoh: Data KTP dan KK sesuai..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeApprovalModal()">Batal</button>
            <button type="button" class="btn btn-primary" onclick="submitApproval()">Konfirmasi Verifikasi</button>
        </div>
    </div>
</div>

<!-- MODAL: JADWALKAN -->
<div id="scheduleModal" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header" style="background: #f59e0b;">
            <h3 class="modal-title"><i data-lucide="calendar" style="width: 20px;"></i> Jadwalkan Pelayanan</h3>
            <button type="button" class="modal-close" onclick="closeScheduleModal()">&times;</button>
        </div>
        <div class="modal-body">
            <?php
                $detailData = json_decode($permohonan->detail_pengajuan, true) ?? [];
                $usulanTanggal = $detailData['usulan_tanggal'] ?? null;
            ?>
            <?php if($usulanTanggal): ?>
            <div style="margin-bottom: 16px; padding: 12px; background-color: #f0f9ff; border-left: 4px solid #0284c7; border-radius: 8px;">
                <div style="font-size: 0.85rem; font-weight: 600; color: #0369a1; margin-bottom: 4px;">Usulan Jadwal dari Pemohon:</div>
                <div style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">
                    <i data-lucide="calendar" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i> 
                    <?php echo e(\Carbon\Carbon::parse($usulanTanggal)->format('d F Y')); ?>

                </div>
            </div>
            <?php endif; ?>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label>Tanggal Pelayanan *</label>
                    <input type="date" id="inputJadwalTanggal" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Jumlah Petugas *</label>
                    <input type="number" id="inputJadwalPetugas" min="1" required class="form-control" placeholder="Contoh: 3">
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label>Waktu Mulai *</label>
                    <input type="time" id="inputJadwalMulai" value="08:00" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Waktu Selesai *</label>
                    <input type="time" id="inputJadwalSelesai" value="12:00" required class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label>Lokasi Pelayanan *</label>
                <input type="text" id="inputJadwalLokasi" value="<?php echo e($permohonan->lokasi->nama_lokasi ?? $permohonan->lokasi_pelayanan ?? $permohonan->masyarakat->alamat); ?>" required class="form-control">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label>Catatan Penjadwalan (Opsional)</label>
                <textarea id="scheduleNote" rows="2" class="form-control" placeholder="Catatan tambahan..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeScheduleModal()">Batal</button>
            <button type="button" class="btn btn-primary" onclick="submitSchedule()" style="background: #f59e0b; color: white;">Konfirmasi Jadwal</button>
        </div>
    </div>
</div>

<!-- MODAL: SELESAI -->
<div id="completionModal" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header" style="background: #0ea5e9;">
            <h3 class="modal-title"><i data-lucide="check-square" style="width: 20px;"></i> Selesaikan Pengajuan</h3>
            <button type="button" class="modal-close" onclick="closeCompletionModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p style="font-size: 0.95rem; color: var(--text-muted); margin-bottom: 20px;">Tandai pengajuan sebagai Selesai. Masukkan total realisasi hasil pelayanan.</p>
            
            <?php if(strtolower($permohonan->jenis_pengajuan) === 'sekolah'): ?>
                <div style="background: #f8fafc; padding: 16px; border-radius: 12px; margin-bottom: 20px; display: flex; flex-direction: column; gap: 16px;">
                    <?php if($isKtp): ?>
                    <div>
                        <label style="font-size: 0.8rem; font-weight: 700; color: var(--primary);">KTP-el (Target: <?php echo e($permohonan->jumlah_orang); ?> Orang)</label>
                        <input type="number" id="inputSudahKtp" value="<?php echo e($permohonan->jumlah_orang); ?>" min="0" max="<?php echo e($permohonan->jumlah_orang); ?>" class="form-control" style="margin-top: 8px;">
                    </div>
                    <?php endif; ?>
                    <?php if($isIkd): ?>
                    <div>
                        <label style="font-size: 0.8rem; font-weight: 700; color: var(--primary);">IKD (Target: <?php echo e($permohonan->jumlah_orang); ?> Orang)</label>
                        <input type="number" id="inputSudahIkd" value="<?php echo e($permohonan->jumlah_orang); ?>" min="0" max="<?php echo e($permohonan->jumlah_orang); ?>" class="form-control" style="margin-top: 8px;">
                    </div>
                    <?php endif; ?>
                    <?php if($isKia): ?>
                    <div>
                        <label style="font-size: 0.8rem; font-weight: 700; color: var(--primary);">KIA (Target: <?php echo e($permohonan->jumlah_orang); ?> Orang)</label>
                        <input type="number" id="inputSudahKia" value="<?php echo e($permohonan->jumlah_orang); ?>" min="0" max="<?php echo e($permohonan->jumlah_orang); ?>" class="form-control" style="margin-top: 8px;">
                    </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 16px; border-radius: 12px; margin-bottom: 20px; color: #166534;">
                    <strong style="display: block; margin-bottom: 4px;">Penyelesaian Layanan Perorangan</strong>
                    <span style="font-size: 0.9rem;">Sistem akan otomatis mencatat 1 realisasi penyelesaian untuk individu ini.</span>
                </div>
                <input type="hidden" id="inputSudahKtp" value="<?php echo e($isKtp ? 1 : 0); ?>">
                <input type="hidden" id="inputSudahIkd" value="<?php echo e($isIkd ? 1 : 0); ?>">
                <input type="hidden" id="inputSudahKia" value="<?php echo e($isKia ? 1 : 0); ?>">
            <?php endif; ?>

            <div class="form-group" style="margin-bottom: 0;">
                <label>Catatan Penyelesaian (Opsional)</label>
                <textarea id="completionNote" rows="3" class="form-control" placeholder="Kesimpulan pelayanan..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeCompletionModal()">Batal</button>
            <button type="button" class="btn" onclick="submitCompletion()" style="background: #0ea5e9; color: white;">Konfirmasi Selesai</button>
        </div>
    </div>
</div>

<!-- MODAL: TOLAK -->
<div id="rejectionModal" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header" style="background: #dc2626;">
            <h3 class="modal-title"><i data-lucide="x-circle" style="width: 20px;"></i> Tolak Pengajuan</h3>
            <button type="button" class="modal-close" onclick="closeRejectionModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Kategori Alasan</label>
                <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 8px;">
                    <?php $__currentLoopData = ['Dokumen Tidak Terbaca','Data NIK Tidak Valid','Dokumen Kadaluarsa','Data Tidak Lengkap']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label style="display: flex; align-items: center; gap: 10px; padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 10px; cursor: pointer;">
                        <input type="radio" name="reason_category" value="<?php echo e($reason); ?>" style="width: 16px; height: 16px;">
                        <span style="font-weight: 500; font-size: 0.95rem;"><?php echo e($reason); ?></span>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label>Penjelasan Detail untuk Pemohon</label>
                <textarea id="reasonDetail" rows="3" class="form-control" placeholder="Jelaskan bagian mana yang salah..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeRejectionModal()">Batal</button>
            <button type="button" class="btn btn-danger" onclick="submitRejection()">Konfirmasi Tolak</button>
        </div>
</div>
</div>

<!-- MODAL: PREVIEW DOKUMEN -->
<div id="documentModal" class="modal-backdrop" style="z-index: 9999;">
    <div class="modal-content" style="max-width: 900px; width: 90%; height: 90vh; display: flex; flex-direction: column;">
        <div class="modal-header" style="background: var(--primary);">
            <h3 class="modal-title" id="documentModalTitle"><i data-lucide="file-search" style="width: 20px;"></i> Pratinjau Dokumen</h3>
            <button type="button" class="modal-close" onclick="closeDocumentModal()">&times;</button>
        </div>
        <div class="modal-body" style="flex: 1; padding: 0; background: #e2e8f0; display: flex; justify-content: center; align-items: center; overflow: hidden; position: relative;">
            <iframe id="documentIframe" style="width: 100%; height: 100%; border: none; display: none;"></iframe>
            <img id="documentImage" style="max-width: 100%; max-height: 100%; object-fit: contain; display: none;" />
            <div id="documentLoading" style="position: absolute; display: flex; flex-direction: column; align-items: center; gap: 10px; color: #64748b;">
                <i data-lucide="loader-2" class="animate-spin" style="width: 32px; height: 32px;"></i>
                <span>Memuat dokumen...</span>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    /* Modal Handlers */
    function openModal(id) { 
        document.getElementById(id).classList.add('show'); 
        document.body.style.overflow = 'hidden'; 
    }
    function closeModal(id) { 
        document.getElementById(id).classList.remove('show'); 
        document.body.style.overflow = 'auto'; 
    }

    function openApprovalModal() { openModal('approvalModal'); }
    function closeApprovalModal() { closeModal('approvalModal'); }
    function openScheduleModal() { openModal('scheduleModal'); }
    function closeScheduleModal() { closeModal('scheduleModal'); }
    function openCompletionModal() { openModal('completionModal'); }
    function closeCompletionModal() { closeModal('completionModal'); }
    function openRejectionModal() { openModal('rejectionModal'); }
    function closeRejectionModal() { closeModal('rejectionModal'); }

    /* Preview Dokumen */
    function openDocumentModal(url, title) {
        document.getElementById('documentModalTitle').innerHTML = '<i data-lucide="file-search" style="width: 20px;"></i> ' + title;
        
        document.getElementById('documentIframe').style.display = 'none';
        document.getElementById('documentImage').style.display = 'none';
        document.getElementById('documentLoading').style.display = 'flex';
        
        openModal('documentModal');
        lucide.createIcons();
        
        const isImage = url.match(/\.(jpeg|jpg|gif|png|webp)$/i) != null;
        
        if (isImage) {
            const img = document.getElementById('documentImage');
            img.onload = function() {
                document.getElementById('documentLoading').style.display = 'none';
                img.style.display = 'block';
            };
            img.onerror = function() {
                document.getElementById('documentLoading').innerHTML = '<span>Gagal memuat dokumen.</span>';
            };
            img.src = url;
        } else {
            const iframe = document.getElementById('documentIframe');
            iframe.onload = function() {
                document.getElementById('documentLoading').style.display = 'none';
                iframe.style.display = 'block';
            };
            iframe.onerror = function() {
                document.getElementById('documentLoading').innerHTML = '<span>Gagal memuat dokumen.</span>';
            };
            iframe.src = url;
        }
    }
    
    function closeDocumentModal() {
        closeModal('documentModal');
        setTimeout(() => {
            document.getElementById('documentIframe').src = '';
            document.getElementById('documentImage').src = '';
        }, 300);
    }

    /* Submit Verifikasi */
    function submitApproval() {
        document.getElementById('statusInput').value = 'terverifikasi';
        document.getElementById('petugasInput').value = '';
        document.getElementById('keteranganInput').value = document.getElementById('approvalNote').value;
        document.getElementById('statusForm').submit();
    }

    /* Submit Jadwal */
    function submitSchedule() {
        const tanggal = document.getElementById('inputJadwalTanggal').value;
        const mulai = document.getElementById('inputJadwalMulai').value;
        const selesai = document.getElementById('inputJadwalSelesai').value;
        const lokasi = document.getElementById('inputJadwalLokasi').value;
        const petugas = document.getElementById('inputJadwalPetugas').value;

        if (!tanggal || !mulai || !selesai || !lokasi || !petugas) {
            Swal.fire({ icon:'warning', title:'Peringatan', text:'Semua field jadwal wajib diisi!', confirmButtonColor:'#003178' });
            return;
        }

        document.getElementById('jadwalTanggalInput').value = tanggal;
        document.getElementById('jadwalWaktuMulaiInput').value = mulai;
        document.getElementById('jadwalWaktuSelesaiInput').value = selesai;
        document.getElementById('lokasiPelayananInput').value = lokasi;
        document.getElementById('jumlahPetugasInput').value = petugas;

        document.getElementById('statusInput').value = 'terjadwal';
        document.getElementById('keteranganInput').value = document.getElementById('scheduleNote').value;
        document.getElementById('statusForm').submit();
    }

    /* Submit Proses */
    function openProcessingModal() {
        Swal.fire({
            title: 'Mulai Proses Layanan?',
            text: 'Status akan berubah menjadi "Diproses".',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#8b5cf6',
            cancelButtonColor: '#cbd5e1',
            confirmButtonText: 'Ya, Proses Sekarang',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('statusInput').value = 'diproses';
                document.getElementById('statusForm').submit();
            }
        });
    }

    /* Submit Selesai */
    function submitCompletion() {
        const sudahKtp = document.getElementById('inputSudahKtp');
        const sudahIkd = document.getElementById('inputSudahIkd');
        const sudahKia = document.getElementById('inputSudahKia');
        
        document.getElementById('statusInput').value = 'selesai';
        if (sudahKtp) document.getElementById('realisasiInput').value = sudahKtp.value;
        if (sudahIkd) document.getElementById('ikdInput').value = sudahIkd.value;
        if (sudahKia) document.getElementById('kiaInput').value = sudahKia.value;
        
        document.getElementById('keteranganInput').value = document.getElementById('completionNote').value;
        document.getElementById('statusForm').submit();
    }

    /* Submit Tolak */
    function submitRejection() {
        const cat = document.querySelector('input[name="reason_category"]:checked');
        const detail = document.getElementById('reasonDetail').value;
        if (!cat) {
            Swal.fire({ icon:'warning', title:'Peringatan', text:'Pilih salah satu kategori alasan!', confirmButtonColor:'#003178' });
            return;
        }
        if (!detail.trim()) {
            Swal.fire({ icon:'warning', title:'Peringatan', text:'Berikan penjelasan detail penolakan!', confirmButtonColor:'#003178' });
            return;
        }
        document.getElementById('statusInput').value = 'ditolak';
        document.getElementById('keteranganInput').value = `[${cat.value}] ${detail}`;
        document.getElementById('statusForm').submit();
    }

    /* Alerts */
    <?php if(session('success')): ?>
        Swal.fire({ icon:'success', title:'Berhasil!', text:'<?php echo e(session("success")); ?>', timer:3000, showConfirmButton:false });
    <?php endif; ?>
    <?php if(session('error')): ?>
        Swal.fire({ icon:'error', title:'Gagal!', text:'<?php echo e(session("error")); ?>', confirmButtonColor:'#003178' });
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/admin/permohonan-detail.blade.php ENDPATH**/ ?>