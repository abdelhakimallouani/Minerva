<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Auth;

class TeacherController extends BaseController
{
    public function dashboard()
    {
        // Verification authentification + role
        Auth::checkRole('teacher');

        // Vue dashboard enseignant
        $this->view('teacher/dashboard');
    }
}
