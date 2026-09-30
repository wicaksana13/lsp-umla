<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'staff_type',
    'nim',
    'phone',
    'photo',
    'assessor_no',
    'is_active'
])]

#[Hidden([
    'password',
    'remember_token'
])]

class User extends Authenticatable
{
    /**
     * @use HasFactory<UserFactory>
     */
    use HasFactory, Notifiable;


    /**
     * Attribute casting.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

            'is_active' => 'boolean',

        ];
    }






    /**
     * Relasi pendaftaran sertifikasi
     */
    public function registrations()
    {
        return $this->hasMany(ParticipantRegistration::class);
    }



    /**
     * Cek apakah user super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }



    /**
     * Cek apakah user staff
     */
    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }



    /**
     * Cek apakah user asesor
     */
    public function isAsesor(): bool
    {
        return $this->role === 'staff'
            && $this->staff_type === 'asesor';
    }



    /**
     * Cek apakah user admin LSP
     */
    public function isAdminLsp(): bool
    {
        return $this->role === 'staff'
            && $this->staff_type === 'admin_lsp';
    }



    /**
     * Cek apakah user peserta
     */
    public function isParticipant(): bool
    {
        return $this->role === 'participant';
    }
    public function certificates()
    {
        return $this->hasMany(
            Certificate::class,
            'participant_id'
        );
    }



    public function assessmentRegistrations()
    {
        return $this->hasMany(
            AssessmentRegistration::class,
            'participant_id'
        );
    }
    public function assessmentAsParticipant()
{
    return $this->hasMany(
        AssessmentRegistration::class,
        'participant_id'
    );
}
}