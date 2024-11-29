<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    use HasFactory;

    protected $table = 'videos';


    protected $fillable = [
        'capitulo_id',
        'description',
        'video',
    ];
}