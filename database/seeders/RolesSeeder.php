<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            ['role_name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Poster', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Commenter', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Anonymous', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
