<?php

namespace App\Services\Dashboard;

use App\Models\Folder;
use App\Models\FolderFile;
use App\Models\Subscription;
use App\Traits\HandlesSize;
use App\Http\Resources\Common\FileResource;
use App\Http\Resources\Common\FolderResource;
use App\Http\Resources\Photographer\SubscriptionResource;

class PhotographerClass
{   
    use HandlesSize;

    protected $user; 

    protected function userId()
    {
        return auth()->id();
    }

    public function plan(){
        return new SubscriptionResource(Subscription::with('plan.plan','status')->where('user_id',$this->userId())->first());
    }

    public function folders(){
        $data = Folder::where('user_id',$this->userId())->get();
        return FolderResource::collection($data);
    }

    public function files(){
        $id = \Auth::user()->id;
        $data = FolderFile::with('folder','user.profile')->whereHas('folder',function ($query) use ($id) {
            $query->where('user_id',$id);
        })->orderBy('created_at','DESC')->limit(5)->get();
        return FileResource::collection($data);
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
            'total' => $this->formatBytes($totalBytes),
            'types' => [
                //  [
                //     'label' => 'Folders',
                //     'icon' => 'ri-folder-fill',
                //     'color' => 'text-primary',
                //     'description' => Subscription::with('plan.plan')->where('user_id',$this->user)->value('folders_limit'),
                //     'count' => $imageCount,
                //     'data' => $this->formatBytes($imageBytes),
                // ],
                [
                    'label' => 'Images',
                    'icon' => 'ri-image-fill',
                    'color' => 'text-primary',
                    'description' => ($imageCount > 1) ? 'files uploaded' : 'file uploaded',
                    'count' => $imageCount,
                    'data' => $this->formatBytes($imageBytes),
                ],
                [
                    'label' => 'Videos',
                    'icon' => 'ri-movie-fill',
                    'color' => 'text-primary',
                    'description' => ($videoCount > 1) ? 'files uploaded' : 'file uploaded',
                    'count' => $videoCount,
                    'data' => $this->formatBytes($videoBytes),
                ]
            ]
        ];
    }
}
