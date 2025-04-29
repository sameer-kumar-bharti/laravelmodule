<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/modules',[HomeController::class,'index']);
Route::get('/modules/add',[HomeController::class,'addModule']);
