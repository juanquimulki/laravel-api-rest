<?php

namespace App\Services;

use App\Models\User;

interface _IUserService
{
    public function getByEmail(string $email): User;
    public function getByToken(string $token): User;
}
