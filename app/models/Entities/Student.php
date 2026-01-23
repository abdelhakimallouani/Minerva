<?php

use App\Models\Entities\User;

class Student extends User
{
    private $attendance_status;

    public function __construct($id_user, $name, $email, $password, $attendance_status = null)
    {
        parent::__construct($id_user, $name, $email, $password, 'student');
        $this->attendance_status = $attendance_status;
    }

    public function getAttendanceStatus()
    {
        return $this->attendance_status;
    }
    public function setAttendanceStatus($status)
    {
        $this->attendance_status = $status;
    }
}
