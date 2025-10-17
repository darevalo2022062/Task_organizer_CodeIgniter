<?php

namespace App\Controllers;
use App\Models\CourseModel;
use App\Models\UserModel;
use App\Models\TaskModel;
use App\Models\AssignmentModel;


class Course extends BaseController
{
    public function index(): string
    {
        $blade = service('blade');
        $courseModel = model(CourseModel::class);
        $userModel = model(UserModel::class);
        
        if(session('role') === 'admin') {
            $coursesData = $courseModel->findAll();
        } else if(session('role') === 'teacher') {
            $coursesData = $courseModel->where('teacher_owner_id', session('uid'))->findAll();
        } else if(session('role') === 'student') {
            $uid = (int) session('uid');
            $assigmentsModel = model(AssignmentModel::class);
            $assigments = $assigmentsModel->where('id_user', $uid)->findAll();
            $courseIds = array_column($assigments, 'id_course');
            $coursesData = $courseModel->whereIn('id', $courseIds)->findAll();
        } else {
            $coursesData = [];
        }
        
        $courses = [];
        foreach($coursesData as $course) {
            $courses[] = [
                'id' => $course['id'],
                'name' => $course['name'],
                'description' => $course['description'],
                'teacher_owner_id' => $course['teacher_owner_id'],
                'teacher_name' => $userModel->where('id', $course['teacher_owner_id'])->first()['name'] ?? 'Unknown Teacher',
                'created_at' => $course['created_at'],
                'color' => $course['color'] ?? '#4361ee',
                'students_count' => $this->getStudentsCount($course['id'])
            ];
        }
        
        $data = [
            'courses' => $courses
        ];
        
        return $blade->render('courses/index', $data);
    }
    
    public function create(){
        
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty|max_length[1000]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }
        
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        
        $courses = model(CourseModel::class);
        
        $courses->insert([
            'name' => $name,
            'description' => $description,
            'teacher_owner_id' => session('uid'),
        ]);
        
        return redirect()->back()->with('success', lang('App.courses.course_created'));
        
    }
    public function delete($id){
        $courses = model(CourseModel::class);
        $course = $courses->find($id);
        if(!$course){
            return redirect()->back()->with('error', lang('App.courses.course_not_found'));
        }
        if(session('role') !== 'admin' && session('uid') != $course['teacher_owner_id']){
            return redirect()->back()->with('error', lang('App.courses.unauthorized'));
        }
        $courses->update($id, ['status' => 0]);
        $courses->delete($id);
        
        //delete assignments and tasks related to the course
        $assignmentModel = model(AssignmentModel::class);
        $taskModel = model(TaskModel::class);
        $assignmentModel->where('id_course', $id)->update(['status' => 0]);
        $assignmentModel->where('id_course', $id)->delete();
        $taskModel->where('id_course', $id)->update(['status' => 0]);
        $taskModel->where('course_id', $id)->delete();

        return redirect()->back()->with('success', lang('App.courses.course_deleted'));
    }
    
    private function getStudentsCount($courseId)
    {
        return 0;
    }
}