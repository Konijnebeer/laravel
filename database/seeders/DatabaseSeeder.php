<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();
        // Default role creation
        $this->call(RoleSeeder::class);

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
    }
}
