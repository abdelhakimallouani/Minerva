<?php

namespace App\Models\Services;

use App\Models\Repositories\UserRepository;
use App\Models\Entities\User;

class AuthService
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function login($email,  $password)
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user) {
            return null;
        }

        if (!password_verify($password, $user->getPassword())) {
            return null;
        }

        return $user;
    }

    public function register($name,  $email,  $password,  $role)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = new User(
            null,
            $name,
            $email,
            $hashedPassword,
            $role
        );

        return $this->userRepo->create($user);
    }
}
