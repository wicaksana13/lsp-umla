@extends('layouts.participant')


@section('title','Asesmen Saya')


@section('page_title','Asesmen Saya')



@section('content')



<div class="participant-panel">



<div class="panel-head">


<div>

<h2>

Riwayat Asesmen

</h2>


<p>

Informasi proses sertifikasi yang telah Anda ikuti.

</p>


</div>


</div>








<div class="assessment-list">



@forelse($asesmen as $item)





<div class="assessment-card">





<div class="assessment-header">



<div>


<h3>

{{ 
$item->schedule->scheme->name ?? '-'
}}

</h3>



<p>

Kode:
{{ 
$item->schedule->scheme->code ?? '-'
}}

</p>


</div>







<div>



@if($item->status == 'kompeten')


<span class="badge success">

Kompeten

</span>



@elseif($item->status == 'tidak_kompeten')


<span class="badge danger">

Tidak Kompeten

</span>



@else


<span class="badge warning">

Menunggu

</span>



@endif



</div>





</div>









<div class="assessment-info">



<div>


<b>

Tanggal

</b>


<span>

{{ 
$item->schedule->date
?
\Carbon\Carbon::parse(
$item->schedule->date
)->format('d M Y')
:
'-'
}}

</span>


</div>






<div>


<b>

TUK

</b>


<span>

{{ 
$item->schedule->tuk->name ?? '-'
}}

</span>


</div>





</div>









@if($item->units->count())



<div class="unit-summary">


<h4>

Hasil Unit Kompetensi

</h4>





<div class="table-wrap">


<table>


<thead>


<tr>


<th>

Kode

</th>


<th>

Unit Kompetensi

</th>


<th>

Hasil

</th>


</tr>


</thead>




<tbody>


@foreach($item->units as $unit)



<tr>


<td>

{{ $unit->code }}

</td>



<td>

{{ $unit->unit_name }}

</td>



<td>


@if($unit->result=='kompeten')


<span class="badge success">

Kompeten

</span>


@else


<span class="badge danger">

Tidak Kompeten

</span>


@endif



</td>


</tr>




@endforeach



</tbody>



</table>


</div>



</div>



@else



<div class="empty-small">

Unit kompetensi belum tersedia.

</div>



@endif






</div>





@empty




<div class="empty">


<h3>

Belum Ada Asesmen

</h3>


<p>

Anda belum melakukan pendaftaran asesmen.

</p>


</div>




@endforelse





</div>




</div>





@endsection