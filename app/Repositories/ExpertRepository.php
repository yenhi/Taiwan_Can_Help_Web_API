<?php


namespace App\Repositories;


use App\Entities\Expert;

class ExpertRepository
{
    public function model()
    {
        return Expert::query();
    }

    public function search(int $numberPerPage, array $attributes)
    {
        $sdgCodes = $attributes['sdg_codes'];
        $unitType = $attributes['unit_type'];

        return $this->model()
            ->select(['experts.*'])
            ->with('sustainableDevelopmentGoals')
            ->when($unitType, function ($query) use ($unitType) {
                $query->where('experts.unit_type', $unitType);
            })
            ->when(count($sdgCodes), function ($query) use ($sdgCodes) {
                $query->leftJoin(
                    'experts_sustainable_development_goals',
                    'experts.id',
                    '=',
                    'experts_sustainable_development_goals.expert_id')
                    ->whereIn('experts_sustainable_development_goals.sustainable_development_goal_id', $sdgCodes);
            })
            ->paginate($numberPerPage);
    }

    public function find(int $id)
    {
        return $this->model()
            ->with('sustainableDevelopmentGoals')
            ->find($id);
    }

}