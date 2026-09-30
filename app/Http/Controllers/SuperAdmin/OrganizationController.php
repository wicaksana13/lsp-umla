<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class OrganizationController extends Controller {
 public function index(){ $items=OrganizationMember::orderBy('sort_order')->orderBy('name')->paginate(15); return view('superadmin.organisasi.index',compact('items')); }
 public function create(){ return view('superadmin.organisasi.form',['item'=>new OrganizationMember]); }
 public function store(Request $r){ $data=$this->data($r); if($r->hasFile('photo'))$data['photo_path']=$r->file('photo')->store('organization','public'); OrganizationMember::create($data); return redirect()->route('superadmin.organisasi.index')->with('success','Pengurus berhasil ditambahkan.'); }
 public function edit(OrganizationMember $organisasi){ return view('superadmin.organisasi.form',['item'=>$organisasi]); }
 public function update(Request $r,OrganizationMember $organisasi){ $data=$this->data($r); if($r->hasFile('photo')){ if($organisasi->photo_path)Storage::disk('public')->delete($organisasi->photo_path); $data['photo_path']=$r->file('photo')->store('organization','public'); } $organisasi->update($data); return redirect()->route('superadmin.organisasi.index')->with('success','Pengurus berhasil diperbarui.'); }
 public function destroy(OrganizationMember $organisasi){ if($organisasi->photo_path)Storage::disk('public')->delete($organisasi->photo_path); $organisasi->delete(); return back()->with('success','Pengurus berhasil dihapus.'); }
 private function data(Request $r){ return $r->validate(['name'=>'required|max:255','position'=>'required|max:255','sort_order'=>'required|integer|min:0','photo'=>'nullable|image|max:3072'])+['is_active'=>$r->boolean('is_active')]; }
}
