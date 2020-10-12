<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Repositories\EpaperRepository;
use App\Http\Requests\EpaperSubscriptionRequest;

class EpaperController extends Controller
{
    private $epaperRepository;

    public function __construct(EpaperRepository $epaperRepository)
    {
        $this->epaperRepository = $epaperRepository;
    }

    public function subscription(EpaperSubscriptionRequest $request)
    {
        $email = $request->input('email');
        $this->epaperRepository->subscription($email);

        return new ApiResponse(null);
    }
}
