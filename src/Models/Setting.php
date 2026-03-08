<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Setting
{
    public static function all()
    {
        $db = Database::getConnection();
        $results = $db->query("SELECT * FROM settings")->fetchAll();
        $settings = [];
        foreach ($results as $row) {
            $settings[$row['setting_key']] = $row['value'];
        }
        return $settings;
    }

    public static function get($key, $default = null)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT value FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $row = $stmt->fetch();
        return $row ? $row['value'] : $default;
    }

    public static function update($key, $value)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT COUNT(*) FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $exists = $stmt->fetchColumn() > 0;

        if ($exists) {
            $stmt = $db->prepare("UPDATE settings SET value = ? WHERE setting_key = ?");
            return $stmt->execute([$value, $key]);
        } else {
            $stmt = $db->prepare("INSERT INTO settings (setting_key, value) VALUES (?, ?)");
            return $stmt->execute([$key, $value]);
        }
    }

    public static function updateMany($data)
    {
        foreach ($data as $key => $value) {
            self::update($key, $value);
        }
        return true;
    }
}
