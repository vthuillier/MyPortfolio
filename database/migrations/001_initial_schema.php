<?php

// id SERIAL PRIMARY KEY replacement based on driver
$pk = "INTEGER PRIMARY KEY AUTOINCREMENT";
if ($driver === 'pgsql') {
    $pk = "SERIAL PRIMARY KEY";
} elseif ($driver === 'mysql') {
    $pk = "INT AUTO_INCREMENT PRIMARY KEY";
}

// Create projects table
$db->exec("CREATE TABLE IF NOT EXISTS projects (
    id $pk,
    title VARCHAR(255) NOT NULL,
    title_en VARCHAR(255),
    description TEXT,
    description_en TEXT,
    image_url VARCHAR(255),
    project_link VARCHAR(255),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Create timeline table (Experience & Education)
$db->exec("CREATE TABLE IF NOT EXISTS timeline (
    id $pk,
    type VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    title_en VARCHAR(255),
    organization VARCHAR(255),
    organization_en VARCHAR(255),
    period VARCHAR(100),
    period_en VARCHAR(100),
    description TEXT,
    description_en TEXT,
    order_index INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Create skills table
$db->exec("CREATE TABLE IF NOT EXISTS skills (
    id $pk,
    category VARCHAR(100) NOT NULL,
    category_en VARCHAR(100),
    name VARCHAR(100) NOT NULL,
    level INTEGER NOT NULL,
    order_index INTEGER DEFAULT 0
)");

// Create users table
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id $pk,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)");

// Create settings table
$db->exec("CREATE TABLE IF NOT EXISTS settings (
    setting_key VARCHAR(100) PRIMARY KEY,
    value TEXT
)");
