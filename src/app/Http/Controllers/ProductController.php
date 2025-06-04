<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use GuzzleHttp\Psr7\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
        
    public function create()
    {
        $user = Product::all(); //dd($user);
        return response()->json($user);
    }

    public function store(StoreProductRequest $request)
    {   
        $request->fill($request->except("_method",'_token'));
        Product::create($request->all());
        return redirect()->route('products.index');
    }
    

    public function update(UpdateProductRequest $request)    
    {
        $product = Product::find($request->id);        
        if ($product->save()) {
            $result = ["result"=>true, "mje"=>"Se actualizaron los datos correctamente"];
        }
        else{
            $result = ["result"=>false, "mje"=>"Los datos no se actualizaron correctamente"];
        }        
        return response()->json( $result);
    } 
   
    public function destroy(Request $request)
    {
        $product = Product::find($request ); 
        if ($product->save()) {
            $result = ["result"=>true, "mje"=>"Se actualizaron los datos correctamente"];
        }
        else{
            $result = ["result"=>true, "mje"=>"Se actualizaron los datos correctamente"];
        }
        $product = Product::all();
        return response()->json([ $product , $result]);
    }
}
