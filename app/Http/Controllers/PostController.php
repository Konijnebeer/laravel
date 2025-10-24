<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Blog $blog)
    {
        $posts = $blog->posts()->get();
        return view('posts.posts', compact('blog', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Blog $blog)
    {
        $this->authorize('create', [Post::class, $blog->id]);

        return view('posts.create', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Blog $blog)
    {
        $this->authorize('create', [Post::class, $blog->id]);

        $validated = $request->validated();
        $validated['blog_id'] = $blog->id;
        $validated['user_id'] = $blog->user_id;

        // Handle file upload
        if ($request->hasFile('header_image')) {
            $validated['header_image'] = $request->file('header_image')->store('post-images', 'public');
        }

        $post = Post::create($validated);

        return redirect()->route('blogs.posts.show', ['blog' => $blog->id, 'post' => $post->id])
            ->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog, Post $post)
    {
        if ($post->blog_id !== $blog->id) {
            abort(404);
        }

        $this->authorize('view', $post);

        return view('posts.show', compact(['blog', 'post']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog, Post $post)
    {
        if ($post->blog_id !== $blog->id) {
            abort(404);
        }

        $this->authorize('update', $post);

        return view('posts.edit', compact('blog', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Blog $blog, Post $post)
    {
        if ($post->blog_id !== $blog->id) {
            abort(404);
        }

        $this->authorize('update', $post);

        $validated = $request->validated();

        // Handle file upload
        if ($request->hasFile('header_image')) {
            // Delete old image if it exists
            if ($post->header_image) {
                Storage::disk('public')->delete($post->header_image);
            }

            // Store new image
            $validated['header_image'] = $request->file('header_image')->store('post-images', 'public');
        }

        $post->update($validated);

        return redirect()->route('blogs.posts.show', ['blog' => $blog->id, 'post' => $post->id])
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, Post $post)
    {
        if ($post->blog_id !== $blog->id) {
            abort(404);
        }

        $this->authorize('delete', $post);

        // Delete associated image file if it exists
        if ($post->header_image) {
            Storage::disk('public')->delete($post->header_image);
        }

        $post->delete();

        return redirect()->route('blogs.show', $blog->id)
            ->with('success', 'Post deleted successfully!');
    }

    public function toggleLike(Post $post)
    {
        if (!auth()->check()) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }
            return redirect()->route('login')->with('error', 'You must be logged in to like posts.');
        }

        $user = auth()->user();
        $isLiked = $user->likedPosts->contains($post->id);

        if ($isLiked) {
            $user->likedPosts()->detach($post->id);
            $liked = false;
            $message = 'You unliked this post.';
        } else {
            $user->likedPosts()->syncWithoutDetaching([$post->id]);
            $liked = true;
            $message = 'You liked this post!';
        }

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'liked' => $liked,
                'message' => $message
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function publish(Blog $blog, Post $post)
    {
        if ($post->blog_id !== $blog->id) {
            abort(404);
        }

        $this->authorize('update', $post);

        $isPublished = $post->published_at !== null;

        if ($isPublished) {
            $post->published_at = null;
            $published = false;
            $message = 'Post unpublished successfully.';
        } else {
            $post->published_at = now();
            $published = true;
            $message = 'Post published successfully!';
        }

        $post->save();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'published' => $published,
                'message' => $message
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}

