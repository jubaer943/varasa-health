<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Professional;
use App\Models\Service;

class HomeController extends Controller
{
    //
    public function index()
    {
        //
        $orderCounts = Order::selectRaw("
        COUNT(CASE WHEN service_provider IS NULL THEN 1 END) as pending_orders,
        COUNT(CASE WHEN status = 1 THEN 1 END) as active_orders,
        COUNT(CASE WHEN status = 2 THEN 1 END) as completed_orders
    ")->first();

        $users = AppUser::all()->count();
        $professionals = Professional::all()->count();
        $services = Service::all()->count();
        $pendingOrders = $orderCounts->pending_orders;
        $activeOrders = $orderCounts->active_orders;
        $completedOrders = $orderCounts->completed_orders;

        return view('dashboard', compact('pendingOrders', 'activeOrders', 'completedOrders', 'users', 'professionals', 'services'));
    }
}
