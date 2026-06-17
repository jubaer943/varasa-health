<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class ProfileController extends Controller
{
    //
    public function update(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,svg', // optional image
            ]
        );

        $user = Auth::user();
        $user->name = $request->input('name');

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture !== null && Storage::exists('public/' . $user->profile_picture)) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }

        $user->save();

        return redirect()->route('my-profile')->with('success', 'Profile updated successfully!');
    }
}
