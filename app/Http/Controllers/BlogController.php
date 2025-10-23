<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('blog.blogs', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth()->id();

        $blog = Blog::create($validated);
        return redirect()->route('blogs.show', $blog->id)
            ->with('success', 'Blog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if (Auth::user()->cannot('update', $blog)) {
            abort(403);
        }
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {

        $validated = $request->validated();
        $blog->update($validated);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if (Auth::user()->cannot('delete', $blog)) {
            abort(403);
        }
        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully!');
    }

    public function toggleFollow(Blog $blog)
    {
        if (!auth()->check()) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }
            return redirect()->route('login')->with('error', 'You must be logged in to follow blogs.');
        }

        $user = auth()->user();
        $isFollowing = $user->followedBlogs->contains($blog->id);

        if ($isFollowing) {
            $user->followedBlogs()->detach($blog->id);
            $following = false;
            $message = 'You have unfollowed this blog.';
        } else {
            $user->followedBlogs()->syncWithoutDetaching([$blog->id]);
            $following = true;
            $message = 'You are now following this blog!';
        }

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'following' => $following,
                'message' => $message
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function togglePublish(Blog $blog)
    {
        // Only admins can publish/unpublish blogs
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Only administrators can publish or unpublish blogs.');
        }

        $isPublished = $blog->published_at !== null;

        if ($isPublished) {
            $blog->published_at = null;
            $published = false;
            $message = 'Blog unpublished successfully.';
        } else {
            $blog->published_at = now();
            $published = true;
            $message = 'Blog published successfully!';
        }

        $blog->save();

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
