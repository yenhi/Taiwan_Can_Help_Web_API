<?php


namespace App\Repositories;


use App\Entities\Project;

class ProjectRepository
{
    public function model()
    {
        return Project::query();
    }

    public function search(int $numberPerPage)
    {
        return $this->model()
            ->with('sustainableDevelopmentGoalsTargets')
            ->paginate($numberPerPage);
    }

    public function find(int $id)
    {
        return $this->model()
            ->with('sustainableDevelopmentGoalsTargets')
            ->find($id);
    }
}