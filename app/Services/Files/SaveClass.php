<?php

namespace App\Services\Files;

use Hashids\Hashids;
use App\Models\FolderFile;
use App\Jobs\UploaderJob;
use App\Http\Resources\Common\FileResource;

class SaveClass
{
    public function file($request){
        $file = $request->file('file');

        $hashids = new Hashids('krad',10);
        $code = $hashids->encode(\Auth::user()->id);
       
        $currentUsage = \Auth::user()->folders()->withSum('files', 'size')->get()->sum('files_sum_size');

        if($currentUsage + $file->getSize() > $request->limit) {
            return [
                'data' => 'kradwashere!@#$%'
            ];
        }else{
            $kind = str_contains($file->getMimeType(), 'video') ? 'video' : 'image';
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs("folders/{$code}", $filename, 'public');

            $folderFile = FolderFile::create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'kind' => $kind,
                'status' => 'processing', 
                'user_id' => \Auth::user()->id,
                'folder_id' => $request->id,
            ]);
        }

        UploaderJob::dispatch($folderFile);

        return [
            'data' => new FileResource($folderFile),
            'message' => 'File uploaded successfully!',
            'info' => "Your file has been uploaded and is now available."
        ];
    }
}
