<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SustainableDevelopmentGoalsTarget extends Model
{
    protected $fillable = [
        'sustainable_development_goal_id',
        'code',
        'title',
        'image_path',
        'content',
        'display_order',
    ];

    public function sustainableDevelopmentGoal()
    {
        return $this->belongsTo(SustainableDevelopmentGoal::class);
    }

    public function project()
    {
        return $this->belongsToMany(
            Project::class,
            'projects_sustainable_development_goal_targets'
        );
    }
}
