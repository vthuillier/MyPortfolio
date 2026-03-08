<?php

/** @var \PDO $db */
/** @var string $driver */

$stmt = $db->prepare("INSERT INTO settings (setting_key, value) VALUES (?, ?)");
$stmt->execute(['analytics_script', '']);
