<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
        public function login(Request $req)
        {
            // Validate the login credentials
            $validated = $req->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Attempt to authenticate the user
            if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
                // Authentication passed, redirect to the dashboard
                return redirect()->route('dashboard');
            }


            return back()->with('error', 'Wrong credentials');

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
