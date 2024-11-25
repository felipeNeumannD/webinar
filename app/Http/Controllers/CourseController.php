<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\UserCourseModel;
use App\Models\ChapterModel;
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

    public function showDescription($id)
    {
        $classes = ChapterModel::where('course_id', $id)->get();

        return view('CoursePages.mainCoursePage', compact(['classes']));

    }

    public function store(Request $request, $id)
    {
        $course = new CourseModel();
        $courseUser = new UserCourseModel();

        $isActivity = false;
        if ($request->campo_extra != null) {
            $isActivity = true;
        }

        $course->saveCourse($request->nome, $id, $request->descricao, $request->videopercent, $request->campo_extra, $isActivity);

        $email = $request->selectedUserMail;

        $id = Users::getId($email);
        $courseUser->saveUserCourse($id, $course->getKey(), 0, 0);

        return redirect('/main');
    }

    public function getRegisterVideoPage()
    {
        return view('CoursePages/RegisterVideo');
    }

    public function storeVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        if ($request->hasFile('video')) {


            $idChapter = $request->hidden_number;

            $videoPath = $request->file('video')->store('videos', 'public');

            $video = new Video();
            $video->capitulo_id = $idChapter;
            $video->description = "Teste";
            $video->video = $videoPath;
            $video->save();

        }

    }

    public function addChapter( $id)
    {
        $classes = CourseModel::where('course_id', $id)->get();
    }

    public function exploreClass($idCourse){

        $videos = Video::all();

        return view('CoursePages.RegisterVideoContent', compact('videos', 'idCourse'));
    }

    public function storeClass( $idCourse, Request $request )
    {
        $chapter = new ChapterModel;

        $chapter->saveCourse($idCourse,$request->description, $request->name);

        return $this->showDescription($idCourse);
    }

    public function destroyClass( $id )
    {
        $chapter = ChapterModel::findOrFail($id);
        $chapter->delete();

        return redirect()->back();

    }

}
