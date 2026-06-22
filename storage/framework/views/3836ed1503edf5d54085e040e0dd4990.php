<aside class="sidebar-masyarakat" :class="{ 'active': sidebarOpen }">
    <!-- Header with Logo -->
    <div class="sidebar-header">
        <div class="logo-box">
            <img src="<?php echo e(asset('images/logo-tegal.png')); ?>" alt="Logo Tegal">
        </div>
        <div class="brand-text">
            <h1>SI JEBOL</h1>
            <p>Kota Tegal Warga</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav-v2">
        <a href="<?php echo e(route('masyarakat.dashboard')); ?>" class="nav-item <?php echo e(request()->routeIs('masyarakat.dashboard') ? 'active' : ''); ?>">
            <i data-lucide="layout-dashboard"></i>
            <span>Dashboard</span>
        </a>
        <a href="<?php echo e(route('masyarakat.layanan')); ?>" class="nav-item <?php echo e(request()->routeIs('masyarakat.layanan') ? 'active' : ''); ?>">
            <i data-lucide="file-plus-2"></i>
            <span>Pengajuan Layanan</span>
        </a>
        <a href="<?php echo e(route('masyarakat.cek-status')); ?>" class="nav-item <?php echo e(request()->routeIs('masyarakat.cek-status') ? 'active' : ''); ?>">
            <i data-lucide="shield-check"></i>
            <span>Pelacakan Layanan</span>
        </a>
        <a href="<?php echo e(route('masyarakat.jadwal')); ?>" class="nav-item <?php echo e(request()->routeIs('masyarakat.jadwal') ? 'active' : ''); ?>">
            <i data-lucide="calendar"></i>
            <span>Jadwal Mobile</span>
        </a>


        <a href="<?php echo e(route('masyarakat.kepuasan')); ?>" class="nav-item <?php echo e(request()->routeIs('masyarakat.kepuasan') ? 'active' : ''); ?>">
            <i data-lucide="star"></i>
            <span>Penilaian Layanan</span>
        </a>
        
</nav>

    <!-- Footer -->
    <div class="sidebar-footer">
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('masyarakat.layanan')); ?>" class="btn-create-permohonan">
                <i data-lucide="plus-circle"></i>
                <span>Buat Permohonan</span>
            </a>
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout-form">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-logout-sidebar">
                    <i data-lucide="log-out"></i>
                    <span>Keluar Sesi</span>
                </button>
            </form>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn-create-permohonan">
                <i data-lucide="log-in"></i>
                <span>Masuk Akun</span>
            </a>
            <a href="<?php echo e(route('register')); ?>" class="btn-logout-sidebar" style="background: rgba(251, 211, 141, 0.1); border-color: rgba(251, 211, 141, 0.2); color: #fbd38d;">
                <i data-lucide="user-plus"></i>
                <span>Daftar Baru</span>
            </a>
        <?php endif; ?>
    </div>
</aside>

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

