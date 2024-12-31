<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Payment;
use Livewire\Component;
use App\Enums\UserRoleEnum;
use App\Models\Contributor;
use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $filterOption = 'all_time';

    // Filtered data
    #[Url(history: true)]
    public $payments = [];

    #[Url(history: true)]
    public $contributors = [];

    #[Url(history: true)]
    public $users = [];



    // The options for the select input
    public $filterOptions = [
        'yesterday' => 'Yesterday',
        'today' => 'Today',
        'this_week' => 'This Week',
        'this_month' => 'This Month',
        'this_year' => 'This Year',
        'all_time' => 'All Time',
    ];

    // Method to update the filtered data based on the selected time range
    public function updatedFilterOption($value)
    {
        $this->filterData($value);
    }

    // Method to filter data
    public function filterData($timeRange)
    {
        $now = Carbon::now();

        // Define date range based on the filter option
        switch ($timeRange) {
            case 'yesterday':
                $start = $now->copy()->subDay()->startOfDay();
                $end = $now->copy()->subDay()->endOfDay();
                break;
            case 'today':
                $start = $now->copy()->startOfDay();
                $end = $now->copy()->endOfDay();
                break;
            case 'this_week':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                break;
            case 'this_month':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                break;
            case 'this_year':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
                break;
            case 'all_time':
            default:
                $start = null;
                $end = null;
                break;
        }

        // Filter Payments, Contributors, and Users based on date range
        $this->payments = $this->filterByDateRange(Payment::query(), $start, $end);
        $this->contributors = $this->filterByDateRange(Contributor::query(), $start, $end);
        $this->users = $this->filterByDateRange(User::query(), $start, $end);
    }

    private function filterByDateRange($query, $start, $end)
    {
        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }
        return $query->get();
    }



    public function mount()
    {
        // Initialize with all time filter
        $this->filterData($this->filterOption);
    }


    public function render()
    {

        return view('livewire.dashboard', ['members' => Contributor::where('is_member', '=', 1)->orderBy('created_at', 'desc')->get(),]);

        // if (Auth::user()->role === UserRoleEnum::Admin) {
        //     return view('livewire.dashboard', [
        //         'payments' => Payment::orderBy('created_at', 'desc')->get(),
        //         'members' => Contributor::where('is_member', '=', 1)->orderBy('created_at', 'desc')->get(),
        //         'users' => User::get()
        //     ]);
        // } elseif (Auth::user()->role === UserRoleEnum::Collector) {
        //     return view('livewire.dashboard', [
        //         'payments' =>
        //         Payment::orderBy('created_at', 'desc')->get(),
        //         'members' => Contributor::where('is_member', '=', 1)->orderBy('created_at', 'desc')->get(),
        //         'users' => User::get()
        //     ]);
        // } else {
        //     return view('livewire.dashboard', [
        //         'payments' => Payment::orderBy('created_at', 'desc')->get(),
        //         'members' => Contributor::where('is_member', '=', 1)->orderBy('created_at', 'desc')->get(),
        //         'users' => User::get()
        //     ]);
        // }
    }
}
