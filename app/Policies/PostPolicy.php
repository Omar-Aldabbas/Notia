<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function create(User $user)
    {
        return in_array($user->role, ['author','admin']);
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->author_id || $user->role === 'admin';
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->author_id || $user->role === 'admin';
    }
}