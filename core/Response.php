<?php

namespace app\core;

class Response
{
    public const HTTP_OK = 200;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_SERVER_ERROR = 500;
    public const HTTP_UNAUTHORIZED = 401;

    public function __construct()
    {
    }

    public function setStatusCode(int $statusCode)
    {
        http_response_code($statusCode);
    }
}