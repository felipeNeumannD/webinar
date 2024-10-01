<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Users;

class LoginController extends Controller
{
    public function index()
    {
        return view("UserPages\login");
    }

    public function signUp()
    {
        return view("UserPages\cadastro");
    }

    public function createUser(Request $request)
    {
        $user = new Users;

        $user->name = $request->Name;
        $user->email = $request->Email;
        $user->password = Hash::make($request->Password);
        $user->CompanyId = $request->Identification;
        $user->Admin = false;

        $user->save();

        return redirect("/");
    }

    public function login(Request $request)
    {
        $user = Users::where('email', $request->Email)->first();

        if ($user) {

            if (Hash::check($request->Password, $user->password)) {
                session(['user' => $user]);
                return redirect()->intended('/mainView');
            } else {
                return redirect("/");
            }
        } else {
            return redirect("/");
        }
    }

    public function updateUser(Request $request){
        $user = session('user');
        if($user instanceof Users) {
            $user = Users::where('id', $user->id)->first();
            if($request->Password == $request->Confirm) {
                $user->name = $request->Name;
                $user->email = $request->Email;
                $user->password = Hash::make($request->Password);
                $user->CompanyId = $request->Identification;

                $user->save();
                return redirect('/mainView');
            }
        }
        
    }

    public function changeUser()
    {
        $user = session('user');

        if ($user instanceof Users) {
            $name = $user->name;
            $mail = $user->email;
            $companyId = $user->CompanyId;

            return view('UserPages.changeUser', compact('name', 'mail', 'companyId'));
        } else {
            return redirect("/mainView");
        }
    }

    
}
