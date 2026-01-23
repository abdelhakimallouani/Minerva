<?php

namespace App\models\Services;

use App\Models\Repositories\UserRepository;
use App\Models\Repositories\ClassStudentRepository;
use App\Models\Repositories\AttendanceRepository;
use App\Models\Entities\User;
use App\Mail\Mailer;

class StudentService
{
    private UserRepository $userRepo;
    private ClassStudentRepository $classStudentRepo;
    private AttendanceRepository $attendanceRepo;
    private Mailer $mailer;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->classStudentRepo = new ClassStudentRepository();
        $this->attendanceRepo = new AttendanceRepository();
        $this->mailer = new Mailer();
    }

    public function createStudent($classId, $name, $email, $status)
    {
        $generatedPassword = substr(md5(rand()), 0, 8);
        $hashed = password_hash($generatedPassword, PASSWORD_BCRYPT);

        $student = new User(null, $name, $email, $hashed, 'student');
        $studentId = $this->userRepo->createstd($student);

        $this->classStudentRepo->attach($classId, $studentId);

        $this->attendanceRepo->mark($classId, $studentId, $status);

        $this->mailer->send($email, $generatedPassword);

    }
}
