<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CertificationScheme extends Model
{


    protected $fillable = [

        'code',
        'name',
        'description',
        'pdf_path',
        'requirements',
        'is_active'

    ];



    protected $casts = [

        'is_active'=>'boolean'

    ];


}