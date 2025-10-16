<?php

namespace App\Controllers;

class Assignment extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        return $blade->render('assignments/index');
    }
}
