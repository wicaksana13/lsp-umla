<?php

namespace App\Http\Controllers\SuperAdmin;


use App\Http\Controllers\Controller;
use App\Models\CertificationScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;



class SkemaController extends Controller
{


    public function index(Request $r)
    {


        $items = CertificationScheme::when(
            $r->q,
            fn($q,$s)=>
            $q->where(function($x) use($s){

                $x->where(
                    'name',
                    'like',
                    "%$s%"
                )
                ->orWhere(
                    'code',
                    'like',
                    "%$s%"
                );

            })
        )
        ->latest()
        ->paginate(10)
        ->withQueryString();



        return view(
            'superadmin.skema.index',
            compact('items')
        );


    }







    public function create()
    {

        return view(
            'superadmin.skema.form',
            [
                'item'=>new CertificationScheme
            ]
        );

    }









    public function store(Request $request)
    {


        $data = $this->data($request);



        if($request->hasFile('pdf')){


            $data['pdf_path'] = 
            $request
            ->file('pdf')
            ->store(
                'skema/pdf',
                'public'
            );


        }



        CertificationScheme::create($data);



        return redirect()
        ->route('superadmin.skema.index')
        ->with(
            'success',
            'Skema berhasil ditambahkan.'
        );


    }









    public function edit(CertificationScheme $skema)
    {


        return view(
            'superadmin.skema.form',
            [
                'item'=>$skema
            ]
        );


    }









    public function update(
        Request $request,
        CertificationScheme $skema
    )
    {


        $data=$this->data(
            $request,
            $skema->id
        );




        if($request->hasFile('pdf')){


            if($skema->pdf_path){

                Storage::disk('public')
                ->delete(
                    $skema->pdf_path
                );

            }



            $data['pdf_path'] =
            $request
            ->file('pdf')
            ->store(
                'skema/pdf',
                'public'
            );


        }




        $skema->update($data);



        return redirect()
        ->route('superadmin.skema.index')
        ->with(
            'success',
            'Skema berhasil diperbarui.'
        );


    }









    public function destroy(
        CertificationScheme $skema
    )
    {


        if($skema->pdf_path){


            Storage::disk('public')
            ->delete(
                $skema->pdf_path
            );


        }



        $skema->delete();



        return back()
        ->with(
            'success',
            'Skema berhasil dihapus.'
        );


    }









    private function data(
        Request $r,
        $id=null
    )
    {


        return $r->validate([


            'code'=>[
                'required',
                'max:100',
                Rule::unique(
                    'certification_schemes',
                    'code'
                )
                ->ignore($id)
            ],


            'name'=>[
                'required',
                'max:255'
            ],


            'description'=>[
                'nullable',
                'string'
            ],


            'pdf'=>[
                'nullable',
                'mimes:pdf',
                'max:10240'
            ],


            'requirements'=>[
                'nullable',
                'string'
            ],


            'is_active'=>[
                'nullable',
                'boolean'
            ]


        ])
        +
        [
            'is_active'=>$r->boolean('is_active')
        ];



    }


}