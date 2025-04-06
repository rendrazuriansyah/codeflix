<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Initialize Midtrans configuration.
     */
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Handle the checkout process.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        // Generate a unique transaction number
        $transactionNumber = 'ORDER-' . time() . '-' . $user->id;

        // Create a new transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'plan_id' => $request->plan_id,
            'transaction_number' => $transactionNumber,
            'total_amount' => $request->amount,
            'payment_status' => 'pending',
        ]);

        // Prepare the payload for Midtrans
        $payload = [
            'transaction_details' => [
                'order_id' => $transaction->transaction_number,
                'gross_amount' => (int) round($transaction->total_amount, 0, PHP_ROUND_HALF_UP),
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => '081122334455',
            ],
            'item_details' => [
                [
                    'id' => $transaction->plan_id,
                    'price' => (int) round($transaction->total_amount, 0, PHP_ROUND_HALF_UP),
                    'quantity' => 1,
                    'name' => $transaction->plan->title,
                ],
            ],
        ];

        try {
            // Request Snap token from Midtrans
            $snapToken = Snap::getSnapToken($payload);
            $transaction->update(['snap_token' => $snapToken]);

            // Return success response with Snap token
            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            // Return error response if an exception occurs
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
