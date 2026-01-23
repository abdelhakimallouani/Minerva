<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\Services\ClassService;
use App\models\Services\StudentService;

class ClassController extends BaseController
{
    private ClassService $classService;
    private StudentService $studentService;

    public function __construct()
    {
        $this->classService = new ClassService();
        $this->studentService = new StudentService();
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


    public function addStudentForm($classId)
    {
        $this->view('teacher/addstudent', ['classId' => $classId]);
    }

    public function storeStudent($classId)
    {
        $this->studentService->createStudent(
            $classId,
            $_POST['name'],
            $_POST['email'],
            $_POST['status']
        );

        $this->redirect("/teacher/classes/$classId");
        exit;
    }
}
