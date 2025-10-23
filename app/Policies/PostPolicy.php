<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        // Anyone can view published posts, only owner/admin can view unpublished
        if ($post->published_at) {
            return true;
        }
        return $user->id === $post->blog->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, $blogId = null): bool
    {
        // User must own the blog to create posts in it
        if ($blogId) {
            $blog = \App\Models\Blog::find($blogId);
            return $blog && $user->id === $blog->user_id;
        }
        return true; // Has at least one blog
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        // Only the blog owner can update their posts
        return $user->id === $post->blog->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        // Only the blog owner can delete their posts
        return $user->id === $post->blog->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->id === $post->blog->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->id === $post->blog->user_id;
    }
}
