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


    // TAMBAHKAN RELASI INI
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'certification_scheme_id');
    }
    protected $casts = [

        'is_active'=>'boolean'

    ];


}