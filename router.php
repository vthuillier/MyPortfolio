<?php
if (file_exists(__DIR__ . '/public' . $_SERVER['REQUEST_URI'])) {
    return false; // serve the requested resource as-is.
} else {
    // Process the request through our index.php with the route parameter
    $_GET['route'] = ltrim($_SERVER['REQUEST_URI'], '/');
    require_once __DIR__ . '/public/index.php';
}
