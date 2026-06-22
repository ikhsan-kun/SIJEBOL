<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru | SI JEBOL</title>
    <meta name="description" content="Atur ulang password akun SI JEBOL Anda.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #003178 !important;
            background-image: linear-gradient(rgba(0, 49, 120, 0.92), rgba(0, 49, 120, 0.85)), url('{{ asset('images/batik-tegal-premium.jpg') }}') !important;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }
        .auth-card {
            background: white;
            border-radius: 20px;
            padding: 40px 36px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
        }
        .auth-page {
            background: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: auto;
        }
        .auth-shell {
            width: 100%;
            max-width: 100%;
            box-shadow: none !important;
            border: none !important;
            background: transparent !important;
        }
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
                        <img src="{{ asset('images/logo-tegal.png') }}" alt="Logo Kota Tegal">
                        <div class="form-logo-text">
                            <span class="brand">SI JEBOL</span>
                            <span class="tagline">Kota Tegal</span>
                        </div>
                    </div>
                    <h2>Buat Password Baru</h2>
                    <p>Akun terverifikasi untuk <strong>{{ $email }}</strong>. Silakan masukkan password baru yang kuat.</p>
                </div>

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <div class="input-with-icon" style="position: relative;">
                            <i data-lucide="lock" class="input-icon"></i>
                            <input id="password" type="password" name="password" placeholder="Minimal 4 karakter" class="form-input {{ $errors->has('password') ? 'input-error' : '' }}" style="padding-right: 48px;">
                            <button type="button" onclick="togglePasswordVisibility('password', this)" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: transparent; border: none; cursor: pointer; color: #64748b; outline: none; display: flex; align-items: center; justify-content: center; padding: 0;">
                                <i data-lucide="eye" style="width: 20px; height: 20px;"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <div class="input-with-icon" style="position: relative;">
                            <i data-lucide="lock" class="input-icon"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ketik ulang password baru" class="form-input" style="padding-right: 48px;">
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: transparent; border: none; cursor: pointer; color: #64748b; outline: none; display: flex; align-items: center; justify-content: center; padding: 0;">
                                <i data-lucide="eye" style="width: 20px; height: 20px;"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top: 20px;">
                        <span>Simpan Password</span>
                        <i data-lucide="save" style="width: 18px; height: 18px; margin-left: 10px;"></i>
                    </button>
                    
                    <div class="form-footer" style="text-align: center; margin-top: 15px;">
                        <a href="{{ route('login') }}" class="text-link"><i data-lucide="x" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i> Batalkan</a>
                    </div>
                </form>
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

