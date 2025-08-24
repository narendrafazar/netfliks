<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'video_url',
        'thumbnail',
        'rating',
        'is_featured',
    ];
}
