<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Users;
use App\Models\MachineModel;
use App\Models\UserMachineModel;

class MachinePolicy
{
    /**
     * Create a new policy instance.
     */

    public function __construct( $machineModel)
    {
    }

    public function adminActivity( MachineModel $machineModel ){

        $userId = Users::getSessionId();
        $machineId = $machineModel->getKey();

        $userMachine = UserMachineModel::getUserMachine( $userId, $machineId );

        $isMachineAdmin = $userMachine->machineAdmin == 1;

        return ($isMachineAdmin || Users::isUserAdmin());
    }
}
