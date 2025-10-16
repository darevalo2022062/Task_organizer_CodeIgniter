<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        return $blade->render('profile/profile');
    }
}
