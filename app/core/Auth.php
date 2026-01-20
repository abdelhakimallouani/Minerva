<?php

namespace App\Core;

class Auth
{
    public static function check()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    public static function checkRole( $role)
    {
        self::check();

        if ($_SESSION['user']['role'] !== $role) {
            http_response_code(403);
            echo "403 - Accès interdit";
            exit;
        }
    }
}
