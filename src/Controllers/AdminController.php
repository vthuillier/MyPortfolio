<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use App\Models\Timeline;
use App\Models\Skill;
use App\Models\Message;
use App\Models\Post;
use App\Models\Analytics;
use App\Helpers\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        // Detect route consistently with index.php
        $uri = $_SERVER['REQUEST_URI'];
        $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
        $route = $_GET['route'] ?? str_replace($basePath, '', $uri);
        $route = trim(explode('?', $route)[0], '/');

        if ($route !== 'login' && $route !== 'authenticate' && $route !== '') {
            Auth::requireAuth();

            // Global CSRF check for all POST requests in admin
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!\App\Helpers\Csrf::verifyToken($_POST['csrf_token'] ?? '')) {
                    die("Erreur de sécurité CSRF.");
                }
            }
        }

    }

    public function login()
    {
        if (Auth::check()) {
            $this->redirect('admin');
        }
        $this->render('admin/login');
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!\App\Helpers\Csrf::verifyToken($_POST['csrf_token'] ?? '')) {
                return $this->render('admin/login', ['error' => 'Erreur de sécurité CSRF.']);
            }

            // Rate limiting: max 5 login attempts per 15 minutes
            if (\App\Helpers\RateLimiter::isLimited('login_attempt', 5, 900)) {
                return $this->render('admin/login', ['error' => 'Too many login attempts. Please try again later.']);
            }

            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Log attempt
            \App\Models\Analytics::logEvent('login_attempt', '/login');

            $user = User::authenticate($username, $password);
            if ($user) {
                session_regenerate_id(true);
                Auth::login($user['id'], $user['username']);
                $this->redirect('/admin');
            } else {

                $this->render('admin/login', ['error' => 'Identifiants incorrects']);
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('/login');
    }

    public function dashboard()
    {
        $projects = Project::all();
        $settings = Setting::all();
        $timeline = Timeline::all();
        $skills = Skill::all();
        $messages = Message::all();

        $stats = [
            'total_visits' => Analytics::getTotalVisits(),
            'total_downloads' => Analytics::getTotalDownloads(),
            'visits_daily' => Analytics::getVisitStats(14),
            'downloads_daily' => Analytics::getDownloadStats(14)
        ];

        $this->render('admin/dashboard', [
            'projects' => $projects,
            'settings' => $settings,
            'timeline' => $timeline,
            'skills' => $skills,
            'messages' => $messages,
            'banned_senders' => \App\Models\BannedSender::all(),
            'posts' => Post::all(),
            'stats' => $stats
        ]);
    }

    public function messageRead()
    {
        $id = $_GET['id'] ?? null;
        Message::markAsRead($id);
        $this->redirect('/admin');
    }

    public function messageDelete()
    {
        $id = $_GET['id'] ?? null;
        Message::delete($id);
        $this->redirect('/admin');
    }

    public function messageBan()
    {
        $id = $_GET['id'] ?? null;
        $msg = Message::find($id);
        if ($msg) {
            // Ban the email
            if (!empty($msg['email'])) {
                \App\Models\BannedSender::create([
                    'type' => 'email',
                    'value' => $msg['email'],
                    'reason' => 'Spam block from message #' . $id
                ]);
            }
            // Ban the IP
            if (!empty($msg['ip_address'])) {
                \App\Models\BannedSender::create([
                    'type' => 'ip',
                    'value' => $msg['ip_address'],
                    'reason' => 'Spam block from message #' . $id
                ]);
            }
            // Delete the spam message
            Message::delete($id);
        }
        $this->redirect('/admin');
    }

    public function bannedSenderDelete()
    {
        $id = $_GET['id'] ?? null;
        \App\Models\BannedSender::delete($id);
        $this->redirect('/admin');
    }

    public function bannedSenderCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_POST['type'] ?? 'email';
            $value = trim($_POST['value'] ?? '');
            $reason = trim($_POST['reason'] ?? 'Manual ban');

            if (!empty($value)) {
                \App\Models\BannedSender::create([
                    'type' => $type,
                    'value' => $value,
                    'reason' => $reason
                ]);
            }
        }
        $this->redirect('/admin');
    }

    public function messageReply()
    {
        $id = $_GET['id'] ?? null;
        $message = Message::find($id);

        if (!$message)
            $this->redirect('/admin');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['subject'] ?? 'RE: Message from ' . ($_ENV['APP_NAME'] ?? 'Portfolio');
            $replyContent = $_POST['reply_content'] ?? '';

            if (\App\Helpers\MailerHelper::sendDirectReply($message['email'], $subject, $replyContent, $message['message'])) {
                Message::markAsRead($id);
                $this->redirect('/admin?success=reply_sent');
            } else {
                $this->redirect('/admin?error=reply_failed');
            }
        }

        $this->render('admin/message_reply', ['msg' => $message]);
    }

    public function projectCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $data['image_url'] = $this->handleUpload($_FILES['image']);
            Project::create($data);
            $this->redirect('/admin');
        }
        $this->render('admin/project_form', ['action' => 'create']);
    }

    public function projectEdit()
    {
        $id = $_GET['id'] ?? null;
        $project = Project::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            if (!empty($_FILES['image']['name'])) {
                $data['image_url'] = $this->handleUpload($_FILES['image']);
            } else {
                $data['image_url'] = $project['image_url'];
            }
            Project::update($id, $data);
            $this->redirect('/admin');
        }

        $this->render('admin/project_form', ['action' => 'edit', 'project' => $project]);
    }

    public function projectDelete()
    {
        $id = $_GET['id'] ?? null;
        Project::delete($id);
        $this->redirect('/admin');
    }

    public function timelineCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Timeline::create($_POST);
            $this->redirect('/admin');
        }
        $this->render('admin/timeline_form', ['action' => 'create']);
    }

    public function timelineEdit()
    {
        $id = $_GET['id'] ?? null;
        $item = Timeline::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Timeline::update($id, $_POST);
            $this->redirect('/admin');
        }

        $this->render('admin/timeline_form', ['action' => 'edit', 'item' => $item]);
    }

    public function timelineDelete()
    {
        $id = $_GET['id'] ?? null;
        Timeline::delete($id);
        $this->redirect('/admin');
    }

    public function skillCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Skill::create($_POST);
            $this->redirect('/admin');
        }
        $this->render('admin/skill_form', ['action' => 'create']);
    }

    public function skillEdit()
    {
        $id = $_GET['id'] ?? null;
        $skill = Skill::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Skill::update($id, $_POST);
            $this->redirect('/admin');
        }

        $this->render('admin/skill_form', ['action' => 'edit', 'skill' => $skill]);
    }

    public function skillDelete()
    {
        $id = $_GET['id'] ?? null;
        Skill::delete($id);
        $this->redirect('/admin');
    }

    public function settingsUpdate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            unset($data['csrf_token']);

            // Handle CV Upload
            if (!empty($_FILES['cv_file']['name'])) {
                $cvPath = $this->handleUpload($_FILES['cv_file'], ['pdf', 'doc', 'docx']);
                if ($cvPath) {
                    $data['social_cv'] = $cvPath;
                }
            }

            // Handle Favicon Upload
            if (!empty($_FILES['favicon']['name'])) {
                $favPath = $this->handleUpload($_FILES['favicon'], ['ico', 'png', 'svg']);
                if ($favPath) {
                    $data['favicon'] = $favPath;
                }
            }

            Setting::updateMany($data);
            $this->redirect('/admin');
        }
    }

    public function postCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            if (empty($data['slug'])) {
                $data['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title'])));
            }
            if (empty($data['published_at']) && $data['is_published'] == 1) {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
            Post::create($data);
            $this->redirect('/admin');
        }
        $this->render('admin/post_form', ['action' => 'create']);
    }

    public function postEdit()
    {
        $id = $_GET['id'] ?? null;
        $post = Post::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            unset($data['csrf_token']);
            if (empty($data['slug'])) {
                $data['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title'])));
            }
            Post::update($id, $data);
            $this->redirect('/admin');
        }

        $this->render('admin/post_form', ['action' => 'edit', 'post' => $post]);
    }

    public function postDelete()
    {
        $id = $_GET['id'] ?? null;
        Post::delete($id);
        $this->redirect('/admin');
    }

    public function dbExport()
    {
        $connection = \App\Helpers\Env::get('DB_CONNECTION', 'sqlite');

        if ($connection === 'sqlite') {
            $dbFile = \App\Helpers\Env::get('DB_FILE', 'database/portfolio.sqlite');
            $fullPath = __DIR__ . '/../../' . $dbFile;

            if (file_exists($fullPath)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/x-sqlite3');
                header('Content-Disposition: attachment; filename="' . basename($fullPath) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($fullPath));
                readfile($fullPath);
                exit;
            }
        }

        // Non-sqlite or file not found
        $this->redirect('/admin?error=export_failed');
    }

    private function handleUpload($file, $allowed = ['jpg', 'png', 'jpeg', 'gif', 'webp'])
    {
        if (empty($file['name']))
            return null;

        $targetDir = __DIR__ . "/../../public/uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . '_' . str_replace(' ', '_', basename($file["name"]));
        $targetFile = $targetDir . $fileName;

        // Basic security check
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowed)) {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return "uploads/" . $fileName;
            }
        }
        return null;
    }
}
