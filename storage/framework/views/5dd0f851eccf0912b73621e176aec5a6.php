<?php $__env->startSection('title', 'Edit Profil - SI JEBOL Admin'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 32px 40px;
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
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }

    .form-section { margin-bottom: 32px; }
    .form-section:last-child { margin-bottom: 0; }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 24px 0;
        padding-bottom: 12px;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
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
        .form-grid { grid-template-columns: 1fr; }
    }

    .form-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px;}
    .form-group:last-child { margin-bottom: 0; }
    
    .form-label { font-size: 0.85rem; font-weight: 700; color: var(--text-main); }
    .form-control { 
        width: 100%; 
        padding: 12px 16px; 
        border-radius: 12px; 
        border: 1px solid #cbd5e1; 
        background: white; 
        font-family: inherit; 
        font-size: 0.95rem; 
        outline: none; 
        transition: all 0.2s; 
    }
    .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(0, 49, 120, 0.1); }
    
    .form-hint { font-size: 0.8rem; color: var(--text-muted); margin-top: 4px; }

    .avatar-upload-container {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 24px;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
    }
    
    .avatar-preview {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        background: white;
    }

    input[type="file"]::file-selector-button {
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        background: white;
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--text-main);
        cursor: pointer;
        margin-right: 12px;
        transition: all 0.2s;
    }
    input[type="file"]::file-selector-button:hover { background: #f8fafc; }

    .form-actions { display: flex; justify-content: flex-end; gap: 16px; margin-top: 32px; padding-top: 24px; border-top: 1px solid #e2e8f0; }
    
    .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; }
</style>

<div class="page-header">
    <div class="header-content">
        <h1 class="header-title">
            <i data-lucide="user-cog" style="width: 32px; height: 32px; color: #fbbf24;"></i>
            Edit Profil
        </h1>
        <p class="header-subtitle">Perbarui informasi akun Anda</p>
    </div>
    <div class="header-actions">
        <a href="<?php echo e(route('admin.profil')); ?>" class="btn btn-light-outline">
            <i data-lucide="arrow-left" style="width: 18px;"></i> Kembali ke Profil
        </a>
    </div>
</div>

<div class="panel-box">
    <?php if(session('success')): ?>
    <div class="alert-success">
        <i data-lucide="check-circle" style="width: 20px;"></i>
        <span><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.profil.update')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <div class="form-section">
            <h3 class="section-title"><i data-lucide="camera" style="color: var(--primary);"></i> Foto Profil</h3>
            <div class="avatar-upload-container">
                <?php if(auth()->user()->foto_profil): ?>
                    <img src="<?php echo e(asset('storage/' . auth()->user()->foto_profil)); ?>" alt="Avatar" class="avatar-preview" id="avatar_preview">
                <?php else: ?>
                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name)); ?>&background=003178&color=ffffff&bold=true" alt="Avatar" class="avatar-preview" id="avatar_preview">
                <?php endif; ?>
                <div>
                    <input type="file" name="foto_profil" id="foto_profil" accept="image/*" class="form-control" style="border: none; padding: 0; background: transparent;">
                    <div class="form-hint" style="margin-top: 8px;">Format: JPG, PNG. Maksimal ukuran file 2MB.</div>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="section-title"><i data-lucide="user" style="color: var(--primary);"></i> Informasi Pribadi</h3>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="name" value="<?php echo e(auth()->user()->name); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="<?php echo e(auth()->user()->username); ?>" placeholder="<?php echo e(auth()->user()->name); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" value="<?php echo e(auth()->user()->email); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Handphone</label>
                    <input type="text" name="phone" value="<?php echo e(auth()->user()->phone); ?>" placeholder="0812-3456-7890" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="section-title"><i data-lucide="briefcase" style="color: var(--primary);"></i> Informasi Pekerjaan</h3>
            
            <div class="form-group">
                <label class="form-label">Jabatan / Peran</label>
                <input type="text" name="jabatan" value="<?php echo e(auth()->user()->jabatan); ?>" placeholder="Admin Pusat" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Alamat Instansi</label>
                <textarea name="alamat" rows="3" placeholder="Jl. Ki Gede Sebayu No. 12, Kota Tegal, Jawa Tengah 52122" class="form-control"><?php echo e(auth()->user()->alamat); ?></textarea>
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <a href="<?php echo e(route('admin.profil')); ?>" class="btn btn-outline" style="border: 1px solid #cbd5e1; color: var(--text-main); background: white;">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i data-lucide="save" style="width: 18px;"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('foto_profil').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar_preview').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/admin/profil-edit.blade.php ENDPATH**/ ?>