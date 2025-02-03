<?php
namespace App\Controllers;

use App\Models\User;

class AuthController
{
    // Show login form
    public function showLogin()
    {
        require_once '../app/views/auth/login.php';
    }

    // Handle login form submission
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = User::findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                // Correct credentials
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: index.php?controller=task&action=index');
                exit;
            } else {
                // Invalid
                header('Location: index.php?controller=auth&action=showLogin&error=1');
                exit;
            }
        }
    }

    // Show registration form
    public function showRegister()
    {
        require_once '../app/views/auth/register.php';
    }

    // Handle registration form submission
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            User::create($username, $hashedPassword);
            header('Location: index.php?controller=auth&action=showLogin');
            exit;
        }
    }

    // Log out
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?controller=auth&action=showLogin');
        exit;
    }
}
