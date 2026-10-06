@extends('layouts.participant')


@section('title','Daftar Asesmen')


@section('page_title','Daftar Asesmen')



@section('content')



<div class="participant-panel">



<div class="panel-head">


<div>

<h2>

Jadwal Sertifikasi Terbuka

</h2>


<p>

Pilih jadwal asesmen yang tersedia.

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

Skema Sertifikasi

</th>




<th>

Tanggal

</th>




<th>

Tempat Uji Kompetensi

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



@forelse($jadwal as $item)



<tr>



<td>

{{ $loop->iteration }}

</td>







<td>


<b>

{{ $item->scheme->name ?? '-' }}

</b>


<small>

{{ $item->scheme->code ?? '' }}

</small>


</td>







<td>


{{ 
\Carbon\Carbon::parse($item->date)
->format('d M Y')
}}


</td>








<td>


{{ $item->tuk->name ?? '-' }}


</td>







<td>


<span class="badge info">


Terbuka


</span>


</td>







<td class="actions">

    @if(in_array($item->id, $sudahDaftar))
        <span class="badge muted">
            Sudah Daftar
        </span>
    @else
        <!-- Gunakan satu form GET yang bersih -->
        <form method="GET" action="{{ route('peserta.register.form', $item->id) }}">
            <button class="btn btn-primary">Daftar</button>
        </form>
    @endif

</td>





</tr>





@empty



<tr>


<td colspan="6">


<div class="empty">


<h3>

Belum Ada Jadwal Asesmen

</h3>



<p>

Jadwal sertifikasi belum tersedia.

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