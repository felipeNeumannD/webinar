<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Hash;
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
        $user->password = Hash::make($request->Password);
        $user->CompanyId = $request->Identification;
        $user->Admin = false;

        $user->save();

        return redirect("/");
    }

    public function login( Request $request ){
        $user = Users::where('email', $request->Email)->first();

        if($user){

            if(Hash::check($request->Password, $user->password)){
                return redirect()->intended('/mainView');
            }else{
                return redirect("/");
            }
        } else{
            return redirect("/");
        }
    }
}
