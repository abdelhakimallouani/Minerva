<?php
namespace App\Controllers;

use App\Core\Database;

class WorkController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();            
        }
    }

    private function checkRole($role)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
            header('Location: /auth/login');
            exit;
        }
    }

    public function index()
    {
        $this->checkRole('teacher');
        $teacherId = $_SESSION['user']['id_user'];

 
        $stmt = $this->db->prepare(
            "SELECT w.*, c.name as class_name 
             FROM works w 
             JOIN classes c ON w.id_classe = c.id_classe 
             WHERE w.id_teacher = ? 
             ORDER BY w.created_at DESC"
        );
        $stmt->execute([$teacherId]);


        $works = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/teacher/works.php';
    }

    public function create()
    {
        $this->checkRole('teacher');
        $teacherId = $_SESSION['user']['id_user'];
        $classes = $this->db->query(
            "SELECT * FROM classes WHERE id_teacher = ?",
            [$teacherId]
        )->fetchAll();

        include __DIR__ . '/../views/teacher/create_work.php';
    }

    private function uploadFile($fileInput, $folder)
    {
        if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] === 0) {
            $uploadDir = __DIR__ . "/../uploads/$folder/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileName = time() . '_' . basename($_FILES[$fileInput]['name']);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES[$fileInput]['tmp_name'], $filePath)) {
                return "/uploads/$folder/" . $fileName;
            }
        }
        return null;
    }
    public function store()
    {
        $this->checkRole('teacher');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $classId = $_POST['class_id'];
            $teacherId = $_SESSION['user']['id_user'];
            $filePath = $this->uploadFile('file', 'works');

            $this->db->query(
                "INSERT INTO works (title, description, file_path, id_classe, id_teacher) 
                VALUES (?, ?, ?, ?, ?)",
                [$title, $description, $filePath, $classId, $teacherId]
            );

            $workId = $this->db->lastInsertId();

            $students = $this->db->query(
                "SELECT student_id FROM class_students WHERE id_classe = ?",
                [$classId]
            )->fetchAll();

            foreach ($students as $s) {
                $this->db->query(
                    "INSERT INTO work_assignments (id_work, student_id) VALUES (?, ?)",
                    [$workId, $s['student_id']]
                );
            }

            $_SESSION['success'] = 'Travail créé avec succès';
            header('Location: /work/index');
        }
    }
    public function studentWorks()
    {
        $this->checkRole('student');
        $studentId = $_SESSION['user']['id_user'];

        $works = $this->db->query(
            "SELECT w.*, c.name as class_name, 
                    (SELECT COUNT(*) FROM submissions s 
                    WHERE s.id_work = w.id_work AND s.student_id = ?) as submitted
            FROM works w
            JOIN work_assignments wa ON w.id_work = wa.id_work
            JOIN classes c ON w.id_classe = c.id_classe
            WHERE wa.student_id = ?
            ORDER BY w.created_at DESC",
            [$studentId, $studentId]
        )->fetchAll();

        include __DIR__ . '/../views/student/works.php';
    }

        public function submit($workId)
    {
        $this->checkRole('student');
        $studentId = $_SESSION['user']['id_user'];

        $assigned = $this->db->query(
            "SELECT COUNT(*) as count FROM work_assignments WHERE id_work = ? AND student_id = ?",
            [$workId, $studentId]
        )->fetch()['count'];

        if ($assigned == 0) {
            $_SESSION['error'] = 'Travail non assigné';
            header('Location: /work/studentWorks');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'];
            $filePath = $this->uploadFile('file', 'submissions');

            $this->db->query(
                "INSERT INTO submissions (id_work, student_id, content, file_path) 
                 VALUES (?, ?, ?, ?)",
                [$workId, $studentId, $content, $filePath]
            );

            $_SESSION['success'] = 'Travail soumis avec succès';
            header('Location: /work/studentWorks');
        } else {
            $work = $this->db->query("SELECT * FROM works WHERE id_work = ?", [$workId])->fetch();
            include __DIR__ . '/../views/student/submit_work.php';
        }
    }

}
