<?php

namespace App\Services;

interface IUserService
{
    public function getByEmail(string $email);
    public function getByToken(string $token);
}
