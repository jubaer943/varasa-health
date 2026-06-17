<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(Request $req)
    {

        $validated = $req->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );


        if (Auth::attempt(['email' => $req->email, 'password' => $req->password, 'status' => 1])) {

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['error' => 'Wrong credentials']);
    }


    public function logout(Request $request)
    {
        //logout user 
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
