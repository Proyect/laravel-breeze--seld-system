<?php

namespace App\Http\Controllers;

u  /**
     * Store a newly created resource in storage.
     */se App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

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

    public function store(Request $request)// not finished
    {
        $user = User::created($request->except("_method",'_token',"id"));
        if ($user) {
            $result = ["result"=>true,"mje"=>"Datos actualizados correctamente"];
        } else {
            $result = ["result"=>false, "mje"=>"Los datos no se actualizaron correctamente"];
        }
        return response()->json($result);
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

    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $user->fill($request->except("_method",'_token'));
        //dd($user);
        if ($user->save()) {
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
