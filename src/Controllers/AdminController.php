<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use App\Models\Timeline;
use App\Models\Skill;
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
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = User::authenticate($username, $password);
            if ($user) {
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
        $this->render('admin/dashboard', [
            'projects' => $projects,
            'settings' => $settings,
            'timeline' => $timeline,
            'skills' => $skills
        ]);
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
            Setting::updateMany($_POST);
            $this->redirect('/admin');
        }
    }

    private function handleUpload($file)
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
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'png', 'jpeg', 'gif', 'webp'];

        if (in_array($imageFileType, $allowed)) {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return "uploads/" . $fileName;
            }
        }
        return null;
    }
}
