<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectsSustainableDevelopmentGoalTarget extends Model
{
    protected $fillable = [
        'project_id',
        'sustainable_development_goals_target_id',
    ];
}
