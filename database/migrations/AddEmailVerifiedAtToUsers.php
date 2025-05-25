<?php
namespace AuthPower\Migrations;
use AuthPower\Helpers\Database;

class AddEmailVerifiedAtToUsers
{
    public static function up()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::getInstance($config['db'])->getConnection();

        $sql = "ALTER TABLE users ADD COLUMN email_verified_at DATETIME NULL AFTER password";
        $db->exec($sql);

        echo "✓ Added email_verified_at column to users table.\n";
    }
}
