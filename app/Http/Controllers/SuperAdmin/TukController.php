<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller; use App\Models\Tuk; use Illuminate\Http\Request;
class TukController extends Controller {
 public function index(Request $r){$items=Tuk::when($r->q,fn($q,$s)=>$q->where('name','like',"%$s%"))->latest()->paginate(10)->withQueryString();return view('superadmin.tuk.index',compact('items'));}
 public function create(){return view('superadmin.tuk.form',['item'=>new Tuk]);}
 public function store(Request $r){Tuk::create($this->data($r));return redirect()->route('superadmin.tuk.index')->with('success','TUK berhasil ditambahkan.');}
 public function edit(Tuk $tuk){return view('superadmin.tuk.form',['item'=>$tuk]);}
 public function update(Request $r,Tuk $tuk){$tuk->update($this->data($r));return redirect()->route('superadmin.tuk.index')->with('success','TUK berhasil diperbarui.');}
 public function destroy(Tuk $tuk){$tuk->delete();return back()->with('success','TUK berhasil dihapus.');}
 private function data(Request $r){return $r->validate(['name'=>'required|max:255','type'=>'nullable|max:100','address'=>'nullable|string','city'=>'nullable|max:150','contact_name'=>'nullable|max:255','phone'=>'nullable|max:30'])+['is_active'=>$r->boolean('is_active')];}
}
