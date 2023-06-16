<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Support\Arr;

class RoleController extends Controller
{
     /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rolesTableColumns = [
            "name",
            "created_at",
            "updated_at",
        ];

        if (auth()->user()->can("update roles")) {
            array_push($rolesTableColumns, "edit");
        }
        if (auth()->user()->can("delete roles")) {
            array_push($rolesTableColumns, "delete");
        }

        $rolesTableColumnsDTFormat = Arr::map($rolesTableColumns, function ($value, $key) {
            if ($value === 'edit' || $value === 'delete' || $value === 'role') {
                return ["data" => $value, "orderable" => false];
            }
            return ["data" => $value];
        });

        return response()->view('roles.index', compact("rolesTableColumnsDTFormat"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionsByGroup = Permission::all()->groupBy('group');

        return response()->view("roles.create", compact('permissionsByGroup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create(["name" => $request->name]);
        $role->givePermissionTo($request->permissions);
        return redirect()->route('roles.index')->with('status', 'Role created successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissionsByGroup = Permission::all()->groupBy('group');

        $rolePermissionsIds = $role->permissions()->pluck('id');

        return response()->view('roles.edit', compact('role', 'permissionsByGroup', 'rolePermissionsIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->fill([
            'name' => $request->name,
        ])->save();
        $role->syncPermissions($request->permissions);

        return redirect()->route("roles.index")->with("status", "Role updated successfully!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with(["status" => "Role deleted successfully!!"]);
    }
}
