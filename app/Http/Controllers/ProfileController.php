<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\OrganizationMember;


class ProfileController extends Controller
{

    public function index()
    {

        $settings = SiteSetting::pluck(
            'value',
            'key'
        );


        $organization = OrganizationMember::where(
            'is_active',
            true
        )
        ->orderBy(
            'sort_order'
        )
        ->get();



        return view('profil', compact(
            'settings',
            'organization'
        ));

    }

}