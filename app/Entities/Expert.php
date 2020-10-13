<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $fillable = [
        'unit_type_id',
        'unit_name',
        'image_path',
        'date',
        'summary',
        'content',
        'display_order',
    ];

    public function unitType()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function sustainableDevelopmentGoals()
    {
        return $this->belongsToMany(
            SustainableDevelopmentGoal::class,
            'experts_sustainable_development_goals'
        );
    }
}
