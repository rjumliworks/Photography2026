<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use ZipArchive;
use App\Models\Folder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ViewerController extends Controller
{
    public function view(){
        return inertia('Participant/Index');
    }

    public function login(){
        return inertia('Participant/Login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('viewer')->logout(); // logout the participant guard
        $request->session()->invalidate();     // invalidate session
        $request->session()->regenerateToken(); // regenerate CSRF token

        return redirect('/viewer/login'); // or any route you prefer
    }

    public function download(Folder $folder)
    {
        $viewer = auth('viewer')->user();

        // 🔐 Authorization: viewer must have access to folder
        if (! $folder->viewers()->where('viewer_id', $viewer->id)->exists()) {
            abort(403);
        }

        $zipFileName = Str::slug($folder->name) . '.zip';
        $zipPath = storage_path("app/temp/{$zipFileName}");

        // Ensure temp directory exists
        if (! file_exists(dirname($zipPath))) {
            mkdir(dirname($zipPath), 0755, true);
        }

        $zip = new ZipArchive;

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Unable to create ZIP file.');
        }

        // Add ORIGINAL files only
        foreach ($folder->files as $file) {
            $absolutePath = storage_path("app/public/{$file->path}");

            if (file_exists($absolutePath)) {
                $zip->addFile(
                    $absolutePath,
                    $file->name // keep original filename
                );
            }
        }

        $zip->close();

        // Stream + auto delete
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
