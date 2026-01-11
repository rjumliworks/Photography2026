<?php

namespace App\Services\Folders;

use App\Models\Folder;
use App\Models\FolderPassword;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\Common\FolderResource;

class UpdateClass
{
    public function restore($request)
    {
        $folder = Folder::withTrashed()
            ->with(['files' => function ($q) {
                $q->withTrashed();
            }])
            ->findOrFail($request->id);

        // Restore folder first
        $folder->restore();

        // Restore related files
        $folder->files()->restore();

        return [
            'data' => $folder->fresh('files'),
            'message' => 'Folder restored successfully!',
            'info' => 'The folder and its files have been restored from Trash.'
        ];
    }

    public function folder($request){
        $data = Folder::find($request->id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->type_id = $request->type_id;
        $data->save();

        $data = Folder::find($request->id);
        return [
            'data' => new FolderResource($data),
            'message' => 'Folder updated successfully!', 
            'info' => "You’ve successfully updated your folder. All changes are now saved."
        ];
    }

    public function tags($request)
    {
        $data = Folder::find($request->id);
        $data->tags()->sync($request->tags);

        return [
            'data' => $data,
            'message' => 'Tags updated successfully!',
            'info' => 'The folder’s tags have been refreshed with your latest selection.'
        ];
    }

    public function share($request)
    {
        $data = Folder::find($request->id);
        $share = $data->shares()->create([
            'user_id'   => $request->user_id,
            'type_id'   => $request->type_id,
            'status_id' => $request->status_id ?? 15,
            'is_limited'=> $request->is_limited ?? false,
            'start_at'  => $request->start_at,
            'end_at'    => $request->end_at,
        ]);
        if($share){
            $data->type_id = 3;
            $data->save();
        }

        return [
            'data' => $share,
            'message' => 'Folder shared successfully!',
            'info' => 'The folder has been shared with the selected user.'
        ];
    }

    public function visibility($request)
    {
        $data = Folder::find($request->id);
        $data->type_id = $request->type_id;
        $data->save();

        return [
            'data' => $data->toArray(),
            'message' => 'Tags updated successfully!',
            'info' => 'The folder’s tags have been refreshed with your latest selection.'
        ];
    }

    public function delete($request)
    {
        $folder = Folder::with('files')->withTrashed()->findOrFail($request->id);

        if ($request->is_permanent) {
            $folder->files()->forceDelete();
            $folder->forceDelete();         
            $message = "Folder permanently deleted!";
            $info = "The folder and its files are permanently deleted and cannot be restored.";
        } else {
            $folder->files()->delete(); 
            $folder->delete();         
            $message = "Folder deleted successfully!";
            $info = "The folder and its files are no longer visible but can still be restored from Trash.";
        }

        return [
            'data' => $folder,
            'message' => $message,
            'info' => $info
        ];
    }

    public function password($request){
         $request->validate([
            'id' => 'required|exists:folders,id',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' requires confirm_password
        ]);
        
        $data = new FolderPassword;
        $data->password = Crypt::encryptString($request->password);
        $data->folder_id = $request->id; 
        $data->user_id = \Auth::user()->id; 
        $data->expires_at = now(); 
        if($data->save()){
            $folder = Folder::where('id',$request->id)->update(['is_protected' => 1]);
        }

        return [
            'data' => $data->toArray(),
            'message' => 'Folder password has been successfully updated!',
            'info' => 'The folder is now protected with your new password.'
        ];
    }
}
