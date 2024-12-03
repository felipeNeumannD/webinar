<?php

namespace App\Http\Controllers;

use App\Models\UserMachineModel;
use App\Models\MachineModel;
use App\Models\LineModel;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UserCourseModel;

class MachineController extends Controller
{

    public function returnInitialPage()
    {
        return redirect()->route("machines");
    }

    public function index()
    {
        $machines = $this->showMachines();
        return view("MachinePages/mainMachinePage", ["machines" => $machines]);
    }

    public function create(Request $request)
    {
        $model = new LineModel();
        $lines = $model->lineList();
        return view("MachinePages.MachineRegister", compact("lines"));
    }


    public function store(Request $request)
    {

        $email = $request->selectedUserMail;

        if (!empty($email)) {
            $model = new LineModel();
            $lineName = $model->lineId($request->lineList);

            $userid = Users::getId($email);

            $machine = new MachineModel();
            $machineUser = new UserMachineModel();

            $machine->saveMachine($request->nome, $request->descricao, $lineName);
            $machineUser->saveMachineUser($userid, $machine->getKey(), false);
        }
        return $this->returnInitialPage();
    }

    public function showMachines()
    {
        if (session()->has('user')) {
            $userSession = session('user');
            $userId = $userSession->getKey();

            $machinesListId = UserMachineModel::where('user_id', $userId)->pluck('machine_id');

            $machinesList = MachineModel::whereIn('id', $machinesListId)->get();

            return $machinesList;
        }
    }

    public function showDescription($id)
    {
        $userId = Users::getSessionId(); // Obtém o ID do usuário autenticado

        $machine = MachineModel::with([
            'courses' => function ($query) use ($userId) {
                $query->whereHas('userCourses', function ($subQuery) use ($userId) {
                    $subQuery->where('user_id', $userId);
                });
            }
        ])->findOrFail($id);

        foreach ($machine->courses as $course) {
            $course->coursePercentage = $course->calculateTotalPercentage();
        }

        return view('MachinePages.MachineDetails', compact('machine'));
    }

    public function edit($id)
    {
        $machine = MachineModel::findOrFail($id);
        return view('MachinePages.editMachine', compact('machine'));
    }

    public function update(Request $request, $id)
    {
        $machine = MachineModel::findOrFail($id);
        $machine->name = $request->input('name');
        $machine->description = $request->input('description');
        $machine->save();

        return $this->returnInitialPage();
    }

    public function destroy($id)
    {
        $machine = MachineModel::findOrFail($id);

        $machine->courses()->delete();

        $machine->delete();

        return $this->returnInitialPage();
    }


    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!Users::where('id', $value)->exists()) {
                        $fail('O usuário selecionado não é válido.');
                    }
                },
            ],
            'machine_id' => 'required|integer|exists:machines,id',
            'is_admin' => 'nullable|boolean',
        ]);

        $isAdmin = isset($validatedData['is_admin']) && $validatedData['is_admin'] === '1';

        $machineUser = new UserMachineModel();
        $machineUser->saveMachineUser($validatedData['user_id'], $validatedData['machine_id'], $isAdmin);
        $id = $validatedData['machine_id'];

        return redirect()->route('machine.description', [$id]);

    }


}
