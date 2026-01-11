<?php

namespace App\Services\Folders;

use App\Models\Folder;
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

}
