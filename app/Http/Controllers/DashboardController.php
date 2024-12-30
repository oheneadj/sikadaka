<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\Payment;
use App\Models\Contributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (Auth::user()->role === UserRoleEnum::Admin) {
            return view('dashboard');
        } elseif (Auth::user()->role === UserRoleEnum::Collector) {
            return view('dashboard', [
                'payments' =>
                Payment::orderBy('created_at', 'desc')->get(),
                'members' => Contributor::where('is_member', '=', 1)->orderBy('created_at', 'desc')->get(),
                'users' => User::get()
            ]);
        } else {
            return view('dashboard', [
                'payments' => Payment::orderBy('created_at', 'desc')->get(),
                'members' => Contributor::where('is_member', '=', 1)->orderBy('created_at', 'desc')->get(),
                'users' => User::get()
            ]);
        }
    }
}
