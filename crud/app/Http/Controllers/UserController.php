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

    public function store(Request $request)
    { //use the register controller
        $user = User::created($request->except("_method",'_token',"id"));        
        if ($user) {
            $result = ["result"=>true,"mje"=>"Datos actualizados correctamente"];
        } else {
            $result = ["result"=>false, "mje"=>"Los datos no se actualizaron correctamente"];
        }
        return response()->json($result);
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


    public function destroy($id)
    {
        $user = User::find($id)->delete(); 
        if ($user) {
            $result = ["result"=>true,"mje"=>"Datos Eliminados Correctamente"];
        } else {
            $result = ["result"=>false, "mje"=>"Datos no eliminados correctamente"];
        }
        return response()->json($result);
    }
}
