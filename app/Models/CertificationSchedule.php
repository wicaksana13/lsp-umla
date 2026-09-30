<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificationSchedule extends Model
{
    protected $fillable = [
        'title', 'certification_scheme_id', 'tuk_id', 'assessor_id',
        'date', 'start_time', 'end_time', 'mode', 'quota', 'status', 'notes'
    ];

    protected $casts = ['date' => 'date'];

    public function scheme() { return $this->belongsTo(CertificationScheme::class, 'certification_scheme_id'); }
    public function tuk() { return $this->belongsTo(Tuk::class); }
    public function assessor() { return $this->belongsTo(User::class, 'assessor_id'); }
}
