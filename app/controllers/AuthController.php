<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        session_start();
        $this->authService = new AuthService();
    }

    public function loginForm()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        $user = $this->authService->login(
            $_POST['email'],
            $_POST['password']
        );

        if (!$user) {
            $this->view('auth/login', ['error' => 'Identifiants invalides']);
            return;
        }

        $_SESSION['user'] = [
            'id' => $user->getId(),
            'role' => $user->getRole(),
            'name' => $user->getName()
        ];

        if ($user->getRole() === 'teacher') {
            $this->redirect('/teacher/dashboard');
        } else {
            $this->redirect('/student/dashboard');
        }
    }

    public function registerForm()
    {
        $this->view('auth/register');
    }

    public function register()
    {
        $this->authService->register(
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            $_POST['role']
        );

        $this->redirect('/login');
    }
}
