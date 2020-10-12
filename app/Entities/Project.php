<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'id',
        'unit_type',
        'unit_name',
        'image_path',
        'date',
        'summary',
        'content',
        'display_order',
    ];

    public function sustainableDevelopmentGoalsTargets()
    {
        return $this->belongsToMany(
            SustainableDevelopmentGoalsTarget::class,
            'projects_sustainable_development_goal_targets'
        );
    }
}
