<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {


        if ($user->contributors()->count() === 0) {

            $user->deleteProfilePhoto();
            $user->tokens->each->delete();
            $user->delete();

            toastr()->success("User has been deleted  successfully");

            return;
        }

        toastr()->error("User has registered members. Consider making user inactive");

        return;
    }
}
