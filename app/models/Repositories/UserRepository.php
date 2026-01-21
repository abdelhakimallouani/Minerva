<?php

namespace App\Models\Repositories;

use App\Core\BaseModel;
use App\Models\Entities\User;
use PDO;

class UserRepository extends BaseModel
{
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return null;

        return new User(
            $data['id_user'],
            $data['name'],
            $data['email'],
            $data['password'],
            $data['role']
        );
    }

    public function create(User $user)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password, role)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->execute([
            $user->getName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRole()
        ]);

        $user->setId($this->db->lastInsertId());
        return $user;
    }
}
