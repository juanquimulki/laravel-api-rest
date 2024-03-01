<?php

namespace App\Services;

use App\Services\IUserService;
use App\Repositories\UserRepository;
use App\Models\User;

class UserService implements IUserService {

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getByEmail(string $email)
    {
        return $this->userRepository->getFirstByEmail($email);
    }

    public function getByToken(string $token)
    {
        return User::getByToken($token);
    }
}
