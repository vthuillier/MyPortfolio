<?php

// Basic Router and Autoloader
// Load Composer autoloader
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

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

// Security Headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self' https:;");

// Secure Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}

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
use App\Helpers\MigrationHelper;

Env::load(__DIR__ . '/../.env');
Language::init();

// Auto-migrate database on request if needed
(new MigrationHelper())->run();

use App\Controllers\SetupController;
use App\Models\User;

// Check if setup is needed
if (User::count() === 0 && !in_array($route, ['setup', 'setup/submit'])) {
    (new SetupController())->index();
    exit;
}

switch ($route) {
    case 'sitemap.xml':
        (new \App\Controllers\SitemapController())->index();
        break;

    case 'setup':
        (new SetupController())->index();
        break;

    case 'setup/submit':
        (new SetupController())->submit();
        break;

    case 'home':
    case 'index.php':
    case '':
        (new HomeController())->index();
        break;

    case 'cv-download':
        (new HomeController())->cvDownload();
        break;

    case 'contact':
        (new HomeController())->contact();
        break;

    case 'legal-mentions':
    case 'legal':
        (new HomeController())->legal();
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

    case 'admin/message/read':
        (new AdminController())->messageRead();
        break;

    case 'admin/message/delete':
        (new AdminController())->messageDelete();
        break;

    case 'admin/settings':
        (new AdminController())->settingsUpdate();
        break;

    default:
        http_response_code(404);
        echo "404 - Page non trouvée: " . htmlspecialchars($route);
        break;
}
