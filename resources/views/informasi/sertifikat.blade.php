@extends('layouts.app')


@section('title','Daftar Sertifikat')



@section('content')



<section class="informasi-detail">


<div class="detail-layout">





<div class="detail-content sertifikat-content">





@if(!empty($settings['sertifikat_image']))


<img 

src="{{ asset('storage/'.$settings['sertifikat_image']) }}"

class="sertifikat-image"

alt="Daftar Sertifikat LSP UMLA"

>



@else


<img 

src="{{ asset('assets/sertifikat.jpg') }}"

class="sertifikat-image"

alt="Daftar Sertifikat LSP UMLA"

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