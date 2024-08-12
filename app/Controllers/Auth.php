<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function login_action()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin = $adminModel->where('username', $username)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            session()->set('admin_logged_in', true);
            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Invalid username or password');
            return redirect()->to('/login');
        }
    }

    public function register_action()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if ($password !== $passwordConfirm) {
            session()->setFlashdata('error', 'Passwords do not match');
            return redirect()->to('/register');
        }

        if (empty($username) || empty($password)) {
            session()->setFlashdata('error', 'Username and password are required');
            return redirect()->to('/register');
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $adminModel = new AdminModel();
        $adminModel->save([
            'username' => $username,
            'password' => $hashedPassword
        ]);

        session()->setFlashdata('success', 'Registration successful. Please login.');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->remove('admin_logged_in');
        return redirect()->to('/login');
    }
}
