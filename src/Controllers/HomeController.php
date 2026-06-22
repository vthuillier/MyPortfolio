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
            // Get sender IP
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
            } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            $ip = trim($ip);

            $email = $_POST['email'] ?? '';

            // Check if sender is banned (IP or Email)
            if (\App\Models\BannedSender::isBanned($ip, $email)) {
                // Silently redirect to success to avoid alerting the spammer
                $this->redirect('/?success=1');
            }

            // Check if message is spam (honeypot or text heuristics)
            $messageContent = $_POST['message'] ?? '';
            if (\App\Helpers\SpamChecker::isSpam($_POST, $messageContent)) {
                // Auto-ban IP
                \App\Models\BannedSender::create([
                    'type' => 'ip',
                    'value' => $ip,
                    'reason' => 'Auto-ban: spam detected'
                ]);
                // Auto-ban Email if provided
                if (!empty($email)) {
                    \App\Models\BannedSender::create([
                        'type' => 'email',
                        'value' => $email,
                        'reason' => 'Auto-ban: spam detected'
                    ]);
                }
                
                // Silently redirect to success
                $this->redirect('/?success=1');
            }

            // Rate limiting check: max 3 messages per hour
            if (\App\Helpers\RateLimiter::isLimited('contact_form', 3, 3600)) {
                $this->redirect('/?error=rate_limit');
            }

            // Log attempt
            Analytics::logEvent('contact_form', '/contact');

            if (!\App\Helpers\Csrf::verifyToken($_POST['csrf_token'] ?? '')) {
                $this->redirect('/?error=csrf');
            }

            $data = [
                'name' => $_POST['name'] ?? 'Anonymous',
                'email' => $email,
                'message' => $_POST['message'] ?? 'No message',
                'ip_address' => $ip
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
