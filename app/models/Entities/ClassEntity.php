<?php

namespace App\Models\Entities;

class ClassEntity
{
    private $id_classe;
    private $name;
    private $id_teacher;
    private $created_at;

    public function __construct($id_classe = null, $name = null, $id_teacher = null, $created_at = null)
    {
        $this->id_classe = $id_classe;
        $this->name = $name;
        $this->id_teacher = $id_teacher;
        $this->created_at = $created_at;
    }

    // Getters
    public function getIdClasse()
    {
        return $this->id_classe;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIdTeacher()
    {
        return $this->id_teacher;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    // Setters
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setIdTeacher($id_teacher)
    {
        $this->id_teacher = $id_teacher;
    }
}
