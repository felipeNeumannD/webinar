<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    use HasFactory;

    protected $table = 'courses';

    public function saveCourse( $name, $machine_id, $description, $min_vid_percentage, $min_activity_percentage, $isActivity ) {

        $this->name = $name;
        $this->machine_id = $machine_id;
        $this->description = $description;
        $this->activity = $isActivity;
        $this->min_vid_percentage = $min_vid_percentage;
        $this->min_activity_percentage = $min_activity_percentage;

        $this-> save();
    }
}
