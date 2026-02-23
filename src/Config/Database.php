<?php

namespace App\Config;

use PDO;
use PDOException;
use App\Helpers\Env;

class Database
{
    private static $instance = null;

    public static function getConnection()
    {
        if (self::$instance === null) {
            try {
                $connection = Env::get('DB_CONNECTION', 'sqlite');

                if ($connection === 'pgsql') {
                    $host = Env::get('DB_HOST', 'localhost');
                    $port = Env::get('DB_PORT', '5432');
                    $dbname = Env::get('DB_DATABASE', 'portfolio');
                    $user = Env::get('DB_USERNAME', 'postgres');
                    $pass = Env::get('DB_PASSWORD', '');

                    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                    self::$instance = new PDO($dsn, $user, $pass);
                } elseif ($connection === 'mysql') {
                    $host = Env::get('DB_HOST', 'localhost');
                    $port = Env::get('DB_PORT', '3306');
                    $dbname = Env::get('DB_DATABASE', 'portfolio');
                    $user = Env::get('DB_USERNAME', 'root');
                    $pass = Env::get('DB_PASSWORD', '');

                    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
                    self::$instance = new PDO($dsn, $user, $pass);
                } else {
                    $dbFile = Env::get('DB_FILE', 'database/portfolio.sqlite');
                    $dbPath = __DIR__ . '/../../' . $dbFile;
                    self::$instance = new PDO("sqlite:" . $dbPath);
                }

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
