<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class ApiResponse implements Responsable
{
    const STATUS_CODE_SUCCESS = 0x00000000;
    const STATUS_MESSAGE_SUCCESS = 'Success';

    private $payload;
    private $statusCode;
    private $message;

    public function __construct(
        $payload,
        $statusCode = self::STATUS_CODE_SUCCESS,
        $message = self::STATUS_MESSAGE_SUCCESS
    ) {
        $this->payload = $payload;
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    public function toResponse($request)
    {
        $response = [
            'status_code' => sprintf('0x%08X', $this->statusCode),
            'message' => $this->message,
            'result' => $this->payload,
        ];

        return response($response)
            ->header('Content-Type', 'application/json');
    }
}
