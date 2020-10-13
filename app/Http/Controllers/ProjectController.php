<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Responses\ApiResponse;
use App\Repositories\ProjectRepository;
use App\Transformers\ImagePathTransformer;
use App\Transformers\SearchResultTransformer;
use App\Transformers\SdgTargetsResultTransformer;

class ProjectController extends Controller
{
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function search(Request $request)
    {
        $numberPerPage = $request->input('number_per_page', 3);
        $sdgCodes = $request->input('sdg_codes', null);
        $sdgCodes = $sdgCodes ? explode('|', $sdgCodes) : [];

        $attributes = [
            'sdg_codes' => $sdgCodes,
            'unit_type' => $request->input('unit_type', null),
        ];

        $result = $this->projectRepository->search($numberPerPage, $attributes);

        $experts = SearchResultTransformer::format($result, function ($expert) {
            return [
                'id' => $expert->id,
                'image_url' => ImagePathTransformer::getUrl($expert->image_path),
                'unit_type' => $expert->unitType->name,
                'unit_name' => $expert->unit_name,
                'summary' => $expert->summary,
                'goals_targets' => SdgTargetsResultTransformer::format($expert->sustainableDevelopmentGoalsTargets)
            ];
        });

        return new ApiResponse($experts);
    }

    public function find(int $id)
    {
        $expert = $this->projectRepository->find($id);

        throw_unless(
            $expert,
            new ApiException('查無此資料', ApiException::ERROR_CODE_PROJECT_NOT_FOUND)
        );

        $expert = [
            'id' => $expert->id,
            'date' => $expert->date,
            'image_url' => ImagePathTransformer::getUrl($expert->image_path),
            'unit_type' => $expert->unitType->name,
            'unit_name' => $expert->unit_name,
            'summary' => $expert->summary,
            'content' => $expert->content,
            'goals_targets' => SdgTargetsResultTransformer::format($expert->sustainableDevelopmentGoalsTargets)
        ];

        return new ApiResponse($expert);
    }
}
