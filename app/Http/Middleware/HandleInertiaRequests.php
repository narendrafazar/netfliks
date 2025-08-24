<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    // bikin fungsi activePlan buat ngecek apakah user punya plan aktif
    // public function activePlan()
    // {
    //     $activePlan = Auth::user() ? Auth::user()->lastActiveUserSubscription : null;

    //     if (!$activePlan) {
    //         return null;
    //     }

    //     // $lastDay = parse($activePlan->expired_date)->format('d');
    //     $lastDay = Carbon::parse($activePlan->updated_at)->addMonths($activePlan->subscriptionPlan->active_period_in_months);
    //     $activeDays = Carbon::parse($activePlan->updated_at)->diffInDays($lastDay);
    //     $remainingActiveDays = Carbon::parse($activePlan->expired_date)->diffInDays(now());

    //     return [
    //         'name' => $activePlan->subscriptionPlan->name,
    //         'activeDays' => $activeDays,
    //         'remainingActiveDays' => $remainingActiveDays,
    //     ];
    // }
    public function activePlan()
    {
        $user = Auth::user();

        // Kalau belum login atau tidak punya subscription aktif
        if (!$user || !$user->lastActiveUserSubscription) {
            return null;
        }

        $activePlan = $user->lastActiveUserSubscription;

        // Hitung tanggal akhir dari plan
        $lastDay = Carbon::parse($activePlan->updated_at)
            ->addMonths($activePlan->subscriptionPlan->active_period_in_months);

        // Hitung total hari aktif plan
        $activeDays = Carbon::parse($activePlan->updated_at)
            ->diffInDays($lastDay);

        // Hitung sisa hari dari sekarang sampai expired_date dengan pembulatan
        // Menggunakan abs untuk memastikan tidak ada nilai negatif
        // dan round untuk pembulatan ke hari terdekat
        // false artinya tidak akan mengembalikan nilai negatif
        $remainingActiveDays = abs(round(
            Carbon::parse($activePlan->expired_date)->diffInDays(now(), false)
        ));

        return [
            'name' => $activePlan->subscriptionPlan->name,
            'activeDays' => $activeDays,
            'remainingActiveDays' => $remainingActiveDays,
        ];
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'activePlan' => $this->activePlan(),
            ],
        ];
    }
}
