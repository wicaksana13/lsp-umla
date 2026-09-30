@extends('layouts.app')


@section('title',$announcement->title)



@section('content')



<section class="informasi-detail">



<div class="detail-header">


<h1>
{{ $announcement->title }}
</h1>



<div class="detail-date">

{{ $announcement->published_at
? $announcement->published_at->format('d F Y')
: '-'
}}

</div>



</div>





<div class="detail-image">


@if($announcement->image_path)


<img 
src="{{ asset('storage/'.$announcement->image_path) }}"
alt="{{ $announcement->title }}"
>


@else


<img
src="{{ asset('assets/berita.jpeg') }}"
alt="Berita"
>


@endif


</div>







<div class="detail-content">


{!! nl2br(e($announcement->body)) !!}


</div>







<a href="{{ route('pengumuman') }}"
class="back-button">

← Kembali ke Pengumuman

</a>





</section>




@endsection