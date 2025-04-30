<?php

namespace Modules\Backup\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DB;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::files(storage_path('backups'));
        return view('backup::index',compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backup::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $backup = '';
        $tables = DB::select('SHOW TABLES');
        $databaseName = 'brandzzysofttech01';
        $tableKey = "Tables_in_$databaseName";
        foreach ($tables as $tableObj) {
            $table = $tableObj->$tableKey;
            $createTable = DB::select("SHOW CREATE TABLE `$table`")[0]->{'Create Table'};
            $backup .= "-- Table structure for `$table`\n";
            $backup .= $createTable . ";\n\n";
            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                $columns = array_keys((array)$row);
                $escapedCols = array_map(fn($col) => "`" . addslashes($col) . "`", $columns);
                $escapedVals = array_map(function ($val) {
                    return is_null($val) ? "NULL" : "'" . addslashes($val) . "'";
                }, array_values((array)$row));

                $backup .= "INSERT INTO `$table` (" . implode(",", $escapedCols) . ") VALUES (" . implode(",", $escapedVals) . ");\n";
            }
            $backup .= "\n";
        }
        $folder = storage_path('backups');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }
        $filename = 'backup_' . now()->format('Y-m-d_H-i-s') . '.sql';
        $path = $folder . '/' . $filename;
        File::put($path, $backup);
        return Response::make($backup, 200, [
            'Content-Type' => 'application/sql',
            'Content-Disposition' => "attachment; filename=\"$filename\""
        ]);
        
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('backup::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('backup::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    public function downloadBackupFile($filename)
    {
        $filePath = storage_path("backups/{$filename}");

        if (!File::exists($filePath)) {
            abort(404, 'File not found.');
        }

        return Response::download($filePath, $filename);
    }
}
