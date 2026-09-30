@extends('layouts.participant')


@section('title','Dashboard Peserta')

@section('page_title','Dashboard')



@section('content')


<div class="participant-panel">



<div class="welcome-card">


<div>

<span class="eyebrow">

SELAMAT DATANG

</span>


<h1>

{{ auth()->user()->name }}

</h1>


<p>

Kelola proses sertifikasi Anda melalui dashboard peserta.

</p>


</div>



</div>





</div>







<div class="stats-grid">



<div class="stat-card">


<div class="stat-icon">

✓

</div>


<div>

<strong>

{{ $jumlahAsesmen ?? 0 }}

</strong>


<span>

Total Asesmen

</span>


</div>


</div>







<div class="stat-card">


<div class="stat-icon">

◇

</div>


<div>

<strong>

{{ $certificate ?? 0 }}

</strong>


<span>

Sertifikat

</span>


</div>


</div>







<div class="stat-card">


<div class="stat-icon">

◷

</div>


<div>

<strong>

{{ $status->status ?? '-' }}

</strong>


<span>

Status Terakhir

</span>


</div>


</div>



</div>









<div class="participant-panel">



<div class="panel-head">


<div>

<h2>

Status Asesmen Terakhir

</h2>


</div>


</div>




@if($status)



<div class="table-wrap">


<table>


<tr>

<th>
Skema
</th>


<th>
Tanggal
</th>


<th>
Status
</th>


</tr>



<tr>


<td>

{{ 
$status->schedule->scheme->name ?? '-'
}}

</td>


<td>

{{ 
$status->schedule->date ?? '-'
}}

</td>



<td>


<span class="badge 

@if($status->status=='kompeten')
success

@elseif($status->status=='tidak_kompeten')
danger

@else
warning

@endif

">


{{ ucfirst($status->status) }}


</span>


</td>


</tr>



</table>


</div>



@else



<div class="empty">

Belum ada riwayat asesmen.

</div>



@endif




</div>



@endsection