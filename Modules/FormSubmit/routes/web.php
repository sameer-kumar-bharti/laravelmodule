<?php

use Illuminate\Support\Facades\Route;
use Modules\FormSubmit\App\Http\Controllers\FormSubmitController;

//Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('form', FormSubmitController::class)->names('formsubmit');
//});
