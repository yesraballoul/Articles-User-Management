<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usersTableColumns = [
            "name",
            "email",
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

        $usersTableColumnsDTFormat  = Arr::map($usersTableColumns, function ($value, $key) {
            if($value === 'edit' || $value ==='delete' || $value === 'role'){
                return ["data" => $value, "orderable" => false];
            }
            return ["data" => $value ];
        });

        return view('home', compact("usersTableColumnsDTFormat"));
    }
}
