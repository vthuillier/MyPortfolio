<?php

// id SERIAL PRIMARY KEY replacement based on driver
$pk = "INTEGER PRIMARY KEY AUTOINCREMENT";
if ($driver === 'pgsql') {
    $pk = "SERIAL PRIMARY KEY";
} elseif ($driver === 'mysql') {
    $pk = "INT AUTO_INCREMENT PRIMARY KEY";
}

// Create messages table for contact form
$db->exec("CREATE TABLE IF NOT EXISTS messages (
    id $pk,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
