<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Blog $blog)
    {
//        dd($blog);
        $posts = $blog->posts()->get();
        return view('posts.posts', compact('blog', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog, Post $post)
    {
        if ($post->blog_id !== $blog->id) {
            abort(404);
        }
        return view('posts.show', compact(['blog', 'post']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function toggleLike(Post $post)
    {
        $user = auth()->user();
        if ($user->likedPosts->contains($post->id)) {
            $user->likedPosts()->detach($post->id);
            return redirect()->back()->with('success', 'You unliked this post.');
        } else {
            $user->likedPosts()->syncWithoutDetaching([$post->id]);
            return redirect()->back()->with('success', 'You liked this post!');
        }
    }
}
