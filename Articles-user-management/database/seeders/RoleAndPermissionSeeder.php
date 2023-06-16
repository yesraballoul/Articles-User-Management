<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //users crud permissions
        Permission::create(['name' => 'view all users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

         // roles crud permissions
         Permission::create(['name' => 'view all roles']);
         Permission::create(['name' => 'create roles']);
         Permission::create(['name' => 'update roles']);
         Permission::create(['name' => 'delete roles']);

        //other crud permissions
        //Permissions::create['name'=> 'make something']

        //Roles
        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo([
                //users crud permissions
                "view all users",
                "create users",
                "update users",
                "delete users",

                // roles crud permission
                "view all roles",
                "create roles",
                "update roles",
                "delete roles",

                //other crud permissions
                //"make somethings"
            ]);

        $editorRole = Role::create(['name' => 'editor']);

    }
}