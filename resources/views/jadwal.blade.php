@extends('layouts.app')


@section('title','Jadwal LSP UMLA')



@section('content')



<!-- HERO -->

<section class="page-hero">


<img
src="{{ asset('assets/gedung.png') }}"
alt="Gedung Universitas Muhammadiyah Lamongan"
class="page-hero__image"
>



<div class="page-hero__content">


<div class="page-hero__badge">
Jadwal
</div>



<h1 class="page-hero__title">

LEMBAGA<br>
SERTIFIKASI<br>
PROFESI

</h1>



<p class="page-hero__subtitle">

Universitas Muhammadiyah<br>
Lamongan

</p>



</div>


</section>









<!-- FILTER -->


<section class="floating-card filter-card">



<h3>
Filter
</h3>





<form method="GET" action="{{ route('jadwal') }}">



<div class="filter-box">





<div class="filter-item">


<select name="scheme">

<option value="">
Pilih Skema
</option>



@foreach($schemes as $scheme)

<option value="{{ $scheme->id }}"
@if(request('scheme')==$scheme->id)
selected
@endif
>

{{ $scheme->name }}

</option>


@endforeach


</select>



</div>







<div class="filter-item">


<input
type="date"
name="date"
value="{{ request('date') }}"
>


</div>







<div class="filter-item">


<select name="tuk">


<option value="">
Pilih Tempat Uji
</option>



@foreach($tuks as $tuk)


<option value="{{ $tuk->id }}"
@if(request('tuk')==$tuk->id)
selected
@endif
>

{{ $tuk->name }}

</option>



@endforeach


</select>


</div>






</div>






<div class="filter-button">


<button type="submit">
Cari
</button>



<a href="{{ route('jadwal') }}"
class="reset">

Reset

</a>



</div>





</form>



</section>









<!-- LIST JADWAL -->


<section class="jadwal-list">





@forelse($jadwal as $item)





<div class="jadwal-card">





<div class="jadwal-image">

</div>







<h3>

{{ $item->title }}

</h3>





<p>

{{ $item->scheme->name ?? '-' }}

</p>







<div class="detail">



<p>

▣ &nbsp;

{{ $item->date->format('d M Y') }}

</p>





@if($item->tuk)


<p>

⌾ &nbsp;

{{ $item->tuk->name }}

</p>


@endif



</div>







<div class="bottom">





<span class="status">


{{ ucfirst($item->mode) }}


</span>






<span>


@php

$hari = now()->diffInDays(
    $item->date,
    false
);

@endphp



@if($hari > 0)

{{ $hari }} Hari Lagi


@elseif($hari == 0)

Hari Ini


@else

Selesai


@endif



</span>





</div>







</div>







@empty





<div class="jadwal-card">


<h3>

Belum Ada Jadwal Sertifikasi

</h3>


<p>

Jadwal sertifikasi akan ditampilkan setelah tersedia.

</p>


</div>





@endforelse





</section>





@endsection