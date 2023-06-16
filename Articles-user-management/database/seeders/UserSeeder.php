<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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


        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create users']);

        $adminRole = Role::create(['name' => 'admin'])->givePermissionTo('create users');
        $editorRole = Role::create(['name' => 'editor']);

        $admin->assignRole("admin");
        $editor->assignRole("editor");
    }
}
