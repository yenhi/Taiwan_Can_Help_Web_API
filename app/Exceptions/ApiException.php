<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $code;

    /**
     * @param string $message
     * @param string|int $code
     */
    public function __construct($message, $code = self::ERROR_CODE_UNKNOWN)
    {
        $this->message = $message;
        $this->code = is_string($code) ? hexdec($code) : $code;
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | General Error Codes
    |-------------------------------------------------------------------------------------------------------------------
    */
    const ERROR_CODE_UNKNOWN = 0x00000001;
    const ERROR_CODE_VALIDATION_EXCEPTION = 0x00000002;

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Experts Error Codes
    |-------------------------------------------------------------------------------------------------------------------
    */
    const ERROR_CODE_EXPERTS_NOT_FOUND = 0x00010001;

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Project Error Codes
    |-------------------------------------------------------------------------------------------------------------------
    */
    const ERROR_CODE_PROJECT_NOT_FOUND = 0x00020001;

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Sustainable Development Goal Error Codes
    |-------------------------------------------------------------------------------------------------------------------
    */
    const ERROR_CODE_SUSTAINABLE_DEVELOPMENT_GOAL_NOT_FOUND = 0x00030001;
}
