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
        Permission::create(['name' => 'view all users', 'group' => 'users']);
        Permission::create(['name' => 'create users', 'group' => 'users']);
        Permission::create(['name' => 'update users', 'group' => 'users']);
        Permission::create(['name' => 'delete users', 'group' => 'users']);

         // roles crud permissions
         Permission::create(['name' => 'view all roles', 'group' => 'roles']);
         Permission::create(['name' => 'create roles', 'group' => 'roles']);
         Permission::create(['name' => 'update roles', 'group' => 'roles']);
         Permission::create(['name' => 'delete roles', 'group' => 'roles']);

        //articles crud permissions
        Permission::create(['name' => 'view all articles', 'group' => 'articles']);
        Permission::create(['name' => 'create articles', 'group' => 'articles']);
        Permission::create(['name' => 'update articles', 'group' => 'articles']);
        Permission::create(['name' => 'delete articles', 'group' => 'articles']);

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

                 // articles crud permission
                 "view all articles",
                 "create articles",
                 "update articles",
                 "delete articles",

                //other crud permissions
                //"make somethings"
            ]);

        $editorRole = Role::create(['name' => 'editor']);

    }
}
