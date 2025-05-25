<?php

namespace AuthPower\Migrations;

use AuthPower\Helpers\Database;

class CreateUsersTable
{
    public static function up()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::getInstance($config['db'])->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            email_verified_at DATETIME DEFAULT NULL,
            remember_token VARCHAR(100) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        $db->exec($sql);

        echo "Migration: users table created successfully.\n";
    }

    public static function down()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::getInstance($config['db'])->getConnection();

        $sql = "DROP TABLE IF EXISTS users;";
        $db->exec($sql);

        echo "Migration: users table dropped successfully.\n";
    }
}
