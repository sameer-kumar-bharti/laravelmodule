<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(){
        $modules = File::directories(base_path('Modules'));
        return view('home',['modules'=>$modules]);
    }

    public function addModule(Request $request){
        return view('addmodule');
    }
}
