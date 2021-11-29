<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function create(User $user)
    {
        true;
    }
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
