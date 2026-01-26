<?php

namespace App\Models\Services;

use App\Models\Repositories\ClassRepository;
use App\Models\Entities\ClassEntity;

class ClassService
{
    private $classRepo;

    public function __construct()
    {
        $this->classRepo = new ClassRepository();
    }

    public function createClass($name, $teacherId)
    {
        $class = new ClassEntity();
        $class->setName($name);
        $class->setIdTeacher($teacherId);

        return $this->classRepo->create($class);
    }

    public function getTeacherClasses($teacherId)
    {
        return $this->classRepo->findByTeacher($teacherId);
    }

    public function getClassDetails($classId)
    {
        return $this->classRepo->findById($classId);
    }

    public function getClassStudents($classId) {
        return $this->classRepo->findStudentsByClass($classId);
    }

    public function saveWorkWithAssignments($classId, $teacherId, $title, $description, $file, $studentIds) {
       
        $workId = $this->classRepo->insertWork($classId, $teacherId, $title, $description, $file);

        if ($workId && !empty($studentIds)) {
            foreach ($studentIds as $studentId) {
                $this->classRepo->assignWorkToStudent($workId, $studentId);
            }
        }
        return $workId;
    }
    public function getWorksByClass($classId) {
        return $this->classRepo->findStudentsByClass($classId);
    }
}

