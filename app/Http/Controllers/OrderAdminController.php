<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{

    public function index(Request $request)
    {
        $query = Order::with(['provider', 'products', 'service', 'orderItem', 'schedule', 'advancePrice']);
        $status = $request->has('status') ? $request->status : 1;

        if ($status == 0) {
            $query->whereNull('service_provider')->where('status', 0);
        } else {
            $query->where('status', $status);
        }

        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('orderDate', $request->date);
        }

        if ($request->has('payment_type') && $request->payment_type !== 'Payment Type') {
            if ($request->payment_type == "Cash") {
                $query->whereNUll('payment_method');
            } else {
                $query->where('payment_method', $request->payment_type);
            }
        }


        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('id', 'like', "%{$request->search}%")
                    ->orWhere('payment_method', 'like', "%{$request->search}%")
                    ->orWhere('user_id', 'like', "%{$request->search}%")
                    ->orWhere('order_number', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        $orders = $query->get();

        if ($request->ajax()) {
            return response()->json(['orders' => $orders]);
        }

        return view('orders');
    }

    public function orderDetails($order_id)
    {
        $order = Order::with([
            'schedule',
            // 'service',
            'provider',
            // 'subServices',
            'products',
            // 'orderItem',
            'appsUsers',
            // 'professional',
            'advancePrice'
        ])->find($order_id);

        // return response()->json($order);
        return view('order-details', compact('order'));
    }
}
