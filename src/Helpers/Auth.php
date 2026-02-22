<?php

namespace App\Helpers;

class Auth
{
    public static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($userId, $username)
    {
        self::startSession();
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
    }

    public static function logout()
    {
        self::startSession();
        session_destroy();
    }

    public static function check()
    {
        self::startSession();
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public static function requireAuth()
    {
        if (!self::check()) {
            header('Location: /login');
            exit;
        }
    }
}
