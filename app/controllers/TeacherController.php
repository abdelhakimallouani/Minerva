<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {
        // Verification authentification + role
        Auth::checkRole('teacher');

        // Vue dashboard enseignant
        $this->view('teacher/dashboard');
    }
}
