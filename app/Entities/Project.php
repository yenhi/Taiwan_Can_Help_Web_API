<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'id',
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

    public function sustainableDevelopmentGoalsTargets()
    {
        return $this->belongsToMany(
            SustainableDevelopmentGoalsTarget::class,
            'projects_sustainable_development_goal_targets'
        );
    }
}
