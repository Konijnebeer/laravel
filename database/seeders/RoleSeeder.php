<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\UserPermission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->updateOrInsert([
            'name' => 'User',
            'permission' => UserPermission::USER,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->updateOrInsert([
            'name' => 'Owner',
            'permission' => UserPermission::ADMIN,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
