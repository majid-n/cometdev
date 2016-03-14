<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Xp;

class XpPolicy
{
    use HandlesAuthorization;

    public function __construct() {
        //
    }

    # Check user can delete this Xp or not
    public function destroy( User $user, Xp $xp ) {
        return $user->id === $xp->user_id || $user->inRole('admins');
    }
}