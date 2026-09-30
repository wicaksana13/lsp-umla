@extends('layouts.app')


@section('title','Prosedur Uji Kompetensi')



@section('content')



<section class="prosedur-page">



<div class="prosedur-layout">





<!-- KONTEN UTAMA -->

<div class="prosedur-content">





@if(!empty($settings['procedure_image']))


<img 
src="{{ asset('storage/'.$settings['procedure_image']) }}"
class="prosedur-image"
alt="Prosedur Uji Kompetensi"
>


@else


<img 
src="{{ asset('assets/prosedure.png') }}"
class="prosedur-image"
alt="Prosedur Uji Kompetensi"
>


@endif








<!-- INFORMASI PENTING -->

<div class="info-box">


<div class="info-title">

INFORMASI PENTING

</div>





@if(!empty($settings['procedure_info']))


<ul>


@foreach(explode("\n",$settings['procedure_info']) as $info)


@if(trim($info))

<li>

{{ $info }}

</li>

@endif


@endforeach


</ul>



@else


<p>
Informasi penting belum tersedia.
</p>



@endif





<img 
src="{{ asset('assets/info.jpg') }}" 
class="bnsp-logo"
alt="Informasi BNSP"
>



</div>









<!-- CARA PENDAFTARAN -->


<div class="pendaftaran-box">



<h3>

LANGKAH PENDAFTARAN

</h3>





<div class="step-list">



@if(!empty($settings['registration_steps']))



@foreach(explode("\n",$settings['registration_steps']) as $index=>$step)


@if(trim($step))


<div>

<span>
{{ $index+1 }}
</span>


{{ $step }}


</div>


@endif


@endforeach





@else



<div class="empty-content">

Langkah pendaftaran belum tersedia.

</div>



@endif





</div>



</div>











</div>









<!-- SIDEBAR BERITA -->



<div class="prosedur-sidebar">





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