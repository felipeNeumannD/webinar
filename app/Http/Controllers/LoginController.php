<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class LoginController extends Controller
{
    public function index() {
        return view("login");
    }

    public function signUp(){
        return view("cadastro");
    }

    public function createUser( Request $request ){
        $user = new Users;

        $user->name = $request->Name;
        $user->email = $request->Email;
        $user->password = bcrypt( $request->Password );
        $user->CompanyId = $request->Identification;
        $user->Admin = false;

        $user->save();

        return redirect("/");
    }
}
