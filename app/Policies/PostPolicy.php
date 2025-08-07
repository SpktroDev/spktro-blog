<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function author(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;

    }

    public function published(?User $user, Post $post): bool
    {
        return $post->status == 2;
    }
}
