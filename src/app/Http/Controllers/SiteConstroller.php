<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteConstroller extends Controller
{
    public function index(){
        return view('site.index');
    }

    public function getSite(){
        return;
    }

}

