<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->insert([
            ['name' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sport', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kitchen', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coffee', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
