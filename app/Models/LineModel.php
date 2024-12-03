<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($line) {
            $line->machines()->delete();
        });
    }

    public function machines()
    {
        return $this->hasMany(MachineModel::class, 'line_id', 'id');
    }

    public function getAcess(){
        $userId = Users::getSessionId();
        $id = $this->admin_id;

        return (($id == $userId) || Users::isUserAdmin());
    }
}
