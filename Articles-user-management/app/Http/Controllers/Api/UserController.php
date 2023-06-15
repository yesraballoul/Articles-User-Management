<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orderByColumnName = request()->columns[request()->order[0]["column"]]["data"];
        $orderDirection = request()->order[0]["dir"];
        $responseDTformat = [
            
            "draw" => intval(request()->input("draw")),
            "recordsTotal" => User::count(),
            "recordsFiltered" => User::count(),
            "data" => User::offset(request()->start)->limit(request()->length)->orderBy($orderByColumnName, $orderDirection)->get(),
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
