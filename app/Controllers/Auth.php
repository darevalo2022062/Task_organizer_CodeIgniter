<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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
            ],
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');
        $users = model(UserModel::class);
        $user = $users->where('email', $email)->first();
        
        if (!$user || !password_verify($pass, $user['password_hash'] ?? '')) {
            return redirect()->back()->withInput()->with('error', lang('App.auth.login.error.invalid_credentials'));
        }
        
        if (empty($user['confirm_email_at'])) {
            return redirect()->back()->withInput()->with('error', lang('App.auth.login.error.email_not_verified'));
        }
        
        if ((int) ($user['status'] ?? 0) !== 1) {
            return redirect()->back()->with('error', lang('App.auth.login.error.inactive_user'));
        }
        
        session()->regenerate();
        
        session()->set([
            'uid' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'avatar' => $user['image_path'] ?? '',
            'logged_in' => true,
        ]);
        
        //TODO Generete Cookie
        
        if ($remember) {
            $payload = [
                'uid'=>$user['id'], 
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'avatar' => $user['image_path'] ?? '',
                'logged_in' => true,
                'exp'=> time()+60*60*24*30,
            ];
            $enc = service('encrypter')->encrypt(json_encode($payload));
            response()->setCookie(
                name:'remember',
                value: base64_encode($enc),
                expire: 60*60*24*30,
                path:'/', domain:'',
                secure: ENVIRONMENT==='production',
                httponly:true,
                samesite:'Lax'
            );
        }
        
        //
        return redirect()->to(uri: base_url('dashboard')) ->with('success', lang('App.auth.login.success'));
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
        $AuthMail = new AuthMail();
        $AuthMail->sendEmailVerification($users->where('email', $data['email'])->first());
        return redirect()->to(route_to('auth.mail_verify'))->with('message', lang('App.auth.register.success'));
        
    }
    
    public function forgotPassword()
    {
        $blade = service(name: 'blade');
        return $blade->render('auth.forgot_password');
    }
    
    public function forgotPasswordNewPassword(){
        
        $rules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
            ],
            'password_confirm' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
            ],
            'userId' => [
                'rules' => 'required',
            ],
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $pass = $this->request->getPost('password');
        $userId = (int) $this->request->getPost('userId');
        
        $users = model(UserModel::class);
        $response = $users->update($userId, [
            'password_hash' => password_hash($pass, PASSWORD_BCRYPT)
        ]);
        if ($response) {
            return redirect()->to(route_to('auth.login'))->with('success', lang('App.auth.forgot_password.password_reset_success'));
        } else {
            return redirect()->back()->withInput()->with('error', lang('App.auth.forgot_password.password_reset_failed'));
        }
        
    }
    
    public function logout()
    {
        $msg = lang('App.auth.logout.success');
        $payload = base64_encode(json_encode([
            'icon' => 'success',
            'text' => $msg,
        ]));
        $response = redirect()->to(route_to('home'));
        $response->setCookie(
            name: 'toast',
            value: $payload,
            expire: 60,
            path: '/',
            domain: '',
            secure: ENVIRONMENT === 'production',
            httponly: true,
            samesite: 'Lax'
        );
        $response->deleteCookie('remember', '/');
        session()->destroy();
        
        return $response;
    }
    
    
}
