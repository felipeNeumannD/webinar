<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseModel extends Model
{
    use HasFactory;

    protected $table = 'user_course';

    public function saveUserCourse($user_id, $course_id, $admin)
    {

        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->admin = $admin;

        $this->save();
    }

    public static function getUserCourseId($userId, $courseId)
    {
        return self::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->value('id');
    }


}
