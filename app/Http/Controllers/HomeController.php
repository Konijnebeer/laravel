<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::where('published_at', '>=', now()->subDays(3))
            ->inRandomOrder()
            ->limit(16)
            ->get();

        $blogs = Blog::whereHas('posts', function ($query) {
            $query->where('published_at', '>=', now()->subMonth());
        })
            ->inRandomOrder()
            ->limit(10)
            ->get();

        // Combine posts, blogs, and fillers
        $items = collect();

        foreach ($posts as $post) {
            $items->push(['type' => 'post', 'data' => $post]);
        }

        foreach ($blogs as $blog) {
            $items->push(['type' => 'blog', 'data' => $blog]);
        }


        // Get real stats from database
        $totalPosts = Post::count();
        $totalUsers = User::count();
        $totalBlogs = Blog::count();

        // Cat facts array
        $catFacts = [
            'Cats spend 70% of their lives sleeping',
            'A group of cats is called a clowder',
            'Cats have over 20 vocalizations',
            'A cat\'s purr vibrates at 25-150 Hz',
            'Cats can rotate their ears 180 degrees',
            'Cats have 32 muscles in each ear',
            'A cat\'s nose is unique like a fingerprint',
            'Cats can jump up to 6 times their length',
            'Cats have fewer taste buds than humans',
            'A cat\'s heart beats 110-140 times per minute',
            'Cats can\'t taste sweetness',
            'Cats groom themselves for 30-50% of the day'
        ];

        // Add all cat facts
        foreach ($catFacts as $fact) {
            $items->push([
                'type' => 'filler',
                'data' => [
                    'filler_type' => 'fact',
                    'cat_fact' => $fact
                ]
            ]);
        }

        // Add all stats
        $statTypes = [
            ['label' => 'Total Posts', 'value' => $totalPosts],
            ['label' => 'Cat Lovers', 'value' => $totalUsers],
            ['label' => 'Active Blogs', 'value' => $totalBlogs],
        ];

        foreach ($statTypes as $stat) {
            $items->push([
                'type' => 'filler',
                'data' => [
                    'filler_type' => 'stat',
                    'stat' => $stat
                ]
            ]);
        }

        // Cat image URLs from cataas.com
        $catImages = [
            'https://cataas.com/cat?type=square',
            'https://cataas.com/cat/cute?type=square',
            'https://cataas.com/cat/gif',
            'https://cataas.com/cat?filter=mono&type=square',
            'https://cataas.com/cat/says/Meow?fontSize=30&fontColor=white&type=square',
            'https://cataas.com/cat?filter=blur&type=square',
            'https://cataas.com/cat/cute,funny?type=square',
            'https://cataas.com/cat/says/Hello?fontSize=25&fontColor=orange&type=square',
            'https://cataas.com/cat?filter=sepia&type=square',
            'https://cataas.com/cat/kitten?type=square',
        ];

        // Add image fillers
        foreach ($catImages as $catImage) {
            $items->push([
                'type' => 'filler',
                'data' => [
                    'filler_type' => 'image',
                    'image' => $catImage
                ]
            ]);
        }

        $items = $items->shuffle();

        return view('home', compact('items'));
    }

    public function search()
    {
        $items = null;
        $posts = true;
        $blogs = true;
        $search = '';
        $tags = [];
        return view('search', compact('items', 'posts', 'blogs', 'search', 'tags'));
    }

    public function results(Request $request)
    {
        $posts = $request->has('posts');
        $blogs = $request->has('blogs');
        $search = $request->input('search');
        $tags = $request->input('tags', []);

        $items = collect();

        // If posts enabled
        if ($posts) {
            $postQuery = Post::query()
                ->when($search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', "%$search%")
                            ->orWhere('text', 'like', "%$search%");
                    });
                })
                ->when(!empty($tags), function ($query) use ($tags) {
                    $query->whereHas('tags', function ($q) use ($tags) {
                        $q->whereIn('tags.id', $tags);
                    });
                })
                ->where('published_at', '!=', 'null');

            foreach ($postQuery->get() as $post) {
                $items->push(['type' => 'post', 'data' => $post]);
            }
        }

        // Search blogs if enabled
        if ($blogs) {
            $blogQuery = Blog::query()
                ->when($search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%");
                    });
                })
                ->when(!empty($tags), function ($query) use ($tags) {
                    $query->whereHas('tags', function ($q) use ($tags) {
                        $q->whereIn('tags.id', $tags);
                    });
                })
                ->where('published_at', '!=', 'null');

            foreach ($blogQuery->get() as $blog) {
                $items->push(['type' => 'blog', 'data' => $blog]);
            }
        }

        $items->shuffle();

        return view('search', compact('items', 'posts', 'blogs', 'search', 'tags'));
    }
}
