<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\CourseModel;
use App\Models\Users;

class CourseUserForm extends Component
{
    
    public CourseModel $courseModel;

    public function __construct(CourseModel $courseModel)
    {
        $this->courseModel = $courseModel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.course-user-form');
    }
}
