<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class BannedSender
{
    public static function all()
    {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM banned_senders ORDER BY created_at DESC")->fetchAll();
    }

    public static function create($data)
    {
        $db = Database::getConnection();
        // Check if already banned to avoid duplicate logs
        $stmt = $db->prepare("SELECT COUNT(*) FROM banned_senders WHERE type = ? AND value = ?");
        $stmt->execute([$data['type'], $data['value']]);
        if ((int)$stmt->fetchColumn() > 0) {
            return true;
        }

        $stmt = $db->prepare("INSERT INTO banned_senders (type, value, reason) VALUES (?, ?, ?)");
        return $stmt->execute([
            $data['type'],
            $data['value'],
            $data['reason'] ?? null
        ]);
    }

    public static function delete($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM banned_senders WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function isBanned($ip, $email)
    {
        if (empty($ip) && empty($email)) {
            return false;
        }
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM banned_senders WHERE (type = 'ip' AND value = ?) OR (type = 'email' AND value = ?)");
        $stmt->execute([$ip, $email]);
        return (int)$stmt->fetchColumn() > 0;
    }
}
