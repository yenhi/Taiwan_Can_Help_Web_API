<?php


namespace App\Repositories;


use App\Entities\Expert;

class ExpertRepository
{
    public function model()
    {
        return Expert::query();
    }

    public function search(int $numberPerPage)
    {
        return $this->model()
            ->with('sustainableDevelopmentGoals')
            ->paginate($numberPerPage);
    }

    public function find(int $id)
    {
        return $this->model()
            ->with('sustainableDevelopmentGoals')
            ->find($id);
    }

}