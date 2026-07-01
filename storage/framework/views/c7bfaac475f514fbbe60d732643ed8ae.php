<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Masuk'); ?> | SI JEBOL</title>
    <meta name="description" content="Masuk ke layanan SI JEBOL menggunakan NIK atau Email dan kata sandi Anda.">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .auth-page {
            background-color: #003178 !important;
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.8)), url('<?php echo e(asset('images/batik-tegal-premium.jpg')); ?>') !important;
            background-size: cover !important;
            background-position: center !important;
            background-attachment: fixed !important;
            position: relative !important;
            z-index: 1;
        }
        .auth-page::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('<?php echo e(asset('img/batik-pattern.png')); ?>');
            background-size: 600px;
            opacity: 0.15;
            mix-blend-mode: overlay;
            pointer-events: none;
            z-index: -1;
        }
        .container.auth-shell {
            position: relative;
            z-index: 10;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
        }
        .bg-blob { display: none !important; }
    </style>
</head>

<body>
    <main class="auth-page">
        <!-- Background Blobs for depth -->
        <div class="bg-blob blob-1"></div>
        <div class="bg-blob blob-2"></div>
        <div class="bg-blob blob-3"></div>

        <div class="jbl-186 auth-shell auth-shell-single">
            <section class="auth-card">
                <div class="auth-card-header">
                    <div class="form-logo">
                        <img src="<?php echo e(asset('images/logo-tegal.png')); ?>" alt="Logo Kota Tegal">
                        <div class="form-logo-text">
                            <span class="brand">SI JEBOL</span>
                            <span class="tagline">Kota Tegal</span>
                        </div>
                    </div>
                    <h2>Selamat Datang Kembali</h2>
                    <p><?php echo $__env->yieldContent('subtitle', 'Silakan masuk untuk mengakses layanan kependudukan Anda.'); ?></p>
                </div>

                <?php echo $__env->yieldContent('content'); ?>

            </section>
        </div>
    </main>

    <script>
        lucide.createIcons();

        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            if (window.lucide) {
                window.lucide.createIcons();
            }
        }
    </script>
</body>
</html>

<?php /**PATH D:\laragon\www\jeboll\resources\views/layouts/auth.blade.php ENDPATH**/ ?>