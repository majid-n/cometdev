<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Edu;

class EduPolicy
{
    use HandlesAuthorization;

    public function __construct() {
        //
    }

    # Check user can delete this edu or not
    public function destroy( User $user, Edu $edu ) {
        return $user->id === $edu->user_id || $user->inRole('admins');
    }
}