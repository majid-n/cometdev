<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Lang;

class LangPolicy
{
    use HandlesAuthorization;

    public function __construct() {
        //
    }

    # Check user can delete this lang or not
    public function destroy( User $user, Lang $lang ) {
        return $user->id === $lang->user_id;
    }
}
