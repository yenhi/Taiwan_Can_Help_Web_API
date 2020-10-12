<?php


namespace App\Repositories;


use App\Entities\HomepageCarousel;

class HomepageCarouselRepository
{
    public function model()
    {
        return HomepageCarousel::query();
    }

    public function getCurrentReleaseHomepageCarousels()
    {
        return $this->model()
            ->where('release_start_at', '<=', now())
            ->where('release_end_at', '>=', now())
            ->where('enabled', true)
            ->orderBy('display_order')
            ->get();
    }
}