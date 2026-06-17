<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Professional;

class ProfessionalController extends Controller
{

    public function index(Request $request)
    {
        $query = Professional::query();
        $filter = $request->has('filter') ? $request->filter : 0;


        if ($filter == 4) {
            $query->where('status', 1);
        } elseif ($filter != 0) {
            $query->where('professional_type', $filter);
        }
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('professional_id', 'like', "%{$request->search}%")
                    ->orWhere('full_name', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        $professionals = $query->get();
        if ($request->ajax()) {
            return response()->json(['professionals' => $professionals]);
        }

        return view('professional');
    } // profeesionals data 

    public function actionStatus(Request $request)
    {
        $professional = Professional::find($request->id);

        if (!$professional) {
            return response()->json(['error' => 'Professional not found'], 404);
        }

        $professional->status = $request->status;
        $professional->save();

        return response()->json(['message' => 'Status updated successfully', 'new_status' => $professional->status]);
    } // changing status for professionals

    public function profile(Request $request, $pro_id)
    {
        $professional = Professional::where('id', $pro_id)->first();

        if (!$professional) {
            return response()->json(['error' => 'Professional not found'], 404);
        }

        $status = $request->has('status') ? $request->status : 1;

        // Query orders directly from the database
        $orders = Order::where('service_provider', $pro_id);

        if ($status == 0) {
            $orders->whereNull('service_provider')->where('status', 0);
        } else {
            $orders->where('status', $status);
        }

        $orders = $orders->get(); // Execute the query and get results

        if ($request->ajax()) {
            return response()->json(['orders' => $orders]);
        }

        return view('professional-profile', compact('professional', 'orders', 'pro_id'));
    }


    public function earningDashboard($pro_id)
    {
        $professional = Professional::where('id', $pro_id)->first();

        $orders = $professional->orders;

        $netEanring = $orders->sum('total_price');
        $netCommistion = $netEanring * 0.25;
        $totalService = $orders->count();
        $complitedService = $orders->where('status', 2)->count();
        $cashPayment = $orders->whereNull('payment_method')->sum('total_price');
        $OnlinePayment = $orders->whereNotNull('payment_method')->sum('total_price');

        return view('professional-earning', compact(
            'orders',
            'netEanring',
            'netCommistion',
            'totalService',
            'complitedService',
            'cashPayment',
            'OnlinePayment'
        ));
    } // professional earnign dashboard
}
