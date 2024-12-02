<?php

namespace App\Http\Controllers;

use App\Models\UserCourseModel;
use App\Models\Users;

class MainController extends Controller
{
    public function index()
    {
        $lateCourses = $this->getLateCourses(1);
        $soonLateCourses = $this->getNotLateCourses(0.9);

        return view("mainView", [
            'lateCourses' => $lateCourses,
            'soonLateCourses' => $soonLateCourses,
        ]);
    }

    public function getLateCourses($yearTime)
    {
        $userId = Users::getSessionId();

        $courses = UserCourseModel::with('course.chapters.videos')
            ->where('user_id', $userId)
            ->get()
            ->pluck('course');

        if ($courses->isEmpty()) {
            return [];
        }

        $delayedCourses = [];

        foreach ($courses as $course) {
            $delayedChapters = [];

            foreach ($course->chapters as $chapter) {
                foreach ($chapter->videos as $video) {
                    $lastUpdatedDate = $video->updated_at;

                    if ($lastUpdatedDate instanceof \Carbon\Carbon) {
                        $lastUpdatedDate = \Carbon\Carbon::parse($lastUpdatedDate);
                    }

                    if (!$lastUpdatedDate || $lastUpdatedDate->diffInYears(now()) > $yearTime) {
                        $delayedChapters[] = [
                            'chapter_name' => $chapter->name,
                            'video_description' => $video->description,
                            'last_watched' => $lastUpdatedDate ? $lastUpdatedDate->format('d/m/Y') : 'Nunca assistido',
                        ];
                    }
                }
            }

            if (!empty($delayedChapters)) {
                $delayedCourses[] = [
                    'course_name' => $course->name,
                    'course_description' => $course->description,
                    'delayed_chapters' => $delayedChapters,
                ];
            }
        }

        return $delayedCourses;
    }

    public function getNotLateCourses($yearTime)
    {
        $userId = Users::getSessionId();

        $courses = UserCourseModel::with('course.chapters.videos')
            ->where('user_id', $userId)
            ->get()
            ->pluck('course');

        if ($courses->isEmpty()) {
            return [];
        }

        $delayedCourses = [];

        foreach ($courses as $course) {
            $delayedChapters = [];

            foreach ($course->chapters as $chapter) {
                foreach ($chapter->videos as $video) {
                    $lastUpdatedDate = $video->updated_at;

                    if ($lastUpdatedDate instanceof \Carbon\Carbon) {
                        $lastUpdatedDate = \Carbon\Carbon::parse($lastUpdatedDate);
                    }

                    if (!$lastUpdatedDate || $lastUpdatedDate->diffInYears(now()) > $yearTime &&  1 > $yearTime) {
                        $delayedChapters[] = [
                            'chapter_name' => $chapter->name,
                            'video_description' => $video->description,
                            'last_watched' => $lastUpdatedDate ? $lastUpdatedDate->format('d/m/Y') : 'Nunca assistido',
                        ];
                    }
                }
            }

            if (!empty($delayedChapters)) {
                $delayedCourses[] = [
                    'course_name' => $course->name,
                    'course_description' => $course->description,
                    'delayed_chapters' => $delayedChapters,
                ];
            }
        }

        return $delayedCourses;
    }

}
