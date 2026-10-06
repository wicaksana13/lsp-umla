@extends('superadmin.layout')

@section('title', 'Dashboard Asesor')
@section('page_title', 'Dashboard Asesor')

@section('content')
<div class="welcome-card" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); color: white; padding: 30px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <span class="eyebrow" style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.8;">PANEL ASESOR LSP UMLA</span>
        <h1 style="margin: 5px 0 10px 0; font-size: 24px;">Selamat datang, {{ auth()->user()->name }}</h1>
        <p style="margin: 0; opacity: 0.9; font-size: 14px;">Kelola penilaian unit kompetensi peserta uji sertifikasi dengan mudah dan cepat.</p>
    </div>
</div>

<div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 25px;">
    <div class="stat-card" style="background: white; padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div class="stat-icon" style="font-size: 24px; background: #e0e7ff; color: #3730a3; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 10px;">✓</div>
        <div>
            <strong style="font-size: 20px; display: block; color: #1e293b;">{{ $stats['pending_approval'] }}</strong>
            <span style="color: #64748b; font-size: 13px;">Siap Dinilai</span>
        </div>
    </div>

    <div class="stat-card" style="background: white; padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div class="stat-icon" style="font-size: 24px; background: #dcfce7; color: #166534; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 10px;">★</div>
        <div>
            <strong style="font-size: 20px; display: block; color: #1e293b;">{{ $stats['completed'] }}</strong>
            <span style="color: #64748b; font-size: 13px;">Asesmen Selesai</span>
        </div>
    </div>

    <div class="stat-card" style="background: white; padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div class="stat-icon" style="font-size: 24px; background: #fef3c7; color: #d97706; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 10px;">▣</div>
        <div>
            <strong style="font-size: 20px; display: block; color: #1e293b;">{{ $stats['schedules'] }}</strong>
            <span style="color: #64748b; font-size: 13px;">Jadwal Aktif</span>
        </div>
    </div>
</div>

<div class="dashboard-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
  
  <!-- Tabel Asesmen yang Siap Dinilai -->
  <section class="panel" style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <div class="panel-head" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <div>
            <h2 style="margin: 0; font-size: 16px; color: #1e293b;">Asesmen Menunggu Penilaian</h2>
            <p style="margin: 0; font-size: 13px; color: #64748b;">Peserta yang pendaftarannya telah disetujui admin dan siap diinput unit kompetensinya.</p>
        </div>
        <a href="{{ route('superadmin.assessment.index') }}" style="color: #2563eb; text-decoration: none; font-size: 13px; font-weight: 500;">Lihat semua →</a>
    </div>

    <div class="table-wrap">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc; text-align: left;">
                    <th style="padding: 10px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">Peserta</th>
                    <th style="padding: 10px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">NIM</th>
                    <th style="padding: 10px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">Skema</th>
                    <th style="padding: 10px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingAssessments as $item)
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">
                        <b>{{ $item->participant->name ?? '-' }}</b><br>
                        <small style="color: #64748b;">{{ $item->participant->email ?? '-' }}</small>
                    </td>
                    <td style="padding: 10px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">{{ $item->participant->nim ?? '-' }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">{{ $item->schedule->scheme->name ?? '-' }}</td>
                    <td style="padding: 10px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">
                        <a href="{{ route('superadmin.assessment.unit.create', $item->id) }}" class="btn-primary" style="padding: 5px 10px; background: #2563eb; color: white; border-radius: 4px; text-decoration: none; font-size: 12px;">Input Nilai</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty" style="text-align: center; padding: 20px; color: #64748b; font-size: 13px;">Belum ada asesmen yang menunggu penilaian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
  </section>


</div>
@endsection