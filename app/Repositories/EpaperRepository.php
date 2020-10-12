<?php


namespace App\Repositories;


use App\Entities\Epaper;

class EpaperRepository
{
    public function model()
    {
        return Epaper::query();
    }

    public function subscription(string $email)
    {
        $attributes = [
            'email' => $email
        ];
        $this->model()->updateOrCreate($attributes, $attributes);
    }
}