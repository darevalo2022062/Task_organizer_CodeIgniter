<?php

namespace App\Controllers;

class Course extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        return $blade->render('courses/index');
    }
}
