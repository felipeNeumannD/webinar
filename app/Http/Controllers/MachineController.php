<?php

namespace App\Http\Controllers;

use App\Models\UserMachineModel;
use App\Models\MachineModel;
use App\Models\LineModel;
use Illuminate\Http\Request;
use App\Models\Users;


class MachineController extends Controller
{
    public function index()
    {
        $machines = $this->showMachines();
        return view("MachinePages/mainMachinePage", ["machines" => $machines]);
    }

    public function create( Request $request ){
        $model = new LineModel();
        $lines = $model->lineList();
        return view("MachinePages.MachineRegister", compact("lines"));
    }


    public function store( Request $request ){
    
        $email = $request->selectedUserMail;

        if (!empty($email)) {
            $model = new LineModel();
            $lineName = $model->lineId( $request->lineList );

            $userid = Users::getId($email);

            $machine = new MachineModel();
            $machineUser = new UserMachineModel();

            $machine->saveMachine($request->nome, $request->descricao, $lineName );
            $machineUser->saveMachineUser($userid,$machine->getKey(), false);
        }
        return redirect()->back();
    }

    public function showMachines()
    {
        $machinesList = MachineModel::all();
        return $machinesList;
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
    
        return redirect()->route('machines')->with('success', 'Machine updated successfully');
    }

    public function destroy($id)
    {
        $machine = MachineModel::findOrFail($id);
    
        $machine->courses()->delete();
    
        $machine->delete();
    
        return redirect()->route('machines')->with('success', 'Machine deleted successfully');
    }

}
