<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $blade = service(name: 'blade');
        return $blade->render('auth.login');
    }

    public function attemptLogin()
    {
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required'
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('password');

        $users = new UserModel();

        $user = $users->where('email', $email)->first();

        if (!$user || !password_verify($pass, $user->password_hash)) {
            return redirect()->back()->withInput()->with('error', lang('App.auth.login.invalid_credentials'));
        }
        if ((int) ($user->status ?? 0) !== 1) {
            return redirect()->back()->with('error', 'Usuario inactivo o no confirmado.');
        }

        session()->set([
            'uid' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role ?? 'student',
            'logged_in' => true,
        ]);

        return redirect()->back()->with('message', '¡Bienvenido de nuevo, ' . $user->name . '!');

        //return redirect()->to('/');

    }

    public function register()
    {
        $blade = service(name: 'blade');
        return $blade->render('auth.register');
    }
}
