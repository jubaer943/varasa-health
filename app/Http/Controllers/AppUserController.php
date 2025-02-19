<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppUser;

class AppUserController extends Controller
{
    //
    public function index()
    {
        $users = AppUser::all(); // Fetch all users from the database
        // print_r($users);
        return view('users', compact('users'));
    }
}
