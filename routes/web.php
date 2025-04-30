<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/modules',[HomeController::class,'index'])->name('modules');
Route::get('/modules/add',[HomeController::class,'addModule'])->name('addmodule');
Route::post('/modules/{module}', [HomeController::class, 'changeStatus'])->name('modules.toggle');
Route::get('export-module/{moduleName}', [HomeController::class, 'downloadModule'])->name('downloadModule');
Route::post('extractModuleZip', [HomeController::class, 'extractModuleZip'])->name('extractModuleZip');
Route::post('/remove/{module}', [HomeController::class, 'removeModule'])->name('removeModule');
