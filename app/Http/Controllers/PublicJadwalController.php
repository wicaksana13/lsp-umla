<?php

namespace App\Http\Controllers;

use App\Models\CertificationSchedule;
use App\Models\CertificationScheme;
use App\Models\Tuk;
use Illuminate\Http\Request;


class PublicJadwalController extends Controller
{

    public function index(Request $request)
    {


        $query = CertificationSchedule::with([
            'scheme',
            'tuk'
        ])
        ->where('status','open')
        ->orderBy(
            'date',
            'asc'
        );



        // FILTER SKEMA

        if($request->scheme)
        {

            $query->where(
                'certification_scheme_id',
                $request->scheme
            );

        }



        // FILTER TANGGAL

        if($request->date)
        {

            $query->whereDate(
                'date',
                $request->date
            );

        }




        // FILTER KOTA/TUK

        if($request->tuk)
        {

            $query->where(
                'tuk_id',
                $request->tuk
            );

        }





        $jadwal = $query->get();



        $schemes = CertificationScheme::where(
            'is_active',
            true
        )
        ->orderBy('name')
        ->get();




        $tuks = Tuk::where(
            'is_active',
            true
        )
        ->orderBy('name')
        ->get();





        return view('jadwal',compact(

            'jadwal',
            'schemes',
            'tuks'

        ));


    }

}