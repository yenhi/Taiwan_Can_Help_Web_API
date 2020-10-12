<?php


namespace App\Repositories;


use App\Entities\SustainableDevelopmentGoal;

class SustainableDevelopmentGoalRepository
{
    public function model()
    {
        return SustainableDevelopmentGoal::query();
    }

    public function search(int $numberPerPage)
    {
        return $this->model()
            ->paginate($numberPerPage);
    }

    public function find(int $id)
    {
        return $this->model()
            ->with('sustainableDevelopmentGoalsTargets')
            ->find($id);
    }
}