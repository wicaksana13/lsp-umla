@extends('layouts.participant')


@section('title','Unit Kompetensi')


@section('page_title','Unit Kompetensi')



@section('content')



<div class="participant-panel">





<div class="panel-head">


<div>

<h2>

Daftar Unit Kompetensi

</h2>


<p>

Daftar unit kompetensi hasil asesmen Anda.

</p>


</div>


</div>









<div class="table-wrap">



<table>



<thead>

<tr>


<th>

No

</th>


<th>

Kode Unit

</th>



<th>

Nama Unit Kompetensi

</th>



<th>

Hasil

</th>



</tr>


</thead>








<tbody>



@forelse($units as $unit)



<tr>



<td>

{{ $loop->iteration }}

</td>





<td>


<b>

{{ $unit->code }}

</b>


</td>





<td>


{{ $unit->unit_name }}


</td>





<td>




@if($unit->result == 'kompeten')



<span class="badge success">

Kompeten

</span>




@elseif($unit->result == 'tidak_kompeten')



<span class="badge danger">

Tidak Kompeten

</span>




@else



<span class="badge warning">

Belum Dinilai

</span>



@endif





</td>





</tr>





@empty



<tr>


<td colspan="4">


<div class="empty">


<h3>

Belum Ada Unit Kompetensi

</h3>



<p>

Unit kompetensi akan muncul setelah proses asesmen dilakukan.

</p>


</div>



</td>


</tr>




@endforelse





</tbody>



</table>





</div>






</div>




@endsection