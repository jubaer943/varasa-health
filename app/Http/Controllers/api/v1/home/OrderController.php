<?php

namespace App\Http\Controllers\Api\V1\Home;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\AppUser;
use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Order;
use App\Models\SubService;
use App\Models\OrderCancel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schedule;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\AuthenticatedProfessional;
use App\Traits\FCMTrait;
use function PHPSTORM_META\map;


class OrderController extends Controller
{
    use FCMTrait;
    use AuthenticatedProfessional;
    // place order 

    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'schedule' => 'required|exists:time_slots,id',
            'contact_info.customer_name' => 'required|string|max:255',
            'contact_info.phone' => 'required|string|max:20',
            'contact_info.email' => 'nullable|email|max:255',
            'contact_info.address' => 'required|string',
            'gender' => 'required|in:1,2', // 1 = Male, 2 = Female
            'service' => 'required|exists:services,id',
            'product_id' => 'required|exists:sub_services,id',
            'quantity' => 'required|',
            'price' => 'required|',
            'payment_method' => 'nullable|string|max:50',
            'total_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                return response()->json(['error' => 'Token not provided'], 400);
            }

            $payload = JWTAuth::parseToken()->getPayload();
            $user = AppUser::find($payload->get('sub'));

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            $userId = $user ? $user->id : null;
            $schedule = $request->schedule;

            $availableServiceProviders = Professional::whereDoesntHave('bookings', function ($query) use ($schedule) {
                $query->where('time_slots_id', $schedule);
            })->get();

            if ($availableServiceProviders->isEmpty()) {
                return response()->json(['error' => 'No service providers available for the selected schedule.'], 422);
            }

            $orderData = [
                'order_number' => now()->format('Y-m-d'),
                'schedule_id' => $request->schedule,
                'orderDate' => now()->format('Y-m-d'),
                'user_id' => $userId,
                'customer_name' => $request->contact_info['customer_name'],
                'phone' => $request->contact_info['phone'],
                'email' => $request->contact_info['email'],
                'address' => $request->contact_info['address'],
                'gender' => $request->gender,
                'service_id' => $request->service,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'payment_method' => $request->payment_method,
                'total_price' => $request->total_price,
                'discount' => $request->discount ?? 0,
                'subtotal' => $request->subtotal,
            ];
            // return response()->json($orderData);

            $order = Order::create($orderData);

            $service = $order->service()->first();
            $orderDate = Carbon::parse($order->orderDate);
            $schedule  = $order->schedule()->first();

            $startTime = Carbon::parse($schedule->start_time)->format('h:i A');
            $endTime = Carbon::parse($schedule->end_time)->format('h:i A');

            foreach ($availableServiceProviders as $provider) {
                $this->sendPushNotification($provider->id, $provider->professional_id, 'Order', 'A new order has been placed');
            }
            $this->sendPushNotification($userId, $user->userId, 'Order', 'Order has been placed. Please wait for professional to accept.');

            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => 'Order placed successfully',
                'data' => [
                    'orderId' =>  $order->order_number,
                    'service' => $service->name,
                    'requireGender' => $order->gender == 1 ? 'Male' : 'Female',
                    'date' => $orderDate->format('jS F, Y'),
                    'time' => $startTime . ' - ' . $endTime,
                ]
            ], 201);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => "Token is expired",
                'data' => null,
            ], 200);
        }
    }

    private function getAuthenticatedUser()
    {
        try {
            $token = JWTAuth::parseToken();
            $payload = $token->getPayload();
            return AppUser::find($payload->get('sub'));
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getOrder()
    {
        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Invalid or missing token or professional not found',
            ], 200);
        }

        $orders = Order::whereNull('service_provider')->where('gender', $professional->gender)->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'No available orders for this professional'
            ], 200);
        }

        $scheduleIds = $orders->pluck('schedule_id')->toArray();

        $availableOrders = $orders->filter(function ($order) use ($professional, $scheduleIds) {
            return !$professional->bookings()->where('time_slots_id', $order->schedule_id)->exists() && !$professional->orderCancels()->where('order_id', $order->id)->exists()
                && in_array($order->schedule_id, $scheduleIds);
        });

        if ($availableOrders->isEmpty()) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'No available orders for this professional'
            ], 200);
        }

        $data = $availableOrders->map(function ($order) {
            $serviceName = optional($order->service)->name ?? 'No service available';
            $subService = SubService::find($order->product_id);
            $subServiceText = $subService ? $subService->service_name . ' ×' . $order->quantity : '';

            $schedule = $order->schedule;
            $serviceTime = $schedule ? Carbon::parse($schedule->start_time)->format('h:i A') . ' - ' . Carbon::parse($schedule->end_time)->format('h:i A') : 'N/A';

            return [
                'userId' => $order->appsUsers->userId,
                'address' => $order->address,
                'service' => $serviceName . ' | ' . $subServiceText,
                'requestGender' => $order->gender == 1 ? 'Male' : 'Female',
                'orderID' => $order->order_number,
                'servceDate' => $order->orderDate,
                'serviceTime' => $serviceTime,
            ];
        });

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Orders retrieved successfully!',
            'data' => $data
        ]);
    }

    public function orderDetails($order_id)
    {

        $order = Order::where('order_number', $order_id)->first();

        if (!$order) {
            return response()->json(['status' => false, 'code' => 404, 'message' => "Order not found. ", 'data' => null], 200);
        }

        $serviceName = optional($order->service)->name ?? 'No service available';
        $subService = SubService::find($order->product_id);
        $subServiceText = $subService ? $subService->service_name . ' ×' . $order->quantity : '';


        $patient = AppUser::where('id', intval($order->user_id))->first();

        $schedule = $order->schedule;
        $serviceTime = $schedule ? Carbon::parse($schedule->start_time)->format('h:i A') . ' - ' . Carbon::parse($schedule->end_time)->format('h:i A') : 'N/A';

        $isCanceled = OrderCancel::where('order_id', $order->id)->exists();
        $finalStatus = $isCanceled ? 3 : $order->status;

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => "Order retrived successfully ! ",
            'data' => [
                'patientName' => $patient->fullname,
                'userId' => $order->appsUsers->userId,
                'gender' => $patient->gender == 1 ? "Male" : "Female",
                'address' => $order->address,
                'serviceName' => $serviceName . '|' . $subServiceText,
                'requestGender' => $order->gender == 1 ? "Male" : "Female",
                'orderId' => $order->order_number,
                'serviceDate' => $order->orderDate,
                'serviceTime' => $serviceTime,
                'payment' => $order->total_price . ' BDT',
                'status' => $finalStatus,
            ],
        ]);
    }

    public function updateOrderStatus(Request $request)
    {

        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Invalid or missing token or professional not found'
            ], 200);
        }

        $request->validate([
            'order_id' => 'required|exists:orders,order_number',
            'action' => 'required|',
        ]);

        $order = Order::where('order_number', $request->order_id)->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Order not found'
            ], 200);
        }

        if ($order->service_provider) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Order already assigned'
            ], 200);
        }

        $user = $order->appsUsers;
        if ($request->action === 1) {
            $order->update(['service_provider' => $professional->id, 'status' => 1]);
            $this->sendPushNotification($user->id, $user->userId, 'Order', $professional->full_name . ' accept your order ' . $order->order_number);

            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Order accepted successfully'
            ]);
        } elseif ($request->action === 0) {
            OrderCancel::create([
                'order_id' => $order->id,
                'professional_id' => $professional->id,
            ]);
            return response()->json(['status' => false, 'code' => 200, 'message' => 'Order canceled successfully']);
        }
    }

    public function myOrders(Request $request)
    {
        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing token or user not found'
            ], 200);
        }

        $status = $request->query('status');

        // Only allow status values 1, 2, 3
        if (!in_array($status, [0, 1, 2, 3])) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid status'
            ], 200);
        }

        if ($status == 0 || $status == 1) {
            // Fetch orders with status 0 (Pending) and 1 (Confirmed)
            $orders = Order::where('user_id', $user->id)
                ->whereIn('status', [0, 1])
                ->get();
        } else {
            // Fetch orders with status 2 (Completed) or 3 (Canceled)
            $orders = Order::where('user_id', $user->userId)
                ->where('status', $status)
                ->get();
        }

        $data = $orders->map(function ($order) use ($status) {
            $schedule = $order->schedule;
            $serviceTime = $schedule
                ? Carbon::parse($schedule->start_time)->format('h:i A') . ' - ' . Carbon::parse($schedule->end_time)->format('h:i A')
                : 'N/A';

            return [
                'order_id' => $order->order_number,
                'service_name' => optional($order->service)->name ?? 'No service available',
                'status' => ($status == 1)
                    ? ($order->service_provider === null ? "Pending" : "Confirmed")
                    : ($status == 2 ? "Completed" : "Canceled"),
                'schedule' => $serviceTime . ' ' . Carbon::parse($order->orderDate)->format('j M'),
                'payment' => $order->total_price . ' BDT',
            ];
        });

        return response()->json(['status' => true, 'code' => 200, 'data' => $data]);
    }

    public function userOrderDetails($order_id)
    {
        $order = Order::where('order_number', $order_id)->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => "Order not found.",
                'data' => null
            ], 200);
        }
        $data = [
            'orderDetails' => null,
            'providerDetails' => null,
            'otp' => $order->otp,
        ];
        $serviceName = optional($order->service)->name ?? 'No service available';
        $subService = SubService::find($order->product_id);
        $subServiceText = $subService ? $subService->service_name . ' ×' . $order->quantity : '';


        $schedule = $order->schedule;
        $serviceTime = $schedule ? Carbon::parse($schedule->start_time)->format('h:i A') . ' - ' . Carbon::parse($schedule->end_time)->format('h:i A') : 'N/A';


        $data['orderDetails'] = [
            'serviceName' => $serviceName . '|' . $subServiceText,
            'requestGender' => $order->gender == 1 ? "Male" : "Female",
            'orderId' => $order->order_number,
            'serviceDate' => $order->orderDate,
            'serviceTime' => $serviceTime,
            'payment' => $order->total_price . ' BDT',
        ];
        $professional = $order->provider;

        if ($professional) {
            $data['providerDetails'] = [
                'ServiceProviderName' => $professional->full_name,
                'professionaId' => $professional->professional_id,
                'gender' => $professional->gender == 1 ? "Male" : "Female",
            ];
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => "Order retrieved successfully!",
            'data' => $data,
        ]);
    }

    public function sendOrderOtp(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,order_number',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'errors' => $validator->errors()
            ], 200);
        }

        // Fetch order
        $order = Order::where('order_number', $request->order_id)->firstOrFail();

        // Generate OTP and update order
        $otp = mt_rand(100000, 999999);
        $order->update(['otp' => $otp]);

        $user = $order->appsUsers;

        return response()->json($user);

        $professional = $order->professional;
        $this->sendPushNotification($user->id, $user->userId, 'Order', ' You received an OTP-' . $otp . ' from ' . $professional->full_name);
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => "OTP sent successfully!",
        ]);
    }

    public function verifyOrderOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,order_number',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ], 200);
        }

        $order = Order::where('order_number', $request->order_id)->firstOrFail();
        if ($order->otp != $request->otp) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid OTP.',
            ], 200);
        }

        $order->update(['status' => 2]);

        $user = $order->appsUsers;
        $this->sendPushNotification($user->id, $user->userId, 'Order', 'Thanks for your order . Stay with us.');

        $professional = $order->professional;
        $this->sendPushNotification($professional->id, $professional->professional_id, 'Order', 'You have completed a service. Thank you for your Support.');

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'OTP verified successfully!',
        ], 200);
    }

    public function professionalServices(Request $request)
    {
        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Invalid or missing token or professional not found'
            ], 200);
        }

        $status = $request->query('status');

        // Only allow status values 1, 2, 3
        if (!in_array($status, [1, 2, 3])) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid status'
            ], 200);
        }

        // Initialize $orders as an empty collection
        $orders = collect();

        if ($status == 1) {
            // Fetch orders with status 1 (Confirmed)
            $orders = Order::where('service_provider', $professional->id)
                ->where('status', 1)
                ->get();
        } elseif ($status == 2) {
            // Fetch orders with status 2 (Completed)
            $orders = Order::where('service_provider', $professional->id)
                ->where('status', 2)
                ->get();
        } elseif ($status == 3) {
            // Fetch canceled orders
            $cancelOrders = $professional->orderCancels;

            if ($cancelOrders->isNotEmpty()) {
                $orders = Order::whereIn('id', $cancelOrders->pluck('order_id'))->get();
            }
        }

        if ($orders->isEmpty()) {
            return response()->json(['status' => false, 'code' => 404, 'message' => 'No orders found'], 200);
        }

        $data = $orders->map(function ($order) use ($status) {
            $schedule = $order->schedule;
            $serviceTime = $schedule
                ? Carbon::parse($schedule->start_time)->format('h:i A') . ' - ' . Carbon::parse($schedule->end_time)->format('h:i A')
                : 'N/A';

            return [
                'order_id' => $order->order_number,
                'service_name' => optional($order->service)->name ?? 'No service available',
                'status' => ($status == 1)
                    ? ($order->service_provider === null ? "Pending" : "Confirmed")
                    : ($status == 2 ? "Completed" : "Canceled"),
                'schedule' => $serviceTime . ' ' . Carbon::parse($order->orderDate)->format('j M'),
                'payment' => $order->total_price . ' BDT',
            ];
        });

        return response()->json(['status' => true, 'code' => 200, 'data' => $data]);
    }
}
