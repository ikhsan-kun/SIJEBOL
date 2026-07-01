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

<?php echo $__env->make('partials.header-masyarakat', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<!-- Sidebar Overlay Element -->
<div class="sidebar-overlay-fixed" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>
<?php /**PATH D:\laragon\www\jeboll\resources\views/partials/sidebar-masyarakat.blade.php ENDPATH**/ ?>