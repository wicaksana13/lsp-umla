<?php

namespace App\Http\Controllers;

use App\Models\CertificationScheme;
use Illuminate\Http\Request;


class PublicSkemaController extends Controller
{


    public function index(Request $request)
    {


        $skema = CertificationScheme::where(
            'is_active',
            true
        )

        ->when(
            $request->q,
            function($query,$search){

                $query->where(function($q) use($search){

                    $q->where(
                        'name',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'code',
                        'like',
                        "%{$search}%"
                    );

                });

            }
        )


        ->orderBy(
            'id',
            'asc'
        )

        ->get();





        return view(
            'skema',
            compact('skema')
        );


    }



}