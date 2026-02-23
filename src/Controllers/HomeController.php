<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Setting;
use App\Models\Timeline;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $settings = Setting::all();
        $timeline = Timeline::all();
        $skills = Skill::all();

        $this->render('home', [
            'projects' => $projects,
            'settings' => $settings,
            'timeline' => $timeline,
            'skills' => $skills
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
