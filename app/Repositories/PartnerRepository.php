<?php


namespace App\Repositories;


use App\Entities\Partner;

class PartnerRepository
{
    public function model()
    {
        return Partner::query();
    }

    public function getCurrentReleasePartners()
    {
        return $this->model()
            ->orderBy('display_order')
            ->get();
    }
}