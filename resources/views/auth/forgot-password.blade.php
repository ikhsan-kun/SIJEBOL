<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | SI JEBOL</title>
    <meta name="description" content="Verifikasi akun untuk mengatur ulang password SI JEBOL Anda.">
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
                    <h2>Lupa Password</h2>
                    <p>Masukkan NIK dan Email yang terdaftar untuk verifikasi kepemilikan akun.</p>
                </div>

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.verify') }}" method="POST" class="auth-form">
                    @csrf

                    <div class="form-group">
                        <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                        <div class="input-with-icon">
                            <i data-lucide="credit-card" class="input-icon"></i>
                            <input id="nik" type="text" name="nik" value="{{ old('nik') }}" placeholder="Masukkan 16 digit NIK Anda" class="form-input {{ $errors->has('nik') ? 'input-error' : '' }}">
                        </div>
                        @error('nik')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <div class="input-with-icon">
                            <i data-lucide="mail" class="input-icon"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" class="form-input {{ $errors->has('email') ? 'input-error' : '' }}">
                        </div>
                        @error('email')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top: 20px;">
                        <span>Verifikasi Akun</span>
                        <i data-lucide="shield-check" style="width: 18px; height: 18px; margin-left: 10px;"></i>
                    </button>

                    <div class="form-footer" style="text-align: center; margin-top: 15px;">
                        <a href="{{ route('login') }}" class="text-link"><i data-lucide="arrow-left" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i> Kembali ke Login</a>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

