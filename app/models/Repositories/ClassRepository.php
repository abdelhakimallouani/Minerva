<?php

namespace App\Models\Repositories;

use App\Core\BaseModel;
use App\Models\Entities\ClassEntity;
use PDO;

class ClassRepository extends BaseModel
{
    public function create(ClassEntity $class)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO classes (name, id_teacher) VALUES (?, ?)"
        );

        return $stmt->execute([
            $class->getName(),
            $class->getIdTeacher()
        ]);
    }

    public function findByTeacher($teacherId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM classes WHERE id_teacher = ?"
        );
        $stmt->execute([$teacherId]);

        $classes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $classes[] = new ClassEntity(
                $row['id_classe'],
                $row['name'],
                $row['id_teacher'],
                $row['created_at']
            );
        }

        return $classes;
    }
}
