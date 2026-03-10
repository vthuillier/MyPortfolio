<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Post
{
    public static function all($publishedOnly = false)
    {
        $db = Database::getConnection();
        $sql = "SELECT * FROM posts";
        if ($publishedOnly) {
            $sql .= " WHERE is_published = 1 AND (published_at IS NULL OR published_at <= CURRENT_TIMESTAMP)";
        }
        $sql .= " ORDER BY published_at DESC, created_at DESC";
        return $db->query($sql)->fetchAll();
    }

    public static function findBySlug($slug)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM posts WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    public static function find($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO posts (title, title_en, slug, content, content_en, excerpt, excerpt_en, is_published, published_at) 
            VALUES (:title, :title_en, :slug, :content, :content_en, :excerpt, :excerpt_en, :is_published, :published_at)
        ");
        return $stmt->execute([
            'title' => $data['title'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $data['slug'],
            'content' => $data['content'],
            'content_en' => $data['content_en'] ?? null,
            'excerpt' => $data['excerpt'] ?? null,
            'excerpt_en' => $data['excerpt_en'] ?? null,
            'is_published' => $data['is_published'] ?? 0,
            'published_at' => $data['published_at'] ?? null
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            UPDATE posts 
            SET title = :title, title_en = :title_en, slug = :slug, content = :content, content_en = :content_en, 
                excerpt = :excerpt, excerpt_en = :excerpt_en, is_published = :is_published, published_at = :published_at 
            WHERE id = :id
        ");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public static function delete($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM posts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
