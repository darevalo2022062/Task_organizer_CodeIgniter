<?php

namespace App\Controllers;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
use App\Models\UserModel;


class Assignment extends BaseController
{
    public function index(): string
    {
        $blade = service(name: 'blade');
        $assignmentsModel = model(AssignmentModel::class);
        $coursesModel = model(CourseModel::class);
        $usersModel = model(UserModel::class);
        
        
        if (session()->get('role') === 'teacher') {
            $courses = $coursesModel->where('teacher_owner_id', session()->get('uid'))->findAll();
            $students = $usersModel->where('role', 'student')->findAll();
            $assignments = $assignmentsModel->whereIn('id_course', array_column($courses, 'id'))->findAll();
            
            $data = [
                'courses' => $courses,
                'students' => $students,
                'assignments' => $assignments,
            ];
            
        } else if (session()->get('role') === 'admin') {
            $courses = $coursesModel->where('teacher_owner_id', session()->get('uid'))->findAll();
            $students = $usersModel->where('role', 'student')->findAll();
            $assignments = $assignmentsModel->findAll();
            
            $data = [
                'courses' => $courses,
                'students' => $students,
                'assignments' => $assignments,
            ];
            
        } else {
            $assignments = $assignmentsModel->where('id_user', session()->get('uid'))->findAll();
            $data = [
                'assignments' => $assignments,
            ];
        }
        
        return $blade->render('assignments/index', $data);
    }
    
    public function create(){
        
        $rules = [
            'student_id' => [
                'label' => 'Student',
                'rules' => 'required|integer'
            ],
            'course_id' => [
                'label' => 'Course',
                'rules' => 'required|integer'
            ],
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }
        
        $studentId = $this->request->getPost('student_id');
        $courseId = $this->request->getPost('course_id');
        $teacherId = $this->request->getPost('teacher_id');
        $assignmentsModel = model(AssignmentModel::class);
        
        $response = $assignmentsModel->insert([
            'id_user' => $studentId,
            'id_course' => $courseId,
        ]);
        
        if ($response) {
            return redirect()->back()->with('success', lang('App.common.create_success'));
        } else {
            return redirect()->back()->with('error', lang('App.common.create_error'));
        }
        
    }
}
