<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantDashboardController;


Route::middleware(['auth','participant'])
->prefix('peserta')
->name('peserta.')
->group(function(){


    // Dashboard
    Route::get('/dashboard',
    [ParticipantDashboardController::class,'index'])
    ->name('dashboard');



    // Jadwal asesmen
    Route::get('/schedule',
    [ParticipantDashboardController::class,'schedule'])
    ->name('schedule');



    // Daftar asesmen
    Route::post('/assessment/register/{id}',
    [ParticipantDashboardController::class,'register'])
    ->name('register');



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