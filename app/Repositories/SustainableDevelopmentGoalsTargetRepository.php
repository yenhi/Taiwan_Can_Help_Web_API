<?php


namespace App\Repositories;


use App\Entities\SustainableDevelopmentGoalsTarget;

class SustainableDevelopmentGoalsTargetRepository
{
    public function model()
    {
        return SustainableDevelopmentGoalsTarget::query();
    }
}