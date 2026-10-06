<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\SuperAdminAuthController;


use App\Http\Controllers\SuperAdmin\{

    AnnouncementController,
    AssessmentController,
    CertificateController,
    DashboardController,
    ParticipantController,
    RegistrationController,
    ScheduleController,
    SiteContentController,
    SkemaController,
    StaffController,
    TukController,
    AssessmentUnitController,
    OrganizationController

};



use App\Http\Middleware\SuperAdminMiddleware;




/*
|--------------------------------------------------------------------------
| LOGIN SUPER ADMIN
|--------------------------------------------------------------------------
*/


Route::get('/login-admin',[
    SuperAdminAuthController::class,
    'create'
])
->name('superadmin.login');




Route::post('/login-admin',[
    SuperAdminAuthController::class,
    'store'
])
->name('superadmin.login.store');








/*
|--------------------------------------------------------------------------
| SUPER ADMIN PANEL
|--------------------------------------------------------------------------
*/


Route::middleware([
    'auth',
    SuperAdminMiddleware::class
])

->prefix('superadmin')

->name('superadmin.')

->group(function(){





/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/


Route::get('/',[
    DashboardController::class,
    'index'
])
->name('dashboard');






/*
|--------------------------------------------------------------------------
| MASTER DATA
|--------------------------------------------------------------------------
*/


Route::resource(
    'skema',
    SkemaController::class
)
->except('show');



Route::resource(
    'tuk',
    TukController::class
)
->except('show');



Route::resource(
    'staff',
    StaffController::class
)
->except('show');



Route::resource(
    'peserta',
    ParticipantController::class
)
->except('show');








/*
|--------------------------------------------------------------------------
| APPROVAL AKUN PESERTA
|--------------------------------------------------------------------------
*/


Route::get(
    'pendaftaran',
    [
        RegistrationController::class,
        'index'
    ]
)
->name('pendaftaran.index');



Route::patch(
    'pendaftaran/{registration}/approve',
    [
        RegistrationController::class,
        'approve'
    ]
)
->name('pendaftaran.approve');



Route::patch(
    'pendaftaran/{registration}/reject',
    [
        RegistrationController::class,
        'reject'
    ]
)
->name('pendaftaran.reject');









/*
|--------------------------------------------------------------------------
| APPROVAL ASESMEN PESERTA
|--------------------------------------------------------------------------
*/


Route::get(
    'assessment',
    [
        AssessmentController::class,
        'index'
    ]
)
->name('assessment.index');



Route::patch(
    'assessment/{assessment}/approve',
    [
        AssessmentController::class,
        'approve'
    ]
)
->name('assessment.approve');







/*
|--------------------------------------------------------------------------
| OPERASIONAL
|--------------------------------------------------------------------------
*/


Route::resource(
    'jadwal',
    ScheduleController::class
)
->except('show');



Route::resource(
    'sertifikat',
    CertificateController::class
);







/*
|--------------------------------------------------------------------------
| WEBSITE
|--------------------------------------------------------------------------
*/


Route::resource(
    'pengumuman',
    AnnouncementController::class
)
->except('show');



Route::resource(
    'organisasi',
    OrganizationController::class
)
->except('show');



Route::get(
    'konten-website',
    [
        SiteContentController::class,
        'edit'
    ]
)
->name('konten.edit');



Route::put(
    'konten-website',
    [
        SiteContentController::class,
        'update'
    ]
)
->name('konten.update');






/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/


Route::post(
    'logout',
    [
        SuperAdminAuthController::class,
        'destroy'
    ]
)
->name('logout');

Route::get(
'assessment/{assessment}/unit',
[
AssessmentUnitController::class,
'create'
]
)
->name('assessment.unit.create');

Route::get('assessment/{assessment}', [AssessmentController::class, 'show'])
    ->name('assessment.show');
Route::patch(
    'assessment/{assessment}/revise',
    [AssessmentController::class, 'revise']
)->name('assessment.revise');
Route::post(
'assessment/{assessment}/unit',
[
AssessmentUnitController::class,
'store'
]
)
->name('assessment.unit.store');
Route::get(
    'assessment/{assessment}/result',
    [
        AssessmentController::class,
        'result'
    ]
)
->name('assessment.result');
});
