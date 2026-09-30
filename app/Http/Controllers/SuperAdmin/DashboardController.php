<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\{Announcement, Certificate, CertificationSchedule, CertificationScheme, ParticipantRegistration, Tuk, User};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'schemes' => CertificationScheme::count(),
            'assessors' => User::where('role', 'staff')->where('staff_type', 'asesor')->count(),
            'tuks' => Tuk::count(),
            'participants' => User::where('role', 'participant')->count(),
            'certificates' => Certificate::where('status', 'issued')->count(),
            'pending' => ParticipantRegistration::where('status', 'pending')->count(),
            'schedules' => CertificationSchedule::whereDate('date', '>=', now()->toDateString())->count(),
            'announcements' => Announcement::where('is_published', true)->count(),
        ];

        $pendingRegistrations = ParticipantRegistration::with('scheme')->where('status', 'pending')->latest()->take(6)->get();
        $upcomingSchedules = CertificationSchedule::with(['scheme', 'tuk'])->whereDate('date', '>=', now()->toDateString())->orderBy('date')->take(5)->get();

        return view('superadmin.dashboard', compact('stats', 'pendingRegistrations', 'upcomingSchedules'));
    }
}
