<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class SubscribeController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }
    
    public function showPlans()
    {
        $plans = Plan::all();

        return view('subscribe.plans', compact('plans'));
    }

    public function checkoutPlan(Plan $plan)
    {
        $user = Auth::user();

        return view('subscribe.checkout', compact('plan', 'user'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user(); // ini otomatis ngebind "user_id" nya
        $plan = Plan::findOrFail($request->plan_id);

        $user->memberships()->create([
            'plan_id' => $request->plan_id,
            'active' => true,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration),
        ]);

        return redirect()->route('subscribe.success');
    }

    public function showSuccess()
    {
        return view('subscribe.success');
    }
}
