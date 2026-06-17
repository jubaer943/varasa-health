<?php

namespace App\Http\Controllers\Api\V1\Home;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\AuthenticatedProfessional;
use App\Models\Order;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EarningController extends Controller
{
    use AuthenticatedProfessional;

    public function dashboard(Request $request)
    {
        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing token or professional not found',
            ], 400);
        }

        // Parse filters
        $filterType = $request->input('filter', 'monthly');
        $startDate = null;
        $endDate = null;

        // Set date range based on filter type
        if ($filterType === 'monthly') {
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
        } elseif ($filterType === 'range') {
            $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : null;
            $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : null;
        }

        // Build base query
        $orders = Order::where('service_provider', $professional->id);

        // Apply date filter
        if ($startDate && $endDate) {
            $orders->whereBetween('orderDate', [$startDate->toDateString(), $endDate->toDateString()]);
        }

        // Clone for calculations
        $totalService   = (clone $orders)->count();
        $totalComplete  = (clone $orders)->where('status', 2)->count();
        $cashPayment    = (clone $orders)->whereNotNull('payment_method')->sum('total_price');
        $onlinePayment  = (clone $orders)->whereNull('payment_method')->sum('total_price');

        // Get commission and due info
        $summary = $this->calculateDueToVarasa($professional->id);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Earnings data retrieved successfully',
            'data' => [
                'net_earning'    => number_format($summary['net_earning'], 2, '.', ''),
                'net_commission' => number_format($summary['net_commission'], 2, '.', ''),
                'total_service'  => $totalService,
                'total_complete' => $totalComplete,
                'cash_payment'   => number_format($cashPayment, 2, '.', ''),
                'online_payment' => number_format($onlinePayment, 2, '.', ''),
                'due_payment'    => number_format($summary['due'], 2, '.', ''),
                'status'         => $summary['due'] > 1200 ? 1 : 0,
                'varasa_bkash_number' => '01824536209',
            ]
        ]);
    }

    public function payment(Request $request)
    {
        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing token or professional not found',
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'transaction_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $summary = $this->calculateDueToVarasa($professional->id);

        if ($summary['due'] < $request->amount) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Payment amount exceeds due amount'
            ], 400);
        }

        TransactionHistory::create([
            'professional_id' => $professional->id,
            'amount'          => $request->amount,
            'transaction_id'  => $request->transaction_id,
        ]);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Payment recorded successfully'
        ]);
    }

    public function transactionHistory(Request $request)
    {
        $professional = $this->getAuthenticatedProfessional();

        if (!$professional) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing token or professional not found',
            ], 400);
        }

        $transactions = TransactionHistory::where('professional_id', $professional->id)->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'No transaction history found'
            ], 404);
        }

        $transactions = $transactions->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'professional_name' => $transaction->professional->full_name,
                'professional_image' => $transaction->professional->profile_picture,
                'amount' => number_format($transaction->amount, 2, '.', ''),
                'transaction_id' => $transaction->transaction_id,
                'created_at' => $transaction->created_at->format('h:i A, d/m/y'),
            ];
        });

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Transaction history retrieved successfully',
            'data' => $transactions
        ]);
    }



    /**
     * Calculate commission and due balance
     */
    private function calculateDueToVarasa($professionalId)
    {
        $orders = Order::where('service_provider', $professionalId);
        $netEarning = (clone $orders)->sum('total_price');
        $netCommission = $netEarning * 0.30;
        $paidAmount = TransactionHistory::where('professional_id', $professionalId)->sum('amount');
        $dueToVarasa = $netCommission - $paidAmount;

        return [
            'net_earning'    => $netEarning,
            'net_commission' => $netCommission,
            'paid_amount'    => $paidAmount,
            'due'            => $dueToVarasa,
        ];
    }
}
