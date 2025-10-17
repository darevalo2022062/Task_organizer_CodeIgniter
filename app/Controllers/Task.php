<?php

namespace App\Controllers;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
use App\Models\UserModel;
use App\Models\TaskModel;

class Task extends BaseController
{
    public function index(): string
    {
        $taskModel = model(TaskModel::class);
        $assigmentsModel = model(AssignmentModel::class);
        $courseModel = model(CourseModel::class);
        
        if (session()->get('role') === 'student') {
            $uid = (int) session('uid');
            $assigments = $assigmentsModel->where('id_user', $uid)->findAll();
            $courseIds = array_column($assigments, 'id_course');
            $tasksData = $taskModel->whereIn('course_id', $courseIds)->findAll();
            $data = [
                'tasks' => $tasksData
            ];
        
        } else if (session()->get('role') === 'teacher') {
            $uid = (int) session()->get('uid');
            $courses = $courseModel->where('teacher_owner_id', $uid)->findAll();
            $courseIds = array_column($courses, 'id');
            $tasksData = $taskModel->whereIn('course_id', $courseIds)->findAll();
            $taskViews = [];
            foreach ($tasksData as $task) {
                $course = $courseModel->where('id', $task['course_id'])->first();
                $taskViews[] = [
                    'id' => $task['id'],
                    'name' => $task['name'],
                    'description' => $task['description'],
                    'due_date' => $task['created_at'],
                    'status' => $task['status'],
                    'course_name' => $course['name'] ?? 'Unknown Course',
                ];

            }
            $data = [
                'tasks' => $taskViews
            ];
        } else if (session()->get('role') === 'admin') {
            $tasksData = $taskModel->findAll();
        } else {
            $tasksData = [];

        }
        
        
        $blade = service(name: 'blade');
        return $blade->render('tasks/index', $data);
    }
}