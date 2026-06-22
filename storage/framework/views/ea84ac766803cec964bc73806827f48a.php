<?php $__env->startSection('title', 'Ajukan Jadwal Sekolah - SI JEBOL'); ?>

<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary: #003178;
        --accent: #f59e0b;
    }

    .form-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 36px 48px;
        position: relative;
        overflow: hidden;
        margin: -2rem -2rem 32px -2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 30px rgba(0, 49, 120, 0.15);
        border-bottom: 6px solid var(--accent);
    }

    .form-header::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('<?php echo e(asset("images/batik-tegal-premium.jpg")); ?>');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        mix-blend-mode: overlay;
        pointer-events: none;
    }

    .form-title-wrap {
        position: relative;
        z-index: 10;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .form-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 4px 0;
        line-height: 1.2;
    }

    .form-subtitle {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.85);
        margin: 0;
    }

    .card-panel {
        background: white;
        border-radius: 12px;
        padding: 32px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 20px 0;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .field-group {
        margin-bottom: 20px;
    }

    .field-group-full {
        grid-column: span 2;
    }

    @media (max-width: 768px) {
        .field-group-full {
            grid-column: span 1;
        }
    }

    .field-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .field-input, .field-textarea, .field-select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
        background-color: #f8fafc;
        outline: none;
        transition: all 0.3s;
    }

    .field-input:focus, .field-textarea:focus, .field-select:focus {
        border-color: var(--primary);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(0, 49, 120, 0.05);
    }

    .field-input[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    .btn-submit {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 14px 28px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-submit:hover {
        background: #00255a;
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        border-radius: 8px;
        padding: 14px 28px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
    }
</style>

<!-- Header -->
<div class="form-header">
    <div class="form-title-wrap">
        <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
            <i data-lucide="school" style="width: 24px; height: 24px; color: white;"></i>
        </div>
        <div>
            <h1 class="form-title">Ajukan Jadwal Jemput Bola</h1>
            <p class="form-subtitle"><?php echo e(request('school')); ?></p>
        </div>
    </div>
    <a href="<?php echo e(route('cabang.sekolah')); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.2); color: white; padding: 10px 16px; border-radius: 8px; font-weight: 700; font-size: 0.85rem; text-decoration: none; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
        <i data-lucide="arrow-left" style="width: 16px;"></i> Kembali
    </a>
</div>

<form action="<?php echo e(route('cabang.sekolah.ajukan_jadwal.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    
    <!-- Section 1: Detail Pengajuan Sekolah -->
    <div class="card-panel">
        <h2 class="form-section-title">
            <i data-lucide="info" style="width: 20px; color: var(--primary);"></i> Detail Pengajuan Sekolah
        </h2>
        
        <div class="form-grid">
            <div class="field-group">
                <span class="field-label">Lokasi Sekolah</span>
                <input type="text" name="lokasi" value="<?php echo e(request('school')); ?>" readonly class="field-input">
            </div>
            
            <div class="field-group">
                <span class="field-label">Detail Lokasi Pelayanan (Opsional)</span>
                <input type="text" name="detail_lokasi" placeholder="Contoh: Aula Utama, Ruang Kelas..." class="field-input">
            </div>

            <div class="field-group">
                <span class="field-label">Kecamatan</span>
                <input type="text" name="kecamatan" value="<?php echo e($schoolInfo->kecamatan ?? ''); ?>" required placeholder="Contoh: Tegal Timur" class="field-input">
            </div>

            <div class="field-group">
                <span class="field-label">Desa / Kelurahan</span>
                <input type="text" name="desa" value="<?php echo e($schoolInfo->kelurahan ?? ''); ?>" required placeholder="Contoh: Panggung" class="field-input">
            </div>

            <div class="field-group">
                <span class="field-label">Nama Kegiatan</span>
                <input type="text" name="nama_kegiatan" value="Jemput Bola - <?php echo e(request('school')); ?>" required class="field-input">
            </div>

            <div class="field-group">
                <span class="field-label">Fokus Layanan</span>
                <select name="kategori" required class="field-select">
                    <option value="KTP-el">KTP-el (Perekaman Siswa)</option>
                    <option value="KIA">KIA</option>
                    <option value="IKD">IKD (Digital)</option>
                    <option value="Lainnya">Layanan Campuran</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Section 2: Waktu Pelaksanaan -->
    <div class="card-panel">
        <h2 class="form-section-title">
            <i data-lucide="calendar" style="width: 20px; color: var(--primary);"></i> Waktu Pelaksanaan
        </h2>
        
        <div class="form-grid">
            <div class="field-group">
                <span class="field-label">Tanggal Pelayanan</span>
                <input type="date" name="tanggal" required class="field-input">
            </div>

            <div class="field-group">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div>
                        <span class="field-label">Waktu Mulai</span>
                        <input type="time" name="jam_mulai" required class="field-input">
                    </div>
                    <div>
                        <span class="field-label">Waktu Selesai</span>
                        <input type="time" name="jam_selesai" required class="field-input">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 3: Informasi Tambahan -->
    <div class="card-panel">
        <h2 class="form-section-title">
            <i data-lucide="file-text" style="width: 20px; color: var(--primary);"></i> Informasi Tambahan
        </h2>
        
        <div class="field-group" style="margin-bottom: 0;">
            <span class="field-label">Keterangan / Catatan Tambahan</span>
            <textarea name="keterangan" rows="4" placeholder="Masukkan detail tambahan jika ada..." class="field-textarea"></textarea>
        </div>
    </div>

    <!-- Actions -->
    <div style="display: flex; justify-content: flex-end; gap: 16px; margin-bottom: 40px;">
        <a href="<?php echo e(route('cabang.sekolah')); ?>" class="btn-cancel">Batal & Kembali</a>
        <button type="submit" class="btn-submit">
            <i data-lucide="send" style="width: 18px;"></i> Kirim Pengajuan Jadwal
        </button>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/cabang/ajukan-jadwal-sekolah.blade.php ENDPATH**/ ?>