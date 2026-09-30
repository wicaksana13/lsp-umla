@extends('layouts.app')


@section('title','Skema Sertifikasi LSP UMLA')



@section('content')



<section class="page-hero">


<img
src="{{ asset('assets/gedung.png') }}"
class="page-hero__image"
>


<div class="page-hero__content">


<div class="page-hero__badge">

Skema

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






<section class="floating-card skema-card">



@forelse($skema as $item)



<div class="accordion-item 
{{ $loop->first ? 'active':'' }}">



<button 
class="accordion-header"
type="button">


<span>


{{ $loop->iteration }}.
{{ $item->name }}


</span>


<span class="accordion-arrow">

<svg 
width="20" 
height="20" 
viewBox="0 0 24 24">

<path 
d="M6 9l6 6 6-6"
fill="none"
stroke="currentColor"
stroke-width="2.5"
stroke-linecap="round"
stroke-linejoin="round"/>

</svg>

</span>


</button>







<div class="accordion-content">





@if($item->description)


<h4>
Tentang Skema
</h4>


<p class="skema-description">
    {{ $item->description }}
</p>


@endif







@if($item->pdf_path)



<h4>

Dokumen Skema

</h4>





<div class="pdf-reader">



<div class="pdf-toolbar">


<button
type="button"
class="pdf-btn"
onclick="prevPDF({{ $item->id }})">

‹

</button>





<span id="pageInfo{{ $item->id }}">

1 / 1

</span>





<button
type="button"
class="pdf-btn"
onclick="nextPDF({{ $item->id }})">

›

</button>



</div>







<div class="pdf-page">


<canvas
id="pdfCanvas{{ $item->id }}">
</canvas>


</div>




</div>







<script>


document.addEventListener(
"DOMContentLoaded",
function(){


loadPDF(

"{{ asset('storage/'.$item->pdf_path) }}",

"pdfCanvas{{ $item->id }}",

"pageInfo{{ $item->id }}",

{{ $item->id }}

);


});


</script>



@else


<div class="pdf-not-found">

Dokumen skema belum tersedia.

</div>


@endif







@if($item->requirements)



<h4>

Persyaratan Peserta

</h4>




<ol>


@foreach(explode("\n",$item->requirements) as $req)


@if(trim($req))


<li>

{{ $req }}

</li>


@endif


@endforeach


</ol>


@endif






</div>





</div>





@empty



<div class="accordion-item active">


<button class="accordion-header">

Belum Ada Skema Sertifikasi

</button>



<div class="accordion-content">

<p>

Informasi skema sertifikasi belum tersedia.

</p>


</div>


</div>



@endforelse





</section>





@endsection