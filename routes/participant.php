<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantDashboardController;


Route::middleware(['auth','participant'])
->prefix('peserta')
->name('peserta.')
->group(function(){

Route::get('/assessment/{id}/edit', [ParticipantDashboardController::class, 'assessmentEdit'])->name('assessment.edit');
Route::put('/assessment/{id}/update', [ParticipantDashboardController::class, 'assessmentUpdate'])->name('assessment.update');
    // Dashboard
    Route::get('/dashboard',
    [ParticipantDashboardController::class,'index'])
    ->name('dashboard');



    // Jadwal asesmen
    Route::get('/schedule',
    [ParticipantDashboardController::class,'schedule'])
    ->name('schedule');



    // Form Pendaftaran Asesmen (GET)
    Route::get('/assessment/register/{id}',
    [ParticipantDashboardController::class,'registerForm'])
    ->name('register.form');



    // Proses Simpan Pendaftaran Asesmen (POST)
    Route::post('/assessment/register/{id}',
    [ParticipantDashboardController::class,'registerStore'])
    ->name('register.store');



    // Asesmen saya
    Route::get('/assessment',
    [ParticipantDashboardController::class,'assessment'])
    ->name('assessment');



    // Unit kompetensi
    Route::get('/unit',
    [ParticipantDashboardController::class,'unit'])
    ->name('unit');



    // Sertifikat
    Route::get('/certificate',
    [ParticipantDashboardController::class,'certificate'])
    ->name('certificate');



    // Profil
    Route::get('/profile',
    [ParticipantDashboardController::class,'profile'])
    ->name('profile');


    Route::put('/profile',
    [ParticipantDashboardController::class,'updateProfile'])
    ->name('profile.update');



});