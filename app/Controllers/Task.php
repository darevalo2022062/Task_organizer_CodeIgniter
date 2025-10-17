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
                    'due_date' => $task['due_date'],
                    'status' => $task['status'],
                    'course_name' => $course['name'] ?? 'Unknown Course',
                ];
            }
            $data = [
                'tasks' => $taskViews,
                'courses' => $courses
            ];
        } else if (session()->get('role') === 'admin') {
            $tasksData = $taskModel->findAll();
        } else {
            $tasksData = [];
            
        }
        
        
        $blade = service(name: 'blade');
        return $blade->render('tasks/index', $data);
    }
    
    public function create(){
        $rules = [
            'name' => 'required|string|max_length[255]',
            'description' => 'permit_empty|string',
            'due_date' => 'required|valid_date[Y-m-d\TH:i]',
            'course_id' => 'required|integer|is_not_unique[courses.id]',
            'grade' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[10]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $taskModel = model(TaskModel::class);
        $taskModel->insert([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'course_id' => $this->request->getPost('course_id'),
            'grade' => $this->request->getPost('grade'),
            'due_date' => $this->request->getPost('due_date'),
        ]);
        return redirect()->back()->with('success',lang('App.common.create_success'));
    }
    
    public function view($id){
        $taskModel = model(TaskModel::class);
        $task = $taskModel->find($id);
        if (!$task) {
            return redirect()->back()->with('error', lang('App.tasks.not_found'));
        }
        $courseModel = model(CourseModel::class);
        $course = $courseModel->find($task['course_id']);
        
        $data = [
            'task' => $task,
            'course' => $course,
        ];
        
        $blade = service(name: 'blade');
        return $blade->render('tasks/view', $data);
    }
    
    public function edit($id){
        $rules = [
            'name' => 'required|string|max_length[255]',
            'description' => 'permit_empty|string',
            'due_date' => 'required|valid_date[Y-m-d\TH:i]',
            'grade' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[10]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $taskModel = model(TaskModel::class);
        
        $taskModel->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'due_date' => $this->request->getPost('due_date'),
            'grade' => $this->request->getPost('grade'),
        ]);
        return redirect()->back()->with('success', lang('App.common.update_success'));
    }
    
    public function delete($id){
        $taskModel = model(TaskModel::class);
        $taskModel->update($id, ['status' => 0]);
        $taskModel->delete($id);
        return redirect()->to('tasks')->with('success', lang('App.common.delete_success'));
    }
    
}