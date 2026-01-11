<?php

namespace App\Services\Files;

use App\Models\FolderFile;
use App\Http\Resources\Common\FileResource;

class ViewClass
{
    protected function userId()
    {
        return auth()->id();
    }

    public function lists($request){
        $data = FolderFile::with('folder')
        ->where('user_id', $this->userId())
        ->paginate(10);
        return FileResource::collection($data);
    }
}
