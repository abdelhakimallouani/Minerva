<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        // Verification authentification + role
        Auth::checkRole('student');

        // Vue dashboard etudiant
        $this->view('student/dashboard');
    }
}
