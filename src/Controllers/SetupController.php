<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\Auth;

class SetupController extends Controller
{
    public function index()
    {
        if (User::count() > 0) {
            $this->redirect('/');
        }
        $this->render('setup/index');
    }

    public function submit()
    {
        if (User::count() > 0) {
            $this->redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!\App\Helpers\Csrf::verifyToken($_POST['csrf_token'] ?? '')) {
                return $this->render('setup/index', ['error' => 'Erreur de sécurité CSRF.']);
            }
            $username = $_POST['username'] ?? '';

            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';

            if (empty($username) || empty($password)) {
                return $this->render('setup/index', ['error' => 'Tous les champs sont obligatoires.']);
            }

            if ($password !== $confirm) {
                return $this->render('setup/index', ['error' => 'Les mots de passe ne correspondent pas.']);
            }

            if (User::create($username, $password)) {
                $user = User::findByUsername($username);
                Auth::login($user['id'], $user['username']);
                $this->redirect('/admin');
            } else {
                return $this->render('setup/index', ['error' => 'Erreur lors de la création du compte.']);
            }
        }
    }
}
