<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\Services\ClassService;

class ClassController extends BaseController
{
    private $classService;

    public function __construct()
    {
        $this->classService = new ClassService();
    }

    // afficher classes
    public function index()
    {
        // teacher connect
        $teacherId = $_SESSION['user']['id'];

        $classes = $this->classService->getTeacherClasses($teacherId);

        $this->view('teacher/classes', [
            'classes' => $classes
        ]);
    }

    // ajouter classe
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $teacherId = $_SESSION['user']['id'];

            $this->classService->createClass($name, $teacherId);

            $this->redirect('/teacher/classes');
        }

        $this->view('teacher/createclass');
    }
}
