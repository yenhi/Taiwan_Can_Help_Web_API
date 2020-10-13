<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'mapping_code',
        'name',
    ];
}
