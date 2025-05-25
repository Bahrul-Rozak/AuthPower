<?php
namespace AuthPower\Migrations;

use AuthPower\Helpers\Database;

class CreatePasswordResetsTable
{
    public static function up()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::getInstance($config['db'])->getConnection();

       $sql = "CREATE TABLE IF NOT EXISTS password_resets (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL,
                    token VARCHAR(255) NOT NULL,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        $db->exec($sql);

        echo "Password Reset table created successfully.\n";
    }

    public static function down()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::getInstance($config['db'])->getConnection();

        $sql = "DROP TABLE IF EXISTS users;";
        $db->exec($sql);

        echo "Password Reset table dropped successfully.\n";
    }
}

