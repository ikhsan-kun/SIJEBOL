<!-- Global Content Header (Centralized) -->
<header class="global-content-header">
    <!-- Mobile Toggle (New) -->
    <button class="mobile-nav-toggle" @click="sidebarOpen = !sidebarOpen">
        <i data-lucide="menu"></i>
    </button>

    <form action="<?php echo e(route('masyarakat.cek-status')); ?>" method="GET" class="header-search-form">
        <i data-lucide="search" class="search-icon-fixed"></i>
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari layanan atau permohonan...">
    </form>
    
    <div class="header-right-actions">
        <!-- Notifications -->
        <?php
            $recentNotifs = collect();
            if (auth()->check() && auth()->user() instanceof \App\Models\Masyarakat) {
                $recentNotifs = \App\Models\PengajuanLayanan::where('nik', auth()->user()->nik)
                    ->whereNotNull('tanggal_pengajuan')
                    ->orderBy('tanggal_pengajuan', 'desc')
                    ->take(3)
                    ->get();
            }
        ?>
        <div class="header-notification-wrapper">
            <div class="notification-trigger">
                <i data-lucide="bell"></i>
                <?php if($recentNotifs->count() > 0): ?>
                <span class="notification-badge"></span>
                <?php endif; ?>
            </div>
            
            <!-- Notification Dropdown -->
            <div class="header-dropdown-menu notification-dropdown">
                <p class="dropdown-label">Pesan Terbaru</p>
                <div class="notification-list">
                    <?php $__empty_1 = true; $__currentLoopData = $recentNotifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('masyarakat.cek-status', ['search' => $notif->nomor_tiket])); ?>" style="text-decoration: none;" class="notification-item-row jbl-582 jbl-632" style="display: flex; gap: 12px; padding: 10px; border-radius: 8px;">
                        <div class="notif-dot" style="background: <?php echo e($notif->status == 'Selesai' ? '#10b981' : ($notif->status == 'Ditolak' ? '#ef4444' : '#f59e0b')); ?>"></div>
                        <div class="notif-content">
                            <p class="notif-title" style="margin: 0; font-size: 0.8rem; font-weight: 800; color: #1e293b;">Status: <?php echo e($notif->status); ?></p>
                            <p class="notif-desc" style="margin: 4px 0 0; font-size: 0.75rem; color: #64748b;">Layanan <?php echo e($notif->jenis_layanan); ?> (<?php echo e($notif->nomor_tiket); ?>)</p>
                            <p style="margin: 4px 0 0; font-size: 0.65rem; color: #94a3b8; font-weight: 600;"><?php echo e($notif->tanggal_pengajuan ? \Carbon\Carbon::parse($notif->tanggal_pengajuan)->diffForHumans() : ''); ?></p>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div style="text-align: center; padding: 16px 0; font-size: 0.75rem; color: #94a3b8;">
                        Belum ada notifikasi baru.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="header-divider"></div>

        <!-- User Profile Dropdown -->
        <div class="header-user-wrapper">
            <?php if(auth()->guard()->check()): ?>
                <button class="user-profile-trigger">
                    <div class="user-avatar-initials">
                        <?php if(auth()->user()->foto_profil ?? auth()->user()->profile_photo_path): ?>
                            <img src="<?php echo e(asset('storage/' . (auth()->user()->foto_profil ?? auth()->user()->profile_photo_path))); ?>" alt="Profile">
                        <?php else: ?>
                            <?php echo e(strtoupper(substr(auth()->user()->nama ?? auth()->user()->name ?? 'U', 0, 2))); ?>

                        <?php endif; ?>
                    </div>
                    <div class="user-info-text">
                        <p class="user-display-name"><?php echo e(auth()->user()->nama ?? auth()->user()->name ?? 'Pengguna'); ?></p>
                        <p class="user-display-role">Warga Digital</p>
                    </div>
                    <i data-lucide="chevron-down" class="dropdown-arrow-icon"></i>
                </button>

                <!-- Dropdown Menu -->
                <div class="header-dropdown-menu profile-dropdown">
                    <div class="dropdown-header-box">
                        <p class="dropdown-user-name"><?php echo e(auth()->user()->nama ?? auth()->user()->name ?? 'Pengguna'); ?></p>
                        <p class="dropdown-user-email"><?php echo e(auth()->user()->email); ?></p>
                    </div>
                    <div class="dropdown-links">
                        <a href="<?php echo e(route('masyarakat.profile')); ?>" class="dropdown-link-item">
                            <i data-lucide="user"></i>
                            Profil Akun
                        </a>
                        <a href="<?php echo e(route('masyarakat.help')); ?>" class="dropdown-link-item">
                            <i data-lucide="help-circle"></i>
                            Bantuan
                        </a>
                    </div>
                    <div class="dropdown-footer">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="logout-link-btn" style="color: #ef4444; border: none; background: transparent; cursor: pointer; display: flex; align-items: center; gap: 12px; font-weight: 700; width: 100%; padding: 12px 20px;">
                                <i data-lucide="log-out"></i>
                                Keluar Sesi
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="user-profile-trigger" style="text-decoration: none;">
                    <div class="user-avatar-initials" style="background: rgba(148, 163, 184, 0.1); color: #64748b; border-color: rgba(148, 163, 184, 0.2);">
                        <i data-lucide="user"></i>
                    </div>
                    <div class="user-info-text">
                        <p class="user-display-name">Tamu</p>
                        <p class="user-display-role">Belum Masuk</p>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>
<?php /**PATH D:\laragon\www\jeboll\resources\views/partials/header-masyarakat.blade.php ENDPATH**/ ?>