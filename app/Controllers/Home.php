<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        return $blade->render('home');
    }
}
