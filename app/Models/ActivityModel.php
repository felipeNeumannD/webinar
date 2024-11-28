<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityModel extends Model
{
    use HasFactory;
    protected $table = 'activities';

    protected $fillable = [
        'capitulo_id',
        'activity_description',
        'correct_option_id'
    ];


    public function options()
    {
        return $this->hasMany(OptionModel::class, 'activity_id');
    }

}
