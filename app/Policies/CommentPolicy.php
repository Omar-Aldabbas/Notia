<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function create(User $user)
    {
        return $user->role !== null;
    }

    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id || $user->role === 'admin';
    }
}