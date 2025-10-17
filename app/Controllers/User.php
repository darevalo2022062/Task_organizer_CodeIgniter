<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        $userModel = model(UserModel::class);
        $users = $userModel->findAll();
        return $blade->render('users/index', ['users' => $users]);
    }
}
