<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\Services\AuthService;

class AuthController extends BaseController
{
    private AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function loginForm()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        $user = $this->auth->login($_POST['email'], $_POST['password']);

        if (!$user) {
            $this->view('auth/login', ['error' => 'Email ou mot de passe incorrect']);
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

    // register teacher 
    public function registerForm()
    {
        $this->view('auth/register');
    }

    public function register()
    {
        $this->auth->registerTeacher(
            $_POST['name'],
            $_POST['email'],
            $_POST['password']
        );

        $this->redirect('/login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->redirect('/login');
        exit;
    }
}
