<?php

/** @var \PDO $db */
/** @var string $driver */

$check = $db->prepare("SELECT COUNT(*) FROM settings WHERE setting_key = ?");
$check->execute(['analytics_script']);
if ($check->fetchColumn() == 0) {
    $stmt = $db->prepare("INSERT INTO settings (setting_key, value) VALUES (?, ?)");
    $stmt->execute(['analytics_script', '']);
}
