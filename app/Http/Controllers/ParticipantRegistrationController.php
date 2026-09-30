<?php

namespace App\Http\Controllers;

use App\Models\ParticipantRegistration;
use App\Models\CertificationScheme;
use Illuminate\Http\Request;


class ParticipantRegistrationController extends Controller
{

    public function create()
    {

        $schemes = CertificationScheme::where(
            'is_active',
            true
        )
        ->orderBy('name')
        ->get();


        return view('daftar', compact('schemes'));

    }



    public function store(Request $request)
    {


        $data = $request->validate([

            'name' => 'required|max:255',

            'nim' => 'required|max:50|unique:participant_registrations,nim',

            'email' => 'required|email|unique:participant_registrations,email',

            'phone' => 'nullable|max:30',

            'certification_scheme_id' =>
                'required|exists:certification_schemes,id',

        ]);




        // cek apakah NIM sudah pernah punya akun

        if(
            \App\Models\User::where(
                'nim',
                $data['nim']
            )->exists()
        ){

            return back()
            ->withInput()
            ->withErrors([
                'nim'=>'NIM sudah terdaftar sebagai peserta.'
            ]);

        }





        ParticipantRegistration::create([

            'name'=>$data['name'],

            'nim'=>$data['nim'],

            'email'=>$data['email'],

            'phone'=>$data['phone'] ?? null,

            'certification_scheme_id'=>
                $data['certification_scheme_id'],

            'status'=>'pending',

        ]);





        return redirect()
        ->route('daftar')
        ->with(
            'success',
            'Pendaftaran berhasil. Silahkan menunggu persetujuan admin.'
        );


    }

}