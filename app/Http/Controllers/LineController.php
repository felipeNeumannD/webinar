<?php

namespace App\Http\Controllers;

use App\Models\LineModel;
use Illuminate\Http\Request;
use App\Models\Users;

class LineController extends Controller
{

    public function returnInitialPage(){
        return redirect()->route("lines");
    }


    public function index()
    {
        $lines = $this->lineUserList();
        return view("LinePages/mainLinePage", ["userLines" => $lines]);
    }

    public function create()
    {
        return view("LinePages.LineRegister");
    }

    public function lineRegister(Request $request)
    {
        $email = $request->selectedUserMail;

        if (!empty($email)) {
            $userid = Users::where("email", $email)->first()->id;
            $line = new LineModel;

            $line->name = $request->nome;
            $line->description = $request->descricao;
            $line->admin_id = $userid;

            $line->save();
        }
        return $this->returnInitialPage();
    }


    public function lineUserList()
    {
        $user = session('user');

        if ($user instanceof Users) {
            $lines = LineModel::where('admin_id', $user->id)->get();
            return $lines;
        }
        return collect();
    }

    public function showDescription($id)
    {
        $line = LineModel::with('machines')->findOrFail($id);
        return view('LinePages.LineDescription', compact('line'));
    }

    public function edit($id)
    {
        $line = LineModel::findOrFail($id);
        return view('LinePages.editLine', compact('line'));
    }

    public function update(Request $request, $id)
    {
        $line = LineModel::findOrFail($id);
        $line->name = $request->input('name');
        $line->description = $request->input('description');
        $line->save();
    
        return $this->returnInitialPage();
    }

    public function destroy($id)
    {
        $line = LineModel::findOrFail($id);
    
        $line->forceDelete();
    
        return $this->returnInitialPage();
    }

}
