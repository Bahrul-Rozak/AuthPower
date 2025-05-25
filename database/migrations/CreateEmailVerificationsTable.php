<?php
namespace AuthPower\Migrations;
use AuthPower\Helpers\Database;

class CreateEmailVerificationsTable
{
    public static function up()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::getInstance($config['db'])->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS email_verifications (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            token VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )";
        $db->exec($sql);

        echo "✓ email_verifications table created.\n";
    }
}
