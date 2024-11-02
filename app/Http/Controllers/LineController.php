<?php

namespace App\Http\Controllers;

use App\Models\LineModel;
use Illuminate\Http\Request;
use App\Models\Users;

class LineController extends Controller
{
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
        return redirect()->back();
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

    public function showDescription(Request $request)
    {
        $lineId = $request->query('line_id');

        $line = LineModel::find($lineId);

        if ($line) {
            return view('LinePages.LineDescription', compact('line'));
        }

        return redirect()->back()->with('error', 'Linha não encontrada');
    }

}
