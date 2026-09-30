@extends('superadmin.layout')


@section('content')


<div class="floating-card">


<h2>
Approval Asesmen Peserta
</h2>



@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif




<table>


<thead>

<tr>

<th>
Peserta
</th>

<th>
NIM
</th>

<th>
Skema
</th>

<th>
Tanggal
</th>

<th>
Status
</th>

<th>
Aksi
</th>


</tr>

</thead>




<tbody>


@forelse($data as $item)



<tr>


<td>
{{ $item->participant->name ?? '-' }}
</td>



<td>
{{ $item->participant->nim ?? '-' }}
</td>




<td>
{{ $item->schedule->scheme->name ?? '-' }}
</td>




<td>

@if($item->schedule?->date)

{{ $item->schedule->date->format('d M Y') }}

@else

-

@endif

</td>





<td>


@if($item->status == 'menunggu')


<span class="status status-menunggu">
Menunggu
</span>



@elseif($item->status == 'berlangsung')


<span class="status status-berlangsung">
Sedang Asesmen
</span>



@elseif($item->status == 'kompeten')


<span class="status status-kompeten">
Kompeten
</span>



@elseif($item->status == 'tidak_kompeten')


<span class="status status-tidak">
Tidak Kompeten
</span>



@endif


</td>






<td>



@if($item->status == 'menunggu')


<form method="POST"
action="{{ route('superadmin.assessment.approve',$item->id) }}">


@csrf

@method('PATCH')


<button class="btn-success">

Approve

</button>


</form>





@elseif($item->status == 'berlangsung')


<a href="{{ route(
'superadmin.assessment.unit.create',
$item->id
)}}"
class="btn-primary">

Input Unit Kompetensi

</a>




@elseif($item->status == 'kompeten')



<a href="{{ route('superadmin.assessment.result',$item) }}"
class="btn-info">

Lihat Hasil

</a>



@elseif($item->status == 'tidak_kompeten')



<span class="text-danger">

Selesai

</span>




@endif



</td>





</tr>



@empty


<tr>

<td colspan="6"
style="text-align:center">

Belum ada peserta yang mendaftar asesmen.

</td>

</tr>



@endforelse



</tbody>



</table>



</div>


@endsection