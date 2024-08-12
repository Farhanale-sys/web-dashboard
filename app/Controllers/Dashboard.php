<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function __construct()
    {
        helper('url');
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('dashboard/index', $data);
    }

    public function add_user()
    {
        return view('dashboard/add_user');
    }

    public function save_user()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');

        $userModel = new UserModel();
        $userModel->save([
            'name'  => $name,
            'email' => $email
        ]);

        session()->setFlashdata('success', 'User added successfully.');
        return redirect()->to('/dashboard');
    }
}
