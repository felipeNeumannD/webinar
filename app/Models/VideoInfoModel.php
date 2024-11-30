<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoInfoModel extends Model
{
    use HasFactory;

    protected $table = 'video_inf';

    protected $fillable = [
        'user_course_id',
        'video_id',
        'video_percentage',
    ];
}
