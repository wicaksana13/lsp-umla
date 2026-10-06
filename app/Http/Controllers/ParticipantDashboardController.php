<?php

namespace App\Http\Controllers;

use App\Models\CertificationSchedule;
use App\Models\Certificate;
use App\Models\AssessmentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParticipantDashboardController extends Controller
{
    public function index()
    {
        $certificate = Certificate::where(
            'participant_id',
            auth()->id()
        )->count();

        $status = AssessmentRegistration::where(
            'participant_id',
            auth()->id()
        )
        ->latest()
        ->first();

        $jumlahAsesmen = AssessmentRegistration::where(
            'participant_id',
            auth()->id()
        )
        ->count();

        return view(
            'participant.dashboard',
            compact(
                'certificate',
                'status',
                'jumlahAsesmen'
            )
        );
    }

    public function schedule()
    {
        $jadwal = CertificationSchedule::with([
            'scheme',
            'tuk'
        ])
        ->where(
            'status',
            'open'
        )
        ->orderBy(
            'date'
        )
        ->get();

        $sudahDaftar = AssessmentRegistration::where(
            'participant_id',
            auth()->id()
        )
        ->pluck('schedule_id')
        ->toArray();

        return view(
            'participant.schedule',
            compact(
                'jadwal',
                'sudahDaftar'
            )
        );
    }

    // Menampilkan Form Pendaftaran Asesmen
    public function registerForm($id)
    {
        $jadwal = CertificationSchedule::with(['scheme', 'tuk'])->findOrFail($id);

        if ($jadwal->status !== 'open') {
            return redirect()->route('peserta.schedule')->with('error', 'Jadwal asesmen sudah tidak tersedia.');
        }

        $cek = AssessmentRegistration::where('participant_id', auth()->id())
            ->where('schedule_id', $id)
            ->exists();

        if ($cek) {
            return redirect()->route('peserta.schedule')->with('error', 'Anda sudah mendaftar pada asesmen ini.');
        }

        return view('participant.assessment-form', compact('jadwal'));
    }

    // Memproses Penyimpanan Data & Upload Berkas Baru
    public function registerStore(Request $request, $id)
    {
        $jadwal = CertificationSchedule::findOrFail($id);

        if ($jadwal->status !== 'open') {
            return back()->with('error', 'Jadwal asesmen sudah tidak tersedia.');
        }

        $cek = AssessmentRegistration::where('participant_id', auth()->id())
            ->where('schedule_id', $id)
            ->exists();

        if ($cek) {
            return back()->with('error', 'Anda sudah mendaftar pada asesmen ini.');
        }

        $request->validate([
            'program_studi' => 'required|string|max:255',
            'ktp_scan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'diploma_scan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'agreement' => 'required'
        ]);

        $ktpPath = $request->file('ktp_scan')->store('assessment/ktp', 'public');
        $diplomaPath = $request->file('diploma_scan')->store('assessment/diploma', 'public');
        $paymentPath = $request->file('payment_proof')->store('assessment/payment', 'public');

        AssessmentRegistration::create([
            'participant_id' => auth()->id(),
            'schedule_id' => $id,
            'program_studi' => $request->program_studi,
            'ktp_scan' => $ktpPath,
            'diploma_scan' => $diplomaPath,
            'payment_proof' => $paymentPath,
            'status' => 'menunggu'
        ]);

        return redirect()->route('peserta.assessment')->with('success', 'Pendaftaran asesmen berhasil. Menunggu approval admin.');
    }

    // Menampilkan Form Edit/Revisi Pendaftaran Asesmen
    public function assessmentEdit($id)
    {
        $assessment = AssessmentRegistration::where('participant_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'revisi')
            ->with(['schedule.scheme', 'schedule.tuk'])
            ->firstOrFail();

        return view('participant.assessment-edit', compact('assessment'));
    }

    // Memproses Perbaikan/Update Berkas Revisi
    public function assessmentUpdate(Request $request, $id)
    {
        $assessment = AssessmentRegistration::where('participant_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'revisi')
            ->firstOrFail();

        $request->validate([
            'program_studi' => 'required|string|max:255',
            'ktp_scan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'diploma_scan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'agreement' => 'required'
        ]);

        $dataUpdate = [
            'program_studi' => $request->program_studi,
            'status' => 'menunggu', // Kembalikan status ke menunggu setelah diperbaiki
            'note' => null // Kosongkan catatan revisi lama
        ];

        // Jika upload file KTP baru, hapus file lama dan simpan yang baru
        if ($request->hasFile('ktp_scan')) {
            if ($assessment->ktp_scan) {
                Storage::disk('public')->delete($assessment->ktp_scan);
            }
            $dataUpdate['ktp_scan'] = $request->file('ktp_scan')->store('assessment/ktp', 'public');
        }

        // Jika upload file Ijazah baru
        if ($request->hasFile('diploma_scan')) {
            if ($assessment->diploma_scan) {
                Storage::disk('public')->delete($assessment->diploma_scan);
            }
            $dataUpdate['diploma_scan'] = $request->file('diploma_scan')->store('assessment/diploma', 'public');
        }

        // Jika upload bukti pembayaran baru
        if ($request->hasFile('payment_proof')) {
            if ($assessment->payment_proof) {
                Storage::disk('public')->delete($assessment->payment_proof);
            }
            $dataUpdate['payment_proof'] = $request->file('payment_proof')->store('assessment/payment', 'public');
        }

        $assessment->update($dataUpdate);

        return redirect()->route('peserta.assessment')->with('success', 'Perbaikan berkas berhasil dikirim ulang. Menunggu approval admin.');
    }

    public function assessment()
    {
        $asesmen = AssessmentRegistration::with([
            'schedule.scheme',
            'schedule.tuk',
            'units'
        ])
        ->where(
            'participant_id',
            auth()->id()
        )
        ->latest()
        ->get();

        return view(
            'participant.assessment',
            compact('asesmen')
        );
    }

    public function unit()
    {
        $units = AssessmentRegistration::with('units')
        ->where(
            'participant_id',
            auth()->id()
        )
        ->get()
        ->pluck('units')
        ->flatten();

        return view(
            'participant.unit',
            compact('units')
        );
    }

    public function certificate()
    {
        $sertifikat = Certificate::where(
            'participant_id',
            auth()->id()
        )
        ->latest()
        ->get();

        return view(
            'participant.certificate',
            compact('sertifikat')
        );
    }

    public function profile()
    {
        return view(
            'participant.profile'
        );
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name'=>'required',
            'photo'=>'nullable|image|max:2048'
        ]);

        if($request->hasFile('photo')){
            $data['photo'] =
            $request
            ->file('photo')
            ->store(
                'profile',
                'public'
            );
        }

        $user->update($data);

        return back()
        ->with(
            'success',
            'Profil berhasil diperbarui'
        );
    }
}