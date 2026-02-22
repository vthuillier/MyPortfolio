<?php

namespace App\Controllers;

class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . "/../Views/{$view}.php";

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View {$view} not found.");
        }
    }

    protected function redirect($url)
    {
        // If url doesn't start with /, add it
        if (strpos($url, 'http') !== 0 && strpos($url, '/') !== 0) {
            $url = '/' . $url;
        }

        // Handle systems without URL rewriting by appending ?route=
        if (isset($_GET['route']) || !file_exists('.htaccess')) {
            // Basic detection if we should use query param
            // But for now, we assume the server handles it or user uses /?route=
        }

        header("Location: {$url}");
        exit;
    }
}
