<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class SuperAdminAuthController extends Controller
{


    public function create()
    {

        if(
            Auth::check() &&
            Auth::user()->role === 'super_admin'
        ){

            return redirect()
            ->route('superadmin.dashboard');

        }


        return view('auth.login-admin');

    }






    public function store(Request $request)
    {


        $credentials = $request->validate([

            'email'=>'required|email',

            'password'=>'required'

        ]);




        if(!Auth::attempt($credentials)){


            throw ValidationException::withMessages([

                'email'=>'Email atau password salah.'

            ]);


        }



        $request->session()->regenerate();



        $user = Auth::user();




        if(
            $user->role !== 'super_admin'
            ||
            !$user->is_active
        ){


            Auth::logout();


            throw ValidationException::withMessages([

                'email'=>'Akun bukan Super Admin.'

            ]);

        }




        return redirect()
        ->route('superadmin.dashboard');


    }







    public function destroy(Request $request)
    {


        Auth::logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();



        return redirect()
        ->route('superadmin.login');


    }


}