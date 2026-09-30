<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicSkemaController;
use App\Http\Controllers\PublicJadwalController;
use App\Http\Controllers\PublicInformasiController;



/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE LSP UMLA
|--------------------------------------------------------------------------
*/


// Beranda
Route::get('/', [
    HomeController::class,
    'index'
])->name('home');



// Profil LSP
use App\Http\Controllers\ProfileController;


Route::get('/profil', [
    ProfileController::class,
    'index'
])->name('profil');



// Skema Sertifikasi
Route::get('/skema', [
    PublicSkemaController::class,
    'index'
])->name('skema');



// Jadwal Sertifikasi
Route::get('/jadwal', [
    PublicJadwalController::class,
    'index'
])->name('jadwal');



/*
|--------------------------------------------------------------------------
| INFORMASI
|--------------------------------------------------------------------------
*/


// Pengumuman
Route::get('/informasi/pengumuman', [
    PublicInformasiController::class,
    'pengumuman'
])->name('pengumuman');



// Prosedur
Route::get('/informasi/prosedur', [
    PublicInformasiController::class,
    'prosedur'
])->name('prosedur');



// Biaya
Route::get('/informasi/biaya', [
    PublicInformasiController::class,
    'biaya'
])->name('biaya');



// Tempat Uji Kompetensi
Route::get('/informasi/tuk', [
    PublicInformasiController::class,
    'tuk'
])->name('tuk');



// Daftar Asesor
Route::get('/informasi/asesor', [
    PublicInformasiController::class,
    'asesor'
])->name('asesor');



// Sertifikat Dikeluarkan
Route::get('/informasi/sertifikat', [
    PublicInformasiController::class,
    'sertifikat'
])->name('sertifikat');

use App\Http\Controllers\ParticipantRegistrationController;


Route::get('/daftar',[
    ParticipantRegistrationController::class,
    'create'
])->name('daftar');



Route::post('/daftar',[
    ParticipantRegistrationController::class,
    'store'
])->name('daftar.store');
/*
|--------------------------------------------------------------------------
| AUTH PESERTA & ASESOR
|--------------------------------------------------------------------------
*/


use App\Http\Controllers\Auth\LoginController;


Route::get('/login',
[
    LoginController::class,
    'index'
])
->name('login');



Route::post('/login',
[
    LoginController::class,
    'login'
])
->name('login.post');



Route::post('/logout',
[
    LoginController::class,
    'logout'
])
->name('logout');


Route::get('/informasi/pengumuman/{announcement}', [
    PublicInformasiController::class,
    'detail'
])->name('pengumuman.detail');

require __DIR__.'/participant.php';



/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/


require __DIR__.'/superadmin.php';