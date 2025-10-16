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
    
    public function updatePassword(){
        $rules = [
            'current_password' => [
                'label' => 'Current Password',
                'rules' => 'required'
            ],
            'new_password' => [
                'label' => 'New Password',
                'rules' => 'required|min_length[8]'
            ],
            'confirm_new_password' => [
                'label' => 'Confirm New Password',
                'rules' => 'required|matches[new_password]'
            ],
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }
        
        $users = model(UserModel::class);
        $current_password = $this->request->getPost('current_password');
        $new_password = $this->request->getPost('new_password');
        $userId = session()->get('uid');
        $user = $users->where('id', $userId)->first();
        
        if (!$user || !password_verify($current_password, $user['password_hash'] ?? '')) {
            return redirect()->back()->with('error', lang('App.common.invalid_password'));
        }
        
        $response = $users->update($userId, [
            'password_hash' => password_hash($new_password, PASSWORD_BCRYPT)
        ]);
        
        if($response){
            return redirect()->back()->with('success', lang('App.common.update_success'));
        } else {
            return redirect()->back()->with('error', lang('App.common.update_failed'));
        }
        
    }
    
    public function updateAvatar(){
        $rules = [
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'uploaded[avatar]|is_image[avatar]|max_size[avatar,8048]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/gif]'
            ],
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }
        
        $users = model(UserModel::class);
        $userId = session()->get('uid');
        $user = $users->where('id', $userId)->first();
        
        if (!$user) {
            return redirect()->back()->with('error', lang('App.common.user_not_found'));
        }
        
        $file = $this->request->getFile('avatar');
        if (! $file->isValid()) {
            return redirect()->back()->with('error', 'Archivo inválido');
        }
        
        $newName = $file->getRandomName();
        $targetFolder = WRITEPATH . '../public/uploads/avatars/';
        $file->move($targetFolder, $newName);
        $relativePath = 'uploads/avatars/' . $newName;
        
        $users = model(UserModel::class);
        $user = $users->find($userId);
        
        if (! empty($user['image_path'])) {
            $old = ROOTPATH . 'public/' . $user['image_path'];
            if (is_file($old)) {
                unlink($old);
            }
        }
        
        
        $users->update($userId, ['image_path' => $relativePath]);
        
        session()->set('avatar', $relativePath);
        
        return redirect()->back()->with('success', 'Avatar actualizado');
        
    }
    
    public function deleteAvatar(){
        $users = model(UserModel::class);
        $userId = session()->get('uid');
        $user = $users->where('id', $userId)->first();
        
        if (!$user) {
            return redirect()->back()->with('error', lang('App.common.user_not_found'));
        }
        
        if (empty($user['image_path'])) {
            return redirect()->back()->with('error', lang('App.common.no_data'));
        }
        
        $old = ROOTPATH . 'public/' . $user['image_path'];
        if (is_file($old)) {
            unlink($old);
        }
        
        $users->update($userId, ['image_path' => null]);
        session()->remove('avatar');
        
        return redirect()->back()->with('success', lang('App.common.delete_success'));
    }
    
}
