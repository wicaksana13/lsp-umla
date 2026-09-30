@extends('superadmin.layout')

@section('title','Sertifikat')

@section('page_title','Sertifikat Peserta')


@section('content')


<div class="toolbar">

    <span>
        Data ini sekaligus menjadi sumber jumlah 
        <b>Pemegang Sertifikat</b> di beranda.
    </span>


    <a class="btn btn-primary"
       href="{{ route('superadmin.sertifikat.create') }}">
        + Kirim Sertifikat
    </a>

</div>





<section class="panel">


<div class="table-wrap">


<table>


<thead>

<tr>

<th>
No. Sertifikat
</th>

<th>
Peserta
</th>

<th>
Skema
</th>

<th>
Terbit
</th>

<th>
Status
</th>

<th class="actions">
Aksi
</th>

</tr>

</thead>





<tbody>


@forelse($items as $item)



<tr>


<td>

<b>
{{ $item->certificate_no }}
</b>

</td>





<td>

{{ $item->participant?->name }}

<small>
{{ $item->participant?->nim }}
</small>

</td>





<td>

{{ $item->scheme?->name }}

</td>





<td>

{{ $item->issued_at 
? $item->issued_at->format('d M Y')
: '-'
}}

</td>





<td>


<span class="badge 
{{ $item->status==='issued'
?'success'
:'muted'
}}">


{{ ucfirst($item->status) }}


</span>


</td>







<td class="actions">


<a href="{{ route('superadmin.sertifikat.show',$item) }}"
class="action-view">

Lihat

</a>





<a href="{{ route('superadmin.sertifikat.edit',$item) }}">

Edit

</a>





<form method="POST"
action="{{ route('superadmin.sertifikat.destroy',$item) }}">


@csrf

@method('DELETE')


<button type="submit"
onclick="return confirm('Hapus sertifikat ini?')">

Hapus

</button>


</form>



</td>




</tr>



@empty



<tr>

<td colspan="6"
class="empty">

Belum ada sertifikat.

</td>

</tr>



@endforelse



</tbody>


</table>


</div>



{{ $items->links() }}



</section>


@endsection