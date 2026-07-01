<?php $__env->startSection('title', 'Profil Cabang - SI JEBOL'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 40px;
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

    .header-content { position: relative; z-index: 10; display: flex; align-items: center; gap: 24px; }
    
    .profile-avatar-large {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        object-fit: cover;
        background: white;
    }
    
    .header-title { font-size: 2rem; font-weight: 800; margin: 0 0 4px 0; letter-spacing: -0.5px; color: white; }
    .header-subtitle { font-size: 1rem; color: rgba(255,255,255,0.8); margin: 0; font-weight: 500; display: flex; align-items: center; gap: 8px; }

    .header-actions { position: relative; z-index: 10; display: flex; gap: 12px; }

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
    
    .btn-warning { background: #f59e0b; color: #78350f; }
    .btn-warning:hover { background: #d97706; color: white; transform: translateY(-2px); }

    .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }
    
    @media (max-width: 1024px) { 
        .main-grid { grid-template-columns: 1fr; } 
        .page-header { margin: -1.5rem -1rem 24px -1rem; }
    }
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            text-align: center;
            gap: 20px;
            padding: 30px 20px;
        }
        .header-content {
            flex-direction: column;
            gap: 16px;
        }
        .header-actions {
            flex-wrap: wrap;
            justify-content: center;
        }
    }

    .panel-box {
        background: white;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 24px 0;
        padding-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-list { display: flex; flex-direction: column; gap: 20px; }
    
    .info-item { display: flex; align-items: flex-start; gap: 16px; }
    
    .info-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: #f8fafc;
        color: #1e293b;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border: 1px solid #e2e8f0;
    }
    
    .info-content { flex: 1; }
    .info-label { font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .info-value { font-size: 1.05rem; font-weight: 600; color: #1e293b; }

    .stat-card {
        background: #f8fafc;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
        transition: all 0.2s;
    }
    .stat-card:hover { border-color: var(--primary); background: white; box-shadow: 0 4px 12px rgba(0, 49, 120, 0.05); }
    .stat-card:last-child { margin-bottom: 0; }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }
    
    .icon-success { background: #d1fae5; color: #047857; }
    .icon-primary { background: #dbeafe; color: #1d4ed8; }
    .icon-warning { background: #fef3c7; color: #d97706; }
    
    .stat-text { flex: 1; }
    .stat-title { font-size: 0.85rem; font-weight: 700; color: var(--text-muted); margin-bottom: 4px; }
    .stat-val { font-size: 1.1rem; font-weight: 800; color: var(--text-main); }
    .stat-desc { font-size: 0.8rem; color: var(--text-muted); margin-top: 4px; }

    .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; }
</style>

<div class="page-header">
    <div class="header-content">
        <?php if(auth()->user()->foto_profil): ?>
            <img src="<?php echo e(asset('storage/' . auth()->user()->foto_profil)); ?>" alt="Avatar" class="profile-avatar-large">
        <?php else: ?>
            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name ?? 'Cabang')); ?>&background=f59e0b&color=ffffff&bold=true&size=200" alt="Avatar" class="profile-avatar-large">
        <?php endif; ?>
        <div>
            <h1 class="header-title"><?php echo e(auth()->user()->name ?? 'Petugas Cabang'); ?></h1>
            <p class="header-subtitle">
                <i data-lucide="shield" style="width: 16px;"></i> <?php echo e(auth()->user()->jabatan ?? 'Petugas Cabang Dinas'); ?>

            </p>
        </div>
    </div>
    <div class="header-actions">
        <a href="<?php echo e(route('cabang.profil.edit')); ?>" class="btn btn-warning">
            <i data-lucide="edit-3" style="width: 18px;"></i> Ubah Profil
        </a>
        <a href="<?php echo e(route('cabang.profil.password')); ?>" class="btn btn-light-outline">
            <i data-lucide="lock" style="width: 18px;"></i> Keamanan
        </a>
    </div>
</div>

<?php if(session('success')): ?>
<div class="alert-success">
    <i data-lucide="check-circle" style="width: 20px;"></i>
    <span><?php echo e(session('success')); ?></span>
</div>
<?php endif; ?>

<div class="main-grid">
    <!-- Kolom Kiri: Informasi Detail -->
    <div>
        <div class="panel-box">
            <h3 class="section-title"><i data-lucide="user" style="color: var(--primary);"></i> Informasi Detail Profil</h3>
            
            <div class="info-list">
                <div class="info-item">
                    <div class="info-icon"><i data-lucide="user"></i></div>
                    <div class="info-content">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value"><?php echo e(auth()->user()->name ?? '-'); ?></div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon"><i data-lucide="mail"></i></div>
                    <div class="info-content">
                        <div class="info-label">Email Address</div>
                        <div class="info-value"><?php echo e(auth()->user()->email ?? '-'); ?></div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i data-lucide="phone"></i></div>
                    <div class="info-content">
                        <div class="info-label">Nomor Handphone</div>
                        <div class="info-value"><?php echo e(auth()->user()->phone ?? '-'); ?></div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i data-lucide="briefcase"></i></div>
                    <div class="info-content">
                        <div class="info-label">Jabatan / Role</div>
                        <div class="info-value"><?php echo e(auth()->user()->jabatan ?? 'Petugas Cabang Dinas'); ?></div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i data-lucide="map-pin"></i></div>
                    <div class="info-content">
                        <div class="info-label">Kecamatan Tugas</div>
                        <div class="info-value"><?php echo e(auth()->user()->kecamatan ?? 'Kec. Tegal Bar'); ?></div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i data-lucide="building"></i></div>
                    <div class="info-content">
                        <div class="info-label">Alamat Kantor</div>
                        <div class="info-value"><?php echo e(auth()->user()->alamat ?? 'Jl. Bawal No.5, Tegalsari, Kec. Tegal Bar., Kota Tegal, Jawa Tengah 52111, Indonesia.'); ?></div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i data-lucide="calendar"></i></div>
                    <div class="info-content">
                        <div class="info-label">Tanggal Bergabung</div>
                        <div class="info-value"><?php echo e(auth()->user()->created_at ? auth()->user()->created_at->translatedFormat('d F Y') : '-'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Status & Info Akun -->
    <div>
        <div class="panel-box">
            <h3 class="section-title"><i data-lucide="info" style="color: var(--primary);"></i> Status Akun</h3>
            
            <!-- Status Aktif -->
            <div class="stat-card">
                <div class="stat-icon icon-success"><i data-lucide="check-circle"></i></div>
                <div class="stat-text">
                    <div class="stat-title">Status Akun</div>
                    <div class="stat-val" style="color: #047857;">Aktif</div>
                    <div class="stat-desc">Akun Anda dalam kondisi aktif</div>
                </div>
            </div>

            <!-- Role -->
            <div class="stat-card">
                <div class="stat-icon icon-primary"><i data-lucide="shield"></i></div>
                <div class="stat-text">
                    <div class="stat-title">Hak Akses</div>
                    <div class="stat-val"><?php echo e(auth()->user()->role ?? 'Cabang'); ?></div>
                    <div class="stat-desc">Akses sebagai petugas cabang</div>
                </div>
            </div>

            <!-- Last Login -->
            <?php
                $loginTime = auth()->user()->updated_at ? \Carbon\Carbon::parse(auth()->user()->updated_at)->translatedFormat('d M Y, H:i') . ' WIB' : 'Baru saja';
                $loginDevice = 'Akses via Web SI JEBOL';
            ?>
            <div class="stat-card">
                <div class="stat-icon icon-warning"><i data-lucide="clock"></i></div>
                <div class="stat-text">
                    <div class="stat-title">Terakhir Login</div>
                    <div class="stat-val" style="font-size: 0.95rem;"><?php echo e($loginTime); ?></div>
                    <div class="stat-desc">Melalui <?php echo e($loginDevice); ?></div>
                </div>
            </div>
            
        </div>
        

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/cabang/profil.blade.php ENDPATH**/ ?>