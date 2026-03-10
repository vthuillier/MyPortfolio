<?php

// id SERIAL PRIMARY KEY replacement based on driver
$pk = "INTEGER PRIMARY KEY AUTOINCREMENT";
if ($driver === 'pgsql') {
    $pk = "SERIAL PRIMARY KEY";
} elseif ($driver === 'mysql') {
    $pk = "INT AUTO_INCREMENT PRIMARY KEY";
}

// Create posts table for Dev Log
$db->exec("CREATE TABLE IF NOT EXISTS posts (
    id $pk,
    title VARCHAR(255) NOT NULL,
    title_en VARCHAR(255) DEFAULT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    content_en TEXT DEFAULT NULL,
    excerpt TEXT DEFAULT NULL,
    excerpt_en TEXT DEFAULT NULL,
    is_published INTEGER DEFAULT 0,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
