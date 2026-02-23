<?php

namespace App\Helpers;

use App\Config\Database;
use PDO;

class MigrationHelper
{
    private $db;
    private $driver;

    public function __construct()
    {
        $this->db = Database::getConnection();
        $this->driver = $this->db->getAttribute(PDO::ATTR_DRIVER_NAME);
    }

    public function ensureMigrationTable()
    {
        $pk = "SERIAL PRIMARY KEY";
        if ($this->driver === 'sqlite') {
            $pk = "INTEGER PRIMARY KEY AUTOINCREMENT";
        } elseif ($this->driver === 'mysql') {
            $pk = "INT AUTO_INCREMENT PRIMARY KEY";
        }

        $this->db->exec("CREATE TABLE IF NOT EXISTS migrations (
            id $pk,
            migration VARCHAR(255) UNIQUE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function getAppliedMigrations()
    {
        $stmt = $this->db->query("SELECT migration FROM migrations");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function applyMigration($file)
    {
        $path = __DIR__ . '/../../database/migrations/' . $file;
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        try {
            $this->db->beginTransaction();

            if ($extension === 'sql') {
                $sql = file_get_contents($path);
                $this->db->exec($sql);
            } elseif ($extension === 'php') {
                $db = $this->db;
                $driver = $this->driver;
                require $path;
            }

            // Record the migration
            $stmt = $this->db->prepare("INSERT INTO migrations (migration) VALUES (?)");
            $stmt->execute([$file]);

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            $this->log("Error applying migration $file: " . $e->getMessage());
            return false;
        }
    }

    private function log($message)
    {
        if (php_sapi_name() === 'cli') {
            echo $message . "\n";
        } else {
            error_log($message);
        }
    }

    public function run()
    {
        $this->ensureMigrationTable();
        $applied = $this->getAppliedMigrations();
        $files = array_diff(scandir(__DIR__ . '/../../database/migrations'), ['.', '..']);

        $count = 0;
        foreach ($files as $file) {
            if (!in_array($file, $applied)) {
                $this->log("Applying migration: $file...");
                if ($this->applyMigration($file)) {
                    $count++;
                }
            }
        }

        if ($count > 0) {
            $this->log("Applied $count migration(s) successfully.");
        }
    }
}
