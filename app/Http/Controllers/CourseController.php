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

    public function addChapter($id)
    {
        $classes = CourseModel::where('course_id', $id)->get();
    }

    public function exploreClass($idCourse)
    {

        $videos = Video::all();

        return view('CoursePages.RegisterVideoContent', compact('videos', 'idCourse'));
    }

    public function storeClass(Request $request, $idCourse)
{
    try {
        // Validação
        $validated = $request->validate([
            'courseName' => 'required|string|max:255',
            'courseDescription' => 'required|string|max:1000',
            'videos' => 'required|array',
            'videos.*.name' => 'required|string|max:255',
            'videos.*.description' => 'required|string|max:1000',
            'videos.*.file' => 'required|file|mimetypes:video/mp4|max:20480',
        ]);

        // Criar o capítulo (curso)
        $chapter = ChapterModel::create([
            'course_id' => $idCourse,
            'name' => $validated['courseName'],
            'description' => $validated['courseDescription'],
        ]);

        // Processar os vídeos
        foreach ($request->videos as $index => $videoData) {
            // Capturar o arquivo enviado
            $videoFile = $videoData['file'];

            $filePath = $videoFile->store('videos', 'public');

            Video::create([
                'capitulo_id' => $chapter->id, // ID do capítulo/curso
                'description' => $videoData['description'],
                'video' => $filePath, // Caminho do arquivo no sistema de arquivos
            ]);
        }

        return response()->json([
            'message' => 'Curso e vídeos salvos com sucesso!',
            'course_id' => $idCourse,
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Erro ao salvar o curso e vídeos.',
            'details' => $e->getMessage(),
        ], 500);
    }
}




    public function destroyClass($id)
    {
        $chapter = ChapterModel::findOrFail($id);
        $chapter->delete();

        return redirect()->back();

    }

}
