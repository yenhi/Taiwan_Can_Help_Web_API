<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SustainableDevelopmentGoal extends Model
{
    protected $fillable = [
        'name',
        'code',
        'image_path',
        'color_code',
        'summary',
        'content',
        'display_order',
    ];

    public function experts()
    {
        return $this->belongsToMany(
            Expert::class,
            'experts_sustainable_development_goals'
        );
    }

    public function sustainableDevelopmentGoalsTargets()
    {
        return $this->hasMany(SustainableDevelopmentGoalsTarget::class);
    }
}
