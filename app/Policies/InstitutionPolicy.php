<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\UserRoleEnum;
use App\Models\Institution;
use Illuminate\Auth\Access\Response;

class InstitutionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === UserRoleEnum::Admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Institution $institution): bool
    {
        return $user->hasPermission('view_communities');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === UserRoleEnum::Admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Institution $institution): bool
    {
        return $user->role === UserRoleEnum::Admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Institution $institution): bool
    {
        return $user->hasPermission('delete_community');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Institution $institution): bool
    {
        return $user->hasPermission('restore_community');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Institution $institution): bool
    {
        return $user->hasPermission('force_delete_community');
    }
}
