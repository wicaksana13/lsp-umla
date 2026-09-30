@extends('layouts.app')


@section('title','Login LSP')



@section('content')

<!-- 
<section class="page-hero">

    <img
        src="{{ asset('assets/gedung.png') }}"
        alt="Gedung Universitas Muhammadiyah Lamongan"
        class="page-hero__image"
    >


    <div class="page-hero__content">


        <div class="page-hero__badge">
            Login
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

</section> -->





<section class="floating-card login-card">


<h2>
Login
</h2>



<p>
Silahkan masuk menggunakan akun yang telah diberikan.
</p>





@if(session('success'))

<div class="alert-success">

{{ session('success') }}

</div>

@endif





@if($errors->any())

<div class="alert-danger">

<ul>

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif






<form method="POST" action="{{ route('login.post') }}">


@csrf





<div class="form-group">


<label>
Email
</label>


<input
type="email"
name="email"
value="{{ old('email') }}"
placeholder="Masukkan email"
required
>



</div>






<div class="form-group">


<label>
Password
</label>



<input
type="password"
name="password"
placeholder="Masukkan password"
required
>



</div>








<div class="form-option">


<label>

<input
type="checkbox"
name="remember"
value="1"
>


 Ingat saya

</label>



</div>








<button type="submit" class="hero-button">

Masuk

<span class="btn-arrow"></span>

</button>







<div class="login-footer">


<p>
Belum memiliki akun?
</p>



<a href="{{ route('daftar') }}">

Daftar Peserta Sertifikasi

</a>



</div>






</form>





</section>




@endsection