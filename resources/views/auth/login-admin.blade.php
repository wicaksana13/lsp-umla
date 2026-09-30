<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Super Admin - LSP UMLA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">
</head>
<body class="auth-page">
<div class="auth-shell">
    <section class="auth-brand">
        <div class="brand-mark">LSP</div>
        <span class="eyebrow">LSP UMLA MANAGEMENT</span>
        <h1>Kelola layanan sertifikasi dari satu dashboard.</h1>
        <p>Portal khusus Super Admin untuk mengatur skema, asesor, TUK, peserta, jadwal, sertifikat, dan konten website.</p>
        <div class="auth-points">
            <span>✓ Data terpusat</span><span>✓ Hak akses terpisah</span><span>✓ Siap untuk approval peserta</span>
        </div>
    </section>

    <section class="auth-card">
        <div class="mobile-brand">LSP UMLA</div>
        <p class="eyebrow">SUPER ADMIN</p>
        <h2>Masuk ke Dashboard</h2>
        <p class="muted">Gunakan akun Super Admin LSP UMLA.</p>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('superadmin.login.store') }}" class="form-stack">
            @csrf
            <label>Email
                <input type="email" name="email" value="{{ old('email') }}" placeholder="superadmin@lspumla.id" required autofocus>
            </label>
            <label>Password
                <input type="password" name="password" placeholder="••••••••" required>
            </label>
            <label class="check-line"><input type="checkbox" name="remember" value="1"> Ingat saya</label>
            <button class="btn btn-primary btn-block" type="submit">Masuk sebagai Super Admin →</button>
        </form>
        <p class="auth-help">Halaman ini terpisah dari login peserta/asesor di <strong>/login</strong>.</p>
    </section>
</div>
</body>
</html>
