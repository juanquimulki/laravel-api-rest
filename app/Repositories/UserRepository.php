<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function getFirstByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
