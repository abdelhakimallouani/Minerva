<?php

use App\Models\Entities\User;

class Teacher extends User
{
    public function __construct($id_user, $name, $email, $password)
    {
        parent::__construct($id_user, $name, $email, $password, 'teacher');
    }
}
