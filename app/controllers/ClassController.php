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

    // afficher classes
    public function index()
    {
        $teacherId = $_SESSION['user']['id'];

        $classes = $this->classService->getTeacherClasses($teacherId);

        $this->view('teacher/classes', [
            'classes' => $classes
        ]);
    }

    public function show($id)
    {
        $class = $this->classService->getClassDetails($id);
        $students = $this->classService->getClassStudents($id);

        $this->view('teacher/showclasse', [
            'class' => $class,
            'students' => $students
        ]);
    }
    public function works($id)
    {
        $works = []; 

        require_once __DIR__ . '/../views/teacher/works.php';
    }


    
}
