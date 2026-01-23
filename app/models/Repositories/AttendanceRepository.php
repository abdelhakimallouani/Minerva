<?php
namespace App\Models\Repositories;

use App\Core\BaseModel;

class AttendanceRepository extends BaseModel
{
    public function mark($classId, $studentId, $status)
    {
        $stmt = $this->db->prepare("
            INSERT INTO attendance (id_classe, student_id, status, date)
            VALUES (?, ?, ?, CURDATE())
        ");
        $stmt->execute([$classId, $studentId, $status]);
    }
}
