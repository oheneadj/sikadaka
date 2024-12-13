<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Models\Contributor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContributorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Contributor $contributor): bool
    {
        return $contributor->user_id === $user->id or $user->role === UserRoleEnum::Admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Contributor $contributor): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create_contribution(User $user): bool
    {
        return $user->role !== UserRoleEnum::Viewer;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contributor $contributor): bool
    {
        return $contributor->user_id === $user->id or $user->role === UserRoleEnum::Admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contributor $contributor): bool
    {
        return $user->role === UserRoleEnum::Admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Contributor $contributor): bool
    {
        return $user->role === UserRoleEnum::Admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Contributor $contributor): bool
    {
        return $user->role === UserRoleEnum::Admin;
    }
}
