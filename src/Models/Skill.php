<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Skill
{
    public static function all()
    {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM skills ORDER BY order_index ASC")->fetchAll();
    }

    public static function find($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM skills WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO skills (category, category_en, name, level, order_index) VALUES (:category, :category_en, :name, :level, :order_index)");
        return $stmt->execute([
            'category' => $data['category'],
            'category_en' => $data['category_en'],
            'name' => $data['name'],
            'level' => $data['level'],
            'order_index' => $data['order_index'] ?? 0
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE skills SET category = :category, category_en = :category_en, name = :name, level = :level, order_index = :order_index WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'category' => $data['category'],
            'category_en' => $data['category_en'],
            'name' => $data['name'],
            'level' => $data['level'],
            'order_index' => $data['order_index'] ?? 0
        ]);
    }

    public static function delete($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM skills WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
