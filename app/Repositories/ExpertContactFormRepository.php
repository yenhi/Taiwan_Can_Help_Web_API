<?php


namespace App\Repositories;


use App\Entities\ExpertContactForm;

class ExpertContactFormRepository
{
    public function model()
    {
        return ExpertContactForm::query();
    }

    public function create(array $attributes)
    {
        return $this->model()->create($attributes);
    }
}