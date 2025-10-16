<?php

namespace App\Controllers;

class Assignments extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        return $blade->render('assignments/index');
    }
}
