<?php

namespace App\Http\Controllers;

use App\Models\CertificationSchedule;
use App\Models\Certificate;
use App\Models\AssessmentRegistration;
use Illuminate\Http\Request;

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






    public function register(Request $request,$id)
{

    $jadwal = CertificationSchedule::findOrFail($id);


    if($jadwal->status !== 'open'){


        return back()
        ->with(
            'error',
            'Jadwal asesmen sudah tidak tersedia.'
        );

    }



    $cek = AssessmentRegistration::where(
        'participant_id',
        auth()->id()
    )
    ->where(
        'schedule_id',
        $id
    )
    ->exists();



    if($cek){

        return back()
        ->with(
            'error',
            'Anda sudah mendaftar pada asesmen ini.'
        );

    }



    AssessmentRegistration::create([

        'participant_id'=>auth()->id(),

        'schedule_id'=>$id,

        'status'=>'menunggu'

    ]);




    return back()
    ->with(
        'success',
        'Pendaftaran asesmen berhasil. Menunggu approval admin.'
    );


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