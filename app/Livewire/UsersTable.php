<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class UsersTable extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDirection = 'DESC';
    #[Url(history: true)]
    public $per_page = 5;
    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $role = '';

    //public $user_status = '';

    public function setSortBy($sortByColumn)
    {
        if ($this->sortBy === $sortByColumn) {
            $this->sortDirection = ($this->sortDirection == "ASC") ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByColumn;

        $this->sortDirection = 'DESC';
    }

    public function toggle_user_status(User $user)
    {

        if ($user->status === 'active') {
            $user->forceFill([
                'status' => 'inactive'
            ])->save();
            toastr()->success("User set as inactive successfully");
            return;
        } else {
            $user->forceFill([
                'status' => 'active'
            ])->save();
            toastr()->success("User set as active successfully");
            return;
        }



        toastr()->success("{$user->name} password has been reset successfully");
    }

    public function delete(User $user)
    {
        $user->delete();

        toastr()->success("User has been deleted successfully successfully");
    }

    public function reset_user_password(User $user)
    {
        $user->forceFill([
            'password' => Hash::make('password'),
            'password_changed_at' => null
        ])->save();

        toastr()->success("{$user->name} password has been reset successfully successfully");
    }



    public function render()
    {
        return view('livewire.users-table', ['users' => User::search($this->search)->when($this->role !== '', function ($query) {
            $query->where('role', $this->role);
        })->orderBy($this->sortBy, $this->sortDirection)->paginate($this->per_page)->withQueryString()]);
    }
}
