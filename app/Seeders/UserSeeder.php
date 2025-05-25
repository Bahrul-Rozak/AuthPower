<?php

namespace AuthPower\Seeders;

use AuthPower\Helpers\Database;

class UserSeeder
{
    public static function run()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::getInstance($config['db'])->getConnection();

        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

        $name = "Ratna Sari Aida";
        $email = "ratna@example.com";
        $password = password_hash("sayang123", PASSWORD_BCRYPT);

        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
        ]);

        echo "Seeder: Dummy user created (ratna@example.com / sayang123)\n";
    }
}
