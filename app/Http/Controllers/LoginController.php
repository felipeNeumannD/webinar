<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Session;
use App\Models\CourseModel;
use App\Models\UserMachineModel;


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
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required',
        ]);

        $user = Users::where('email', $request->Email)->first();

        if ($user) {
            if (Hash::check($request->Password, $user->password)) {
                Session::put('user', $user);

                return redirect()->route('mainView');
            } else {
                return redirect("/")->withErrors([
                    'Password' => 'Senha incorreta.',
                ]);
            }
        } else {
            return redirect("/")->withErrors([
                'Email' => 'Usuário não encontrado.',
            ]);
        }
    }

    public function updateUser(Request $request)
    {
        $user = session('user');
        if ($user instanceof Users) {
            $user = Users::where('id', $user->id)->first();
            if ($request->Password == $request->Confirm) {
                $user->name = $request->Name;
                $user->email = $request->Email;
                $user->password = Hash::make($request->Password);
                $user->CompanyId = $request->Identification;

                $user->save();
                return view("mainView");
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
            return view("mainView");
        }
    }


    public function oldSearchUser(Request $request)
    {
        $query = $request->get('query');
        $users = Users::where('name', 'like', "%{$query}%")->get(['name', 'email']);

        return response()->json($users);
    }

    public function searchUser(Request $request)
    {
        $query = $request->get('query', '');

        $users = Users::where('name', 'like', '%' . $query . '%')
            ->select('id', 'name')
            ->limit(10)
            ->get();

        return response()->json($users);
    }

    public function getUsersByCourse(Request $request, $courseId)
    {
        $query = $request->get('query', '');
        $course = CourseModel::find($courseId);

        if (!$course) {
            return response()->json(['message' => 'Curso não encontrado'], 404);
        }

        $machineId = $course->machine_id;
        $userIds = UserMachineModel::where('machine_id', $machineId)->pluck('user_id');

        $users = Users::whereIn('id', $userIds)
            ->where('name', 'like', '%' . $query . '%')
            ->select('id', 'name')
            ->get();

        return response()->json($users);
    }



}
