<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\Folder;
use App\Models\ViewerFolderDownload;
use Illuminate\Support\Str;
use App\Http\Resources\Common\DownloadResource;

class DownloadController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'list':
                return $this->list($request);
            break;
            default:
                return inertia('Participant/Downloads/Index');
        }
    }

    public function list($request){
        
        $data = ViewerFolderDownload::with('folder','viewer')
        ->where('viewer_id',\Auth::guard('viewer')->id())
        ->paginate(10);
        return DownloadResource::collection($data);
    }

    public function download(Folder $folder)
{
    $viewer = auth('viewer')->user();

    // 🔐 Authorization
    if (! $folder->viewers()->where('viewer_id', $viewer->id)->exists()) {
        abort(403);
    }

    $zipFileName = Str::slug($folder->name) . '.zip';
    $zipPath = storage_path("app/temp/{$zipFileName}");

    // Ensure temp directory exists
    if (! file_exists(dirname($zipPath))) {
        mkdir(dirname($zipPath), 0755, true);
    }

    $password = $folder->password?->password;
    $zip = new ZipArchive;

    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        abort(500, 'Unable to create ZIP file.');
    }

    $addedFiles = 0; // Track files actually added

    foreach ($folder->files as $file) {
        $absolutePath = storage_path("app/public/{$file->path}");

        if (file_exists($absolutePath)) {
            $nameInZip = $file->name;

            if ($password) {
                // AES encryption requires password per file
                $zip->addFile($absolutePath, $nameInZip);
                $zip->setEncryptionName($nameInZip, ZipArchive::EM_AES_256, $password);
            } else {
                $zip->addFile($absolutePath, $nameInZip);
            }

            $addedFiles++;
        }
    }

    if ($addedFiles === 0) {
        $zip->close();
        abort(404, 'No files available to download.');
    }

    if (! $zip->close()) {
        abort(500, 'Failed to finalize ZIP file.');
    }

    // Track viewer download
    $download = ViewerFolderDownload::firstOrCreate([
        'viewer_id' => $viewer->id,
        'folder_id' => $folder->id,
    ]);
    $download->increment('count');

    return response()->download($zipPath)->deleteFileAfterSend(true);
}
}
