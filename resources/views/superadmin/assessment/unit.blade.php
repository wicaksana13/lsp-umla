@extends('superadmin.layout')


@section('content')


<div class="floating-card">


<h2>
Input Unit Kompetensi
</h2>



<p>
Peserta :
<b>
{{ $assessment->participant->name }}
</b>
</p>




<form method="POST"

action="{{ route(
'superadmin.assessment.unit.store',
$assessment->id
)}}">


@csrf



<div id="unit-container">



<div class="unit-box">


<h4>
Unit Kompetensi 1
</h4>



<label>
Kode Unit
</label>


<input 
type="text"
name="units[0][code]"
placeholder="Contoh: J.620100.001"
required>




<label>
Nama Unit Kompetensi
</label>


<input

type="text"

name="units[0][unit_name]"

placeholder="Nama kompetensi"

required>




<label>
Hasil
</label>


<select name="units[0][result]">


<option value="kompeten">
Kompeten
</option>


<option value="tidak_kompeten">
Tidak Kompeten
</option>


</select>


</div>



</div>




<button
type="button"
onclick="addUnit()"
class="btn-secondary">

+ Tambah Unit

</button>




<br><br>



<button type="submit">

Simpan Semua

</button>



</form>



</div>






<script>


let index = 1;



function addUnit(){


let container =
document.getElementById('unit-container');



let html = `


<div class="unit-box">


<h4>
Unit Kompetensi ${index+1}
</h4>



<label>
Kode Unit
</label>


<input 

type="text"

name="units[${index}][code]"

placeholder="Contoh: J.620100.002"

required>




<label>
Nama Unit Kompetensi
</label>


<input

type="text"

name="units[${index}][unit_name]"

placeholder="Nama kompetensi"

required>



<label>
Hasil
</label>


<select name="units[${index}][result]">


<option value="kompeten">

Kompeten

</option>


<option value="tidak_kompeten">

Tidak Kompeten

</option>


</select>



<button 
type="button"
onclick="this.parentElement.remove()"
class="btn-delete">

Hapus

</button>



</div>



`;



container.insertAdjacentHTML(
'beforeend',
html
);



index++;


}



</script>



@endsection