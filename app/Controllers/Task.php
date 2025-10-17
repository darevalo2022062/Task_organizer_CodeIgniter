<?php

namespace App\Controllers;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
use App\Models\UserModel;


class Task extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        return $blade->render('tasks/index');
    }
}