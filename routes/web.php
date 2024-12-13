<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\EnsureUserPasswordReset;


Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'verify-on-initial-login'
])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/register-institution', function () {
        return view('register-institution.register-institution');
    })->name('register-institution');
    Route::get('/app/dashboard', [DashboardController::class])->name('app-dashboard');
    // Route::get('/register-member', function () {
    //     return view('register-member');
    // })->name('register-member');
    // Route::get('/register-donor', function () {
    //     return view('register-donor');
    // })->name('register-donor');
    Route::get('/donations/view-donations', function () {
        return view('donations.view-donations');
    })->name('donations');
    Route::get('/loader/loading-screen', function () {
        return view('loader.loading-screen');
    })->name('loading');
});

require_once __DIR__ . '/member.php';
require_once __DIR__ . '/donation.php';
require_once __DIR__ . '/contributor.php';
require_once __DIR__ . '/donor.php';
require_once __DIR__ . '/payment.php';
require_once __DIR__ . '/institution.php';
require_once __DIR__ . '/project.php';
require_once __DIR__ . '/user.php';
