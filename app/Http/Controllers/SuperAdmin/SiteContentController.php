<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;


class SiteContentController extends Controller
{


    public function edit()
    {

        $settings = SiteSetting::pluck(
            'value',
            'key'
        );


        return view(
            'superadmin.konten.edit',
            compact('settings')
        );

    }







    public function update(Request $r)
    {


        $data = $r->validate([


            // HOME
            'hero_title'
            =>'nullable|string|max:500',

            'hero_subtitle'
            =>'nullable|string|max:500',




            // PROFILE
            'vision'
            =>'nullable|string',

            'mission'
            =>'nullable|string',






            // BIAYA
            'certification_fee'
            =>'nullable|string|max:100',






            // CONTACT
            'address'
            =>'nullable|string|max:1000',

            'phone'
            =>'nullable|string|max:50',

            'email'
            =>'nullable|email|max:255',






            // PROSEDUR
            'procedure_info'
            =>'nullable|string',

            'registration_steps'
            =>'nullable|string',

            'assessment_aspects'
            =>'nullable|string',






            // UPLOAD GAMBAR WEBSITE
            'procedure_image'
            =>'nullable|image|max:2048',

            'tuk_image'
            =>'nullable|image|max:2048',

            'asesor_image'
            =>'nullable|image|max:2048',

            'sertifikat_image'
            =>'nullable|image|max:2048',


        ]);








        /*
        |--------------------------------------------------------------------------
        | UPLOAD IMAGE
        |--------------------------------------------------------------------------
        */


        $images = [

            'procedure_image',

            'tuk_image',

            'asesor_image',

            'sertifikat_image'

        ];





        foreach($images as $image){


            if($r->hasFile($image)){


                $data[$image] =

                $r->file($image)
                ->store(
                    'website',
                    'public'
                );


            }


        }








        /*
        |--------------------------------------------------------------------------
        | SAVE SETTINGS
        |--------------------------------------------------------------------------
        */


        foreach($data as $key=>$value){


            SiteSetting::updateOrCreate(

                [
                    'key'=>$key
                ],

                [

                    'group'=>$this->group($key),

                    'value'=>$value

                ]

            );


        }





        return back()
        ->with(
            'success',
            'Konten website berhasil disimpan.'
        );


    }








    private function group($key)
    {


        return match(true){


            str_starts_with($key,'hero_')
            =>
            'home',




            in_array($key,['vision','mission'])
            =>
            'profile',





            str_contains($key,'fee')
            =>
            'fee',





            in_array($key,['address','phone','email'])
            =>
            'contact',






            str_contains($key,'image')
            =>
            'image',





            default
            =>
            'content'


        };


    }


}