<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineModel extends Model
{
    use HasFactory;

    protected $table = 'production_lines';

    public function lineList(){
        $line = $this::all();
        return $line;
    }

    public function lineId($name){
        $line = $this::where('name', $name)->first()->getKey();
        return $line;
    }
}
