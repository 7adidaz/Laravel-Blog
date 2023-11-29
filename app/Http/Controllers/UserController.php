<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request){
        $input = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['email', 'required', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        auth()->login($user);

        return redirect('/');
    }

    public function login(Request $request){
        $input = $request->validate([
            'loginname' => ['required'],
            'loginpassword' => ['required', 'string', 'min:8'],
        ]);

        if(!auth()->attempt(['name' => $input['loginname'], 'password' => $input['loginpassword']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
