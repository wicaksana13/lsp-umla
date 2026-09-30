<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuk extends Model
{
    protected $table = 'tuks';
    protected $fillable = ['name', 'type', 'address', 'city', 'contact_name', 'phone', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
