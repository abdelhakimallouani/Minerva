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
        $_SESSION['current_class_id'] = $id; 

        $class = $this->classService->getClassDetails($id);
        $students = $this->classService->getClassStudents($id);

        $this->view('teacher/showclasse', [
            'class' => $class,
            'students' => $students
        ]);
    }
    public function works()
    {
        $classId = $_SESSION['current_class_id'] ?? null;

        if (!$classId) {
            $this->redirect('/teacher/classes');
            exit;
        }

        $works = $this->classService->getWorksByClass($classId);
        $this->view('teacher/works', ['works' => $works]);
    }

    public function addStudentForm($classId)
    {
        $this->view('teacher/addstudent', [$classId]);
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


    public function createWork() {

        $classId = $_SESSION['current_class_id'] ?? null;

        if (!$classId) {
            $this->redirect('/teacher/classes'); 
            exit;
        }

        $students = $this->classService->getClassStudents($classId);
        require_once __DIR__ . '/../views/teacher/addwork.php';
    }

    public function storeWork()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /teacher/dashboard");
            exit;
        }

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $classId = $_POST['class_id'] ?? null;
        $studentIds = $_POST['student_ids'] ?? [];
        $teacherId = $_SESSION['user']['id'] ?? null;

        if (!$title || !$classId || !$teacherId) {
            if (!$classId) {
                die("Error: Class ID is missing!");
            }
           $this->redirect("/teacher/works");
            exit;
        }

        $fileName = null;

        if (!empty($_FILES['file']['name']) && $_FILES['file']['error'] === 0) {
            $uploadDir = __DIR__ . '/../../public/uploads/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fileName);
        }

        $this->classService->saveWorkWithAssignments(
            $classId,
            $teacherId,
            $title,
            $description,
            $fileName,
            $studentIds
        );

        $_SESSION['success_msg'] = "Le travail a été ajouté avec succès !";
        $this->redirect("/teacher/works");
        exit;
    }
}
