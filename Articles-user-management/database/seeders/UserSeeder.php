<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@laravel.com',
        ]);

        $editor = \App\Models\User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@laravel.com',
        ]);



        $admin->assignRole("admin");
        $editor->assignRole("editor");
    }
}
