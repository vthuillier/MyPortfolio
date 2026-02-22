<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Project
{
    public static function all()
    {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();
    }

    public static function find($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO projects (title, title_en, description, description_en, image_url, project_link, category) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['title'],
            $data['title_en'] ?? null,
            $data['description'],
            $data['description_en'] ?? null,
            $data['image_url'],
            $data['project_link'],
            $data['category']
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE projects SET title = ?, title_en = ?, description = ?, description_en = ?, image_url = ?, project_link = ?, category = ? WHERE id = ?");
        return $stmt->execute([
            $data['title'],
            $data['title_en'] ?? null,
            $data['description'],
            $data['description_en'] ?? null,
            $data['image_url'],
            $data['project_link'],
            $data['category'],
            $id
        ]);
    }

    public static function delete($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
