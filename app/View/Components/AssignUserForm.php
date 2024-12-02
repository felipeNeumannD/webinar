<?php

namespace App\View\Components;

use App\Models\MachineModel;
use App\Models\Users;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AssignUserForm extends Component
{
    public MachineModel $machineModel;
    public $users;

    /**
     * Cria uma nova instância do componente.
     */
    public function __construct(MachineModel $machineModel)
    {
        $this->machineModel = $machineModel;
        $this->users = Users::all();
    }

    public function render(): View|Closure|string
    {
        return view('components.assign-user-form', [
            'users' => $this->users,
            'machineModel' => $this->machineModel,
        ]);
    }
}
