<?php

namespace App\Policies;

use App\Models\Blog;
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
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): bool
    {
        // Anyone can view published posts, only owner/admin can view unpublished
        if ($post->published_at) {
            return true;
        }
        // Unpublished posts can only be viewed by the blog owner
        return $user && $user->id === $post->blog->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Blog $blog): bool
    {
        // Blog must be published and only the blog owner can create posts
        if ($blog->published_at !== null) {
            return $user->id === $blog->user_id;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public
    function update(User $user, Post $post): bool
    {
        // Only the blog owner can update their posts
        return $user->id === $post->blog->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public
    function delete(User $user, Post $post): bool
    {
        // Only the blog owner can delete their posts
        return $user->id === $post->blog->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public
    function restore(User $user, Post $post): bool
    {
        return $user->id === $post->blog->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public
    function forceDelete(User $user, Post $post): bool
    {
        return $user->id === $post->blog->user_id;
    }
}
