<?php

namespace App\Models\Entities;

class User
{
    private  $id;
    private $name;
    private $email;
    private $password;
    private $role;

    public function __construct(
        $id,
        $name,
        $email,
        $password,
        $role
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRole()
    {
        return $this->role;
    }

    // Setter
    public function setId($id)
    {
        $this->id = $id;
    }
}
