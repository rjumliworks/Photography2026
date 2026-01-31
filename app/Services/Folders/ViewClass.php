<?php

namespace App\Services\Folders;

use Hashids\Hashids;
use App\Models\Folder;
use App\Models\FolderFile;
use App\Traits\HandlesSize;
use App\Http\Resources\Common\FolderResource;
use App\Http\Resources\Common\FolderViewResource;


class ViewClass
{
    use HandlesSize;

    protected function userId()
    {
        return auth()->id();
    }

    public function counts(){
        return [
            'own' => Folder::where('user_id', \Auth::id())->count(),
            'shared' => Folder::whereHas('shares', function ($q) {
                $q->where('user_id', \Auth::id());
            })->count()
        ];
    }

    public function lists($request){
        $data = Folder::with('type')
        ->when($request->type, function ($query, $type) {
            if ($type == 'shared') {
                $query->whereHas('shares', function ($q) {
                    $q->where('user_id', \Auth::id());
                });
            } else if ($type == 'own') {
                $query->where('user_id', \Auth::id());
            }
        }, function ($query) {
            $query->where(function ($q) {
                $q->where('user_id', \Auth::id())
                ->orWhereHas('shares', function ($q2) {
                    $q2->where('user_id', \Auth::id());
                });
            });
        })
        ->paginate(10);
        return FolderResource::collection($data);
    }

    public function show($code){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($code);
        $folder = Folder::query()
            ->with('files.user.profile','files.comments.user.profile','files.likes.user.profile')
            ->with('password')
            ->with('tags')
            ->with('viewers.viewer')
            ->with('gears')
            ->with('type')
            ->with('shares.user.profile','shares.type','shares.status')
            ->with('user.profile')
            ->where('id',$id)->first();
        $folder->opened_at = now();
        $folder->save();

        return new FolderViewResource($folder);
    }

    public function files($code){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($code);
        $files = FolderFile::where('folder_id', $id)
        ->with(['user.profile','comments.user.profile','likes.user.profile'])
        ->latest()
        ->paginate(20);

        return $files;
    }

    public function used(){
        $totalBytes = FolderFile::where('user_id', $this->userId())->sum('size');
    
        $imageQuery = FolderFile::where('user_id', $this->userId())
        ->whereIn('mime_type', [
            'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
            'image/webp', 'image/svg+xml', 'image/bmp', 'image/tiff'
        ]);

        $imageBytes = $imageQuery->sum('size');
        $imageCount = $imageQuery->count();

        $videoQuery = FolderFile::where('user_id', $this->userId())
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
