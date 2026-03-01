<?php

namespace App\Http\Controllers\Viewer;

use Hashids\Hashids;
use App\Models\Folder;
use App\Models\FolderFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Common\FolderResource;
use App\Http\Resources\Common\FolderViewResource;


class FolderController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'list':
                return $this->list($request);
            break;
            default:
                return inertia('Participant/Folders/Index');
        }
    }

    public function list($request){
        
        $data = Folder::with('type')
        ->whereHas('viewers', function ($q) {
            $q->where('viewer_id',\Auth::guard('viewer')->id());
        })
        ->paginate(10);
        return FolderResource::collection($data);
    }

    public function show($code){
        $hashids = new Hashids('krad',10);
        $code = $hashids->decode($code);
        return inertia('Participant/Folders/View/Index',[
            'folder_data' => $this->view($code),
            'used' => $this->used($code),
        ]);
    }

    private function view($code){
        $folder = Folder::query()
            ->with('files.user.profile','files.comments.commenter','files.likes.liker')
            ->with('password')
            ->with('tags')
            ->with('viewers.viewer')
            ->with('gears')
            ->with('type')
            ->with('shares.user.profile','shares.type','shares.status')
            ->with('user.profile')
            ->where('id',$code)->first();
        $folder->opened_at = now();
        $folder->save();

        return new FolderViewResource($folder);
    }

    private function used($code){
        $totalBytes = FolderFile::whereHas('folder', function ($q) use ($code){
            $q->where('id',$code);
        })->sum('size');
    
        $imageQuery = FolderFile::whereHas('folder', function ($q) use ($code){
            $q->where('id',$code);
        })
        ->whereIn('mime_type', [
            'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
            'image/webp', 'image/svg+xml', 'image/bmp', 'image/tiff'
        ]);

        $imageBytes = $imageQuery->sum('size');
        $imageCount = $imageQuery->count();

        $videoQuery = FolderFile::whereHas('folder', function ($q) use ($code){
            $q->where('id',$code);
        })
        ->whereIn('mime_type', [
            'video/mp4','video/x-m4v','video/quicktime','video/x-msvideo',
            'video/x-ms-wmv','video/x-flv','video/webm','video/x-matroska',
            'video/3gpp','video/3gpp2','video/ogg','video/mp2t'
        ]);

        $videoBytes = $videoQuery->sum('size');
        $videoCount = $videoQuery->count();

        return [
            'total' => $totalBytes,
            'types' => [
                [
                    'label' => 'Images',
                    'icon' => 'ri-image-fill',
                    'color' => 'text-primary',
                    'description' => 'files uploaded',
                    'count' => $imageCount,
                    'data' => $imageBytes,
                ],
                [
                    'label' => 'Videos',
                    'icon' => 'ri-movie-fill',
                    'color' => 'text-primary',
                    'description' => 'files uploaded',
                    'count' => $videoCount,
                    'data' => $videoBytes,
                ]
            ]
        ];
    }

}
