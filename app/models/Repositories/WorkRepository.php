<?php
namespace App\Repositories;

use App\Entities\Work;
use PDO;

class WorkRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findByTeacher(int $teacherId): array
    {
        $stmt = $this->db->prepare(
            "SELECT w.*, c.name AS class_name
             FROM works w
             JOIN classes c ON w.id_classe = c.id_classe
             WHERE w.id_teacher = ?
             ORDER BY w.created_at DESC"
        );
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(Work $work): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO works (title, description, file_path, id_classe, id_teacher)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $work->getTitle(),
            $work->getDescription(),
            $work->getFilePath(),
            $work->getClassId(),
            $work->getTeacherId()
        ]);
    }
}
?>