<?php

namespace AuthPower\Controllers;

use AuthPower\Helpers\Database;
use AuthPower\Middleware\AuthMiddleware;

class DashboardController
{
    protected $db;

    public function __construct()
    {
        AuthMiddleware::check();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['user_id'])) {
            header('Location: ?page=login');
            exit;
        }

        $config = require __DIR__ . '/../../config/config.php';
        $this->db = Database::getInstance($config['db'])->getConnection();
    }

    public function index()
    {
        $stmt = $this->db->prepare("SELECT name, email FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        include __DIR__ . '/../Views/dashboard.php';
    }
}
