<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'image_path',
        'url',
        'display_order',
    ];
}
