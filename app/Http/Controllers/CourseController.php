<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\UserCourseModel;
use App\Models\ChapterModel;
use App\Models\VideoModel;
use App\Models\Users;
use App\Models\ActivityModel;
use App\Models\OptionModel;

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


    public function addChapter($id)
    {
        $classes = CourseModel::where('course_id', $id)->get();
    }

    public function exploreClass($idCourse)
    {

        $videos = VideoModel::all();

        return view('CoursePages.RegisterVideoContent', compact('videos', 'idCourse'));
    }

    public function storeClass(Request $request, $idCourse)
    {
        try {
            $validated = $request->validate([
                'chapterName' => 'required|string|max:255',
                'chapterDescription' => 'required|string|max:1000',
                'videos' => 'required|array',
                'videos.*.description' => 'required|string|max:1000',
                'videos.*.file' => 'required|file|mimetypes:video/mp4|max:20480',

                'activities' => 'nullable|array',
                'activities.*.description' => 'required_with:activities|string|max:1000',
                'activities.*.options' => 'required_with:activities|array|min:2',
                'activities.*.options.*' => 'required|string|max:255',
                'activities.*.correct_option' => 'required_with:activities|integer|min:0',
            ]);

            $chapter = ChapterModel::create([
                'course_id' => $idCourse,
                'name' => $validated['chapterName'],
                'description' => $validated['chapterDescription'],
            ]);

            $this->storeVideo($request->videos, $chapter->getKey());

            $this->storeActivities($validated['activities'], $chapter->getKey());

            return response()->json([
                'message' => 'Curso, vídeos e atividades salvos com sucesso!',
                'course_id' => $idCourse,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao salvar o curso, vídeos ou atividades.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function storeVideo($videos, $chapterId)
    {
        if (!empty($videos)) {

            foreach ($videos as $videoData) {
                $videoFile = $videoData['file'];
                $filePath = $videoFile->store('videos', 'public');

                VideoModel::create([
                    'capitulo_id' => $chapterId,
                    'description' => $videoData['description'],
                    'video' => $filePath,
                ]);
            }
        }
    }

    public function storeActivities($activities, $chapterId)
    {
        if (!empty($activities)) {
            foreach ($activities as $activityData) {
                try {
                    $activity = ActivityModel::create([
                        'capitulo_id' => $chapterId,
                        'activity_description' => $activityData['description'],
                    ]);
                    foreach ($activityData['options'] as $index => $optionDescription) {
                        $option = OptionModel::create([
                            'activity_id' => $activity->id,
                            'description' => $optionDescription,
                        ]);
                        if ($index === (int) $activityData['correct_option']) {
                            $activity->update(['correct_option_id' => $option->id]);
                        }
                    }
                } catch (\Exception $e) {
                    throw new \Exception("Erro ao salvar a atividade: " . $e->getMessage());
                }
            }
        }
    }

    public function getChapterDetails($chapterId)
    {
        try {
            $chapter = ChapterModel::with(['videos', 'activities.options'])->findOrFail($chapterId);

            return response()->json([
                'chapter' => $chapter,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar os detalhes do capítulo.',
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
