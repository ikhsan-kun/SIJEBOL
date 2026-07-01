<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SI JEBOL - Panel Masyarakat'); ?></title>
    
    <!-- Base CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom-style.css')); ?>">
    
    <!-- Panel Masyarakat Global CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/masyarakat.css')); ?>?v=<?php echo e(time()); ?>">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="no-batik" x-data="{ sidebarOpen: false }">
    <div class="dashboard-layout">
        <?php echo $__env->make('partials.sidebar-masyarakat', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <main class="main-content">
            <?php echo $__env->yieldContent('content'); ?>
            
        <div style="margin-top: auto; margin-left: -24px; margin-right: -24px; width: calc(100% + 48px); padding: 16px 24px; background: white; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748b; position: sticky; bottom: 0; z-index: 40; box-sizing: border-box;">
            <div>&copy; <?php echo e(date('Y')); ?> Dinas Kependudukan dan Pencatatan Sipil Kota Tegal. All rights reserved.</div>
            <div style="display:flex; gap:16px;">
                <span style="color:#64748b;">Crafted with ❤️ by Siti Nurhalizah</span>
            </div>
        </div>        
        </main>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>
    
    <!-- Panel Masyarakat Global JS -->
    <script src="<?php echo e(asset('js/masyarakat.js')); ?>"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\laragon\www\jeboll\resources\views/layouts/masyarakat.blade.php ENDPATH**/ ?>