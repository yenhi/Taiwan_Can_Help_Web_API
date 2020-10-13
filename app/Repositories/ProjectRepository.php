<?php


namespace App\Repositories;


use App\Entities\Project;
use App\Entities\SustainableDevelopmentGoalsTarget;

class ProjectRepository
{
    public function model()
    {
        return Project::query();
    }

    public function search(int $numberPerPage, array $attributes)
    {
        $sdgCodes = $attributes['sdg_codes'];
        $unitType = $attributes['unit_type'];

        $sustainableDevelopmentGoalsTargetIds = $this->getSustainableDevelopmentGoalsTargetIdsBySdgCods($sdgCodes);

        return $this->model()
            ->select(['projects.*'])
            ->with('sustainableDevelopmentGoalsTargets')
            ->when($unitType, function ($query) use ($unitType) {
                $query->leftJoin(
                    'unit_types',
                    'projects.unit_type_id',
                    '=',
                    'unit_types.id'
                )->where('unit_types.mapping_code', $unitType);
            })
            ->when(count($sdgCodes), function ($query) use ($sdgCodes, $sustainableDevelopmentGoalsTargetIds) {
                $query->leftJoin(
                    'projects_sustainable_development_goal_targets',
                    'projects.id',
                    '=',
                    'projects_sustainable_development_goal_targets.project_id')
                    ->whereIn(
                        'projects_sustainable_development_goal_targets.sustainable_development_goals_target_id',
                        $sustainableDevelopmentGoalsTargetIds
                    );
            })
            ->paginate($numberPerPage);
    }

    public function find(int $id)
    {
        return $this->model()
            ->with('sustainableDevelopmentGoalsTargets')
            ->find($id);
    }

    private function getSustainableDevelopmentGoalsTargetIdsBySdgCods(array $sdgCodes)
    {
        if (!count($sdgCodes)) {
            return [];
        }
        return SustainableDevelopmentGoalsTarget::query()
            ->join(
                'sustainable_development_goals',
                'sustainable_development_goals.id',
                '=',
                'sustainable_development_goals_targets.sustainable_development_goal_id'
            )
            ->select(['sustainable_development_goals_targets.*'])
            ->whereIn('sustainable_development_goals.code', $sdgCodes)
            ->get()
            ->pluck('id');
    }
}