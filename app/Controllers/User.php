<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AssignmentModel;


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
    
    public function editPage($id){
        $userModel = model(UserModel::class);
        $blade = service(name: 'blade');
        $user = $userModel->find($id);
        $assignmentsModel = model(AssignmentModel::class);
        $assignments = $assignmentsModel->where('id_user', $id)->findAll();
        $data = [
            ...$user,
            'number_courses' => count($assignments)
        ];
        
        return $blade->render('users/edit', ['user' => $data]);
    }
    
    public function edit($id){
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'role' => 'required|in_list[admin,teacher,student]',
            'email' => 'required|valid_email',
            'status' => 'required|in_list[1,0]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $userModel = model(UserModel::class);
        $userModel->update($id, [
            'name' => $this->request->getPost('name'),
            'role' => $this->request->getPost('role'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
        ]);
        return redirect()->back()->with('success',lang('App.common.update_success'));
    }
    
    public function updateAvatar($userId){
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
    
}
