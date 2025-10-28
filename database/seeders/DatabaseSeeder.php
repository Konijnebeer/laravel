<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use App\Models\Role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and tags first
        $this->call(RoleSeeder::class);
        $this->call(TagSeeder::class);

        $adminRoleId = Role::where('name', 'Owner')->value('id');

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('Admin123'),
            'role_id' => $adminRoleId
        ]);
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => Hash::make('password123'),
        ]);

        // Get all tags (including hierarchical cat-related tags)
        $tags = Tag::all();

        // Create users with blogs and posts using Laravel 11+ best practices
        User::factory()
            ->count(40)
            ->create()
            ->each(function ($user) use ($tags) {
                // 50% chance each user has a blog
                if (fake()->boolean()) {
                    $this->createBlogWithPostsAndTags($user, $tags);
                }
            });
    }

    /**
     * Create a blog with posts and attach tags
     */
    private function createBlogWithPostsAndTags(User $user, $tags): void
    {
        // Create blog for user
        $blog = Blog::factory()
            ->for($user)
            ->create();

        // Attach 3 random tags to the blog
        $blog->tags()->attach(
            $tags->random(min(3, $tags->count()))->pluck('id')
        );

        // Create 2-5 posts for the blog
        collect(range(1, fake()->numberBetween(2, 5)))
            ->each(fn() => tap(
                $blog->posts()->create([
                    'user_id' => $user->id,
                    'name' => fake()->sentence(),
                    'header_image' => fake()->randomElement([
                        'https://cataas.com/cat?width=400&height=1200',
                        'https://cataas.com/cat/cute?width=400&height=1200',
                        'https://cataas.com/cat?width=400&height=1200&filter=mono',
                        'https://cataas.com/cat/cute,funny?width=400&height=1200',
                        'https://cataas.com/cat/kitten?width=400&height=1200',
                    ]),
                    'text' => fake()->paragraphs(3, true),
                    'published_at' => fake()->boolean() ? now() : null,
                ]),
                // Attach 3 random tags to each post
                fn($post) => $post->tags()->attach(
                    $tags->random(min(3, $tags->count()))->pluck('id')
                )
            ));
    }
}
