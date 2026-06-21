<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Message
{
    public static function all()
    {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll();
    }

    public static function create($data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO messages (name, email, message, ip_address) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['message'],
            $data['ip_address'] ?? null
        ]);
    }

    public static function find($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM messages WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function markAsRead($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE messages SET is_read = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function delete($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM messages WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function countUnread()
    {
        $db = Database::getConnection();
        return $db->query("SELECT COUNT(*) FROM messages WHERE is_read = 0")->fetchColumn();
    }
}
