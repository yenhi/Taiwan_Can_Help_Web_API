<?php


namespace App\Transformers;

use Illuminate\Database\Eloquent\Collection;

class SdgsResultTransformer
{
    public static function format(Collection $sustainableDevelopmentGoals)
    {
        return $sustainableDevelopmentGoals
            ->map(function ($sustainableDevelopmentGoal) {
                return [
                    'sdg_target_code' => $sustainableDevelopmentGoal->code,
                    'color_code' => $sustainableDevelopmentGoal->color_code,
                ];
            });
    }
}