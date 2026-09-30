@extends('layouts.app')


@section('title','Daftar TUK')



@section('content')



<section class="informasi-detail">



<div class="detail-layout">







<!-- =========================
     KONTEN KIRI
========================= -->


<div class="detail-content tuk-content">





<h1>

DAFTAR TUK LEMBAGA SERTIFIKASI PROFESI (LSP)

<br>

UNIVERSITAS MUHAMMADIYAH LAMONGAN

</h1>









@if(!empty($settings['tuk_image']))



<img 

src="{{ asset('storage/'.$settings['tuk_image']) }}"

class="tuk-image"

alt="Daftar TUK LSP UMLA"

>





@else





<img 

src="{{ asset('assets/tuk.png') }}"

class="tuk-image"

alt="Daftar TUK LSP UMLA"

>





@endif







</div>













<!-- =========================
     SIDEBAR BERITA
========================= -->


<div class="detail-sidebar">






<a href="{{ route('pengumuman') }}" 
class="sidebar-button">

Pengumuman/Berita →

</a>









@forelse($berita as $item)





<div class="sidebar-news">





<h3>

{{ $item->title }}

</h3>







<span>

{{ $item->published_at 
? $item->published_at->format('d F Y')
: '-'
}}

</span>







<p>

{{ $item->excerpt }}

</p>







<a href="{{ route('pengumuman.detail',$item->id) }}">

Selengkapnya →

</a>






</div>







@empty






<div class="sidebar-news">



<h3>

Belum Ada Berita

</h3>



<p>

Informasi terbaru belum tersedia.

</p>



</div>







@endforelse







</div>









</div>





</section>





@endsection