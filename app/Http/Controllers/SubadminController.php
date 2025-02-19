<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SubadminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 1)->get();
        return view('subadmin', compact('admins'));
    }

    public function add(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'FName' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,email',
            'Password' => 'required|string|min:6',
        ]);

        // Create a new user (sub-admin) and hash the password
        $user = new User();
        $user->name = $request->FName;
        $user->email = $request->Email;
        $user->password = Hash::make($request->Password); // Hash the password
        $user->role = 1; // Assuming role 1 is for sub-admin
        $user->save(); // Save to the database

        // Redirect back with a success message
        return redirect()->route('sub-admin.admins')->with('success', 'Sub-admin added successfully!');
    }
}
