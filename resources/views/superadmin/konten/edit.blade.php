@extends('superadmin.layout')

@section('title','Konten Website')

@section('page_title','Konten Website')


@section('content')


<form 
method="POST" 
action="{{ route('superadmin.konten.update') }}"
class="settings-grid"
enctype="multipart/form-data"
>

@csrf
@method('PUT')





<!-- =========================
     BERANDA
========================= -->


<section class="panel form-card">


<div class="section-heading">

<h2>
Beranda
</h2>

<p>
Menggantikan teks yang masih hardcode pada website.
</p>

</div>





<label>

Judul Hero

<textarea 
name="hero_title"
rows="3"
>{{ old('hero_title',$settings['hero_title'] ?? 'LEMBAGA SERTIFIKASI PROFESI') }}</textarea>

</label>






<label>

Subjudul Hero

<textarea 
name="hero_subtitle"
rows="2"
>{{ old('hero_subtitle',$settings['hero_subtitle'] ?? 'Universitas Muhammadiyah Lamongan') }}</textarea>

</label>







<label>

Aspek Penilaian

<textarea 
name="assessment_aspects"
rows="6"
placeholder="Pengetahuan|deskripsi
Keterampilan|deskripsi
Sikap|deskripsi"
>{{ old('assessment_aspects',$settings['assessment_aspects'] ?? '') }}</textarea>

</label>



</section>









<!-- =========================
     PROFIL LSP
========================= -->


<section class="panel form-card">


<div class="section-heading">

<h2>
Profil LSP
</h2>

</div>





<label>

Visi

<textarea 
name="vision"
rows="5"
>{{ old('vision',$settings['vision'] ?? '') }}</textarea>

</label>







<label>

Misi

<textarea 
name="mission"
rows="8"
>{{ old('mission',$settings['mission'] ?? '') }}</textarea>

</label>



</section>









<!-- =========================
     BIAYA & PROSEDUR
========================= -->


<section class="panel form-card">


<div class="section-heading">

<h2>
Biaya & Prosedur
</h2>

</div>






<label>

Biaya Sertifikasi

<input 
name="certification_fee"
value="{{ old('certification_fee',$settings['certification_fee'] ?? 'Rp 350.000,-') }}"
>

</label>







<label>

Informasi Prosedur

<textarea 
name="procedure_info"
rows="5"
>{{ old('procedure_info',$settings['procedure_info'] ?? '') }}</textarea>

</label>








<label>

Langkah Pendaftaran


<textarea 
name="registration_steps"
rows="8"
placeholder="Pilih Skema
Daftar Online
Unggah Dokumen
Verifikasi Admin"
>{{ old('registration_steps',$settings['registration_steps'] ?? '') }}</textarea>


</label>












</section>






<!-- =========================
     KONTAK FOOTER
========================= -->


<section class="panel form-card">


<div class="section-heading">

<h2>
Kontak Footer
</h2>

</div>







<label>

Alamat


<textarea 
name="address"
rows="4"
>{{ old('address',$settings['address'] ?? '') }}</textarea>


</label>








<label>

No. Telepon


<input 
name="phone"
value="{{ old('phone',$settings['phone'] ?? '') }}"
>


</label>








<label>

Email


<input 
type="email"
name="email"
value="{{ old('email',$settings['email'] ?? '') }}"
>


</label>



</section>





<section class="panel form-card">


<div class="section-heading">

<h2>
Gambar Halaman Website
</h2>

<p>
Upload gambar untuk halaman informasi.
</p>

</div>





<label>

Gambar Prosedur Uji Kompetensi


<input 
type="file"
name="procedure_image"
accept="image/*"
>


@if(!empty($settings['procedure_image']))

<img 
src="{{ asset('storage/'.$settings['procedure_image']) }}"
width="250"
style="margin-top:15px;border-radius:15px"
>

@endif


</label>







<label>

Gambar Daftar TUK


<input 
type="file"
name="tuk_image"
accept="image/*"
>


@if(!empty($settings['tuk_image']))


<img 
src="{{ asset('storage/'.$settings['tuk_image']) }}"
width="250"
style="margin-top:15px;border-radius:15px"
>


@endif


</label>







<label>

Gambar Daftar Asesor


<input 
type="file"
name="asesor_image"
accept="image/*"
>



@if(!empty($settings['asesor_image']))


<img 
src="{{ asset('storage/'.$settings['asesor_image']) }}"
width="250"
style="margin-top:15px;border-radius:15px"
>


@endif


</label>







<label>

Gambar Struktur Profil


<input 
type="file"
name="sertifikat_image"
accept="image/*"
>




@if(!empty($settings['sertifikat_image']))


<img 
src="{{ asset('storage/'.$settings['sertifikat_image']) }}"
width="250"
style="margin-top:15px;border-radius:15px"
>


@endif


</label>



</section>






<div class="settings-save">


<button class="btn btn-primary">

Simpan Semua Konten

</button>



</div>





</form>


@endsection