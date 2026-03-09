<?php

$pk = "INTEGER PRIMARY KEY AUTOINCREMENT";
if ($driver === 'pgsql') {
    $pk = "SERIAL PRIMARY KEY";
} elseif ($driver === 'mysql') {
    $pk = "INT AUTO_INCREMENT PRIMARY KEY";
}

$db->exec("CREATE TABLE IF NOT EXISTS analytics (
    id $pk,
    event_type VARCHAR(50) NOT NULL,
    page_path VARCHAR(255),
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
