<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Timeline
{
    public static function all($type = null)
    {
        $db = Database::getConnection();
        $query = "SELECT * FROM timeline";
        if ($type) {
            $query .= " WHERE type = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$type]);
            return $stmt->fetchAll();
        }
        return $db->query($query . " ORDER BY type, order_index ASC")->fetchAll();
    }

    public static function find($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM timeline WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO timeline (type, title, title_en, organization, organization_en, period, period_en, description, description_en, order_index) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['type'],
            $data['title'],
            $data['title_en'] ?? null,
            $data['organization'],
            $data['organization_en'] ?? null,
            $data['period'],
            $data['period_en'] ?? null,
            $data['description'],
            $data['description_en'] ?? null,
            $data['order_index'] ?? 0
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE timeline SET type = ?, title = ?, title_en = ?, organization = ?, organization_en = ?, period = ?, period_en = ?, description = ?, description_en = ?, order_index = ? WHERE id = ?");
        return $stmt->execute([
            $data['type'],
            $data['title'],
            $data['title_en'] ?? null,
            $data['organization'],
            $data['organization_en'] ?? null,
            $data['period'],
            $data['period_en'] ?? null,
            $data['description'],
            $data['description_en'] ?? null,
            $data['order_index'] ?? 0,
            $id
        ]);
    }

    public static function delete($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM timeline WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
