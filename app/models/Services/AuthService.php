<?php

namespace App\Models\Services;

use App\Models\Repositories\UserRepository;
use App\Models\Entities\User;

class AuthService
{
    private UserRepository $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    // login teacher o student
    public function login( $email, $password)
    {
        $user = $this->repo->findByEmail($email);

        if (!$user) return null;

        if (!password_verify($password, $user->getPassword())) {
            return null;
        }

        return $user;
    }

    // register dyal teacher
    public function registerTeacher( $name,  $email,  $password): User
    {
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $teacher = new User(
            null,
            $name,
            $email,
            $hashed,
            'teacher'
        );

        return $this->repo->create($teacher);
    }

    // creer student by teacher
    public function createStudent( $name,  $email)
    {
        $generatedPassword = substr(md5(rand()), 0, 8);
        $hashed = password_hash($generatedPassword, PASSWORD_BCRYPT);

        $student = new User(
            null,
            $name,
            $email,
            $hashed,
            'student'
        );

        $this->repo->create($student);

        // ne7tajoha bach nsiftof f email
        return $generatedPassword;
    }
}
