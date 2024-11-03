<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\UserCourseModel;
use App\Models\Users;

class CourseController extends Controller
{
    public function index()
    {
        $courses = $this->getCoursesByAccess();
        return view("CoursePages/mainCoursePage", ["courses" => $courses]);
    }

    public function create()
    {
        return view('CoursePages.CourseRegister');
    }

    public function getCoursesByAccess()
    {
        return CourseModel::all();
    }

    public function store( Request $request )
    {
       $course = new CourseModel();
       $courseUser = new UserCourseModel();

       $isActivity = false;
       if( $request->campo_extra != null)
       {
        $isActivity = true; 
       }

       $course->saveCourse($request->nome,'1', $request->descricao, $request->videopercent, $request->campo_extra, $isActivity );

       $email = $request->selectedUserMail;

       $id = Users::getId($email);
       $courseUser->saveUserCourse( $id, $course->getKey(), 0, 0 );

        return redirect('/main');
    }


}
