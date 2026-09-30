@extends('superadmin.layout')


@section('title',
$item->exists?'Edit Peserta':'Tambah Peserta'
)


@section('page_title',
$item->exists?'Edit Akun Peserta':'Tambah Akun Peserta'
)



@section('content')


<form 
method="POST"
enctype="multipart/form-data"
class="panel form-card"
action="{{ 
$item->exists
?
route('superadmin.peserta.update',$item)
:
route('superadmin.peserta.store')
}}">


@csrf


@if($item->exists)

@method('PUT')

@endif





<div class="form-grid">





<label>
Foto Profil


@if($item->photo)


<div style="margin:10px 0">

<img 
src="{{asset('storage/'.$item->photo)}}"
width="100"
height="100"
style="
border-radius:50%;
object-fit:cover;
">

</div>

@endif



<input 
type="file"
name="photo"
accept="image/*">


<small>
Format JPG/PNG maksimal 2MB
</small>


</label>









<label>
Nama Lengkap


<input 
type="text"
name="name"
value="{{old('name',$item->name)}}"
required>

</label>








<label>
NIM


<input 
name="nim"
value="{{old('nim',$item->nim)}}"
required>

</label>







<label>
Email


<input 
type="email"
name="email"
value="{{old('email',$item->email)}}"
required>


</label>







<label>
Nomor HP


<input 
name="phone"
value="{{old('phone',$item->phone)}}">


</label>









<label>
Password


<input 
type="password"
name="password">


<small>
Kosongkan jika tidak ingin mengganti password
</small>


</label>








<label>
Konfirmasi Password


<input 
type="password"
name="password_confirmation">

</label>








<label>

Status


<select name="is_active">


<option 
value="1"
@selected(old('is_active',$item->is_active ?? true)==1)
>

Aktif

</option>



<option 
value="0"
@selected(old('is_active',$item->is_active)==0)
>

Nonaktif

</option>


</select>


</label>







</div>







<div class="form-actions">


<a 
href="{{route('superadmin.peserta.index')}}"
class="btn btn-outline">

Batal

</a>



<button 
class="btn btn-primary">

Simpan Peserta

</button>



</div>






</form>


@endsection