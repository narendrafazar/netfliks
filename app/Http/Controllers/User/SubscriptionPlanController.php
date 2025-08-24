<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = SubscriptionPlan::all();
        return inertia('User/Dashboard/SubscriptionPlan/Index', [
            'subscriptionPlans' => $plans,
        ]);
       
    }

    /**
     * Handle the user subscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionPlan  $subscriptionPlan
     * @return \Illuminate\Http\Response
     */
    public function userSubscribe(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        // Validate the request if necessary
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'subscription_plan_id' => 'required|exists:subscription_plans,id',
        // ]); 

        $data = [
            'user_id' => Auth::id(),
            'subscription_plan_id' => $subscriptionPlan->id,
            'price' => $subscriptionPlan->price,
            'expired_date' => Carbon::now()->addMonths($subscriptionPlan->active_period_in_months),
            'payment_status' => 'paid', // Assuming the initial status is paid
        ];

        $userSubscription = UserSubscription::create($data);

        return redirect()->route('dashboard')->with('success', 'Subscription successful! Your plan will expire on ' . $userSubscription->expired_date->format('Y-m-d'));
    }

}
