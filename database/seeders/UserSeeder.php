<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed data for roles table
        DB::table('roles')->insert([
            ['id' => 1, 'nama_role' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_role' => 'User', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed data for users table
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1234'),
                'id_role' => 1, // Admin role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('1234'),
                'id_role' => 2, // User role
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
