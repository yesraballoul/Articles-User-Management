<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderByColumnName = request()->columns[request()->order[0]["column"]]["data"];
        $orderDirection = request()->order[0]["dir"];

        $query = Role::query();

        $data = $query->clone()
            ->orderBy($orderByColumnName, $orderDirection)
            ->offset(request()->start)
            ->limit(request()->length)
            ->get();

        $responseDTformat = [
            
            "draw" => intval(request()->input("draw")),
            "recordsTotal" => Role::count(),
            "recordsFiltered" => Role::count(),
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
