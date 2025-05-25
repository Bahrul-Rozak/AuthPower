<?php

use AuthPower\Controllers\PasswordResetController;
use AuthPower\Controllers\EmailVerificationController;

session_start();

require __DIR__ . '/../vendor/autoload.php';

// Simple Router based on $_GET['page']
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'register':
        (new \AuthPower\Controllers\AuthController())->register();
        break;
    case 'login':
        (new \AuthPower\Controllers\AuthController())->login();
        break;
    case 'logout':
        (new \AuthPower\Controllers\AuthController())->logout();
        break;
    case 'dashboard':
        (new \AuthPower\Controllers\DashboardController())->index();
        break;
    case 'forgot-password':
        (new PasswordResetController())->forgot();
        break;
    case 'reset-password':
        (new PasswordResetController())->reset();
        break;
    case 'verify-email':
        (new EmailVerificationController())->verify();
        break;
    default:
        echo "Welcome to AuthPower Home";
}
