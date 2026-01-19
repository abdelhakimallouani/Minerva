<?php

require_once __DIR__ . '/../app/Core/Database.php';

use App\Core\Database;

$db = Database::getInstance()->getConnection();

if ($db) {
    echo "Bonne connexion <br><br>";

    $stmt = $db->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_NUM);

    if (count($tables) > 0) {
        echo "Liste des tables :<br>";
        foreach ($tables as $table) {
            echo "- " . $table[0] . "<br>";
        }
    }
}
