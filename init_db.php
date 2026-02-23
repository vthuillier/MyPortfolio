<?php

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0)
        return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file))
        require $file;
});

use App\Config\Database;
use App\Helpers\Env;
use App\Helpers\MigrationHelper;

Env::load(__DIR__ . '/.env');

echo "Initializing database...\n";
(new MigrationHelper())->run();

echo "\nDatabase setup complete.\n";