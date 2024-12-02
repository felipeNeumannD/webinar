<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class CourseModel extends Model
{
    use HasFactory;

    protected $table = 'courses';
    public $coursePercentage;

    public $minPercent;

    public function saveCourse( $name, $machine_id, $description, $min_vid_percentage, $min_activity_percentage, $isActivity ) {

        $this->name = $name;
        $this->machine_id = $machine_id;
        $this->description = $description;
        $this->activity = $isActivity;
        $this->min_vid_percentage = $min_vid_percentage;
        $this->min_activity_percentage = $min_activity_percentage;

        $this-> save();
    }


    public function calculateTotalPercentage(){

        $chapters = ChapterModel::where('course_id', $this->id)->get();
        $total = 0;

        foreach($chapters as $chapter){
            $total += $chapter->calculateTotalPercentage();
        }

        return ($chapters->count() > 0) ? $total/$chapters->count() : 0;
    }

    public function chapters()
    {
        return $this->hasMany(ChapterModel::class, 'course_id');
    }


    public static function getVidPercent($id){
        return self::where('id', $id)->select('min_vid_percentage')->get();
    }
}
