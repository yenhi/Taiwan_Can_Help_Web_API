<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Responses\ApiResponse;
use App\Transformers\ImagePathTransformer;
use App\Transformers\SearchResultTransformer;
use App\Repositories\SustainableDevelopmentGoalRepository;

class SustainableDevelopmentGoalController extends Controller
{
    private $sustainableDevelopmentGoalRepository;

    public function __construct(SustainableDevelopmentGoalRepository $sustainableDevelopmentGoalRepository)
    {
        $this->sustainableDevelopmentGoalRepository = $sustainableDevelopmentGoalRepository;
    }

    public function search(Request $request)
    {
        $numberPerPage = $request->input('number_per_page', 3);
        $sustainableDevelopmentGoals = $this->sustainableDevelopmentGoalRepository->search($numberPerPage);

        $sustainableDevelopmentGoals = SearchResultTransformer::format($sustainableDevelopmentGoals,
            function ($sustainableDevelopmentGoal) {
                return [
                    'id' => $sustainableDevelopmentGoal->id,
                    'sdg_target_code' => $sustainableDevelopmentGoal->code,
                    'image_url' => ImagePathTransformer::getUrl($sustainableDevelopmentGoal->image_path),
                    'color_code' => $sustainableDevelopmentGoal->color_code,
                    'name' => $sustainableDevelopmentGoal->name,
                ];
            });

        return new ApiResponse($sustainableDevelopmentGoals);
    }

    public function find(int $id)
    {
        $sustainableDevelopmentGoal = $this->sustainableDevelopmentGoalRepository->find($id);

        throw_unless(
            $sustainableDevelopmentGoal,
            new ApiException('查無此資料', ApiException::ERROR_CODE_SUSTAINABLE_DEVELOPMENT_GOAL_NOT_FOUND)
        );

        $sustainableDevelopmentGoal = [
            'id' => $sustainableDevelopmentGoal->id,
            'sdg_target_code' => $sustainableDevelopmentGoal->code,
            'image_url' => ImagePathTransformer::getUrl($sustainableDevelopmentGoal->image_path),
            'color_code' => $sustainableDevelopmentGoal->color_code,
            'name' => $sustainableDevelopmentGoal->name,
            'summary' => $sustainableDevelopmentGoal->summary,
            'title' => $sustainableDevelopmentGoal->title,
            'content' => nl2br($sustainableDevelopmentGoal->content),
            'goals_targets' => $sustainableDevelopmentGoal->sustainableDevelopmentGoalsTargets
                ->map(function ($sustainableDevelopmentGoalsTarget) use ($sustainableDevelopmentGoal) {
                    return [
                        'goals_target_code' => $sustainableDevelopmentGoalsTarget->code,
                        'color_code' => $sustainableDevelopmentGoal->color_code,
                        'name' => $sustainableDevelopmentGoalsTarget->name,
                        'content' => $sustainableDevelopmentGoalsTarget->content,
                    ];
                }),
        ];

        return new ApiResponse($sustainableDevelopmentGoal);
    }

    public function findByCode(string $code)
    {
        $sustainableDevelopmentGoal = $this->sustainableDevelopmentGoalRepository->findByCode($code);

        throw_unless(
            $sustainableDevelopmentGoal,
            new ApiException('查無此資料', ApiException::ERROR_CODE_SUSTAINABLE_DEVELOPMENT_GOAL_NOT_FOUND)
        );

        $sustainableDevelopmentGoal = [
            'id' => $sustainableDevelopmentGoal->id,
            'sdg_target_code' => $sustainableDevelopmentGoal->code,
            'image_url' => ImagePathTransformer::getUrl($sustainableDevelopmentGoal->image_path),
            'color_code' => $sustainableDevelopmentGoal->color_code,
            'name' => $sustainableDevelopmentGoal->name,
            'summary' => $sustainableDevelopmentGoal->summary,
            'title' => $sustainableDevelopmentGoal->title,
            'content' => nl2br($sustainableDevelopmentGoal->content),
            'goals_targets' => $sustainableDevelopmentGoal->sustainableDevelopmentGoalsTargets
                ->map(function ($sustainableDevelopmentGoalsTarget) use ($sustainableDevelopmentGoal) {
                    return [
                        'goals_target_code' => $sustainableDevelopmentGoalsTarget->code,
                        'color_code' => $sustainableDevelopmentGoal->color_code,
                        'image_url' => ImagePathTransformer::getUrl($sustainableDevelopmentGoalsTarget->image_path),
                        'name' => $sustainableDevelopmentGoalsTarget->name,
                        'content' => nl2br($sustainableDevelopmentGoalsTarget->content),
                    ];
                }),
        ];

        return new ApiResponse($sustainableDevelopmentGoal);
    }
}