<style>
    *, *::before, *::after {
        box-sizing: border-box;
    }

    /* Global Batik Background */
    body {
        background-color: #f6f9fc !important;
        background-image: url('<?php echo e(asset('img/batik-pattern.png')); ?>') !important;
        background-size: 400px !important;
        background-attachment: fixed !important;
    }

    /* Premium Sidebar Styles (Sleek Batik Theme) */
    .sidebar-masyarakat {
        background: #003178;
        border-right: 4px solid #fcd34d;
        padding: 24px 0;
        display: flex;
        flex-direction: column;
        position: fixed;
        width: 260px;
        height: 100vh;
        z-index: 2000;
        overflow: hidden;
        color: #e2e8f0;
        box-shadow: 10px 0 30px rgba(0,0,0,0.15);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-masyarakat::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('/images/batik-tegal-premium.jpg');
        background-size: 400px;
        opacity: 0.15;
        mix-blend-mode: luminosity; /* Adds a nice effect for JPGs on color background */
        pointer-events: none;
        z-index: 0;
    }

    .sidebar-header {
        padding: 0 24px;
        margin-bottom: 32px;
        display: flex;
        align-items: center;
        gap: 16px;
        position: relative;
        z-index: 10;
    }

    .sidebar-header .logo-box {
        width: 90px;
        height: 90px;
        background: transparent;
        border: none;
        display: grid;
        place-items: center;
        padding: 0;
        transition: all 0.3s ease;
    }

    .sidebar-header .logo-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 0 12px rgba(255, 255, 255, 0.6));
    }

    .sidebar-header .brand-text h1 {
        color: white;
        font-size: 1.25rem;
        font-weight: 900;
        margin: 0;
        line-height: 1;
        letter-spacing: -0.5px;
    }

    .sidebar-header .brand-text p {
        color: #fbd38d;
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin: 4px 0 0;
    }

    .sidebar-nav-v2 {
        display: flex;
        flex-direction: column;
        gap: 4px;
        flex-grow: 1;
        padding: 0 12px;
        position: relative;
        z-index: 10;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #cbd5e1;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.2s ease;
        text-decoration: none;
        border-radius: 12px;
    }

    .nav-item i {
        width: 20px;
        height: 20px;
        transition: all 0.2s ease;
        opacity: 0.8;
    }

    .nav-item:hover i {
        opacity: 1;
    }

    .nav-item:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateX(4px);
    }

    .nav-item.active {
        background: rgba(255, 255, 255, 0.1);
        color: #fbd38d;
        position: relative;
    }

    .nav-item.active::after {
        content: '';
        position: absolute;
        left: 0;
        top: 15%;
        height: 70%;
        width: 4px;
        background: #fbd38d;
        border-radius: 0 4px 4px 0;
        box-shadow: 0 0 15px rgba(251, 211, 141, 0.4);
    }

    .sidebar-footer {
        padding: 24px 20px;
        background: transparent;
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
        z-index: 10;
    }

    .btn-create-permohonan {
        background: #fbd38d;
        color: #003178;
        padding: 14px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-weight: 900;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(251, 211, 141, 0.3);
        transition: all 0.3s ease;
        border: none;
    }

    .btn-create-permohonan i {
        width: 18px;
        height: 18px;
    }

    .btn-create-permohonan:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(251, 211, 141, 0.5);
        filter: brightness(1.1);
    }

    .btn-logout-sidebar {
        width: 100%;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: #cbd5e1;
        font-weight: 800;
        font-size: 0.7rem;
        text-transform: uppercase;
        padding: 12px;
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-logout-sidebar:hover {
        background: rgba(255, 255, 255, 0.05);
        color: white;
        border-color: rgba(255, 255, 255, 0.2);
    }

    /* Global Content Header Styling */
    .global-content-header {
        box-sizing: border-box;
        position: fixed;
        top: 0;
        right: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 80px;
        padding: 0 48px;
        width: calc(100% - 260px);
        z-index: 1000;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
    }

    .header-search-form {
        position: relative;
        width: 100%;
        max-width: 440px;
    }

    .header-search-form input {
        width: 100%;
        padding: 14px 20px 14px 52px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #1e293b;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        outline: none;
    }

    .header-search-form input:focus {
        background: white;
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        transform: translateY(-1px);
    }

    .header-search-form .search-icon-fixed {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        width: 18px;
        height: 18px;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .header-search-form input:focus ~ .search-icon-fixed {
        color: #f59e0b;
    }

    .header-right-actions {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-notification-wrapper, .header-user-wrapper {
        position: relative;
    }

    .notification-trigger {
        padding: 10px;
        border-radius: 14px;
        color: #64748b;
        cursor: pointer;
        display: flex;
        position: relative;
        transition: all 0.2s ease;
    }

    .notification-trigger:hover {
        background: #f8fafc;
        color: #f59e0b;
    }

    .notification-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 8px;
        height: 8px;
        background: #ef4444;
        border: 2px solid white;
        border-radius: 50%;
    }

    .header-divider {
        width: 1px;
        height: 32px;
        background: #f1f5f9;
        margin: 0 8px;
    }

    .user-profile-trigger {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 6px 12px 6px 6px;
        background: transparent;
        border: 1px solid transparent;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .user-profile-trigger:hover {
        background: #f8fafc;
        border-color: #f1f5f9;
    }

    .user-avatar-initials {
        width: 40px;
        height: 40px;
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-weight: 900;
        font-size: 0.85rem;
        border: 1px solid rgba(245, 158, 11, 0.2);
        overflow: hidden;
    }

    .user-avatar-initials img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-info-text {
        text-align: right;
    }

    .user-display-name {
        font-size: 0.75rem;
        font-weight: 900;
        color: #0f172a;
        margin: 0;
        line-height: 1;
    }

    .user-display-role {
        font-size: 9px;
        font-weight: 800;
        color: #f59e0b;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 4px 0 0;
    }

    .dropdown-arrow-icon {
        color: #94a3b8;
        width: 16px;
        height: 16px;
    }

    /* Dropdown Menus */
    .header-dropdown-menu {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.15);
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1100;
        overflow: hidden;
    }

    .header-notification-wrapper:hover .notification-dropdown,
    .header-user-wrapper:hover .profile-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .notification-dropdown { width: 300px; padding: 20px; }
    .profile-dropdown { width: 240px; }

    .dropdown-label {
        font-size: 10px;
        font-weight: 900;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 16px;
    }

    .notification-item-row {
        display: flex;
        gap: 12px;
    }

    .notif-dot {
        width: 8px;
        height: 8px;
        background: #f59e0b;
        border-radius: 50%;
        margin-top: 5px;
        flex-shrink: 0;
    }

    .notif-title { font-size: 0.8rem; font-weight: 800; color: #1e293b; margin: 0; }
    .notif-desc { font-size: 0.75rem; color: #64748b; margin: 4px 0 0; line-height: 1.4; }

    .dropdown-header-box {
        padding: 20px;
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
    }

    .dropdown-user-name { font-size: 0.8rem; font-weight: 900; color: #0f172a; margin: 0; }
    .dropdown-user-email { font-size: 0.7rem; color: #64748b; margin: 4px 0 0; }

    .dropdown-links { padding: 8px; }
    .dropdown-link-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 12px;
        color: #475569;
        font-size: 0.8rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .dropdown-link-item:hover {
        background: #f8fafc;
        color: #f59e0b;
    }

    .dropdown-link-item .material-symbols-outlined { font-size: 20px; }

    .dropdown-footer {
        padding: 8px;
        border-top: 1px solid #f1f5f9;
    }

    .logout-link-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        background: transparent;
        border: none;
        color: #ef4444;
        font-size: 0.8rem;
        font-weight: 800;
        cursor: pointer;
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .logout-link-btn:hover {
        background: #fef2f2;
    }

    /* Mobile Responsive Logic */
    .mobile-nav-toggle {
        display: none;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        color: #003178;
        cursor: pointer;
        transition: all 0.2s;
    }

    .mobile-nav-toggle:hover {
        background: #f1f5f9;
        color: #f59e0b;
    }

    @media (max-width: 1024px) {
        .sidebar-masyarakat {
            transform: translateX(-100%);
            z-index: 3000;
        }

        /* Using Alpine.js class toggle */
        .sidebar-masyarakat.active {
            transform: translateX(0);
        }

        .global-content-header {
            width: 100%;
            padding: 0 20px;
        }

        .mobile-nav-toggle {
            display: flex;
        }

        .header-search-form {
            display: none; /* Hide search on small mobile to save space */
        }

        @media (min-width: 640px) {
            .header-search-form {
                display: block;
                max-width: 200px;
            }
        }
    }

    /* Sidebar Overlay for Mobile */
    .sidebar-overlay-fixed {
        position: fixed;
        inset: 0;
        background: rgba(0, 30, 80, 0.4);
        backdrop-filter: blur(4px);
        z-index: 2500;
        display: none;
    }

    @media (max-width: 1024px) {
        .sidebar-overlay-fixed.active {
            display: block;
        }
    }
    @media (max-width: 768px) {
        .notification-dropdown, .profile-dropdown { 
            position: fixed;
            top: 70px;
            right: 20px;
            left: auto;
            width: 280px;
            max-width: calc(100vw - 40px);
        }
        .user-info-text { display: none; } /* Hide text info on very small screens to save space */
    }
</style>

<!-- Sidebar Overlay Element -->
<div class="sidebar-overlay-fixed" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        try {
            lucide.createIcons();
        } catch (e) {}

        // Dynamic Search Box Handler
        const searchInput = document.querySelector('.header-search-form input[name="search"]');
        const searchForm = document.querySelector('.header-search-form');
        
        if (searchInput && searchForm) {
            const currentPath = window.location.pathname.toLowerCase();
            
            // Check if we are on the Layanan page
            if (currentPath.includes('/layanan')) {
                // Prevent form submission on enter
                searchForm.addEventListener('submit', (e) => e.preventDefault());
                
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();
                    document.querySelectorAll('.premium-service-card').forEach(card => {
                        const name = card.querySelector('h3').textContent.toLowerCase();
                        const desc = card.querySelector('p').textContent.toLowerCase();
                        if (name.includes(query) || desc.includes(query)) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
            // Check if we are on the Bantuan (Help Center) page
            else if (currentPath.includes('/bantuan')) {
                // Prevent form submission on enter
                searchForm.addEventListener('submit', (e) => e.preventDefault());
                
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();
                    
                    // Filter FAQ items
                    document.querySelectorAll('.faq-item').forEach(item => {
                        const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                        const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                        if (question.includes(query) || answer.includes(query)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    // Filter category cards
                    document.querySelectorAll('.cat-card').forEach(card => {
                        const title = card.querySelector('h3').textContent.toLowerCase();
                        const desc = card.querySelector('p').textContent.toLowerCase();
                        if (title.includes(query) || desc.includes(query)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
        }
    });
</script>
<?php /**PATH D:\laragon\www\jeboll\resources\views/partials/sidebar-masyarakat.blade.php ENDPATH**/ ?>