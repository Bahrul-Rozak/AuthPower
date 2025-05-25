<?php

namespace AuthPower\Middleware;

class AuthMiddleware
{
    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (empty($_SESSION['user_id'])) {
            header('Location: ?page=login');
            exit;
        }
    }
}
