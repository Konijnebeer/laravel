<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
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
        $totalUsers = \App\Models\User::count();
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

        // Add 6 image fillers
        for ($i = 0; $i < 6; $i++) {
            $items->push([
                'type' => 'filler',
                'data' => [
                    'filler_type' => 'image',
                    'image' => 'https://picsum.photos/200/200?random=' . rand(1000, 9999)
                ]
            ]);
        }

        $items = $items->shuffle();

        return view('home', compact('items'));
    }

    public function search()
    {

    }
}
