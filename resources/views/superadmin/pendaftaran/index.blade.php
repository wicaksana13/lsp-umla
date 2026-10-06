@extends('superadmin.layout') 
@section('title','Approval Pendaftaran') 
@section('page_title','Approval Pendaftaran Peserta')

@section('content')
<div class="toolbar">
    <form method="GET">
        <select name="status" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            @foreach(['pending'=>'Pending','approved'=>'Disetujui','rejected'=>'Ditolak'] as $k=>$v)
                <option value="{{ $k }}" @selected(request('status')===$k)>{{ $v }}</option>
            @endforeach
        </select>
    </form>
</div>

<section class="panel">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>NIM / Peserta</th>
                    <th>Tgl Lahir & Kontak</th> <!-- Menggantikan kolom Skema -->
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th class="actions">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>
                        <b>{{ $item->nim }} · {{ $item->name }}</b>
                        <br>
                        <small>{{ $item->email }}</small>
                    </td>
                    
                    <!-- Menampilkan Tanggal Lahir dan No. HP sebagai pengganti Skema -->
                    <td>
                        {{ $item->birth_date ? \Carbon\Carbon::parse($item->birth_date)->format('d M Y') : '-' }}
                        <br>
                        <small>{{ $item->phone ?? '-' }}</small>
                    </td>
                    
                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                    
                    <td>
                        <span class="badge {{ $item->status==='approved'?'success':($item->status==='rejected'?'danger':'warning') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    
                    <td class="actions">
                        @if($item->status==='pending')
                            <form method="POST" action="{{ route('superadmin.pendaftaran.approve',$item) }}" style="display:inline-block;">
                                @csrf 
                                @method('PATCH')
                                <button class="success-action" onclick="return confirm('Setujui pendaftaran dan buat akun peserta?')">ACC</button>
                            </form>
                            <form method="POST" action="{{ route('superadmin.pendaftaran.reject',$item) }}" style="display:inline-block;">
                                @csrf 
                                @method('PATCH')
                                <input type="hidden" name="rejection_note" value="Pendaftaran belum memenuhi persyaratan.">
                                <button onclick="return confirm('Tolak pendaftaran ini?')">Tolak</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty">Belum ada pendaftaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $items->links() }}
</section>
@endsection