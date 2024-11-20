<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterModel extends Model
{
    use HasFactory;
    protected $table = 'capitulo';

    public function saveCourse( $course_id, $description, $name ) {

        $this->name = $name;
        $this->course_id = $course_id;
        $this->description = $description;

        $this-> save();
    }
    
}
