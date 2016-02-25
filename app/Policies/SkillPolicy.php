<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Skill;

class SkillPolicy
{
    use HandlesAuthorization;

    # Check user can delete this Skill or not
    public function destroy( User $user , Skill $skill ) {
        return $user->id === $skill->user_id;
    }
}