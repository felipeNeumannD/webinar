<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMachineModel extends Model
{
    use HasFactory;

    protected $table = 'user_machine';

    public function saveMachineUser($userId, $machineId, $isAdmin = false)
    {
        return self::updateOrCreate(
            [
                'user_id' => $userId,
                'machine_id' => $machineId,
            ],
            [
                'machineAdmin' => $isAdmin,
            ]
        );
    }

    protected $fillable = [
        'user_id',
        'machine_id',
        'machineAdmin',
    ];

    public static function getUserMachine($userId, $machineId)
    {
        return self::where('user_id', $userId)
            ->where('machine_id', $machineId)->first();
    }
}
