<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteConstroller extends Controller
{
    public function index(){
        return view('site.index');
    }

    public function getSite($site =""){
        return view('site.'+$site);
    }

    public function search(request $request) {  
        return return view('site.search');        
    }

}

