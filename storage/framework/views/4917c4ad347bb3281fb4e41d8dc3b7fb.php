<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | SI JEBOL</title>
    <meta name="description" content="Masuk ke layanan SI JEBOL menggunakan NIK dan kata sandi Anda.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #003178;
            background-image: linear-gradient(rgba(0, 49, 120, 0.92), rgba(0, 49, 120, 0.85)), url('<?php echo e(asset('images/batik-tegal-premium.jpg')); ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 40px 36px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
        }

        /* Brand */
        .brand-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 24px;
        }
        .brand-logo-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            border: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            overflow: hidden;
            margin-bottom: 10px;
        }
        .brand-logo-circle img {
            width: 52px;
            height: 52px;
            object-fit: contain;
        }
        .brand-name {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.5px;
        }
        .brand-sub {
            font-size: 0.7rem;
            font-weight: 600;
            color: #94a3b8;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* Heading */
        .login-heading {
            text-align: center;
            margin-bottom: 24px;
        }
        .login-heading h1 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
        }
        .login-heading p {
            font-size: 0.85rem;
            color: #64748b;
            line-height: 1.5;
        }

        /* Form Fields */
        .field-group { margin-bottom: 18px; }
        .field-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }
        .input-wrap {
            display: flex;
            align-items: center;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            background: white;
            overflow: hidden;
            transition: border-color 0.2s;
        }
        .input-wrap:focus-within {
            border-color: #003178;
            box-shadow: 0 0 0 3px rgba(0,49,120,0.08);
        }
        .input-icon-box {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 14px;
            color: #94a3b8;
        }
        .input-icon-box svg { width: 18px; height: 18px; }
        .field-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 13px 12px 13px 0;
            font-size: 0.9rem;
            color: #1e293b;
            background: transparent;
            font-family: 'Inter', sans-serif;
        }
        .field-input::placeholder { color: #94a3b8; }
        .toggle-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0 14px;
            color: #94a3b8;
            display: flex;
            align-items: center;
        }
        .toggle-btn svg { width: 18px; height: 18px; }

        /* Forgot password */
        .forgot-link {
            text-align: right;
            margin-top: -10px;
            margin-bottom: 20px;
        }
        .forgot-link a {
            font-size: 0.8rem;
            color: #003178;
            font-weight: 600;
            text-decoration: none;
        }
        .forgot-link a:hover { text-decoration: underline; }

        /* Submit */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background 0.2s;
            font-family: 'Inter', sans-serif;
            margin-bottom: 16px;
        }
        .btn-login:hover { background: #003178; }
        .btn-login svg { width: 18px; height: 18px; }

        /* Footer */
        .register-link {
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
        }
        .register-link a {
            color: #003178;
            font-weight: 700;
            text-decoration: none;
        }
        .register-link a:hover { text-decoration: underline; }

        /* Alerts */
        .alert-success {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 8px;
            padding: 12px 16px;
            color: #16a34a;
            font-size: 0.85rem;
            margin-bottom: 18px;
        }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            padding: 12px 16px;
            color: #dc2626;
            font-size: 0.85rem;
            margin-bottom: 18px;
        }
        .ferr {
            font-size: 0.75rem;
            color: #dc2626;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<div class="login-card">

    
    <div class="brand-top">
        <div class="brand-logo-circle">
            <img src="<?php echo e(asset('images/logo-tegal.png')); ?>" alt="Logo Kota Tegal">
        </div>
        <div class="brand-name">SI JEBOL</div>
        <div class="brand-sub">Kota Tegal</div>
    </div>

    
    <div class="login-heading">
        <h1>Selamat Datang Kembali</h1>
        <p>Silakan masuk untuk mengakses layanan kependudukan Anda.</p>
    </div>

    
    <?php if(session('status')): ?>
        <div class="alert-success"><?php echo e(session('status')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert-error"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('login')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        
        <div class="field-group">
            <label class="field-label">NIK (Nomor Induk Kependudukan)</label>
            <div class="input-wrap">
                <span class="input-icon-box"><i data-lucide="user"></i></span>
                <input class="field-input" id="nik" type="text" name="nik"
                    value="<?php echo e(old('nik')); ?>"
                    placeholder="Masukkan 16 digit NIK Anda"
                    required maxlength="16"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">
            </div>
            <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="ferr"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="field-group">
            <label class="field-label">Password</label>
            <div class="input-wrap">
                <span class="input-icon-box"><i data-lucide="lock"></i></span>
                <input class="field-input" id="password" type="password" name="password"
                    placeholder="Masukkan password" required style="padding-right: 0;">
                <button type="button" class="toggle-btn" onclick="togglePw('password', this)">
                    <i data-lucide="eye"></i>
                </button>
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="ferr"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="forgot-link">
            <a href="/password/reset">Lupa Password?</a>
        </div>

        
        <button type="submit" class="btn-login">
            Masuk Sekarang
            <i data-lucide="log-in"></i>
        </button>

        <div class="register-link">
            Belum memiliki akun? <a href="<?php echo e(route('register')); ?>">Register sekarang</a>
        </div>
    </form>

</div>

<script>
    lucide.createIcons();

    function togglePw(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }
</script>
</body>
</html>
<?php /**PATH D:\laragon\www\jeboll\resources\views/auth/login.blade.php ENDPATH**/ ?>