<?php

// Basic Router and Autoloader
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

session_start();

// Handle request routing
$uri = $_SERVER['REQUEST_URI'];
$basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$route = $_GET['route'] ?? str_replace($basePath, '', $uri);
$route = trim(explode('?', $route)[0], '/');

use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Helpers\Language;
use App\Helpers\Env;

Env::load(__DIR__ . '/../.env');
Language::init();

switch ($route) {
    case 'home':
    case 'index.php':
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

    case 'admin/timeline/create':
        (new AdminController())->timelineCreate();
        break;

    case 'admin/timeline/edit':
        (new AdminController())->timelineEdit();
        break;

    case 'admin/timeline/delete':
        (new AdminController())->timelineDelete();
        break;

    case 'admin/skill/create':
        (new AdminController())->skillCreate();
        break;

    case 'admin/skill/edit':
        (new AdminController())->skillEdit();
        break;

    case 'admin/skill/delete':
        (new AdminController())->skillDelete();
        break;

    case 'admin/settings':
        (new AdminController())->settingsUpdate();
        break;

    default:
        http_response_code(404);
        echo "404 - Page non trouvée: " . htmlspecialchars($route);
        break;
}
