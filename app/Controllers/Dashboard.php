<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        return $blade->render('dashboard/dashboard');
    }
}
