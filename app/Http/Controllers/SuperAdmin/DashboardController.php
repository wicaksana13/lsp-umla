<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\AssessmentRegistration;
use App\Models\CertificationSchedule;
use App\Models\CertificationScheme;
use App\Models\Tuk;
use App\Models\User;
use App\Models\Certificate;
use App\Models\Announcement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // JIKA AKUN ADALAH STAFF / ASESOR
        if ($user->role === 'staff') {
            $stats = [
                'pending_approval' => AssessmentRegistration::where('status', 'approved')->count(),
                'completed'        => AssessmentRegistration::whereIn('status', ['kompeten', 'tidak_kompeten'])->count(),
                'schedules'        => CertificationSchedule::where('status', 'open')->count(),
            ];

            $pendingAssessments = AssessmentRegistration::with(['participant', 'schedule.scheme', 'schedule.tuk'])
                ->where('status', 'approved')
                ->latest()
                ->take(5)
                ->get();

            $upcomingSchedules = CertificationSchedule::with(['scheme', 'tuk'])
                ->where('status', 'open')
                ->orderBy('date')
                ->take(5)
                ->get();

            return view('assesor.dashboard', compact('stats', 'pendingAssessments', 'upcomingSchedules'));
        }

        // JIKA AKUN ADALAH SUPER ADMIN (Data Standar)
        $stats = [
            'schemes'      => CertificationScheme::count(),
            'assessors'    => User::where('role', 'staff')->count(),
            'tuks'         => Tuk::count(),
            'participants' => User::where('role', 'participant')->count(),
            'certificates' => Certificate::count(),
            'pending'      => AssessmentRegistration::where('status', 'menunggu')->count(),
            'schedules'    => CertificationSchedule::where('status', 'open')->count(),
            'announcements'=> Announcement::count(),
        ];

        $pendingRegistrations = AssessmentRegistration::with(['participant', 'schedule.scheme'])
            ->where('status', 'menunggu')
            ->latest()
            ->take(5)
            ->get();

        $upcomingSchedules = CertificationSchedule::with(['scheme', 'tuk'])
            ->where('status', 'open')
            ->orderBy('date')
            ->take(5)
            ->get();

        return view('superadmin.dashboard', compact('stats', 'pendingRegistrations', 'upcomingSchedules'));
    }
}