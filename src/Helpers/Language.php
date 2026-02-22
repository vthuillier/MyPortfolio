<?php

namespace App\Helpers;

class Language
{
    private static $currentLang = 'fr';
    private static $translations = [];

    public static function init()
    {
        if (isset($_GET['lang']) && in_array($_GET['lang'], ['fr', 'en'])) {
            $_SESSION['lang'] = $_GET['lang'];
            self::$currentLang = $_GET['lang'];
        } elseif (isset($_SESSION['lang'])) {
            self::$currentLang = $_SESSION['lang'];
        }

        self::loadTranslations();
    }

    private static function loadTranslations()
    {
        $file = __DIR__ . '/../Lang/' . self::$currentLang . '.php';
        if (file_exists($file)) {
            self::$translations = require $file;
        }
    }

    public static function get($key)
    {
        return self::$translations[$key] ?? $key;
    }

    public static function getCurrent()
    {
        return self::$currentLang;
    }
}
