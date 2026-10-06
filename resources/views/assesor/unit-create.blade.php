@extends('superadmin.layout')

@section('title', 'Input Unit Kompetensi')
@section('page_title', 'Input Unit Kompetensi')

@section('content')
<div class="floating-card" style="max-width: 800px; margin: 0 auto;">
    <h2>Input Unit Kompetensi</h2>
    <p style="margin-top: 5px; color: #64748b;">
        Peserta : <b>{{ $assessment->participant->name }}</b> (NIM: {{$assessment->participant->nim ?? '-' }})
    </p>

    <form method="POST" action="{{ route('superadmin.assessment.unit.store', $assessment->id) }}" style="margin-top: 20px;">
        @csrf

        <div id="unit-container" style="display: flex; flex-direction: column; gap: 20px;">
            <div class="unit-box" style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                <h4 style="margin-top: 0; margin-bottom: 15px; color: #1e293b;">Unit Kompetensi 1</h4>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Kode Unit</label>
                    <input type="text" name="units[0][code]" placeholder="Contoh: J.620100.001" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Nama Unit Kompetensi</label>
                    <input type="text" name="units[0][unit_name]" placeholder="Nama kompetensi" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Hasil</label>
                    <select name="units[0][result]" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; background: white;">
                        <option value="kompeten">Kompeten</option>
                        <option value="tidak_kompeten">Tidak Kompeten</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <button type="button" onclick="addUnit()" class="btn-secondary" style="padding: 10px 15px; background: #e2e8f0; color: #334155; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">
                + Tambah Unit
            </button>
        </div>

        <hr style="margin: 30px 0; border: none; border-top: 1px solid #e2e8f0;">

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <a href="{{ route('superadmin.assessment.index') }}" style="padding: 10px 20px; background: #e2e8f0; color: #334155; text-decoration: none; border-radius: 6px; font-weight: 600;">Batal</a>
            <button type="submit" style="padding: 10px 20px; background: #16a34a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">
                Simpan Semua & Selesaikan Penilaian
            </button>
        </div>
    </form>
</div>

<script>
let index = 1;

function addUnit(){
    let container = document.getElementById('unit-container');
    let html = `
        <div class="unit-box" style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h4 style="margin: 0; color: #1e293b;">Unit Kompetensi ${index+1}</h4>
                <button type="button" onclick="this.closest('.unit-box').remove()" style="background: #fee2e2; color: #991b1b; border: none; padding: 4px 10px; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: 600;">Hapus</button>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Kode Unit</label>
                <input type="text" name="units[${index}][code]" placeholder="Contoh: J.620100.002" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Nama Unit Kompetensi</label>
                <input type="text" name="units[${index}][unit_name]" placeholder="Nama kompetensi" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Hasil</label>
                <select name="units[${index}][result]" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; background: white;">
                    <option value="kompeten">Kompeten</option>
                    <option value="tidak_kompeten">Tidak Kompeten</option>
                </select>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    index++;
}
</script>
@endsection