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
            $viewedAssignments = [];
            foreach ($assignments as $assignment) {
                $viewedAssignments[] = [
                    'id' => $assignment['id'],
                    'name' => $coursesModel->where('id', $assignment['id_course'])->first()['name'] ?? 'Unknown Course',
                    'status' => $assignment['status'] ,
                    'teacher_name' => $usersModel->where('id', session()->get('uid'))->first()['name'] ?? 'Unknown Teacher',
                    'student_name' => $usersModel->where('id', $assignment['id_user'])->first()['name'] ?? 'Unknown Student',
                ];
            }
            $data = [
                'courses' => $courses,
                'students' => $students,
                'assignments' => $viewedAssignments,
            ];
            
        } else if (session()->get('role') === 'admin') {
            $courses = $coursesModel->where('teacher_owner_id', session()->get('uid'))->findAll();
            $students = $usersModel->where('role', 'student')->findAll();
            $assignments = $assignmentsModel->findAll();
            $viewedAssignments = [];
            foreach ($assignments as $assignment) {
                $viewedAssignments[] = [
                    'id' => $assignment['id'],
                    'name' => $coursesModel->where('id', $assignment['id_course'])->first()['name'] ?? 'Unknown Course',
                    'status' => $assignment['status'] ,
                    'teacher_name' => $usersModel->where('id', session()->get('uid'))->first()['name'] ?? 'Unknown Teacher',
                    'student_name' => $usersModel->where('id', $assignment['id_user'])->first()['name'] ?? 'Unknown Student',
                ];
            }
            $data = [
                'courses' => $courses,
                'students' => $students,
                'assignments' => $viewedAssignments,
            ];
            
        } else {
            $assignments = $assignmentsModel->where('id_user', session()->get('uid'))->findAll();
            $viewedAssignments = [];
            foreach ($assignments as $assignment) {
                $viewedAssignments[] = [
                    'id' => $assignment['id'],
                    'name' => $coursesModel->where('id', $assignment['id_course'])->first()['name'] ?? 'Unknown Course',
                    'status' => $assignment['status'] ,
                    'teacher_name' => $usersModel->where('id', $coursesModel->where('id', $assignment['id_course'])->first()['teacher_owner_id'] ?? 0)->first()['name'] ?? 'Unknown Teacher',
                ];
            }
            $data = [
                'assignments' => $viewedAssignments,
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

    public function delete($id){
        $assignmentsModel = model(AssignmentModel::class);
        $assignment = $assignmentsModel->find($id);
        if(!$assignment){
            return redirect()->back()->with('error', lang('App.assignments.assignment_not_found'));
        }
        
        $assignmentsModel->update($id, ['status' => 0]);
        $assignmentsModel->delete($id);
        return redirect()->back()->with('success', lang('App.assignments.assignment_deleted'));
    }
}
