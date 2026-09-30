@extends('layouts.participant')


@section('title','Profil Saya')


@section('page_title','Profil Saya')



@section('content')



<div class="profile-layout">





<div class="participant-panel profile-card">





<div class="profile-header">



<div class="profile-photo">



@if(auth()->user()->photo)


<img 
src="{{ asset('storage/'.auth()->user()->photo) }}"
alt="Foto Profil"
>


@else


<div class="profile-avatar-large">

{{ strtoupper(
substr(
auth()->user()->name,
0,
1
)
) }}

</div>


@endif



</div>






<div>


<h2>

{{ auth()->user()->name }}

</h2>


<p>

Peserta Sertifikasi LSP UMLA

</p>


</div>




</div>







<div class="profile-info">



<div>

<span>

Nama

</span>


<b>

{{ auth()->user()->name }}

</b>


</div>






<div>

<span>

Email

</span>


<b>

{{ auth()->user()->email }}

</b>


</div>






<div>

<span>

Role

</span>


<b>

Peserta

</b>


</div>



</div>





</div>













<div class="participant-panel">



<div class="panel-head">


<div>

<h2>

Edit Profil

</h2>


<p>

Perbarui informasi akun Anda.

</p>


</div>


</div>








<form method="POST"
action="{{ route('peserta.profile.update') }}"
enctype="multipart/form-data"
class="profile-form">


@csrf

@method('PUT')





<div class="form-group">



<label>

Nama Lengkap

</label>


<input 
type="text"
name="name"
value="{{ old('name',auth()->user()->name) }}"
required
>


</div>








<div class="form-group">



<label>

Foto Profil

</label>



<input 
type="file"
name="photo"
accept="image/*"
>



<small>

Format JPG/PNG maksimal 2MB.

</small>


</div>







<div class="form-actions">


<button class="btn btn-primary">


Simpan Profil


</button>


</div>







</form>






</div>





</div>





@endsection