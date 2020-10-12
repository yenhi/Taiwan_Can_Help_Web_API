<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ExpertsSustainableDevelopmentGoal extends Model
{
    protected $fillable = [
        'expert_id',
        'sustainable_development_goal_id',
    ];
}
