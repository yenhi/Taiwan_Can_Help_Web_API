<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Responses\ApiResponse;
use App\Repositories\ExpertRepository;
use App\Transformers\ImagePathTransformer;
use App\Transformers\SdgsResultTransformer;
use App\Transformers\SearchResultTransformer;

class ExpertController extends Controller
{
    private $expertRepository;

    public function __construct(ExpertRepository $expertRepository)
    {
        $this->expertRepository = $expertRepository;
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

        $result = $this->expertRepository->search($numberPerPage, $attributes);

        $experts = SearchResultTransformer::format($result, function ($expert) {
            return [
                'id' => $expert->id,
                'image_url' => ImagePathTransformer::getUrl($expert->image_path),
                'unit_type' => $expert->unitType->name,
                'unit_name' => $expert->unit_name,
                'summary' => $expert->summary,
                'sgd_items' => SdgsResultTransformer::format($expert->sustainableDevelopmentGoals),
            ];
        });

        return new ApiResponse($experts);
    }

    public function find(int $id)
    {
        $expert = $this->expertRepository->find($id);

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
            'intro' => nl2br($expert->intro),
            'solution' => nl2br($expert->solution),
            'url' => $expert->url,
            'sgd_items' => SdgsResultTransformer::format($expert->sustainableDevelopmentGoals),
        ];

        return new ApiResponse($expert);
    }
}
