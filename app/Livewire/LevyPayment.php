<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Payment;
use Livewire\Component;
use App\Traits\LevyTrait;
use App\Models\Contributor;

use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;

class LevyPayment extends Component
{
    public $months = [];

    private $payable = 0;

    public $debt_amount = '';

    public $amount = '';

    #[Url(history: true)]
    public $search = '';

    public $members = [];

    public $selected_member;

    public $outstanding_debt = '';

    public $memberId = '';

    public $totalAmount;

    public $missedMonths = [];

    public $monthsCovered = 0;

    public $selected_months = [];


    public function pay_debt()
    {

        $this->validate([
            'debt_amount' => 'required|numeric|min:1|max:'
                . $this->selected_member->outstanding_debt
        ], [
            'debt_amount.required' => 'You must enter an amount',
            'debt_amount.numeric' => 'Enter a valid amount',
            'debt_amount.min' => 'You cannot be less than GHs 1',
            'debt_amount.max' => 'You cannot be more than the GHs'
                . $this->selected_member->outstanding_debt . ' debt amount',
        ]);

        if ($this->selected_member->outstanding_debt > 0) {
            $this->selected_member->update([
                'outstanding_debt' => max(0, $this->selected_member->outstanding_debt - $this->debt_amount),
            ]);
        }

        $this->selected_member->payments()->create([
            'amount' => $this->debt_amount,
            'payment_type' => 'DEBT',
            'user_id' => Auth::user()->id
        ]);

        $this->debt_amount = '';

        toastr()->success("Outstanding debt has been paid successfully");

        return redirect()->route('member.single', $this->selected_member->id);
    }

    public function pay_levy()
    {



        if ($this->selected_member->gender === 'MALE') {
            $this->validate([
                'amount' => 'required|numeric|min:'
                    . Auth::user()->institution->male_amount
            ], [
                'amount.required' => 'You must enter an amount',
                'amount.numeric' => 'Enter a valid amount',
                'amount.min' => 'You cannot pay below the GHs'
                    . Auth::user()->institution->male_amount . ' levy fee',

            ]);
        }

        if ($this->selected_member->gender === 'FEMALE') {
            $this->validate([
                'amount' => 'required|numeric|min:'
                    . Auth::user()->institution->female_amount,
            ], [
                'amount.required' => 'You must enter an amount',
                'amount.numeric' => 'Enter a valid amount',
                'amount.min' => 'You cannot pay below the GHs' . Auth::user()->institution->female_amount . ' levy fee',

            ]);
        }

        // Fetch member details
        $member = Contributor::find($this->selected_member->id);

        $data = max($this->selected_months);

        //array_search($data, $this->months);


        foreach ($this->selected_months as $month) {

            $member->payments()->create([
                'amount' => $this->amount / $data,
                'payment_type' => 'CONTRIBUTION',
                'month' => $this->months[$month - 1]['month'],
                'year' => $this->months[$month - 1]['year'],
                'user_id' => Auth::user()->id
            ]);
        }


        toastr()->success("Levy has been paid successfully");

        return redirect()->route('member.single', $this->selected_member->id);
    }

    public function calculatePayments()
    {
        $this->months = [];
        $this->selected_months = [];

        $this->validate([
            'amount' => 'required|numeric|min:'
                . Auth::user()->institution->female_amount,
        ], [
            'amount.required' => 'You must enter an amount',
            'amount.numeric' => 'Enter a valid amount',
            'amount.min' => 'You cannot pay below the GHs' . Auth::user()->institution->female_amount . ' levy fee',

        ]);

        // Fetch member details
        $all_payments = Payment::where('contributor_id', $this->selected_member->id)
            ->where('payment_type', 'CONTRIBUTION')->latest()->first();

        if ($all_payments !== null) {

            // dd("is not null");


            $start_date = $all_payments->created_at;

            // Set initial payable amount from input amount
            $this->payable = $this->amount;

            $currentDate = Carbon::now();

            $minimum_payment_amount = $this->getMinimumPaymentForGender($this->selected_member->gender);


            //
            $key = 1;
            // Loop through months from start date to current date
            while ($start_date->lessThanOrEqualTo($currentDate)) {

                // Break if remaining payable amount is less than required fee
                if ($this->payable < $minimum_payment_amount) {
                    break;
                }
                // Subtract monthly fee from payable amount
                $this->payable -= $minimum_payment_amount;

                // Add month and year to months array
                $this->months[] = [
                    'key' => $key,
                    'month' => $start_date->format('F'),
                    'year' => $start_date->format('Y'),
                ];

                $this->selected_months[] = $key;

                // Increment to next month
                $start_date->addMonth();

                $key++;
                // Commented out duplicate calculation
                // $months_missed = $diffInMonths->y * 12 + $diffInMonths->m + 1;
            }
        }

        // Check if there are no previous payments
        if ($all_payments === null) {

            // dd("is null");

            // Calculate months since registration (commented out alternative method)
            //$months_missed = $member_registration_date->diffInMonths(Carbon::now());

            // Get difference between registration date and now
            // $diffInMonths = $this->selected_member->created_at->diff(Carbon::now());

            // // Calculate total months missed (years * 12 + months + 1)
            // $months_missed = $diffInMonths->y * 12 + $diffInMonths->m + 1;

            // Set start date to member's registration date
            $start_date = $this->selected_member->created_at;

            // Set initial payable amount from input amount
            $this->payable = $this->amount;

            $currentDate = Carbon::now();

            $minimum_payment_amount = $this->getMinimumPaymentForGender($this->selected_member->gender);


            $key = 1;
            // Loop through months from start date to current date
            while ($start_date->lessThanOrEqualTo($currentDate)) {

                // Break if remaining payable amount is less than required fee
                if ($this->payable < $minimum_payment_amount) {
                    break;
                }
                // Subtract monthly fee from payable amount
                $this->payable -= $minimum_payment_amount;

                // Add month and year to months array
                $this->months[] = [
                    'key' => $key,
                    'month' => $start_date->format('F'),
                    'year' => $start_date->format('Y'),
                ];

                $this->selected_months[] = $key;

                // Increment to next month
                $start_date->addMonth();

                $key++;
                // Commented out duplicate calculation
                // $months_missed = $diffInMonths->y * 12 + $diffInMonths->m + 1;

            }
        }

        return $this->months;
    }

    protected function getMinimumPaymentForGender($gender)
    {
        // Fetch the minimum payment based on gender from the database
        // Replace this with your actual query
        return $gender === 'MALE' ? Auth::user()->institution->male_amount : Auth::user()->institution->female_amount;
    }


    public function updatedSearch()
    {
        if ($this->search !== '') {
            $this->members = Contributor::search($this->search)
                ->where('is_member', '=', 1)
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->get(['id', 'name', 'membership_id']);
        } else {
            $this->members = [];
        }
    }

    public function selectMember($memberId)
    {
        $this->amount = "";
        $this->months = [];
        $this->selected_member = Contributor::find($memberId);
        $this->members = [];
    }



    public function render()
    {
        return view('livewire.levy-payment');
    }
}
