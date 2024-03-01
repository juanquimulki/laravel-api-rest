<?php

namespace App\DataTransferObjects;

class LoginData {

    public ?string $token;
    public string  $statusCode;

    public function __construct(?string $token, string $statusCode = null)
    {
        $this->token      = $token;
        $this->statusCode = $statusCode;
    }
}
