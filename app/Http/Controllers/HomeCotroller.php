<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeCotroller extends Controller
{
    public function home()
    {
        $posts = Post::where('published_at', '>=', now()->subDays(3))
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $blogs = Blog::whereHas('posts', function ($query) {
            $query->where('published_at', '>=', now()->subMonth());
        })
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('home', compact('posts', 'blogs'));
    }
}
