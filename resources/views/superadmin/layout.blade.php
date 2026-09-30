<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Super Admin') - LSP UMLA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">
</head>
<body class="admin-body">
<div class="admin-shell">
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('superadmin.dashboard') }}" class="sidebar-brand"><span class="brand-mark small">LSP</span><div><b>Super Admin</b><small>LSP UMLA</small></div></a>
        <nav class="sidebar-nav">
            <a href="{{ route('superadmin.dashboard') }}" class="{{ request()->routeIs('superadmin.dashboard')?'active':'' }}">▦ <span>Dashboard</span></a>
            <p class="nav-label">MASTER DATA</p>
            <a href="{{ route('superadmin.skema.index') }}" class="{{ request()->routeIs('superadmin.skema.*')?'active':'' }}">◫ <span>Skema Sertifikasi</span></a>
            <a href="{{ route('superadmin.staff.index') }}" class="{{ request()->routeIs('superadmin.staff.*')?'active':'' }}">♙ <span>Admin & Asesor</span></a>
            <a href="{{ route('superadmin.tuk.index') }}" class="{{ request()->routeIs('superadmin.tuk.*')?'active':'' }}">⌂ <span>Tempat Uji (TUK)</span></a>
            <a href="{{ route('superadmin.peserta.index') }}" class="{{ request()->routeIs('superadmin.peserta.*')?'active':'' }}">♧ <span>Akun Peserta</span></a>
            <p class="nav-label">OPERASIONAL</p>
            <a href="{{ route('superadmin.pendaftaran.index') }}" class="{{ request()->routeIs('superadmin.pendaftaran.*')?'active':'' }}">✓ <span>Approval Pendaftaran</span></a>
            <a href="{{ route('superadmin.assessment.index') }}" 
class="{{ request()->routeIs('superadmin.assessment.*')?'active':'' }}">
✓ <span>Approval Asesmen</span>
</a>
            <a href="{{ route('superadmin.jadwal.index') }}" class="{{ request()->routeIs('superadmin.jadwal.*')?'active':'' }}">▣ <span>Jadwal Sertifikasi</span></a>
            <a href="{{ route('superadmin.sertifikat.index') }}" class="{{ request()->routeIs('superadmin.sertifikat.*')?'active':'' }}">◇ <span>Sertifikat</span></a>
            <p class="nav-label">WEBSITE</p>
            <a href="{{ route('superadmin.pengumuman.index') }}" class="{{ request()->routeIs('superadmin.pengumuman.*')?'active':'' }}">◉ <span>Pengumuman/Berita</span></a>
            <a href="{{ route('superadmin.organisasi.index') }}" class="{{ request()->routeIs('superadmin.organisasi.*')?'active':'' }}">♢ <span>Struktur Organisasi</span></a>
            <a href="{{ route('superadmin.konten.edit') }}" class="{{ request()->routeIs('superadmin.konten.*')?'active':'' }}">⚙ <span>Konten Website</span></a>
        </nav>
    </aside>

    <div class="admin-main">
        <header class="topbar">
            <button class="menu-toggle" type="button" onclick="document.getElementById('sidebar').classList.toggle('show')">☰</button>
            <div class="topbar-title"><span>@yield('page_kicker','SUPER ADMIN')</span><b>@yield('page_title','Dashboard')</b></div>
            <div class="topbar-user"><div class="avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div><div><b>{{ auth()->user()->name }}</b><small>Super Admin</small></div><form action="{{ route('superadmin.logout') }}" method="POST">@csrf<button class="link-button">Keluar</button></form></div>
        </header>
        <main class="content">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="alert alert-danger"><b>Periksa kembali data:</b><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
