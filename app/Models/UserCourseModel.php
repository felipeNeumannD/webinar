<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseModel extends Model
{
    use HasFactory;

    protected $table = 'user_course';

    public function saveUserCourse( $user_id, $course_id, $watched_percentage, $activity_percentage ) {

        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->watched_percentage = $watched_percentage;
        $this->activity_percentage = $activity_percentage;

        $this-> save();
    }


}
