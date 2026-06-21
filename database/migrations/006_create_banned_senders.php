<?php

// id SERIAL PRIMARY KEY replacement based on driver
$pk = "INTEGER PRIMARY KEY AUTOINCREMENT";
if ($driver === 'pgsql') {
    $pk = "SERIAL PRIMARY KEY";
} elseif ($driver === 'mysql') {
    $pk = "INT AUTO_INCREMENT PRIMARY KEY";
}

// Add ip_address column to messages table
try {
    $db->exec("ALTER TABLE messages ADD COLUMN ip_address VARCHAR(45) DEFAULT NULL");
} catch (\Exception $e) {
    // Column might already exist, catch to prevent crash if running migration on modified DB
}

// Create banned_senders table
$db->exec("CREATE TABLE IF NOT EXISTS banned_senders (
    id $pk,
    type VARCHAR(10) NOT NULL, -- 'ip' or 'email'
    value VARCHAR(255) NOT NULL,
    reason TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
