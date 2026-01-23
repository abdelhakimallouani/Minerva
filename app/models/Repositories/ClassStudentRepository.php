<?php
namespace App\Models\Repositories;

use App\Core\BaseModel;

class ClassStudentRepository extends BaseModel
{
    public function attach($classId, $studentId)
    {
        $stmt = $this->db->prepare("
            INSERT INTO class_students (id_classe, student_id)
            VALUES (?, ?)
        ");
        $stmt->execute([$classId, $studentId]);
    }
}
