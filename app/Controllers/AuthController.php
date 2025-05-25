<?php

namespace AuthPower\Controllers;

use AuthPower\Helpers\Database;

class AuthController
{
    protected $db;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $this->db = Database::getInstance($config['db'])->getConnection();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';

            // Simple validation
            if (!$name || !$email || !$password || !$passwordConfirm) {
                $error = "All fields are required.";
                include __DIR__ . '/../Views/auth/register.php';
                return;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
                include __DIR__ . '/../Views/auth/register.php';
                return;
            }
            if ($password !== $passwordConfirm) {
                $error = "Passwords do not match.";
                include __DIR__ . '/../Views/auth/register.php';
                return;
            }

            // Check if email exists
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
            $stmt->execute([':email' => $email]);
            if ($stmt->fetch()) {
                $error = "Email already registered.";
                include __DIR__ . '/../Views/auth/register.php';
                return;
            }

            // Insert user
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashed,
            ]);

            $_SESSION['user_id'] = $this->db->lastInsertId();
            header('Location: ?page=dashboard');
            exit;
        }

        include __DIR__ . '/../Views/auth/register.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (!$email || !$password) {
                $error = "Email and password required.";
                include __DIR__ . '/../Views/auth/login.php';
                return;
            }

            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$user || !password_verify($password, $user['password'])) {
                $error = "Invalid credentials.";
                include __DIR__ . '/../Views/auth/login.php';
                return;
            }

            $_SESSION['user_id'] = $user['id'];
            header('Location: ?page=dashboard');
            exit;
        }

        include __DIR__ . '/../Views/auth/login.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: ?page=login');
        exit;
    }
}
