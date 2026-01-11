<?php

namespace App\Services\Files;

use App\Models\FolderFile;
use App\Models\FolderFileLike;
use App\Models\FolderFileComment;
use App\Http\Resources\Common\FileResource;
use Illuminate\Support\Facades\Storage;

class UpdateClass
{
    public function rename($request){
        $file = FolderFile::findOrFail($request->id);
        $file->name = $request->name;
        $file->save();

        return [
            'data' => new FileResource($file),
            'message' => 'File name updated successfully!',
            'info' => "The file name has been changed and saved."
        ];
    }

    public function download($request){
        $file = FolderFile::findOrFail($request->id);
        return Storage::disk('public')->download($file->path, $file->name);
    }

    public function restore($request)
    {
        $file = FolderFile::withTrashed()->findOrFail($request->id);
        $file->deleted_at = null;
        $file->save(); 
        
        return [
            'data' => $file->toArray(),
            'message' => 'File restored successfully!',
            'info' => "The file {$file->name} has been restored."
        ];
    }

    public function delete($request)
    {
        $file = FolderFile::withTrashed()->findOrFail($request->id);
        if ($request->is_permanent) {
            $file->forceDelete();         
            $message = "File permanently deleted!";
            $info = "The file is permanently deleted and cannot be restored.";
        } else {
            $file->delete();         
            $message = 'File deleted successfully!';
            $info =  "The file is no longer visible in your folders but can still be restored from Trash.";
        }

        return [
            'data' => $file,
            'message' => $message,
            'info' => $info
        ];
    }

    public function comment($request){
        $file = FolderFile::findOrFail($request->id);
        $comment = $file->comments()->create([
            'comment' => $request->comment,
            'user_id' => \Auth::user()->id
        ]);
        $comment = FolderFileComment::with('user.profile')->where('id',$comment->id)->first();
        return [
            'data' => $comment,
            'message' => 'Comment added successfully!',
            'info' => "Your comment has been saved and is now visible on this file."
        ];
    }

    public function like($request){
    
        $like = FolderFileLike::firstOrCreate([
            'file_id' => $request->id,
            'user_id' => \Auth::user()->id
        ]);

        return [
            'data' => '',
            'message' => false,
            'info' => '-'
        ];
    }

    public function unlike($request){
        FolderFileLike::where('id', $request->id)->delete();
        return [
            'data' => '',
            'message' => false,
            'info' => '-'
        ];
    }
}
