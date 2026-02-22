<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class User
{
    public static function findByUsername($username)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function authenticate($username, $password)
    {
        $user = self::findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
