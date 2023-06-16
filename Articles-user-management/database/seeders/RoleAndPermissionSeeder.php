<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //users crud permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        //other crud permissions
        //Permissions::create['name'=> 'make something']

        //Roles
        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo([
                //users crud permissions
                "create users",
                "update users",
                "delete users"

                //other crud permissions
                //"make somethings"
            ]);

        $editorRole = Role::create(['name' => 'editor']);

    }
}
