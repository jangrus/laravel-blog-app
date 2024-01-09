<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'surname' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'adress' => 'Admin Address',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
