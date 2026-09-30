<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller; use App\Models\User; use Illuminate\Http\Request; use Illuminate\Support\Facades\Hash; use Illuminate\Validation\Rule;
class StaffController extends Controller {
 public function index(Request $r){$items=User::where('role','staff')->when($r->q,fn($q,$s)=>$q->where(fn($x)=>$x->where('name','like',"%$s%")->orWhere('email','like',"%$s%")))->latest()->paginate(10)->withQueryString();return view('superadmin.staff.index',compact('items'));}
 public function create(){return view('superadmin.staff.form',['item'=>new User]);}
 public function store(Request $r){$data=$this->data($r);$data['role']='staff';$data['password']=Hash::make($r->password);User::create($data);return redirect()->route('superadmin.staff.index')->with('success','Akun admin/asesor berhasil dibuat.');}
 public function edit(User $staff){abort_unless($staff->role==='staff',404);return view('superadmin.staff.form',['item'=>$staff]);}
 public function update(Request $r,User $staff){abort_unless($staff->role==='staff',404);$data=$this->data($r,$staff->id,true);if($r->filled('password'))$data['password']=Hash::make($r->password);$staff->update($data);return redirect()->route('superadmin.staff.index')->with('success','Akun berhasil diperbarui.');}
 public function destroy(User $staff){abort_unless($staff->role==='staff',404);$staff->delete();return back()->with('success','Akun berhasil dihapus.');}
 private function data(Request $r,$id=null,$edit=false){return $r->validate(['name'=>'required|max:255','email'=>['required','email',Rule::unique('users','email')->ignore($id)],'staff_type'=>['required',Rule::in(['admin_lsp','asesor'])],'assessor_no'=>['nullable','max:100',Rule::unique('users','assessor_no')->ignore($id)],'phone'=>'nullable|max:30','password'=>[$edit?'nullable':'required','min:8','confirmed']])+['is_active'=>$r->boolean('is_active')];}
}
