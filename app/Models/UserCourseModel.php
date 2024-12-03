<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseModel extends Model
{
    use HasFactory;

    protected $table = 'user_course';

    protected $fillable = [
        'user_id',
        'course_id',
        'admin',
    ];

    public static function saveUserCourse($user_id, $course_id, $admin)
    {
        return self::updateOrCreate(
            [
                'user_id' => $user_id,
                'course_id' => $course_id,
            ],
            [
                'admin' => $admin,
            ]
        );
    }

    public static function getUserCourseId($userId, $courseId)
    {
        return self::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->value('id');
    }

    public static function getUserCourse($userId, $courseId)
    {
        return self::where('user_id', $userId)
            ->where('course_id', $courseId)->get();
    }

    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

}
