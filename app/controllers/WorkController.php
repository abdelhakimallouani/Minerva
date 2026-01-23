<?php
namespace App\Controllers;

use App\Core\Database;
use App\Services\WorkService;
use App\Repositories\WorkRepository;

class WorkController
{
    private WorkService $service;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $db = Database::getInstance()->getConnection();
        $repository = new WorkRepository($db);
        $this->service = new WorkService($repository);
    }

    private function checkRole( $role)
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
        $works = $this->service->getWorksByTeacher($teacherId);

        include __DIR__ . '/../views/teacher/works.php';
    }

    public function store()
    {
        $this->checkRole('teacher');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->service->createWork(
                $_POST,
                $_SESSION['user']['id_user']
            );

            $_SESSION['success'] = 'Travail créé avec succès';
            header('Location: /work/index');
            exit;
        }
    }
}
