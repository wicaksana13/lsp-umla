<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\AssessmentRegistration;
use App\Models\AssessmentUnit;
use Illuminate\Http\Request;

class AssessmentUnitController extends Controller
{
    public function create(AssessmentRegistration $assessment)
    {
        $assessment->load(['participant', 'schedule.scheme']);

        // Jika asesor/staff, arahkan ke view unit-create khusus asesor
        if (auth()->user()->role === 'staff') {
            return view('assesor.unit-create', compact('assessment'));
        }

        return view('superadmin.assessment.unit', compact('assessment'));
    }

    public function store(Request $request, AssessmentRegistration $assessment)
    {
        $data = $request->validate([
            'units' => 'required|array',
            'units.*.code' => 'required|string',
            'units.*.unit_name' => 'required|string',
            'units.*.result' => 'required|in:kompeten,tidak_kompeten'
        ]);

        foreach($data['units'] as $unit){
            $assessment->units()->create([
                'code' => $unit['code'],
                'unit_name' => $unit['unit_name'],
                'result' => $unit['result']
            ]);
        }

        // Cek hasil asesmen
        $totalUnit = $assessment->units()->count();
        $jumlahKompeten = $assessment->units()->where('result', 'kompeten')->count();

        if ($totalUnit > 0 && $totalUnit == $jumlahKompeten) {
            $assessment->update([
                'status' => 'kompeten'
            ]);
        } else {
            $assessment->update([
                'status' => 'tidak_kompeten'
            ]);
        }

        return redirect()
            ->route('superadmin.assessment.index')
            ->with('success', 'Unit kompetensi berhasil disimpan.');
    }
}