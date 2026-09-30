<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller; use App\Models\{Certificate,CertificationScheme,User}; use Illuminate\Http\Request; use Illuminate\Support\Facades\Storage; use Illuminate\Validation\Rule;
class CertificateController extends Controller {
 public function index(Request $r){$items=Certificate::with(['participant','scheme'])->latest('issued_at')->paginate(15);return view('superadmin.sertifikat.index',compact('items'));}
 public function create(){return view('superadmin.sertifikat.form',$this->refs()+['item'=>new Certificate]);}
 public function store(Request $r){$data=$this->data($r);if($r->hasFile('certificate_file'))$data['file_path']=$r->file('certificate_file')->store('certificates','public');$data['created_by']=auth()->id();Certificate::create($data);return redirect()->route('superadmin.sertifikat.index')->with('success','Sertifikat berhasil ditambahkan ke akun peserta.');}
 public function edit(Certificate $sertifikat){return view('superadmin.sertifikat.form',$this->refs()+['item'=>$sertifikat]);}
 public function update(Request $r,Certificate $sertifikat){$data=$this->data($r,$sertifikat->id);if($r->hasFile('certificate_file')){if($sertifikat->file_path)Storage::disk('public')->delete($sertifikat->file_path);$data['file_path']=$r->file('certificate_file')->store('certificates','public');}$sertifikat->update($data);return redirect()->route('superadmin.sertifikat.index')->with('success','Sertifikat berhasil diperbarui.');}
 public function destroy(Certificate $sertifikat){if($sertifikat->file_path)Storage::disk('public')->delete($sertifikat->file_path);$sertifikat->delete();return back()->with('success','Sertifikat berhasil dihapus.');}
 private function refs(){return ['participants'=>User::where('role','participant')->where('is_active',true)->orderBy('name')->get(),'schemes'=>CertificationScheme::where('is_active',true)->orderBy('name')->get()];}
 private function data(Request $r,$id=null){return $r->validate(['participant_id'=>'required|exists:users,id','certification_scheme_id'=>'required|exists:certification_schemes,id','certificate_no'=>['required','max:150',Rule::unique('certificates','certificate_no')->ignore($id)],'issued_at'=>'required|date','expires_at'=>'nullable|date|after_or_equal:issued_at','status'=>['required',Rule::in(['issued','revoked','expired'])],'certificate_file'=>'nullable|file|mimes:pdf|max:5120']);}
 public function show(Certificate $sertifikat)
{
    return view(
        'superadmin.sertifikat.show',
        compact('sertifikat')
    );
}
}
