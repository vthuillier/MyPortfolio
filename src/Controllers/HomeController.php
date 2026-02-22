<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $settings = Setting::all();

        $this->render('home', [
            'projects' => $projects,
            'settings' => $settings
        ]);
    }

    public function contact()
    {
        // Handle contact form submission (simplified)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Send email or save message
            $this->redirect('/?success=1');
        }
    }
}
