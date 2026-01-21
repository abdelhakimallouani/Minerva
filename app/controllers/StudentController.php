<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Auth;

class StudentController extends BaseController
{
    public function dashboard()
    {
        // Verification authentification + role
        Auth::checkRole('student');

        // Vue dashboard etudiant
        $this->view('student/dashboard');
    }
}
