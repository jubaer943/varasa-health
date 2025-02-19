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
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // optional image
        ]);

        // Update user profile
        $user = Auth::user();
        $user->name = $request->input('name');

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete the old image if exists
            if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
                Storage::delete('public/' . $user->profile_picture);
            }

            // Store the new profile picture
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }

        // Save the updated user data
        $user->save();

        return redirect()->route('my-profile')->with('success', 'Profile updated successfully!');
    }
}
