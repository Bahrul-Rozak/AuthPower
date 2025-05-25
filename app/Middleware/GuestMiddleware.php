<?php

namespace AuthPower\Middleware;

class GuestMiddleware
{
    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['user_id'])) {
            header('Location: ?page=dashboard');
            exit;
        }
    }
}
