@extends('layouts.participant')


@section('title','Sertifikat Saya')


@section('page_title','Sertifikat Saya')



@section('content')



<div class="participant-panel">



<div class="panel-head">


<div>

<h2>

Daftar Sertifikat

</h2>


<p>

Sertifikat kompetensi yang telah diterbitkan.

</p>


</div>


</div>







<div class="certificate-grid">





@forelse($sertifikat as $item)





<div class="certificate-card">





<div class="certificate-icon">

◇

</div>







<div class="certificate-content">



<h3>

Sertifikat Kompetensi

</h3>



<p>

Nomor Sertifikat

</p>



<strong>

{{ $item->certificate_no ?? '-' }}

</strong>







<div class="certificate-info">



<div>


<span>

Skema

</span>


<b>

{{ 
$item->scheme->name ?? 
$item->assessment->schedule->scheme->name ?? 
'-'
}}

</b>


</div>






<div>


<span>

Tanggal Terbit

</span>


<b>

{{ 
$item->issued_at
?
\Carbon\Carbon::parse(
$item->issued_at
)->format('d M Y')
:
'-'
}}

</b>


</div>





</div>







@if($item->status == 'issued')

<span class="badge success">

Diterbitkan

</span>


@else


<span class="badge warning">

Menunggu

</span>


@endif







@if($item->file_path)


<br>


<a href="{{ asset('storage/'.$item->file_path) }}"
target="_blank"
class="btn btn-primary certificate-btn">


Lihat Sertifikat

</a>



@endif





</div>






</div>







@empty





<div class="empty">


<h3>

Belum Ada Sertifikat

</h3>


<p>

Sertifikat akan tersedia setelah peserta dinyatakan kompeten.

</p>


</div>






@endforelse






</div>






</div>




@endsection