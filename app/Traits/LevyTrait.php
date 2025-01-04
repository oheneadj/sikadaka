<?php

namespace App\Traits;

use App\Models\Payment;
use App\Models\Contributor;
use Illuminate\Support\Facades\Auth;

trait LevyTrait
{


    public $memberId;
    public $totalAmount;
    public $missedMonths = [];
    public $monthsCovered = 0;

    public function mount($memberId)
    {
        $this->memberId = $memberId;
    }

    // public function calculatePayments()
    // {
    //     // Fetch member details
    //     $member = Contributor::find($this->memberId);
    //     $minPayment = $this->getMinimumPaymentForGender($member->gender);

    //     // Identify missed payments
    //     $this->missedMonths = $this->getMissedPayments($member);

    //     // Calculate how many months can be paid
    //     $this->monthsCovered = 0;
    //     $remainingAmount = $this->totalAmount;

    //     foreach ($this->missedMonths as $monthYear) {
    //         if ($remainingAmount >= $minPayment) {
    //             $remainingAmount -= $minPayment;
    //             $this->monthsCovered++;
    //         } else {
    //             break;
    //         }
    //     }
    // }

    protected function getMinimumPaymentForGender($gender)
    {
        // Fetch the minimum payment based on gender from the database
        // Replace this with your actual query
        return $gender === 'male' ? Auth::user()->institution->male_amount : Auth::user()->institution->female_amount;
    }

    protected function getMissedPayments($member)
    {
        $missedMonths = [];
        $registrationDate = new \DateTime($member->registration_date);
        $currentDate = new \DateTime();

        // Iterate from registration date to current date
        while ($registrationDate <= $currentDate) {
            $monthYear = $registrationDate->format('Y-m');
            if (!Payment::where('member_id', $member->id)->where('month_year', $monthYear)->exists()) {
                $missedMonths[] = $monthYear;
            }
            $registrationDate->modify('+1 month');
        }

        return $missedMonths;
    }

    public function render()
    {
        return view('livewire.payment-processor');
    }
}
