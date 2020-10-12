<?php

namespace App\Exceptions;

use Exception;
use App\Http\Responses\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return ApiResponse|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|Response
     *
     */
    public function render($request, Exception $exception)
    {
        if ($request->is('api/*')) {
            $statusCode = $exception->getCode() == ApiResponse::STATUS_CODE_SUCCESS
                ? ApiException::ERROR_CODE_UNKNOWN
                : $exception->getCode();
            $message = $exception->getMessage();
            return (new ApiResponse(
                null,
                $statusCode,
                $message
            ))->toResponse($request);
        }

        return parent::render($request, $exception);
    }
}
