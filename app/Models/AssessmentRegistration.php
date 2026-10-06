<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentRegistration extends Model
{

protected $fillable=[

    'participant_id',

    'schedule_id',

    'program_studi',
    'ktp_scan',
    'diploma_scan',
    'payment_proof',
    'status',

    'approved_by',

    'approved_at',

    'note'

];


protected $casts=[

    'approved_at'=>'datetime'

];



public function participant()
{
    return $this->belongsTo(
        User::class,
        'participant_id'
    );
}




public function schedule()
{
    return $this->belongsTo(
        CertificationSchedule::class,
        'schedule_id'
    );
}




public function approver()
{
    return $this->belongsTo(
        User::class,
        'approved_by'
    );
}




public function units()
{
    return $this->hasMany(
        AssessmentUnit::class,
        'assessment_registration_id'
    );
}


}