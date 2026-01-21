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
}
