<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
        // Automatically set the user_id if not provided
        if (!$post->user_id) {
            $post->user_id = auth()->id();
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleting(Post $post): void
    {
        if ($post->image) {
            // Delete the image file from storage
            Storage::delete($post->image->url);
        }
    }
}
