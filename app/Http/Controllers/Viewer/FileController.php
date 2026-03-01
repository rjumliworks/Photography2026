<?php

namespace App\Http\Controllers\Viewer;

use App\Traits\HandlesTransaction;
use App\Models\FolderFile;
use App\Models\FolderFileLike;
use App\Models\FolderFileComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    use HandlesTransaction;

    public function update(Request $request){
        $result = $this->handleTransaction(function () use ($request) {
            switch($request->option){
                case 'comment':
                    return $this->comment($request);
                break;
                case 'like':
                    return $this->like($request);
                break;
                case 'unlike':
                    return $this->unlike($request);
                break;
            }
        });
        
        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    private function comment($request){
        $file = FolderFile::findOrFail($request->id);
        $user = $this->getAuthenticatedUser();

        $comment = $file->comments()->create([
            'comment'         => $request->comment,
            'commenter_id'    => $user->id,
            'commenter_type'  => get_class($user),
        ]);

        $comment->load('commenter');
        return [
            'data' => $comment,
            'message' => 'Comment added successfully!',
            'info' => "Your comment has been saved and is now visible on this file."
        ];
    }

    private function like($request){
        $file = FolderFile::findOrFail($request->id);
        $user = $this->getAuthenticatedUser();
        FolderFileLike::firstOrCreate([
            'file_id'    => $file->id,
            'liker_id'   => $user->id,
            'liker_type' => get_class($user),
        ]);

        return [
            'data' => '',
            'message' => false,
            'info' => '-'
        ];
    }

    private function unlike($request){
        FolderFileLike::where('id', $request->id)->delete();
        return [
            'data' => '',
            'message' => false,
            'info' => '-'
        ];
    }

    private function getAuthenticatedUser()
    {
        if (auth('viewer')->check()) {
            return auth('viewer')->user();
        }

        if (auth('web')->check()) {
            return auth('web')->user();
        }

        abort(403);
    }
}
