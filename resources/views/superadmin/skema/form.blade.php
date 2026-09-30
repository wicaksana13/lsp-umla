@extends('superadmin.layout')


@section('title',
    $item->exists ? 'Edit Skema' : 'Tambah Skema'
)


@section('page_title',
    $item->exists ? 'Edit Skema' : 'Tambah Skema'
)



@section('content')


<form 
    class="panel form-card"
    method="POST"
    enctype="multipart/form-data"
    action="{{ 
        $item->exists 
        ? route('superadmin.skema.update',$item) 
        : route('superadmin.skema.store') 
    }}"
>


@csrf


@if($item->exists)

@method('PUT')

@endif




<div class="form-grid">


<label>

Kode Skema

<input 
    type="text"
    name="code"
    value="{{ old('code',$item->code) }}"
    placeholder="SKM-001"
    required
>

</label>





<label>

Nama Skema

<input 
    type="text"
    name="name"
    value="{{ old('name',$item->name) }}"
    placeholder="Nama skema sertifikasi"
    required
>

</label>



</div>








<label>

Deskripsi Skema


<textarea
name="description"
rows="5"
placeholder="Jelaskan deskripsi skema sertifikasi..."
>{{ old('description',$item->description) }}</textarea>


</label>








<!-- UPLOAD PDF -->


<label>


Dokumen Skema (PDF)


<input 
type="file"
name="pdf"
accept="application/pdf"
>


<small>
Format PDF maksimal 10 MB
</small>



@if($item->exists && $item->pdf_path)


<div style="margin-top:15px">


<a 
href="{{ asset('storage/'.$item->pdf_path) }}"
target="_blank"
class="btn btn-outline"
>


📄 Lihat Dokumen PDF Saat Ini


</a>


</div>



@endif



</label>









<label>


Persyaratan Peserta


<textarea
name="requirements"
rows="8"
placeholder="Tulis satu persyaratan per baris..."
>{{ old('requirements',$item->requirements) }}</textarea>


</label>









<label class="switch-line">


<input 

type="checkbox"

name="is_active"

value="1"

@checked(
old(
'is_active',
$item->exists 
? $item->is_active 
: true
)
)

>


Skema aktif dan dapat ditampilkan di website


</label>









<div class="form-actions">


<a 
class="btn btn-outline"

href="{{ route('superadmin.skema.index') }}"
>

Batal

</a>





<button 
class="btn btn-primary"
type="submit"
>

Simpan Skema

</button>



</div>







</form>



@endsection