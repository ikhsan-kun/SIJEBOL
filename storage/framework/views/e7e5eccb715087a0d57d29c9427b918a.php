

<?php $__env->startSection('title', 'Masuk Admin'); ?>
<?php $__env->startSection('subtitle', 'Silakan masuk ke akun Admin Anda.'); ?>

<?php $__env->startSection('content'); ?>
<?php if($errors->any()): ?>
    <div class="alert alert-error">
        <?php echo e($errors->first()); ?>

    </div>
<?php endif; ?>
<form action="<?php echo e(route('admin.login.post')); ?>" method="POST" class="auth-form">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="nik">NIK</label>
        <div class="input-with-icon">
            <i data-lucide="user" class="input-icon"></i>
            <input id="nik" type="text" name="nik" value="<?php echo e(old('nik')); ?>" placeholder="Masukkan NIK Admin" class="form-input <?php echo e($errors->has('nik') ? 'input-error' : ''); ?>" required maxlength="16" pattern="[0-9]{16}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-with-icon" style="position: relative;">
            <i data-lucide="lock" class="input-icon"></i>
            <input id="password" type="password" name="password" placeholder="Masukkan password" class="form-input <?php echo e($errors->has('password') ? 'input-error' : ''); ?>" style="padding-right: 48px;" required>
            <button type="button" onclick="togglePasswordVisibility('password', this)" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: transparent; border: none; cursor: pointer; color: #64748b; outline: none; display: flex; align-items: center; justify-content: center; padding: 0;">
                <i data-lucide="eye" style="width: 20px; height: 20px;"></i>
            </button>
        </div>
    </div>
    <div class="form-footer">
        <a href="/password/reset" class="text-link">Lupa Password?</a>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg">
        <span>Masuk Sekarang</span>
        <i data-lucide="log-in" style="width: 18px; height: 18px; margin-left: 10px;"></i>
    </button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/admin/login.blade.php ENDPATH**/ ?>