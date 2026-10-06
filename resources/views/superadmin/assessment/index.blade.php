@extends('superadmin.layout')

@section('content')
<div class="floating-card">
    <h2>Approval Asesmen Peserta</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Peserta</th>
                <th>NIM</th>
                <th>Skema</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $item->participant->name ?? '-' }}</td>
                <td>{{ $item->participant->nim ?? '-' }}</td>
                <td>{{ $item->schedule->scheme->name ?? '-' }}</td>
                <td>
                    @if($item->schedule?->date)
                        {{ \Carbon\Carbon::parse($item->schedule->date)->format('d M Y') }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($item->status == 'menunggu')
                        <span class="status status-menunggu">Menunggu</span>
                    @elseif($item->status == 'approved')
                        <span class="status status-approved" style="background:#dbeafe; color:#1e40af; padding:4px 8px; border-radius:4px;">Approved</span>
                    @elseif($item->status == 'kompeten')
                        <span class="status status-kompeten">Kompeten</span>
                    @elseif($item->status == 'tidak_kompeten')
                        <span class="status status-tidak">Tidak Kompeten</span>
                        @elseif($item->status == 'revisi')
    <span class="status status-revisi" style="background:#fef3c7; color:#d97706; padding:4px 8px; border-radius:4px;">Revisi</span>
                    @endif
                </td>
                <td>
    @if($item->status == 'menunggu' || $item->status == 'revisi')
        <!-- Tombol Menuju Halaman Detail untuk ACC / Revisi -->
        <a href="{{ route('superadmin.assessment.show', $item->id) }}" class="btn-primary" style="padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block;">
            ACC/REVISI
        </a>
    @else
        <!-- Setelah di-approve atau dinilai asesor -->
        <a href="{{ route('superadmin.assessment.result', $item->id) }}" class="btn-info" style="padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block;">
            Lihat Hasil
        </a>
    @endif
</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center">Belum ada peserta yang mendaftar asesmen.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection