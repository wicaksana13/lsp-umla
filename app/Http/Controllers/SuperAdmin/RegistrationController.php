<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller; use App\Mail\ParticipantApprovedMail; use App\Models\ParticipantRegistration; use App\Models\User; use Illuminate\Http\Request; use Illuminate\Support\Facades\{DB,Hash,Mail}; use Illuminate\Support\Str;
class RegistrationController extends Controller {
 public function index(Request $r){$items=ParticipantRegistration::with('scheme')->when($r->status,fn($q,$s)=>$q->where('status',$s))->latest()->paginate(15)->withQueryString();return view('superadmin.pendaftaran.index',compact('items'));}
 public function approve(ParticipantRegistration $registration){
  abort_if($registration->status!=='pending',422,'Pendaftaran ini sudah diproses.');
  abort_if(User::where('nim',$registration->nim)->exists(),422,'NIM sudah memiliki akun peserta.');
  $plain=Str::password(12);
  $user=DB::transaction(function()use($registration,$plain){
    $u=User::create(['name'=>$registration->name,'nim'=>$registration->nim,'email'=>$registration->email,'phone'=>$registration->phone,'password'=>Hash::make($plain),'role'=>'participant','is_active'=>true]);
    $registration->update(['status'=>'approved','approved_by'=>auth()->id(),'approved_at'=>now()]); return $u;
  });
  try{ Mail::to($user->email)->send(new ParticipantApprovedMail($user,$plain)); $msg='Pendaftaran disetujui dan akun telah dikirim ke email peserta.'; }
  catch(\Throwable $e){ report($e); $msg='Pendaftaran disetujui dan akun dibuat, tetapi email gagal dikirim. Periksa konfigurasi MAIL.'; }
  return back()->with('success',$msg);
 }
 public function reject(Request $r,ParticipantRegistration $registration){$data=$r->validate(['rejection_note'=>'required|string|max:1000']);$registration->update(['status'=>'rejected','rejection_note'=>$data['rejection_note'],'approved_by'=>auth()->id()]);return back()->with('success','Pendaftaran ditolak.');}
}
