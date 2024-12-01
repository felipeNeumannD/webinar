<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterModel extends Model
{
    use HasFactory;
    protected $table = 'capitulo';

    public $totalPercentages;

    public $minPercentage;

    public function saveCourse($course_id, $description, $name)
    {

        $this->course_id = $course_id;
        $this->name = $name;
        $this->description = $description;

        $this->save();
    }

    protected $fillable = [
        'course_id',
        'name',
        'description'
    ];

    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'course_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(VideoModel::class, 'capitulo_id');
    }

    public function activities()
    {
        return $this->hasMany(ActivityModel::class, 'capitulo_id');
    }

    public function calculateTotalPercentage(): int
    {
        $userId = Users::getSessionId();

        $videos = $this->videos;
        $userCourse = UserCourseModel::getUserCourseId($userId, $this->course_id);

        if (!$userCourse) {
            return 0;
        }

        $total = 0;
        $totalVideos = $videos->count();

        foreach ($videos as $video) {
            $videoInfo = VideoInfoModel::where('user_course_id', $userCourse)
                ->where('video_id', $video->id)
                ->first();

            if ($videoInfo && $videoInfo->video_percentage >= 70) {
                $total ++;
            }
        }

        return $totalVideos > 0 ? round(( $total * 100 ) / $totalVideos) : 0;
    }

}
