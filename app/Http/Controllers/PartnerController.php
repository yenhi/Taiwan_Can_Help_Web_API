<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Repositories\PartnerRepository;
use App\Transformers\ImagePathTransformer;

class PartnerController extends Controller
{
    private $partnerRepository;

    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    public function get()
    {
        $partners = $this->partnerRepository->getCurrentReleasePartners()
            ->map(function ($partner) {
                return [
                    'id' => $partner->id,
                    'image_url' => ImagePathTransformer::getUrl($partner->image_path),
                    'name' => $partner->name,
                    'url' => $partner->url,
                ];
            });

        return new ApiResponse($partners);
    }
}
