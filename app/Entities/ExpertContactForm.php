<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ExpertContactForm extends Model
{
    protected $fillable = [
        'expert_id',
        'name',
        'email',
        'phone',
        'unit_and_job_title',
        'content',
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}
