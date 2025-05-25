<?php

namespace AuthPower\Controllers;

use AuthPower\Helpers\Database;
use AuthPower\Helpers\Csrf;
use AuthPower\Helpers\Mailer;

class PasswordResetController
{
    public function forgot()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::checkToken($_POST['_csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }

            $email = $_POST['email'];
            $token = bin2hex(random_bytes(32));
            $config = require __DIR__ . '/../../config/config.php';
            $pdo = Database::getInstance($config['db'])->getConnection();

            $stmt = $pdo->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
            $stmt->execute([$email, $token]);

            $resetLink = "http://localhost/AuthPower/?page=reset-password&token=$token";

            Mailer::send($email, 'Reset Your Password', "Click this link to reset your password: <a href=\"$resetLink\">Reset Password</a>");

            echo "Reset link sent to your email.";
        } else {
            require __DIR__ . '../../Views/forgot-password.php';
        }
    }

    public function reset()
    {
        $token = $_GET['token'] ?? '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::checkToken($_POST['_csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }

            $config = require __DIR__ . '/../../config/config.php';
            $db = new Database($config['db']);

            $pdo = $db->getConnection();
            $stmt = $pdo->prepare("SELECT email FROM password_resets WHERE token = ?");
            $stmt->execute([$token]);
            $email = $stmt->fetchColumn();

            if ($email) {
                $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
                $stmt->execute([$newPassword, $email]);

                $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
                $stmt->execute([$token]);

                echo "Password has been reset.";
            } else {
                echo "Invalid or expired token.";
            }
        } else {
            require __DIR__ . '/../../Views/reset-password.php';
        }
    }
}
