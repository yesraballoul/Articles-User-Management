<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usersTableColumns = [
            "id",
            "name",
            "username",
            "role",
            "created_at",
            "updated_at",
        ];

        if (auth()->user()->can("update users")) {
            array_push($usersTableColumns, "edit");
        }
        if (auth()->user()->can("delete users")) {
            array_push($usersTableColumns, "delete");
        }

        $usersTableColumnsDTFormat = Arr::map($usersTableColumns, function ($value, $key) {
            if ($value === 'edit' || $value === 'delete' || $value === 'role') {
                return ["data" => $value, "orderable" => false];
            }
            return ["data" => $value];
        });

        return response()->view('users.index', compact("usersTableColumnsDTFormat"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rolesNames = Role::all()->pluck("name");
        return response()->view("users.create", compact("rolesNames"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = array_merge($request->validated(), ["password" => Hash::make($request->password)]);
        $user = User::create($data);
        $user->assignRole($data["role"]);
        return redirect()->route("users.create")->with("status", "user created successfully!!");
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $rolesNames = Role::all()->pluck("name");
        $userRole = $user->roles()->first()->name;
        return response()->view("users.edit", compact('user', 'rolesNames', 'userRole'));
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->fill([
            "name" => $data["name"],
            "email" => $data["email"] ?? $user->email,
            "password" => $data["password"] ? Hash::make($data["password"]) : $user->password
        ])->save();
        $user->syncRoles($data["role"]);
        
        return redirect()->route("home")->with("status", "User updated successfully!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('home')->with(["status" => "deleted successfully!!"]);
    }
}
