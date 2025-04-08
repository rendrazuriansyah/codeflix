<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function callback(Request $request)
    {
        // Retrieve the Midtrans server key from config
        $serverKey = config('midtrans.server_key');
        
        // Generate the hash signature
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Compare the generated signature with the request signature
        if ($hashed == $request->signature_key) {
            // Find the transaction using the order ID
            $transaction = Transaction::with('user', 'plan')->where('transaction_number', $request->order_id)->first();
        
            if ($transaction) {
                // Default payment status is pending
                $paymentStatus = 'pending';

                // Check if the transaction status is successful
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $paymentStatus = 'success';

                    // Retrieve user and plan related to the transaction
                    $user = $transaction->user;
                    $plan = $transaction->plan;

                    try {
                        // Begin database transaction
                        DB::beginTransaction();

                        // Create a new membership for the user
                        $user->memberships()->create([
                            'plan_id' => $plan->id,
                            'start_date' => now(),
                            'end_date' => now()->addDays($plan->duration),
                            'active' => true,
                        ]);

                        // Update transaction with successful payment status
                        $transaction->update([
                            'payment_status' => $paymentStatus,
                            'midtrans_transaction_id' => $request->transaction_id,
                        ]);
    
                        // Commit the transaction
                        DB::commit();
                    } catch (\Exception $e) {
                        // Log error and return failure response if an error occurs
                        Log::error('Failed to process successful payment: ' . $e->getMessage());

                        return response()->json([
                            'status' => 'error',
                            'message' => 'Failed to process membership',
                        ], 500);
                    }
                    // Update transaction with failed payment status
                
                    $paymentStatus = 'failed';
                    $transaction->update([
                        'payment_status' => $paymentStatus,
                        'midtrans_transaction_id' => $request->transaction_id,
                    ]);
                }

                // Return success response
                return response()->json([
                    'status' => 'success',
                ]);
            }
        }

        // Return error response if signature verification fails or transaction not found
        return response()->json([
            'status' => 'error'
        ], 404);
    }
}
