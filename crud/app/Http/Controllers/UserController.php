<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{    
    public function index()
    {        
        return view('users.index')->render();
    }
    
    public function create()
    {
        $user = User::all(); //dd($user);
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::save($request);
        if ($user) {
            # code...
        } else {
            # code...
        }
        
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
    public function edit(string $id)
    {
        //
    }
    
    public function update(Request $request, string $id)
    {
        $user = User::find($request->id);
        if ($user->save($request)) {
            $result = ["result"=>true,"mje"=>"Datos actualizados correctamente"];
        } else {
            $result = ["result"=>false, "mje"=>"Los datos no se actualizaron correctamente"];
        }
        return response()->json($result);
    }

    
    public function destroy(string $id)
    {
        $user = User::find($request->id);
        if ($user::delete()) {
            $result = ["result"=>true,"mje"=>"Datos Eliminados Correctamente"];
        } else {
            $result = ["result"=>false, "mje"=>"Datos no eliminados correctamente"];
        }
        
    }
}
