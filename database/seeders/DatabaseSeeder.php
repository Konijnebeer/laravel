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
        // Default role creation
        $this->call(RoleSeeder::class);
//        $this->call(BlogSeeder::class);
//        $this->call(TagSeeder::class);

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

        // Create tags
        $tags = Tag::factory()->count(10)->create();

        // Create users with blogs, posts, and attach tags to blogs
        User::factory()
            ->count(40)
            ->has(
                Blog::factory()
                    ->count(rand(0, 1))
                    // Attach random tags to each blog
                    ->hasAttached($tags->random(rand(1, 3)), [], 'tags')
                    // Each blog has posts, set user_id to blog's user_id
                    ->hasPosts(rand(2, 5), function (array $attributes, Blog $blog) {
                        return [
                            'user_id' => $blog->user_id,
                        ];
                    })
            )
            ->create();
    }
}
