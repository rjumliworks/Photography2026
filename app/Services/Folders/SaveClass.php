<?php

namespace App\Services\Folders;

use App\Models\Folder;
use App\Models\Viewer;
use App\Models\ViewerFolder;
use App\Http\Resources\Common\FolderResource;

class SaveClass
{
    public function folder($request)
    {
        $data = Folder::create([
            'name'        => $request->name,
            'description' => $request->description,
            'is_protected'=> $request->is_protected,
            'type_id'   => 2,
            'user_id'     => \Auth::user()->id
        ]);
        
        return [
            'data' => $data,
            'message' => 'Folder created successfully!',
            'info' => "Your new folder has been created and is now available."
        ];
    }

    public function tags($request)
    {
        $data = Folder::find($request->id);
        $data->tags()->attach($request->tags);

        return [
            'data' => $data,
            'message' => 'Folder tags created successfully!',
            'info' => "Your new folder has been created and is now available."
        ];
    }

    public function viewer($request)
    {
        $folder = Folder::find($request->id);

        $email = strtolower($request->email);
        $emailHash = hash('sha256', $email);
        $viewer = Viewer::where('email_hash', $emailHash)->first();
        if (! $viewer) {
            $viewer = Viewer::create([
                'name'  => $request->name,
                'email' => $email, // mutator encrypts + hashes
            ]);
        }
        if (
            ViewerFolder::where('viewer_id', $viewer->id)
                ->where('folder_id', $folder->id)
                ->exists()
        ) {
            return [
                'data' => null,
                'message' => 'Email already added as a viewer!',
                'info' => "Duplicate entr for viewer email.",
                'status' => false
            ];
        }
        ViewerFolder::create([
            'viewer_id' => $viewer->id,
            'folder_id' => $folder->id,
        ]);

        return [
            'data' => $folder->load('viewers'),
            'message' => 'Folder viewer added successfully!',
            'info' => "Your new viewer has been added and is now available."
        ];
    }

}
