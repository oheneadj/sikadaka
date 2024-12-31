<?php

namespace App\Livewire;

use App\Models\Contributor;
use Livewire\Component;
use Livewire\Attributes\Url;

class LevyPayment extends Component
{

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $members = [];

    public $selected_member = null;

    public function search_members()
    {
        $this->members = Contributor::search($this->search)
            ->orderBy('created_at', 'DESC')
            ->get(['id', 'name', 'membership_id']);
    }

    // public function mount() {}

    public function render()
    {
        return view('livewire.levy-payment');
    }
}
