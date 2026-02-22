<?php

// Autoloader (Simple)
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0)
        return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file))
        require $file;
});

// Basic Router
$route = $_GET['route'] ?? 'home';

// Handle trailing slashes and clean route
$route = trim($route, '/');

use App\Controllers\HomeController;
use App\Controllers\AdminController;

switch ($route) {
    case 'home':
    case '':
        (new HomeController())->index();
        break;

    case 'contact':
        (new HomeController())->contact();
        break;

    case 'login':
        $ctrl = new AdminController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ctrl->authenticate();
        } else {
            $ctrl->login();
        }
        break;

    case 'logout':
        (new AdminController())->logout();
        break;

    case 'admin':
        (new AdminController())->dashboard();
        break;

    case 'admin/project/create':
        (new AdminController())->projectCreate();
        break;

    case 'admin/project/edit':
        (new AdminController())->projectEdit();
        break;

    case 'admin/project/delete':
        (new AdminController())->projectDelete();
        break;

    case 'admin/settings':
        (new AdminController())->settingsUpdate();
        break;

    default:
        http_response_code(404);
        echo "404 - Page non trouvée";
        break;
}
