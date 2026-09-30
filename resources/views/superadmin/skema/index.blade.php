@extends('superadmin.layout')
@section('title','Skema Sertifikasi') @section('page_title','Skema Sertifikasi')
@section('content')
@include('superadmin.partials.searchbar',['createUrl'=>route('superadmin.skema.create')])
<section class="panel"><div class="table-wrap"><table><thead><tr><th>Kode</th><th>Nama Skema</th><th>Status</th><th class="actions">Aksi</th></tr></thead><tbody>
@forelse($items as $item)<tr><td><b>{{ $item->code }}</b></td><td><b>{{ $item->name }}</b><small>{{ Str::limit($item->description,80) }}</small></td><td><span class="badge {{ $item->is_active?'success':'muted' }}">{{ $item->is_active?'Aktif':'Nonaktif' }}</span></td><td class="actions"><a href="{{ route('superadmin.skema.edit',$item) }}">Edit</a><form method="POST" action="{{ route('superadmin.skema.destroy',$item) }}" onsubmit="return confirm('Hapus skema ini?')">@csrf @method('DELETE')<button>Hapus</button></form></td></tr>@empty<tr><td colspan="4" class="empty">Belum ada skema.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $items->links() }}</div></section>
@endsection
