@extends('superadmin.layout')


@section('title','Detail Sertifikat')

@section('page_title','Detail Sertifikat')


@section('content')


<section class="panel form-card">


<div class="section-heading">

<h2>
Detail Sertifikat
</h2>

<p>
Informasi sertifikat peserta.
</p>

</div>





<div class="detail-list">


<div>
<b>
Nomor Sertifikat
</b>

<span>
{{ $sertifikat->certificate_no }}
</span>

</div>





<div>
<b>
Peserta
</b>

<span>
{{ $sertifikat->participant?->name ?? '-' }}
</span>

</div>





<div>
<b>
NIM
</b>

<span>
{{ $sertifikat->participant?->nim ?? '-' }}
</span>

</div>





<div>
<b>
Skema
</b>

<span>
{{ $sertifikat->scheme?->name ?? '-' }}
</span>

</div>





<div>
<b>
Tanggal Terbit
</b>

<span>

{{ 
$sertifikat->issued_at
?
$sertifikat->issued_at->format('d M Y')
:
'-'
}}

</span>

</div>





<div>
<b>
Status
</b>

<span class="badge success">

{{ ucfirst($sertifikat->status) }}

</span>

</div>




</div>





@if($sertifikat->file_path)


<div class="pdf-preview">


<h3>
Preview Sertifikat
</h3>


<iframe
src="{{ asset('storage/'.$sertifikat->file_path) }}"
width="100%"
height="700">
</iframe>


</div>



@endif





<a href="{{ route('superadmin.sertifikat.index') }}"
class="btn btn-outline">

Kembali

</a>




</section>


@endsection