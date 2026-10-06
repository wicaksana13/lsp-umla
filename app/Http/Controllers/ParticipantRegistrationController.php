<?php

namespace App\Http\Controllers;

use App\Models\ParticipantRegistration;
use App\Models\User;
use Illuminate\Http\Request;

class ParticipantRegistrationController extends Controller
{
    public function create()
    {
        return view('daftar');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'nim' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'nullable|max:30',
            'birth_date' => 'required|date',
        ]);

        // 1. Cek apakah NIM atau email sudah terdaftar sebagai User (sudah punya akun aktif / approved)
        if (User::where('nim', $data['nim'])->orWhere('email', $data['email'])->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'nim' => 'NIM atau Email sudah terdaftar dan memiliki akun aktif.'
                ]);
        }

        // 2. Cek riwayat pendaftaran sebelumnya di tabel participant_registrations
        $existingRegistration = ParticipantRegistration::where('nim', $data['nim'])
            ->orWhere('email', $data['email'])
            ->first();

        if ($existingRegistration) {
            // Jika status masih pending atau sudah approved, tidak boleh daftar lagi
            if ($existingRegistration->status === 'pending') {
                return back()
                    ->withInput()
                    ->withErrors([
                        'nim' => 'NIM atau Email ini sudah terdaftar dan status pendaftaran Anda masih menunggu (Pending).'
                    ]);
            }

            if ($existingRegistration->status === 'approved') {
                return back()
                    ->withInput()
                    ->withErrors([
                        'nim' => 'NIM atau Email ini sudah disetujui sebelumnya.'
                    ]);
            }

            // Jika statusnya 'rejected' (ditolak), hapus data pendaftaran lama 
            // agar peserta bisa mengirimkan pendaftaran baru dengan bersih.
            if ($existingRegistration->status === 'rejected') {
                $existingRegistration->delete();
            }
        }

        // Generate Password: NIM + 2 Digit Tanggal Lahir (Contoh: NIM 12345, Lahir tanggal 05 -> 1234505)
        $tanggalLahir = date('d', strtotime($data['birth_date']));
        $generatedPassword = $data['nim'] . $tanggalLahir;

        ParticipantRegistration::create([
            'name' => $data['name'],
            'nim' => $data['nim'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'birth_date' => $data['birth_date'],
            'password' => $generatedPassword, // Disimpan sebagai Plain Text
            'status' => 'pending',
        ]);

        return redirect()
            ->route('daftar')
            ->with(
                'success',
                'Pendaftaran berhasil. Silahkan menunggu persetujuan admin. Cek Email secara berkala'
            );
    }
}