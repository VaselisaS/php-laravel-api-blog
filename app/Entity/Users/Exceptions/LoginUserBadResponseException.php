<?php


namespace App\Entity\Users\Exceptions;


class LoginUserBadResponseException
{
    protected $statusCode;

    public function __construct($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getResponse()
    {
        if ($this->statusCode === 400) {
            return response()->json(__('validation.invalid_value'), $this->statusCode);
        } elseif ($this->statusCode === 401) {
            return response()->json(__('validation.invalid_credentials'), $this->statusCode);
        }
        return response()->json(__('server.exception_server'), $this->statusCode);
    }
}
