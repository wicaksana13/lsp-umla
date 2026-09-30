<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentUnit extends Model
{

    protected $fillable = [

        'assessment_registration_id',

        'code',

        'unit_name',

        'result'

    ];



    public function assessment()
    {

        return $this->belongsTo(
            AssessmentRegistration::class,
            'assessment_registration_id'
        );

    }


}