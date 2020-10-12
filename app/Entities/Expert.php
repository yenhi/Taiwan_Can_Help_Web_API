<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $fillable = [
        'unit_type',
        'unit_name',
        'image_path',
        'date',
        'summary',
        'content',
        'display_order',
    ];

    public function sustainableDevelopmentGoals()
    {
        return $this->belongsToMany(
            SustainableDevelopmentGoal::class,
            'experts_sustainable_development_goals'
        );
    }
}
