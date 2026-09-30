@extends('layouts.app')


@section('title','Profil LSP UMLA')



@section('content')



<!-- HERO PROFIL -->

<section class="page-hero page-hero--profile">


    <img
        src="{{ asset('assets/gedung.png') }}"
        alt="Gedung Universitas Muhammadiyah Lamongan"
        class="page-hero__image"
    >



    <div class="page-hero__content">


        <div class="page-hero__badge">

            Profil

        </div>




        <h1 class="page-hero__title">


            {!! nl2br(
                $settings['hero_title']
                ??
                "LEMBAGA\nSERTIFIKASI\nPROFESI"
            ) !!}


        </h1>





        <p class="page-hero__subtitle">


            {!! nl2br(
                $settings['hero_subtitle']
                ??
                "Universitas Muhammadiyah\nLamongan"
            ) !!}


        </p>




    </div>


</section>









<!-- VISI MISI -->


<section class="floating-card visi-card">


<h3>
VISI
</h3>



<p>

{!! nl2br(
    $settings['vision']
    ??
    'Visi LSP belum tersedia.'
) !!}

</p>






<h3>
MISI
</h3>





@php

$misi = explode(
    "\n",
    $settings['mission'] ?? ''
);

@endphp





@if(count($misi) > 0)


<ol>


@foreach($misi as $item)


@if(trim($item))


<li>

{{ $item }}

</li>


@endif


@endforeach


</ol>



@else


<p>

Misi LSP belum tersedia.

</p>



@endif







</section>









<!-- STRUKTUR ORGANISASI -->


<div class="section-title">

Struktur Organisasi

</div>







<section class="struktur">





@forelse($organization as $person)





<div class="person">





<div class="photo">



@if($person->photo_path)



<img
src="{{ asset('storage/'.$person->photo_path) }}"
alt="{{ $person->name }}"
>



@else



<img
src="{{ asset('assets/profile1.png') }}"
alt="Profil pengurus LSP UMLA"
>



@endif



</div>







<h3>

{{ $person->name }}

</h3>





<p>

{{ $person->position }}

</p>





</div>







@empty






<div class="person">


<div class="photo">


<img
src="{{ asset('assets/profile1.png') }}"
alt="Profil pengurus"
>


</div>


<h3>

Belum ada data

</h3>


<p>

Struktur organisasi belum tersedia

</p>



</div>






@endforelse







</section>







@endsection