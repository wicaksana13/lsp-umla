@extends('superadmin.layout')
@section('title','Dashboard')
@section('page_title','Dashboard')
@section('content')
<div class="welcome-card">
    <div><span class="eyebrow">PUSAT KONTROL LSP UMLA</span><h1>Selamat datang, {{ auth()->user()->name }}</h1><p>Kelola data website dan operasional sertifikasi tanpa mengubah Blade secara manual.</p></div>
    <a href="{{ route('superadmin.skema.create') }}" class="btn btn-light">+ Tambah Skema</a>
</div>
<div class="stats-grid">
    @foreach([
      ['Skema Sertifikasi',$stats['schemes'],'◫'],['Asesor',$stats['assessors'],'♙'],['TUK',$stats['tuks'],'⌂'],['Peserta',$stats['participants'],'♧'],
      ['Pemegang Sertifikat',$stats['certificates'],'◇'],['Menunggu Approval',$stats['pending'],'✓'],['Jadwal Mendatang',$stats['schedules'],'▣'],['Berita Aktif',$stats['announcements'],'◉']
    ] as [$label,$value,$icon])
      <div class="stat-card"><div class="stat-icon">{{ $icon }}</div><div><strong>{{ $value }}</strong><span>{{ $label }}</span></div></div>
    @endforeach
</div>
<div class="dashboard-grid">
  <section class="panel"><div class="panel-head"><div><h2>Pendaftaran menunggu approval</h2><p>NIM hanya dapat memiliki satu pendaftaran.</p></div><a href="{{ route('superadmin.pendaftaran.index') }}">Lihat semua →</a></div>
    <div class="table-wrap"><table><thead><tr><th>Peserta</th><th>NIM</th><th>Skema</th><th>Status</th></tr></thead><tbody>
      @forelse($pendingRegistrations as $r)<tr><td><b>{{ $r->name }}</b><small>{{ $r->email }}</small></td><td>{{ $r->nim }}</td><td>{{ $r->scheme?->name ?? '-' }}</td><td><span class="badge warning">Pending</span></td></tr>@empty<tr><td colspan="4" class="empty">Belum ada pendaftaran pending.</td></tr>@endforelse
    </tbody></table></div>
  </section>
  <section class="panel"><div class="panel-head"><div><h2>Jadwal terdekat</h2><p>Agenda uji kompetensi berikutnya.</p></div><a href="{{ route('superadmin.jadwal.index') }}">Kelola →</a></div>
    <div class="schedule-list">@forelse($upcomingSchedules as $j)<div class="schedule-row"><div class="date-box"><b>{{ $j->date->format('d') }}</b><span>{{ strtoupper($j->date->format('M')) }}</span></div><div><b>{{ $j->title }}</b><small>{{ $j->scheme?->name }} · {{ $j->tuk?->name ?? 'TUK belum dipilih' }}</small></div></div>@empty<p class="empty">Belum ada jadwal mendatang.</p>@endforelse</div>
  </section>
</div>
@endsection
