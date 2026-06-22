@extends('layouts.auth')

@section('title', 'Masuk Admin')
@section('subtitle', 'Silakan masuk ke akun Admin Anda.')

@section('content')
@if($errors->any())
    <div class="alert alert-error">
        {{ $errors->first() }}
    </div>
@endif
<form action="{{ route('admin.login.post') }}" method="POST" class="auth-form">
    @csrf
    <div class="form-group">
        <label for="nik">NIK</label>
        <div class="input-with-icon">
            <i data-lucide="user" class="input-icon"></i>
            <input id="nik" type="text" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK Admin" class="form-input {{ $errors->has('nik') ? 'input-error' : '' }}" required maxlength="16" pattern="[0-9]{16}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-with-icon" style="position: relative;">
            <i data-lucide="lock" class="input-icon"></i>
            <input id="password" type="password" name="password" placeholder="Masukkan password" class="form-input {{ $errors->has('password') ? 'input-error' : '' }}" style="padding-right: 48px;" required>
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
@endsection
