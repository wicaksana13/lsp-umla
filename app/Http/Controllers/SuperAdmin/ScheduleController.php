<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller; use App\Models\{CertificationSchedule,CertificationScheme,Tuk,User}; use Illuminate\Http\Request; use Illuminate\Validation\Rule;
class ScheduleController extends Controller {
 public function index(Request $r){$items=CertificationSchedule::with(['scheme','tuk','assessor'])->orderByDesc('date')->paginate(12);return view('superadmin.jadwal.index',compact('items'));}
 public function create(){return view('superadmin.jadwal.form',$this->refs()+['item'=>new CertificationSchedule]);}
 public function store(Request $r){CertificationSchedule::create($this->data($r));return redirect()->route('superadmin.jadwal.index')->with('success','Jadwal berhasil ditambahkan.');}
 public function edit(CertificationSchedule $jadwal){return view('superadmin.jadwal.form',$this->refs()+['item'=>$jadwal]);}
 public function update(Request $r,CertificationSchedule $jadwal){$jadwal->update($this->data($r));return redirect()->route('superadmin.jadwal.index')->with('success','Jadwal berhasil diperbarui.');}
 public function destroy(CertificationSchedule $jadwal){$jadwal->delete();return back()->with('success','Jadwal berhasil dihapus.');}
 private function refs(){return ['schemes'=>CertificationScheme::where('is_active',true)->orderBy('name')->get(),'tuks'=>Tuk::where('is_active',true)->orderBy('name')->get(),'assessors'=>User::where('role','staff')->where('staff_type','asesor')->where('is_active',true)->orderBy('name')->get()];}
 private function data(Request $r){return $r->validate(['title'=>'required|max:255','certification_scheme_id'=>'required|exists:certification_schemes,id','tuk_id'=>'nullable|exists:tuks,id','assessor_id'=>'nullable|exists:users,id','date'=>'required|date','start_time'=>'nullable','end_time'=>'nullable','mode'=>['required',Rule::in(['online','offline','hybrid'])],'quota'=>'required|integer|min:0','status'=>['required',Rule::in(['draft','open','closed','done','cancelled'])],'notes'=>'nullable|string']);}
}
