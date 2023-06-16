<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orderByColumnName = request()->columns[request()->order[0]["column"]]["data"];
        $orderDirection = request()->order[0]["dir"];

        $query = User::with('roles:name');

        $data = $query->clone()
            ->orderBy($orderByColumnName, $orderDirection)
            ->offset(request()->start)
            ->limit(request()->length)
            ->get();

        $responseDTformat = [
            
            "draw" => intval(request()->input("draw")),
            "recordsTotal" => User::count(),
            "recordsFiltered" => User::count(),
            "data" => $data,
        ];
        return response()->json($responseDTformat);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
