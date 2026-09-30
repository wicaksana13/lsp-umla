@extends('layouts.app')


@section('title','Daftar Asesor')



@section('content')



<section class="informasi-detail">


<div class="detail-layout">





<div class="detail-content asesor-content">



<h1>

DAFTAR ASESOR KOMPETENSI DI LEMBAGA SERTIFIKASI PROFESI (LSP)
UNIVERSITAS MUHAMMADIYAH LAMONGAN

</h1>





@if(!empty($settings['asesor_image']))


<img 

src="{{ asset('storage/'.$settings['asesor_image']) }}"

class="asesor-image"

alt="Daftar Asesor Kompetensi LSP UMLA"

>



@else


<img 

src="{{ asset('assets/asesor.jpg') }}"

class="asesor-image"

alt="Daftar Asesor Kompetensi LSP UMLA"

>



@endif






</div>







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