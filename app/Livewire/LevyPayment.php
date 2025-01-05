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
        $minPayment = $this->getMinimumPaymentForGender($member->gender);

        // Identify missed payments
        $this->missedMonths = $this->getMissedPayments($member);

        // Calculate how many months can be paid
        $this->monthsCovered = 0;
        $remainingAmount = $this->totalAmount;

        foreach ($this->missedMonths as $monthYear) {
            if ($remainingAmount >= $minPayment) {
                $remainingAmount -= $minPayment;
                $this->monthsCovered++;
            } else {
                break;
            }
        }

        // if ($this->selected_member->outstanding_debt > 0) {
        //     $this->selected_member->update([
        //         'outstanding_debt' => max(0, $this->selected_member->outstanding_debt - $this->amount),
        //     ]);
        // }


        $this->selected_member->payments()->create([
            'amount' => $this->amount,
            'payment_type' => 'DEBT',
            'user_id' => Auth::user()->id
        ]);

        toastr()->success("Outstanding debt has been paid successfully");

        return redirect()->route('member.single', $this->selected_member->id);
    }

    public function calculatePayments()
    {
        $this->months = [];

        $this->validate([
            'amount' => 'required|numeric|min:'
                . Auth::user()->institution->female_amount,
        ], [
            'amount.required' => 'You must enter an amount',
            'amount.numeric' => 'Enter a valid amount',
            'amount.min' => 'You cannot pay below the GHs' . Auth::user()->institution->female_amount . ' levy fee',

        ]);

        // Fetch member details

        // $minPayment = $this->getMinimumPaymentForGender($this->selected_member->gender);
        // $member_registration_date = Carbon::parse($this->selected_member->created_at);

        // $all_payments = Payment::where('contributor_id', $this->selected_member->id)
        //     ->where('payment_type', 'CONTRIBUTION')->get();

        $all_payments = Payment::where('contributor_id', $this->selected_member->id)
            ->where('payment_type', 'CONTRIBUTION')->latest()->first();

        if ($all_payments !== null) {

            // dd("is not null");


            $start_date = $all_payments->created_at;

            // Set initial payable amount from input amount
            $this->payable = $this->amount;

            $currentDate = Carbon::now();

            // Loop through months from start date to current date
            while ($start_date->lessThanOrEqualTo($currentDate)) {

                // Break if remaining payable amount is less than required fee
                if ($this->payable < Auth::user()->institution->male_amount) {
                    break;
                }
                // Subtract monthly fee from payable amount
                $this->payable -= Auth::user()->institution->male_amount;

                // Add month and year to months array
                $this->months[] = [
                    'month' => $start_date->format('F'),
                    'year' => $start_date->format('Y'),
                ];

                // Increment to next month
                $start_date->addMonth();
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

            // Loop through months from start date to current date
            while ($start_date->lessThanOrEqualTo($currentDate)) {

                // Break if remaining payable amount is less than required fee
                if ($this->payable < Auth::user()->institution->male_amount) {
                    break;
                }
                // Subtract monthly fee from payable amount
                $this->payable -= Auth::user()->institution->male_amount;

                // Add month and year to months array
                $this->months[] = [
                    'month' => $start_date->format('F'),
                    'year' => $start_date->format('Y'),
                ];

                // Increment to next month
                $start_date->addMonth();
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

    protected function getMissedPayments($member)
    {
        $missedMonths = [];
        $registrationDate = new \DateTime($member->registration_date);
        $currentDate = new \DateTime();

        // Iterate from registration date to current date
        while ($registrationDate <= $currentDate) {
            $month = $registrationDate->format('m');
            $year = $registrationDate->format('Y');
            if (!Payment::where('contributor_id', $member->id)
                ->where('month', $month)
                ->where('year', $year)->exists()) {
                $missedMonths[] = $month;
            }
            $registrationDate->modify('+1 month');
        }

        return $missedMonths;
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
