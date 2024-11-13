<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\UserCourseModel;
use App\Models\Video;
use App\Models\Users;

class CourseController extends Controller
{
    public function index()
    {
        $courses = $this->getCoursesByAccess();
        return view("CoursePages/mainCoursePage", ["courses" => $courses]);
    }

    public function create($id)
    {
        return view('CoursePages.CourseRegister', compact("id"));
    }

    public function getCoursesByAccess()
    {
        return CourseModel::all();
    }

    public function getShowVideo()
    {
        $videos = Video::all();

        return view('CoursePages.video', compact('videos'));
    }

    public function store( Request $request, $id )
    {
       $course = new CourseModel();
       $courseUser = new UserCourseModel();

       $isActivity = false;
       if( $request->campo_extra != null)
       {
        $isActivity = true; 
       }

       $course->saveCourse($request->nome,$id, $request->descricao, $request->videopercent, $request->campo_extra, $isActivity );

       $email = $request->selectedUserMail;

       $id = Users::getId($email);
       $courseUser->saveUserCourse( $id, $course->getKey(), 0, 0 );

        return redirect('/main');
    }

    public function getRegisterVideoPage()
    {
        return view('CoursePages/RegisterVideo');
    }

    public function storeVideo( Request $request )
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');

            $video = new Video();
            $video->course_id = "2";
            $video->description = "Teste";
            $video->video = $videoPath;
            $video->save();

            return redirect("")->route("RegisterVideoPage");
        }

    }
    


}
