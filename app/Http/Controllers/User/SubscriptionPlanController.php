<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;

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
        return inertia ('User/Dashboard/SubscriptionPlan/Index', [
            'subscriptionPlans' => $plans,
        ]);
       
    }

    // Other methods like create, store, show, edit, update, destroy can be added here as needed
}
