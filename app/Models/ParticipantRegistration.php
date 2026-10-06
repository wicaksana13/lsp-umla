<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantRegistration extends Model
{
    protected $fillable = [
        'nim', 'name', 'email', 'phone', 'birth_date', 'password',
        'status', 'approved_by', 'approved_at', 'rejection_note'
    ];

    protected $casts = ['approved_at' => 'datetime'];

    // Fungsi scheme() dihapus

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}