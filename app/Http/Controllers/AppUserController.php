<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\UsersPdfExport;
use Illuminate\Http\Request;
use App\Models\AppUser;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class AppUserController extends Controller
{

    public function index(Request $request)
    {
        $query = AppUser::query();

        $filter = $request->has('filter') ? $request->filter : 0;

        if ($filter == 1) {
            $query->where('status', 1);
        }

        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('userId', 'LIKE', "%{$request->search}%")
                    ->orWhere('phone', 'LIKE', "%{$request->search}%");
            });
        }

        $users = $query->get();

        if ($filter == 3) {
            return Excel::download(new UsersExport($users), 'users.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }

        if ($filter == 4) {
            return Excel::download(new UsersExport($users), 'users.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
        if ($filter == 5) {
            return Excel::download(new UsersExport($users), 'users.csv', \Maatwebsite\Excel\Excel::XLSX);
        }
        if ($request->ajax()) {
            return response()->json(['users' => $users]);
        }

        return view('users');
    }

    public function actionStatus(Request $request)
    {
        $user = AppUser::find($request->id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'Status updated successfully', 'new_status' => $user->status]);
    }

    public function userDetails(Request $request, $user_id)
    {
        $user = AppUser::with('UserLocation')->find($user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found']);
        }

        $status = $request->has('status') ? $request->status : 1;
        $orders = Order::with('schedule', 'service')->where('user_id', $user_id);

        if ($status == 0) {
            $orders->whereNull('service_provider')->where('status', 0);
        } else {
            $orders->where('status', $status);
        }

        if ($request->has('date') && !empty($request->date)) {
            $orders->whereDate('orderDate', $request->date);
        }

        if ($request->has('payment_type') && $request->payment_type !== 'Payment Type') {
            if ($request->payment_type == "Cash") {
                $orders->whereNUll('payment_method');
            } else {
                $orders->where('payment_method', $request->payment_type);
            }
        }

        if ($request->has('search') && !empty($request->search)) {
            $orders->where(function ($q) use ($request) {
                $q->where('id', 'like', "%{$request->search}%")
                    ->orWhere('payment_method', 'like', "%{$request->search}%")
                    ->orWhere('user_id', 'like', "%{$request->search}%")
                    ->orWhere('order_number', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }


        $orders = $orders->get();
        if ($request->ajax()) {
            return response()->json(['orders' => $orders]);
        }
        // return response()->json($orders);
        return view('user-details', compact('user', 'user_id'));
    }
}
