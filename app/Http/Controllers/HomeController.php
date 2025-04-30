<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Module;
use ZipArchive;

class HomeController extends Controller
{
    public function index(){
        $modules = File::directories(base_path('Modules'));
        return view('home',['modules'=>$modules]);
    }

    public function addModule(Request $request){
        return view('addmodule');
    }

    public function changeStatus($moduleName){
        if (Module::isEnabled($moduleName)){
            Module::disable($moduleName);
        }else{
            Module::enable($moduleName);
        }
        return redirect()->back();

    }

    public function downloadModule($moduleName)
    {
        $modulePath = base_path('Modules/' . $moduleName);

        if (!File::exists($modulePath)) {
            return response()->json(['error' => 'Module not found'], 404);
        }

        $zipFile = public_path($moduleName . '.zip');
        $zip = new ZipArchive;
        if ($zip->open($zipFile, ZipArchive::CREATE) !== true) {
            return response()->json(['error' => 'Could not create ZIP file'], 500);
        }

        $this->addFolderToZip($zip, $modulePath, $moduleName);
        $zip->close();
        return response()->download($zipFile)->deleteFileAfterSend(true);
    }

    public function addFolderToZip($zip, $folderPath, $zipPath)
    {
        $files = File::allFiles($folderPath);
        foreach ($files as $file) {
            $zip->addFile($file->getRealPath(), $zipPath . '/' . $file->getRelativePathName());
        }
    }

    public function extractModuleZip(Request $request)
    {
        
        $validated = $request->validate([
            'zip_file' => 'required|file|mimes:zip',
        ]);

        $zipFile = $validated['zip_file'];
        $extractToPath = base_path('Modules');
        if (!file_exists($extractToPath)) {
            mkdir($extractToPath, 0755, true);
        }

        $zip = new ZipArchive;

        if ($zip->open($zipFile->getRealPath()) === true) {
            $zip->extractTo($extractToPath);
            $zip->close();

            return redirect('modules');
        } else {
            return redirect('modules');
        }
    }

    public function removeModule($moduleName){
        $modulePath = base_path("Modules/{$moduleName}");
        if (File::exists($modulePath)) {
            File::deleteDirectory($modulePath);
            return redirect('modules');
        } else {
            return redirect('modules');
        }
    }
}
