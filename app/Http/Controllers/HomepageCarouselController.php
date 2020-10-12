<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Transformers\ImagePathTransformer;
use App\Repositories\HomepageCarouselRepository;

class HomepageCarouselController extends Controller
{
    private $homepageCarouselRepository;

    public function __construct(HomepageCarouselRepository $homepageCarouselRepository)
    {
        $this->homepageCarouselRepository = $homepageCarouselRepository;
    }

    public function get()
    {
        $homepageCarousels = $this->homepageCarouselRepository->getCurrentReleaseHomepageCarousels()
            ->map(function ($homepageCarousel) {
                return [
                    'id' => $homepageCarousel->id,
                    'image_url' => ImagePathTransformer::getUrl($homepageCarousel->image_path),
                    'title' => $homepageCarousel->title,
                    'url' => $homepageCarousel->url,
                ];
            });

        return new ApiResponse($homepageCarousels);
    }
}
