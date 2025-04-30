<?php

use Illuminate\Support\Facades\Route;
use Modules\Backup\App\Http\Controllers\BackupController;

//Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('backup-db', BackupController::class)->names('backup');
    Route::get('/download-backup/{filename}', [BackupController::class, 'downloadBackupFile'])->name('download.backup');
//});
