<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'participant_id', 'certification_scheme_id', 'certificate_no',
        'issued_at', 'expires_at', 'file_path', 'status', 'created_by'
    ];

    protected $casts = ['issued_at' => 'date', 'expires_at' => 'date'];

    public function participant() { return $this->belongsTo(User::class, 'participant_id'); }
    public function scheme() { return $this->belongsTo(CertificationScheme::class, 'certification_scheme_id'); }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
}
