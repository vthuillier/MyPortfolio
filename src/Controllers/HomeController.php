<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Setting;
use App\Models\Timeline;
use App\Models\Skill;

use App\Models\Message;
use App\Models\Analytics;


class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $settings = Setting::all();
        $timeline = Timeline::all();
        $skills = Skill::all();

        // Log page view
        Analytics::logEvent('page_view', '/');

        $this->render('home', [
            'projects' => $projects,
            'settings' => $settings,
            'timeline' => $timeline,
            'skills' => $skills
        ]);
    }

    public function cvDownload()
    {
        $cvPath = Setting::get('social_cv');
        if ($cvPath) {
            $fullPath = __DIR__ . '/../../public/' . $cvPath;
            if (file_exists($fullPath)) {
                // Log CV download
                Analytics::logEvent('cv_download');

                header('Content-Description: File Transfer');
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . basename($fullPath) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($fullPath));
                readfile($fullPath);
                exit;
            }
        }
        $this->redirect('/?error=no_cv');
    }

    public function contact()
    {
        // Handle contact form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!\App\Helpers\Csrf::verifyToken($_POST['csrf_token'] ?? '')) {
                $this->redirect('/?error=csrf');
            }

            $data = [
                'name' => $_POST['name'] ?? 'Anonymous',
                'email' => $_POST['email'] ?? 'No email',
                'message' => $_POST['message'] ?? 'No message'
            ];

            if (Message::create($data)) {
                // Send email notification
                \App\Helpers\MailerHelper::sendContactNotification($data);

                $this->redirect('/?success=1');
            } else {
                $this->redirect('/?error=database');
            }
        }
    }

    public function legal()
    {
        $settings = Setting::all();
        Analytics::logEvent('page_view', '/legal');
        $this->render('legal', ['settings' => $settings]);
    }
}
