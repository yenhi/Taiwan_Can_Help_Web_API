<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class HomepageCarousel extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'url',
        'release_start_at',
        'release_end_at',
        'enabled',
        'display_order',
    ];
}
