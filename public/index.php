<?php

require_once __DIR__ . '/../app/Core/Database.php';

use App\Core\Database;

$db = Database::getInstance()->getConnection();

if ($db) {
    echo "bon connexion";
}
