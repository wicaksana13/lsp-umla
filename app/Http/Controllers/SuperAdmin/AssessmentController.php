<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\AssessmentRegistration;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        $data = AssessmentRegistration::with([
            'participant',
            'schedule.scheme',
            'schedule.tuk'
        ])
        ->latest()
        ->paginate(15);

        // Jika asesor/staff, arahkan ke view assesment khusus asesor
        if (auth()->user()->role === 'staff') {
            return view('assesor.assesment', compact('data'));
        }

        return view('superadmin.assessment.index', compact('data'));
    }

    // Menampilkan halaman detail dokumen peserta untuk dicek admin
    public function show(AssessmentRegistration $assessment)
    {
        $assessment->load([
            'participant',
            'schedule.scheme',
            'schedule.tuk'
        ]);

        return view('superadmin.assessment.show', compact('assessment'));
    }

    public function approve(AssessmentRegistration $assessment)
    {
        $assessment->update([
            'status'      => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]);

        return redirect()
            ->route('superadmin.assessment.index')
            ->with('success', 'Peserta asesmen berhasil disetujui.');
    }

    public function reject(Request $request, AssessmentRegistration $assessment)
    {
        $assessment->update([
            'status' => 'tidak_kompeten',
            'note'   => $request->note
        ]);

        return back();
    }

    public function result(AssessmentRegistration $assessment)
    {
        $assessment->load([
            'participant',
            'schedule.scheme',
            'schedule.tuk',
            'units'
        ]);

        // Jika asesor/staff, arahkan ke view result khusus asesor
        if (auth()->user()->role === 'staff') {
            return view('assesor.result', compact('assessment'));
        }

        return view('superadmin.assessment.result', compact('assessment')); 
    }

    public function revise(Request $request, AssessmentRegistration $assessment)
    {
        $request->validate([
            'note' => 'required|string|max:1000'
        ]);

        $assessment->update([
            'status' => 'revisi',
            'note'   => $request->note
        ]);

        return redirect()
            ->route('superadmin.assessment.index')
            ->with('success', 'Catatan revisi berhasil dikirim ke peserta.');
    }
}