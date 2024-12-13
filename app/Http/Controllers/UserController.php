<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Enums\UserRoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('users.view-users', ['users' =>  User::orderBy('created_at', 'desc')->paginate(15)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.register-user', ['roles' =>  UserRoleEnum::cases()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'picture_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|min:5',
            'email' => 'required|unique:App\Models\User,email',
            'phone_number' => 'nullable|min:10|numeric|unique:contributors,phone_number',
            'role' => 'required',
        ], [
            'picture_path' => 'The image must be jpeg,jpg or png',
            'name' => 'Enter a valid user name. Minimum of 5 letters',
            'email' => 'Enter a valid active email for this user ',
            'email.unique' => 'The email you entered has already been used for a user',
            'phone_number' => 'Phone number is either invalid or is registered with another user',
            'role' => 'You must select a role for the user'
        ]);


        if (isset($data['picture_path'])) {
            $image_name = time() . '.' . $data['picture_path']->extension();

            $data['picture_path']->move(public_path('users_pictures'), $image_name);

            $data['picture_path'] = $image_name;
        }

        $data['password'] = Hash::make('password');
        $data['user_id'] = Auth::user()->id;
        $data['institution_id'] = Auth::user()->institution->id;

        $user = User::create($data);

        toastr()->success("{$user->name} has been registered successfully");
        return to_route('user.single', $user->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        $total_contribution = $user->payments_received()->where('payment_type', 'CONTRIBUTION')->sum('amount');
        $total_donation = $user->payments_received()->where('payment_type', 'DONATION')->sum('amount');
        $members = $user->contributors->count();

        return view('users.single-user', [
            'user' => $user,
            'total_contribution' => Number::currency($total_contribution, 'GHS'),
            'total_donation' => Number::currency($total_donation, 'GHS'),
            'members' => $members
        ]);

        return view('users.single-user', [
            'user' => $user,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit-user', [
            'user' => $user,
            'roles' => UserRoleEnum::cases()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'picture_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|min:5',
            'phone_number' => 'nullable|min:10|numeric|unique:contributors,phone_number',
            'role' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
        ], [
            'picture_path' => 'The image must be jpeg,jpg or png',
            'name' => 'Enter a valid user name. Minimum of 5 letters',
            'email' => 'Enter a valid active email for this user ',
            'email.unique' => 'The email you entered has already been used for a user',
            'phone_number' => 'Phone number is either invalid or is registered with another user',
            'role' => 'You must select a role for the user'
        ]);


        if (isset($data['picture_path'])) {
            $image_name = time() . '.' . $data['picture_path']->extension();

            $data['picture_path']->move(public_path('users_pictures'), $image_name);

            $data['picture_path'] = $image_name;
        }

        $user->update($data);

        toastr()->success("{$user->name} has been updated successfully");
        return to_route('user.single', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        toastr()->success("{$user->name} has been deleted successfully");
        return to_route('users');
    }


    public function reset_user_password(User $user)
    {
        $user->update([
            'password' => Hash::make('password'),
            'password_changed_at' => ""
        ]);

        toastr()->success("{$user->name} password has been reset successfully successfully");
        return to_route('users');
    }
}
