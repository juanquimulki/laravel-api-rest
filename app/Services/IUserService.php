<?php

namespace App\Services;

use App\Models\User;

interface IUserService
{
    public function getByEmail(string $email): User;
    public function getByToken(string $token): User;
}
