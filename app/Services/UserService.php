<?php

namespace App\Services;

use App\Repositories\UserRepository;

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
}
