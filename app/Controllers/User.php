<?php

namespace App\Controllers;
use App\Models\UserModel;

use function PHPUnit\Framework\isEmpty;

class User extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        $userModel = model(UserModel::class);
        $users = $userModel->findAll();
        return $blade->render('users/index', ['users' => $users]);
    }
    
    public function create(){
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'role' => 'required|in_list[admin,teacher,student]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $userModel = model(UserModel::class);
        
        $userModel->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getPost('role'),
        ]);
        $AuthMail = new AuthMail();
        $AuthMail->sendEmailVerification($userModel->where('email', $this->request->getPost('email'))->first());
        return redirect()->back()->with('success',lang('App.common.create_success'));
        
    }
}
