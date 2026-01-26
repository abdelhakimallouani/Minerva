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

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM classes WHERE id_classe = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return null;

        return new ClassEntity(
            $data['id_classe'],
            $data['name'],
            $data['id_teacher'],
            $data['created_at']
        );
    }

    public function getStudents($classId)
    {
        $stmt = $this->db->prepare("
            SELECT users.id_user, users.name, users.email
            FROM class_students
            JOIN users ON users.id_user = class_students.student_id
            WHERE class_students.id_classe = ?
        ");
        $stmt->execute([$classId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertWork($classId, $teacherId, $title, $description, $file) {
        $sql = "INSERT INTO works (title, description, file_path, id_classe, id_teacher, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $title,
            $description,
            $file,
            $classId,
            $teacherId
        ]);
        
        return $this->db->lastInsertId(); 
    }

    public function assignWorkToStudent($workId, $studentId) {
        $sql = "INSERT INTO work_assignments (id_work, student_id) VALUES (?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $workId,
            $studentId
        ]);
    }

    public function findStudentsByClass($classId) {
        $sql = "SELECT u.id_user as id, u.name 
                FROM users u 
                JOIN class_students cs ON u.id_user = cs.student_id 
                WHERE cs.id_classe = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$classId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findWorksByClass($classId) {
    $sql = "SELECT * FROM works WHERE id_classe = ? ORDER BY created_at DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$classId]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

}
