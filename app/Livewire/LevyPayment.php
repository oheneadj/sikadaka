<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contributor;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;

class LevyPayment extends Component
{

    public $debt_amount = '';

    public $amount = '';

    #[Url(history: true)]
    public $search = '';

    public $members = [];

    public $selected_member;

    public $outstanding_debt = '';


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

        $this->validate([
            'amount' => 'required|numeric|min:1|max:' . $this->selected_member->outstanding_debt
        ]);

        if ($this->selected_member->outstanding_debt > 0) {
            $this->selected_member->update([
                'outstanding_debt' => max(0, $this->selected_member->outstanding_debt - $this->amount),
            ]);
        }


        $this->selected_member->payments()->create([
            'amount' => $this->amount,
            'payment_type' => 'DEBT',
            'user_id' => Auth::user()->id
        ]);

        toastr()->success("Outstanding debt has been paid successfully");

        return redirect()->route('member.single', $this->selected_member->id);
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
        $this->selected_member = Contributor::find($memberId);
        $this->members = [];
    }



    public function render()
    {
        return view('livewire.levy-payment');
    }
}
