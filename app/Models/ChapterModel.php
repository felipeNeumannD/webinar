<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterModel extends Model
{
    use HasFactory;
    protected $table = 'capitulo';

    public function saveCourse($course_id, $description, $name)
    {

        $this->course_id = $course_id;
        $this->name = $name;
        $this->description = $description;

        $this->save();
    }

    protected $fillable = [
        'course_id',
        'name',
        'description'
    ];

    public function videos()
    {
        return $this->hasMany(VideoModel::class, 'capitulo_id');
    }

    public function activities()
    {
        return $this->hasMany(ActivityModel::class, 'capitulo_id');
    }

}
