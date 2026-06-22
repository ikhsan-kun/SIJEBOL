<?php $__env->startSection('title', 'Penilaian Layanan - SI JEBOL Admin'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 32px 40px;
        position: relative;
        overflow: hidden;
        margin: -2rem -2rem 24px -2rem;
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

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.02);
        display: flex;
        align-items: center;
        gap: 20px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -8px rgba(0,0,0,0.08);
        border-color: #e2e8f0;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }
    
    .stat-icon.primary { background: #e0e7ff; color: #4338ca; }
    .stat-icon.warning { background: #fef3c7; color: #d97706; }
    .stat-icon.success { background: #d1fae5; color: #047857; }

    .stat-label { font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .stat-value { font-size: 1.8rem; font-weight: 800; color: var(--text-main); line-height: 1; margin-bottom: 4px; }
    .stat-desc { font-size: 0.8rem; color: var(--text-muted); }

    .panel-box {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }

    /* Filters */
    .filter-container {
        background: #f8fafc;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
        border: 1px solid #e2e8f0;
    }
    .filter-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr) auto;
        gap: 16px;
        align-items: end;
    }
    .form-group { display: flex; flex-direction: column; gap: 8px; }
    .form-label { font-size: 0.8rem; font-weight: 700; color: var(--text-main); }
    .form-control { 
        width: 100%; 
        padding: 10px 14px; 
        border-radius: 10px; 
        border: 1px solid #cbd5e1; 
        font-family: inherit; 
        font-size: 0.9rem; 
        outline: none; 
    }
    .form-control:focus { border-color: var(--primary); }
    
    .btn { padding: 10px 16px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; transition: all 0.2s; border: none; text-decoration: none; }
    .btn-primary { background: var(--primary); color: white; }
    .btn-outline { background: white; border: 1px solid #cbd5e1; color: var(--text-main); }

    /* Layout Table + Detail */
    .content-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }
    @media (max-width: 1024px) { .content-layout { grid-template-columns: 1fr; } }

    /* Data Table */
    .data-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .data-table th, .data-table td { padding: 16px; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; vertical-align: middle; }
    .data-table th { background: #f8fafc; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.8rem; text-align: left; }
    .data-table th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .data-table th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
    
    .table-row { cursor: pointer; transition: all 0.2s; }
    .table-row:hover { background: #f8fafc; }
    .table-row.active { background: #eff6ff; }

    .star-rating { display: flex; gap: 2px; color: #fbbf24; }
    .star-empty { color: #e2e8f0; }

    /* Detail Panel */
    .detail-panel { background: #f8fafc; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; height: fit-content; position: sticky; top: 24px; }
    .detail-title { font-size: 1.1rem; font-weight: 700; color: var(--text-main); margin: 0 0 20px 0; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px; }
    
    .detail-item { margin-bottom: 16px; }
    .detail-item:last-child { margin-bottom: 0; }
    .detail-label { font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 4px; }
    .detail-value { font-size: 0.95rem; font-weight: 600; color: var(--text-main); }
    .detail-comment { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; font-size: 0.9rem; color: var(--text-main); font-style: italic; margin-top: 8px; }
    
    .empty-state { text-align: center; padding: 40px 20px; color: var(--text-muted); }
    
    .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; }
</style>

<div class="page-header">
    <div class="header-content">
        <h1 class="header-title">
            <i data-lucide="star" style="width: 32px; height: 32px; color: #fbbf24;"></i>
            Penilaian Layanan
        </h1>
        <p class="header-subtitle">Kelola dan pantau hasil penilaian kepuasan warga terhadap layanan SI JEBOL</p>
    </div>
</div>

<?php if(session('success')): ?>
<div class="alert-success">
    <i data-lucide="check-circle" style="width: 20px;"></i>
    <span><?php echo e(session('success')); ?></span>
</div>
<?php endif; ?>

<div class="dashboard-grid">
    <!-- Total Penilaian -->
    <div class="stat-card">
        <div class="stat-icon primary"><i data-lucide="clipboard-list" style="width: 28px; height: 28px;"></i></div>
        <div>
            <div class="stat-label">Total Penilaian</div>
            <div class="stat-value"><?php echo e($totalPenilaian); ?></div>
            <div class="stat-desc">Penilaian dari masyarakat</div>
        </div>
    </div>

    <!-- Rata-rata Rating -->
    <div class="stat-card">
        <div class="stat-icon warning"><i data-lucide="star" style="width: 28px; height: 28px;"></i></div>
        <div>
            <div class="stat-label">Rata-rata Rating</div>
            <div class="stat-value"><?php echo e(number_format($avgKeseluruhan, 2, ',', '.')); ?> <span style="font-size: 1rem; color: var(--text-muted);">/ 5</span></div>
            <div class="stat-desc">Dari seluruh penilaian</div>
        </div>
    </div>

    <!-- Layanan Terbanyak -->
    <div class="stat-card">
        <div class="stat-icon success"><i data-lucide="award" style="width: 28px; height: 28px;"></i></div>
        <div>
            <div class="stat-label">Terbanyak Dinilai</div>
            <div class="stat-value" style="font-size: 1.4rem;"><?php echo e($layananTerbanyakNama); ?></div>
            <div class="stat-desc">Layanan dengan data terbanyak</div>
        </div>
    </div>
</div>

<div class="panel-box">
    <div class="filter-container">
        <form action="<?php echo e(route('admin.kepuasan.index')); ?>" method="GET" class="filter-grid">
            <div class="form-group">
                <label class="form-label">Cari Nama Pemohon</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Masukkan nama..." class="form-control">
            </div>
            
            <div class="form-group">
                <label class="form-label">Jenis Layanan</label>
                <select name="layanan" class="form-control">
                    <option value="">Semua Layanan</option>
                    <option value="KTP-el" <?php echo e(request('layanan') == 'KTP-el' ? 'selected' : ''); ?>>KTP-el</option>
                    <option value="KIA" <?php echo e(request('layanan') == 'KIA' ? 'selected' : ''); ?>>KIA</option>
                    <option value="IKD" <?php echo e(request('layanan') == 'IKD' ? 'selected' : ''); ?>>IKD</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Rating</label>
                <select name="rating" class="form-control">
                    <option value="">Semua Rating</option>
                    <option value="5" <?php echo e(request('rating') == '5' ? 'selected' : ''); ?>>5 Bintang</option>
                    <option value="4" <?php echo e(request('rating') == '4' ? 'selected' : ''); ?>>4 Bintang</option>
                    <option value="3" <?php echo e(request('rating') == '3' ? 'selected' : ''); ?>>3 Bintang</option>
                    <option value="2" <?php echo e(request('rating') == '2' ? 'selected' : ''); ?>>2 Bintang</option>
                    <option value="1" <?php echo e(request('rating') == '1' ? 'selected' : ''); ?>>1 Bintang</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" value="<?php echo e(request('tanggal')); ?>" class="form-control">
            </div>
            
            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn btn-primary">
                    <i data-lucide="search" style="width: 18px;"></i> Cari
                </button>
                <a href="<?php echo e(route('admin.kepuasan.laporan')); ?>" class="btn btn-outline">
                    <i data-lucide="printer" style="width: 18px;"></i> Cetak
                </a>
            </div>
        </form>
    </div>

    <!-- Alpine.js component for interaction -->
    <div class="content-layout" x-data="{ currentId: null, currentMasyarakat: '', currentSaran: '', currentKeseluruhan: 0, currentLayanan: '', currentDate: '', currentFoto: '' }">
        
        <!-- Table -->
        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Pemohon</th>
                        <th>Layanan</th>
                        <th>Rating</th>
                        <th>Tanggal</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="table-row" 
                        @click="currentId = '<?php echo e($review->id_kepuasan); ?>'; currentMasyarakat = '<?php echo e(addslashes($review->masyarakat ? ($review->masyarakat->name ?? $review->masyarakat->nama) : 'Anonim')); ?>'; currentLayanan = '<?php echo e(addslashes($review->status_layanan ?? '-')); ?>'; currentKeseluruhan = <?php echo e((int)round($review->nilai_kepuasan)); ?>; currentSaran = '<?php echo e(addslashes(str_replace(["\r", "\n"], ' ', $review->kritik_saran ?? '-'))); ?>'; currentDate = '<?php echo e($review->tanggal_input ? $review->tanggal_input->format('d M Y H:i') . ' WIB' : '-'); ?>'; currentFoto = '<?php echo e($review->foto_path ? asset('storage/' . $review->foto_path) : ''); ?>';"
                        :class="currentId === '<?php echo e($review->id_kepuasan); ?>' ? 'active' : ''">
                        <td style="font-weight: 600; color: var(--text-muted);"><?php echo e(($reviews->currentPage() - 1) * $reviews->perPage() + $loop->iteration); ?></td>
                        <td style="font-weight: 600; color: var(--text-main);"><?php echo e($review->masyarakat ? ($review->masyarakat->name ?? $review->masyarakat->nama) : 'Anonim'); ?></td>
                        <td><span style="background: #f1f5f9; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;"><?php echo e($review->status_layanan ?? '-'); ?></span></td>
                        <td>
                            <div class="star-rating" title="<?php echo e($review->nilai_kepuasan); ?>/5">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php if($i <= round($review->nilai_kepuasan)): ?>
                                        <i data-lucide="star" style="width: 16px; fill: currentColor;"></i>
                                    <?php else: ?>
                                        <i data-lucide="star" style="width: 16px;" class="star-empty"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </td>
                        <td><?php echo e($review->tanggal_input ? $review->tanggal_input->format('d/m/Y') : '-'); ?></td>
                        <td style="text-align: right;">
                            <button type="button" class="btn" style="padding: 6px; background: transparent; color: var(--text-muted);">
                                <i data-lucide="chevron-right" style="width: 18px;"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="empty-state">Belum ada data penilaian dari warga.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <div style="margin-top: 24px;">
                <?php echo e($reviews->appends(request()->except('page'))->links()); ?>

            </div>
        </div>

        <!-- Detail Panel -->
        <div class="detail-panel">
            <h3 class="detail-title"><i data-lucide="info" style="color: var(--primary);"></i> Detail Penilaian</h3>
            
            <div x-show="!currentId" class="empty-state">
                <i data-lucide="mouse-pointer-click" style="width: 48px; height: 48px; color: #cbd5e1; margin-bottom: 12px; opacity: 0.5;"></i>
                <p>Klik salah satu baris di tabel untuk melihat detail penilaian.</p>
            </div>

            <div x-show="currentId" style="display: none;">
                <div class="detail-item">
                    <div class="detail-label">Nama Pemohon</div>
                    <div class="detail-value" x-text="currentMasyarakat"></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Jenis Layanan</div>
                    <div class="detail-value" x-text="currentLayanan"></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tanggal Penilaian</div>
                    <div class="detail-value" x-text="currentDate"></div>
                </div>
                
                <div class="detail-item" style="margin-top: 24px; padding-top: 16px; border-top: 1px dashed #cbd5e1;">
                    <div class="detail-label">Rating Kepuasan</div>
                    <div class="star-rating" style="margin-top: 8px;">
                        <template x-for="i in 5">
                            <i data-lucide="star" style="width: 20px; height: 20px;" 
                               :class="i <= currentKeseluruhan ? '' : 'star-empty'"
                               :style="i <= currentKeseluruhan ? 'fill: currentColor;' : ''"></i>
                        </template>
                    </div>
                </div>

                <div class="detail-item" style="margin-top: 24px;">
                    <div class="detail-label">Komentar & Saran</div>
                    <div class="detail-comment">
                        <span x-show="currentSaran && currentSaran !== '-'" x-text="currentSaran"></span>
                        <span x-show="!currentSaran || currentSaran === '-'" style="color: #94a3b8; font-style: italic;">Tidak ada komentar.</span>
                    </div>
                </div>

                <div class="detail-item" x-show="currentFoto" style="margin-top: 24px;">
                    <div class="detail-label">Foto Lampiran</div>
                    <div style="margin-top: 8px;">
                        <img :src="currentFoto" alt="Lampiran Kepuasan" style="max-width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; display: block;">
                        <a :href="currentFoto" target="_blank" style="display: inline-block; margin-top: 8px; font-size: 0.8rem; font-weight: 600; color: var(--primary); text-decoration: none;">
                            <i data-lucide="external-link" style="width: 14px; vertical-align: middle;"></i> Lihat Gambar Penuh
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/admin/kepuasan/index.blade.php ENDPATH**/ ?>