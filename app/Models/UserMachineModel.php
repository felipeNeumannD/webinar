<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMachineModel extends Model
{
    use HasFactory;

    protected $table = 'user_machine';

    public function saveMachineUser ( $userId, $machineId, $isMachineAdmin ) {
        $this->user_id = $userId;
        $this->machine_id = $machineId;
        $this->machineAdmin = $isMachineAdmin;
        $this-> save();
    }
}
