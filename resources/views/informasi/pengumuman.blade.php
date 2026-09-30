@extends('layouts.app')


@section('title','Pengumuman & Berita')



@section('content')



<section class="informasi-page">



<div class="informasi-header">


<h1>
Pengumuman dan Berita
</h1>



<div class="search-box">


<input type="text" placeholder="Cari Berita">


<span>
⌕
</span>


</div>


</div>




<div class="informasi-grid">


@forelse($berita as $item)



<div class="informasi-card">


@if($item->image_path)

<img 
src="{{ asset('storage/'.$item->image_path) }}"
alt="{{ $item->title }}"
>


@else


<img 
src="{{ asset('assets/berita.jpeg') }}"
alt="Berita LSP UMLA"
>


@endif




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



<div class="informasi-card">


<h3>
Belum Ada Pengumuman
</h3>


<p>
Informasi terbaru LSP UMLA akan tampil di halaman ini.
</p>


</div>



@endforelse



</div>



</div>




</section>



@endsection