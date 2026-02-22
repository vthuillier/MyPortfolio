<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use App\Helpers\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        // Only require auth for non-login routes
        $route = $_GET['route'] ?? '';
        if ($route !== 'login' && $route !== 'authenticate') {
            Auth::requireAuth();
        }
    }

    public function login()
    {
        if (Auth::check()) {
            $this->redirect('/admin');
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
        $this->render('admin/dashboard', [
            'projects' => $projects,
            'settings' => $settings
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
        $fileName = time() . '_' . basename($file["name"]);
        $targetFile = $targetDir . $fileName;

        // Basic security check
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'png', 'jpeg', 'gif', 'webp'];

        if (in_array($imageFileType, $allowed)) {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return "/uploads/" . $fileName;
            }
        }
        return null;
    }
}
