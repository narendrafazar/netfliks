<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MovieController;
use App\Http\Controllers\User\SubscriptionPlanController;

// Buat test aja
// Route::get('admin', function () {
//     return 'Admin Dashboard';
// })->middleware(['auth', 'role:admin'])->name('admin.dashboard');

// Route::get('user', function () {
//     return 'User Dashboard';
// })->middleware(['auth', 'role:user'])->name('user.dashboard');
    

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::redirect('/', '/login');

// Route::get('/dashboard', function () {
//     return Inertia::render('User/Dashboard/Index');
// })->middleware(['auth', 'verified'])->name('dashboard');

// sintaks diatas sudah useless, diganti controller DashboardController

// Route::middleware(['auth', 'role:user'])->prefix('dashboard')->name('user.dashboard.')->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('index');
//     Route::get('/movie/{movie:slug}', [MovieController::class, 'show'])->name('movie.show');
// });

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('/movie/{movie:slug}', [MovieController::class, 'show'])->name('movie.show');
    Route::get('/subscription-plan', [SubscriptionPlanController::class, 'index'])->name('subscriptionPlan.index');
    Route::post('/subscription-plan/{subscriptionPlan}/user-subscribe', [SubscriptionPlanController::class, 'userSubscribe'])->name('subscriptionPlan.userSubscribe');
});


// ini dari chatgpt
// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard'); // or return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('prototype')->name('prototype.')->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Prototype/Login');
    })->name('login');
    Route::get('/register', function () {
        return Inertia::render('Prototype/Register');
    })->name('register');
    Route::get('/dashboard', function () {
        return Inertia::render('Prototype/Dashboard');
    })->name('dashboard');
    Route::get('/subscriptionPlan', function () {
        return Inertia::render('Prototype/SubscriptionPlan');
    })->name('subscriptionPlan');
    Route::get('/movie/{slug}', function () {
        return Inertia::render('Prototype/Movie/Show');
    })->name('movie.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
