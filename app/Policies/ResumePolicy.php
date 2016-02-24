<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Resume;

class ResumePolicy
{
    use HandlesAuthorization;

    public function __construct() {
        //
    }

    # Check user can delete this resume or not
    public function destroy( User $user, Resume $resume ) {
        return $user->id === $resume->user_id;
    }
}