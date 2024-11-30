<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesInfoModel extends Model
{
    use HasFactory;

    protected $table = 'activity_inf';


    public function saveActivitiesInf( $user_course_id, $correctPercentage ){
        $this->user_course_id = $user_course_id;
        $this->activity_percentage = $correctPercentage;
        $this->save();
    }

    protected $fillable = [
        'user_course_id',
        'activity_id',
        'activity_percentage',
    ];
}
