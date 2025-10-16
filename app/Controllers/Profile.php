<?php

namespace App\Controllers;
use App\Models\UserModel;


class Profile extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        return $blade->render('profile/profile');
    }
    
    public function update(){
        
        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required|min_length[3]|max_length[255]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ],
            'current_password' => [
                'label' => 'Current Password',
                'rules' => 'required'
            ],
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }
        
        $users = model(UserModel::class);
        
        $current_password = $this->request->getPost('current_password');
        $email = $this->request->getPost('email');
        $name = $this->request->getPost('name');
        $userId = session()->get('uid');
        $user = $users->where('id', $userId)->first();
        
        if (!$user || !password_verify($current_password, $user['password_hash'] ?? '')) {
            return redirect()->back()->with('error', lang('App.common.invalid_password'));
        }
        
        $repsonse = $users->update($userId, [
            'name' => $name,
            'email' => $email,
        ]);
        
        if($repsonse){
            session()->set('name', $name);
            session()->set('email', $email);
            return redirect()->back()->with('success', lang('App.common.update_success'));
        } else {
            return redirect()->back()->with('error', lang('App.common.update_failed'));
        }
        
        
    }
    
}
