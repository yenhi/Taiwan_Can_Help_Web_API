<?php


namespace App\Transformers;

use Illuminate\Database\Eloquent\Collection;

class SdgTargetsResultTransformer
{
    public static function format(Collection $sustainableDevelopmentGoalTargets)
    {
        return $sustainableDevelopmentGoalTargets
            ->map(function ($sustainableDevelopmentGoalTarget) {
                return [
                    'goals_target_code' => $sustainableDevelopmentGoalTarget->code,
                    'color_code' => $sustainableDevelopmentGoalTarget->sustainableDevelopmentGoal->color_code,
                ];
            });
    }
}