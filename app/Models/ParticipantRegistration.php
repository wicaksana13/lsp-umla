<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantRegistration extends Model
{
    protected $fillable = [
        'nim', 'name', 'email', 'phone', 'certification_scheme_id',
        'status', 'approved_by', 'approved_at', 'rejection_note'
    ];

    protected $casts = ['approved_at' => 'datetime'];

    public function scheme()
    {
        return $this->belongsTo(CertificationScheme::class, 'certification_scheme_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
