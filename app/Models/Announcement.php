<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'excerpt', 'body', 'image_path', 'published_at', 'is_published'];
    protected $casts = ['published_at' => 'datetime', 'is_published' => 'boolean'];
}
