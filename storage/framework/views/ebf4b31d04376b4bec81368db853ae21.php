<?php $__env->startSection('title', 'Tambah Jadwal Baru - SI JEBOL Admin'); ?>

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
        align-items: center;
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

    .header-actions { position: relative; z-index: 10; }

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

    .btn-light-outline { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; backdrop-filter: blur(5px); }
    .btn-light-outline:hover { background: rgba(255,255,255,0.2); }
    
    .btn-primary { background: var(--primary); color: white; }
    .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); }

    .panel-box {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
    }

    .form-section { margin-bottom: 32px; }
    .form-section:last-child { margin-bottom: 0; }
    
    .section-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 20px 0;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .scheduling-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 24px; }
    @media (max-width: 768px) { 
        .form-grid { grid-template-columns: 1fr; gap: 16px; } 
        .scheduling-grid { grid-template-columns: 1fr; gap: 16px; }
    }

    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px;}
    .form-group:last-child { margin-bottom: 0; }
    
    .form-label { font-size: 0.85rem; font-weight: 700; color: #475569; }
    .form-control { 
        width: 100%; 
        padding: 12px 16px; 
        border-radius: 8px; 
        border: 1px solid #e2e8f0; 
        background: #f8fafc; 
        font-family: inherit; 
        font-size: 0.95rem; 
        color: #1e293b;
        outline: none; 
        transition: all 0.2s ease; 
        box-sizing: border-box;
    }
    .form-control:focus { 
        border-color: var(--primary); 
        background: white;
        box-shadow: 0 0 0 4px rgba(0, 49, 120, 0.1); 
    }
    
    .form-hint { font-size: 0.8rem; color: var(--text-muted); margin-top: 4px; }

    input[type="file"]::file-selector-button {
        padding: 6px 14px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background: white;
        font-weight: 600;
        font-size: 0.8rem;
        color: #475569;
        cursor: pointer;
        margin-right: 12px;
        transition: all 0.2s;
    }
    input[type="file"]::file-selector-button:hover { 
        background: var(--primary); 
        color: white;
        border-color: var(--primary);
    }

    .form-actions { display: flex; justify-content: flex-end; gap: 16px; margin-top: 32px; padding-top: 24px; border-top: 1px solid #e2e8f0; }
</style>

<div class="page-header">
    <div class="header-content">
        <h1 class="header-title">
            <i data-lucide="calendar-plus" style="width: 32px; height: 32px; color: #fbbf24;"></i>
            Tambah Jadwal Baru
        </h1>
        <p class="header-subtitle">Manajemen Layanan Jemput Bola Kota Tegal</p>
    </div>
    <div class="header-actions">
        <a href="<?php echo e(route('admin.jadwal')); ?>" class="btn btn-light-outline">
            <i data-lucide="arrow-left" style="width: 18px;"></i> Kembali
        </a>
    </div>
</div>

<form action="<?php echo e(route('admin.jadwal.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    
    <div class="panel-box">
        <!-- Informasi Utama -->
        <div class="form-section">
            <h3 class="section-title"><i data-lucide="info" style="color: var(--primary);"></i> Informasi Utama</h3>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Kegiatan *</label>
                    <input type="text" name="nama_kegiatan" required placeholder="Contoh: Jempol Sekolah SMK 3" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Penjemputan Apa *</label>
                    <select name="jenis_layanan" required class="form-control">
                        <option value="KTP-el">KTP-el</option>
                        <option value="KK">Kartu Keluarga (KK)</option>
                        <option value="IKD">IKD (Digital)</option>
                        <option value="KIA">KIA (Anak)</option>
                        <option value="Akta Kelahiran">Akta Kelahiran</option>
                        <option value="Akta Kematian">Akta Kematian</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <input type="hidden" name="jenis_lokasi" value="Kecamatan">
                </div>
            </div>
        </div>

        <!-- Informasi Lokasi -->
        <div class="form-section">
            <h3 class="section-title"><i data-lucide="map-pin" style="color: var(--primary);"></i> Informasi Lokasi</h3>
            
            <div class="form-group">
                <label class="form-label">Alamat Lengkap / Lokasi *</label>
                <input type="text" name="lokasi" required placeholder="Contoh: Balai Desa Tegal Barat, Jl. Gajah Mada No. 12" class="form-control">
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Petugas yang Bertugas *</label>
                    <input type="text" name="petugas" required placeholder="Contoh: Tim Disdukcapil (Budi, Ani)" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Upload Foto / Brosur (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="form-control" style="padding: 9px 12px;">
                    <span class="form-hint">Format: JPG, PNG. Maksimal 2MB.</span>
                </div>
            </div>
        </div>

        <!-- Penjadwalan -->
        <div class="form-section">
            <h3 class="section-title"><i data-lucide="calendar" style="color: var(--primary);"></i> Penjadwalan</h3>
            
            <div class="scheduling-grid">
                <div class="form-group">
                    <label class="form-label">Tanggal Pelaksanaan *</label>
                    <input type="date" name="tanggal_pelayanan" required class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Mulai *</label>
                    <input type="time" name="jam_mulai" value="08:00" required class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Selesai *</label>
                    <input type="time" name="jam_selesai" value="12:00" required class="form-control">
                </div>
            </div>
        </div>

        <!-- Keterangan Tambahan -->
        <div class="form-section">
            <h3 class="section-title"><i data-lucide="file-text" style="color: var(--primary);"></i> Keterangan Tambahan</h3>
            
            <div class="form-group">
                <label class="form-label">Deskripsi Tambahan (Opsional)</label>
                <textarea name="deskripsi" rows="3" placeholder="Tambahkan catatan jika ada..." class="form-control"></textarea>
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <a href="<?php echo e(route('admin.jadwal')); ?>" class="btn btn-outline" style="border: 1px solid #cbd5e1; color: var(--text-main); background: white;">Batal & Kembali</a>
            <button type="submit" class="btn btn-primary">
                <i data-lucide="save" style="width: 18px;"></i> Simpan Jadwal Kegiatan
            </button>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/admin/jadwal-baru.blade.php ENDPATH**/ ?>