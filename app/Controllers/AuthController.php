<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // REGISTER
    public function register()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $data = [
            'nama'     => $this->request->getVar('nama'),
            'email'    => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];

        $this->userModel->insert($data);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Registrasi berhasil',
        ]);
    }

    // LOGIN
    public function login()
    {
        $email    = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Email tidak ditemukan.'
            ]);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Password salah.'
            ]);
        }

        // Simpan session
        session()->set([
            'user_id' => $user['id'],
            'user_nama' => $user['nama'],
            'logged_in' => true
        ]);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Login berhasil',
            'data'    => [
                'id'    => $user['id'],
                'nama'  => $user['nama'],
                'email' => $user['email'],
            ]
        ]);
    }

    // LOGOUT
    public function logout()
    {
        session()->destroy();
        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Logout berhasil',
        ]);
    }
}
