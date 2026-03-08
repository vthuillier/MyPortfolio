<?php

namespace App\Controllers;

use App\Models\Project;

class SitemapController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        // Default pages
        $pages = [
            '/',
            '/#about',
            '/#projects',
            '/#skills',
            '/#timeline',
            '/#contact'
        ];

        $appUrl = $_ENV['APP_URL'] ?? ('http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost'));

        foreach ($pages as $page) {
            $url = $xml->addChild('url');
            $url->addChild('loc', htmlspecialchars($appUrl . $page));
            $url->addChild('changefreq', 'weekly');
            $url->addChild('priority', $page === '/' ? '1.0' : '0.8');
        }

        // Projects (currently a single page portfolio but in case you have routes for individual projects later)
        // If we only have anchors, we don't need to loop over projects as unique routes. 
        // But if you plan to have /project?id=X, you'd add them here.
        // For now, let's keep it simple with main routes.

        header('Content-Type: application/xml; charset=utf-8');
        echo $xml->asXML();
        exit;
    }
}
