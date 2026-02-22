<?php

require_once __DIR__ . '/src/Config/Database.php';

use App\Config\Database;

$db = Database::getConnection();

// Create projects table
$db->exec("CREATE TABLE IF NOT EXISTS projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    project_link VARCHAR(255),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Create users table for admin
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)");

// Create settings table for global texts
$db->exec("CREATE TABLE IF NOT EXISTS settings (
    key VARCHAR(100) PRIMARY KEY,
    value TEXT
)");

// Insert default settings
$settings = [
    ['site_title', 'Valentin Thuillier'],
    ['user_name', 'Valentin Thuillier'],
    ['user_job', 'Développeur DevOps 🇫🇷 & Sapeur-Pompier 🚒'],
    ['site_bio', 'Passionné par le Machine Learning, l\'Innovation & le Code.'],
    ['is_available', '1'],
    ['social_linkedin', 'https://linkedin.com/in/vthuillier'],
    ['social_github', 'https://github.com/valentin-t'],
    ['social_cv', '#'],
    ['about_text', 'Passionné par le Machine Learning, l\'Innovation & le Code, le Service & le Courage. Diplômé BUT Informatique et sapeur-pompier volontaire. Expert en infrastructure cloud, automatisation et technologies émergentes.'],
    ['hero_image', ''],
];

$stmt = $db->prepare("INSERT OR IGNORE INTO settings (key, value) VALUES (?, ?)");
foreach ($settings as $setting) {
    $stmt->execute($setting);
}

// Ensure settings are updated if they exist
$stmt = $db->prepare("UPDATE settings SET value = ? WHERE key = ?");
foreach ($settings as $setting) {
    $stmt->execute([$setting[1], $setting[0]]);
}

// Create default admin
$password = password_hash('admin123', PASSWORD_BCRYPT);
$stmt = $db->prepare("INSERT OR IGNORE INTO users (username, password) VALUES (?, ?)");
$stmt->execute(['admin', $password]);

echo "Database initialized successfully.\n";
