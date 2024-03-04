<?php

namespace App\Services;

use App\Services\_IUserService as IUserService;
use App\Repositories\UserRepository;
use App\Models\User;

class UserService implements IUserService {

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getByEmail(string $email): User
    {
        return $this->userRepository->getFirstByEmail($email);
    }

    public function getByToken(string $token): User
    {
        return User::getByToken($token);
    }
}
