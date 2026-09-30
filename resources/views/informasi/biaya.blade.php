@extends('layouts.app')


@section('title','Biaya Sertifikasi')



@section('content')



<section class="informasi-detail">



<div class="detail-layout">





<!-- KONTEN KIRI -->

<div class="detail-content">



<h1>
Biaya
</h1>





<p>

Struktur biaya sertifikasi mencakup biaya asesmen, administrasi dan penerbitan sertifikat.

Biaya sertifikasi khusus Mahasiswa UMLA sebesar


<span class="harga">

{{ $settings['certification_fee'] ?? 'Belum tersedia' }}

</span>


</p>




</div>









<!-- SIDEBAR -->

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