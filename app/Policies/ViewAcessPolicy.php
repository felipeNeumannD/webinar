<?php

namespace App\Policies;

use App\Models\UserCourseModel;
use App\Models\Users;
use App\Models\CourseModel;

class ViewAcessPolicy
{


    public CourseModel $courseModel;

    public function __construct( CourseModel $courseModel)
    {
        $this->courseModel = $courseModel;
    }

    public function view(){
        $userId = Users::getSessionId();
        $courseId = $this->courseModel->getKey();

        $userCourse = UserCourseModel::getUserCourse( $userId, $courseId );

        $isCourseAdmin = $userCourse->admin == 1;

        return ($isCourseAdmin || Users::isUserAdmin());
    }

}
