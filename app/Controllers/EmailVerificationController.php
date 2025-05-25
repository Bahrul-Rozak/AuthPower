<?php

namespace AuthPower\Controllers;

use AuthPower\Helpers\Database;

class EmailVerificationController
{
    public function verify()
    {
        $token = $_GET['token'] ?? '';
        if (!$token) {
            echo "Invalid verification link.";
            return;
        }

        $config = require __DIR__ . '/../../config/config.php';
        $db = new Database($config['db']);
        $pdo = $db->getConnection(); // Assuming getConnection() returns the PDO instance

        $stmt = $pdo->prepare("SELECT user_id FROM email_verifications WHERE token = ?");
        $stmt->execute([$token]);
        $userId = $stmt->fetchColumn();

        if ($userId) {
            // Update user email_verified_at
            $stmt = $pdo->prepare("UPDATE users SET email_verified_at = NOW() WHERE id = ?");
            $stmt->execute([$userId]);

            // Delete the verification token
            $stmt = $pdo->prepare("DELETE FROM email_verifications WHERE token = ?");
            $stmt->execute([$token]);

            echo "Email successfully verified. You can now login.";
        } else {
            echo "Verification token invalid or expired.";
        }
    }
}
