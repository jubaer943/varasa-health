<?php

namespace App\Http\Controllers;

use App\Models\HasPermission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SubadminController extends Controller
{
    public function index(Request $request)
    {
        $admins = User::where('role', 1);

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $admins = $admins->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%$searchTerm%")
                    ->orWhere('email', 'LIKE', "%$searchTerm%");
            });
        }

        $admins = $admins->get();
        if ($request->ajax()) {
            return response()->json(['admins' => $admins]);
        }
        return view('subadmin', compact('admins'));
    }

    public function add(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'FName' => 'required|string|max:255',
                'Email' => 'required|email|unique:admins,email',
                'Password' => 'required|string|min:6',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('sub-admin.add')
                ->withErrors($validator)
                ->withInput();
        }
        $user = new User();
        $user->name = $request->FName;
        $user->email = $request->Email;
        $user->password = Hash::make($request->Password);
        $user->role = 1;
        $user->save();

        $user->permissions()->create([
            'admin_id' => $user->id,
        ]);

        return redirect()->route('sub-admin.index')->with('success', 'Sub-admin added successfully!');
    }
    public function presentation($admin_id)
    {
        $permissions = HasPermission::where('admin_id', $admin_id)->first();
        return view('presentation', compact('admin_id', 'permissions'));
    }
    public function permission(Request $request, $admin_id)
    {
        $service = $request->input('service', 0);
        $orders = $request->input('orders', 0);
        $profile = $request->input('profile', 0);
        $users = $request->input('users', 0);
        $professionals = $request->input('professionals', 0);
        $settings = $request->input('settings', 0);
        $notifications = $request->input('notifications', 0);

        $permission = HasPermission::where('admin_id', $admin_id)->first();
        $permission->our_service = $service;
        $permission->orders = $orders;
        $permission->my_profile = $profile;
        $permission->users = $users;
        $permission->professionals = $professionals;
        $permission->settings = $settings;
        $permission->notifications = $notifications;
        $permission->save();

        return redirect()->route('sub-admin.index')->with('success', "Permission updated successfully");
    }

    public function adminActions(Request $request)
    {
        $admin = User::find($request->id);

        if (!$admin) {
            return response()->json(['error' => 'Admin not found !']);
        }
        $admin->status = $request->status;
        $admin->save();

        return response()->json(['message' => 'status updated successfully', 'new_status' => $admin->status]);
    }
}
