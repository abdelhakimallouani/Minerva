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

        if (!$data) {
            return null;
        }

        return new User(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['password'],
            $data['role']
        );
    }

    public function create(User $user): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([
            $user->getName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRole()
        ]);
    }
}
