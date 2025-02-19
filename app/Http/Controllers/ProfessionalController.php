<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;

class ProfessionalController extends Controller
{
    //
    public function index(){
        $professionals = Professional::all();
        return view('professional', compact('professionals'));
    }
}
