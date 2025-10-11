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
        $users = model(UserModel::class);
        $user = $users->where('email', $email)->first();

        if (!$user || !password_verify($pass, $user['password_hash'] ?? '')) {
            return redirect()->back()->withInput()->with('error', lang('App.auth.login.invalid_credentials'));
        }

        if ((int) ($user['status'] ?? 0) !== 1) {
            return redirect()->back()->with('error', lang('App.auth.login.inactive_user'));
        }

        session()->regenerate();

        session()->set([
            'uid' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'] ?? 'student',
            'logged_in' => true,
        ]);

        return redirect()->to(base_url('dashboard'))->with('message', lang('App.auth.login.welcome', [$user['name']]));

    }

    public function register()
    {
        $blade = service(name: 'blade');
        return $blade->render('auth.register');
    }

    public function attemptRegister()
    {
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
            ],
            'name' => [
                'label' => 'Name',
                'rules' => 'required',
            ],
            'password_confirm' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $users = model(UserModel::class);

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'status' => 1,
            'role' => 'student',
        ];

        $users->insert($data);

        return redirect()->to(base_url('auth/login'))->with('message', lang('App.auth.register.success'));


    }

}
