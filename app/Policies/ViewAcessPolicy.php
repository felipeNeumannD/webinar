<?php

namespace App\Policies;

use App\Models\UserCourseModel;
use App\Models\Users;
use App\Models\CourseModel;

class ViewAcessPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct( CourseModel $courseModel)
    {
        $userId = Users::getSessionId();
        $courseId = $courseModel->getKey();

        $userCourse = UserCourseModel::getUserCourse( $userId, $courseId );

        $isAdmin = ($userCourse->admin == 1);

        
    }
}
