<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Mail\ParticipantApprovedMail;
use App\Mail\ParticipantRejectedMail;
use App\Models\ParticipantRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Mail};

class RegistrationController extends Controller
{
    public function index(Request $r)
    {
        $items = ParticipantRegistration::when($r->status, fn($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15)
            ->withQueryString();
            
        return view('superadmin.pendaftaran.index', compact('items'));
    }

    public function approve(ParticipantRegistration $registration)
    {
        abort_if($registration->status !== 'pending', 422, 'Pendaftaran ini sudah diproses.');
        abort_if(User::where('nim', $registration->nim)->exists(), 422, 'NIM sudah memiliki akun peserta.');

        // Ambil password plain text dari data pendaftaran
        $plainPassword = $registration->password;

        $user = DB::transaction(function() use ($registration, $plainPassword) {
            $u = User::create([
                'name'      => $registration->name,
                'nim'       => $registration->nim,
                'email'     => $registration->email,
                'phone'     => $registration->phone,
                'password'  => $plainPassword, // Disimpan sebagai plain text
                'role'      => 'participant',
                'is_active' => true
            ]);

            $registration->update([
                'status'      => 'approved',
                'approved_by' => auth()->id(),
                'approved_at' => now()
            ]); 
            
            return $u;
        });

        try {
            // Kirim email persetujuan beserta password aslinya
            Mail::to($user->email)->send(new ParticipantApprovedMail($user, $plainPassword)); 
            $msg = 'Pendaftaran disetujui, akun dibuat, dan password telah dikirim ke email peserta.';
        } catch (\Throwable $e) {
            report($e);
            $msg = 'Pendaftaran disetujui dan akun dibuat, tetapi email notifikasi gagal dikirim. Periksa konfigurasi MAIL.';
        }
        
        return back()->with('success', $msg);
    }

    public function reject(Request $r, ParticipantRegistration $registration)
    {
        abort_if($registration->status !== 'pending', 422, 'Pendaftaran ini sudah diproses.');

        $data = $r->validate([
            'rejection_note' => 'required|string|max:1000'
        ]);
        
        $registration->update([
            'status'         => 'rejected',
            'rejection_note' => $data['rejection_note'],
            'approved_by'    => auth()->id()
        ]);

        try {
            // Kirim email penolakan beserta catatan/alasan penolakannya
            Mail::to($registration->email)->send(new ParticipantRejectedMail($registration, $data['rejection_note']));
            $msg = 'Pendaftaran ditolak dan email pemberitahuan telah dikirim ke peserta.';
        } catch (\Throwable $e) {
            report($e);
            $msg = 'Pendaftaran ditolak, tetapi email pemberitahuan gagal dikirim. Periksa konfigurasi MAIL.';
        }
        
        return back()->with('success', $msg);
    }
}