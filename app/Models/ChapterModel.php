<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterModel extends Model
{
    use HasFactory;
    protected $table = 'capitulo';

    public function saveCourse( $course_id, $description, $name ) {

        $this->course_id = $course_id;
        $this->name = $name;
        $this->description = $description;

        $this-> save();
    }

    protected $fillable = [
        'course_id',
        'name',
        'description'
    ];
    
}
