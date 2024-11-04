<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineModel extends Model
{
    use HasFactory;

    protected $table = 'machines';

    public function saveMachine( $nome, $descricao, $combobox ) {
        $this->name = $nome;
        $this->description = $descricao;
        $this->line_id = $combobox;
        $this-> save();
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($machine) {
            $machine->courses()->delete();
        });
    }

    public function courses()
    {
        return $this->hasMany(CourseModel::class, 'machine_id', 'id');
    }

}
