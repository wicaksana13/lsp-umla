<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Tuk;
use App\Models\Certificate;
use App\Models\Announcement;
use App\Models\SiteSetting;
use App\Models\CertificationScheme;



class HomeController extends Controller
{


    public function index()
    {


        /*
        |--------------------------------------------------------------------------
        | STATISTIK WEBSITE
        |--------------------------------------------------------------------------
        */


        // jumlah skema sertifikasi
        $jumlahSkema = CertificationScheme::where(
            'is_active',
            true
        )->count();




        // jumlah asesor kompetensi
        $jumlahAsesor = User::where(
            'role',
            'staff'
        )
        ->where(
            'staff_type',
            'asesor'
        )
        ->where(
            'is_active',
            true
        )
        ->count();





        // jumlah tempat uji kompetensi
        $jumlahTuk = Tuk::where(
            'is_active',
            true
        )
        ->count();





        // jumlah pemegang sertifikat
        $jumlahSertifikat = Certificate::where(
            'status',
            'issued'
        )
        ->count();






        /*
        |--------------------------------------------------------------------------
        | BERITA TERBARU
        |--------------------------------------------------------------------------
        */


        $berita = Announcement::where(
            'is_published',
            true
        )
        ->orderBy(
            'published_at',
            'desc'
        )
        ->take(3)
        ->get();






        /*
        |--------------------------------------------------------------------------
        | KONTEN WEBSITE DARI SUPER ADMIN
        |--------------------------------------------------------------------------
        */


        $settings = SiteSetting::pluck(
            'value',
            'key'
        );







        return view('home', compact(

            'jumlahSkema',

            'jumlahAsesor',

            'jumlahTuk',

            'jumlahSertifikat',

            'berita',

            'settings'

        ));



    }



}