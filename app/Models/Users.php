<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'user';


    public static function getId( $email )
    {
        return Users::where("email", $email)->first()->id;
    }


    public static function getSessionId(){
        $user = session('user');
        $userId = ($user instanceof Users) ? $user->id : 0 ;
        
        return $userId;
    }
}
