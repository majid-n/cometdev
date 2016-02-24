<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Comment;
use App\User;

class CommentPolicy
{
    use HandlesAuthorization;

    public function __construct() {
        //
    }

    # Check user can delete this comment or not
    public function destroy( User $user, Comment $comment ) {
        return ($user->id === $comment->from_user_id || $user->id === $comment->to_user_id);
    }
}
