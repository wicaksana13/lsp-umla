<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller; use App\Models\Announcement; use Illuminate\Http\Request; use Illuminate\Support\Facades\Storage;
class AnnouncementController extends Controller {
 public function index(){ $items=Announcement::latest()->paginate(12); return view('superadmin.pengumuman.index',compact('items')); }
 public function create(){return view('superadmin.pengumuman.form',['item'=>new Announcement]);}
 public function store(Request $r){$data=$this->data($r);if($r->hasFile('image'))$data['image_path']=$r->file('image')->store('announcements','public');Announcement::create($data);return redirect()->route('superadmin.pengumuman.index')->with('success','Pengumuman berhasil ditambahkan.');}
 public function edit(Announcement $pengumuman){return view('superadmin.pengumuman.form',['item'=>$pengumuman]);}
 public function update(Request $r,Announcement $pengumuman){$data=$this->data($r);if($r->hasFile('image')){if($pengumuman->image_path)Storage::disk('public')->delete($pengumuman->image_path);$data['image_path']=$r->file('image')->store('announcements','public');}$pengumuman->update($data);return redirect()->route('superadmin.pengumuman.index')->with('success','Pengumuman berhasil diperbarui.');}
 public function destroy(Announcement $pengumuman){if($pengumuman->image_path)Storage::disk('public')->delete($pengumuman->image_path);$pengumuman->delete();return back()->with('success','Pengumuman berhasil dihapus.');}
 private function data(Request $r){return $r->validate(['title'=>'required|max:255','excerpt'=>'nullable|string|max:500','body'=>'nullable|string','published_at'=>'nullable|date','image'=>'nullable|image|max:3072'])+['is_published'=>$r->boolean('is_published')];}
}
