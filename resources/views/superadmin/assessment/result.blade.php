@extends('superadmin.layout')


@section('title','Hasil Asesmen')

@section('page_title','Hasil Asesmen')



@section('content')


<section class="panel form-card">



<div class="section-heading">

<h2>
Hasil Asesmen Peserta
</h2>

<p>
Detail hasil evaluasi sertifikasi peserta.
</p>

</div>







<div class="detail-grid">



<div>

<b>
Nama Peserta
</b>

<span>
{{ $assessment->participant->name ?? '-' }}
</span>

</div>





<div>

<b>
NIM
</b>

<span>
{{ $assessment->participant->nim ?? '-' }}
</span>

</div>





<div>

<b>
Skema Sertifikasi
</b>

<span>
{{ $assessment->schedule->scheme->name ?? '-' }}
</span>

</div>





<div>

<b>
Tanggal Asesmen
</b>

<span>

{{ 
$assessment->schedule?->date
?
$assessment->schedule->date->format('d M Y')
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
{{ $assessment->schedule->tuk->name ?? '-' }}
</span>

</div>







<div>

<b>
Status Akhir
</b>


<span class="badge 
@if($assessment->status=='kompeten')
success

@else
danger

@endif
">


{{ 
str_replace('_',' ',
ucfirst($assessment->status))
}}


</span>


</div>





</div>









<h3 class="result-title">

Hasil Unit Kompetensi

</h3>






<div class="table-wrap">


<table>


<thead>

<tr>

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


@forelse($assessment->units as $unit)


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


@empty


<tr>

<td colspan="3"
class="empty">

Belum ada hasil unit kompetensi.

</td>

</tr>


@endforelse



</tbody>



</table>


</div>







<a href="{{ route('superadmin.assessment.index') }}"
class="btn btn-outline">

Kembali

</a>



</section>


@endsection