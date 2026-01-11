<?php

namespace App\Services\Trash;

use App\Models\Plan;
use App\Models\Folder;
use App\Models\FolderFile;
use App\Traits\HandlesSize;

class ViewClass
{   
    use HandlesSize;

    protected function userId()
    {
        return auth()->id();
    }

    public function lists()
    {
        $trashedFolders = Folder::where('user_id', \Auth::id())
            ->onlyTrashed()
            ->get();

        $trashedFiles = FolderFile::where('user_id', \Auth::id())
            ->onlyTrashed()
            ->whereDoesntHave('folder', function ($q) {
                $q->onlyTrashed(); // exclude files whose parent folder is also soft deleted
            })
            ->get();

        $trashedFolders->map(function ($folder) {
            $folder->type = 'folder';
            return $folder;
        });

        $trashedFiles->map(function ($file) {
            $file->type = ($file->kind == 'image') ? 'image' : 'video';
            return $file;
        });

        $trash = $trashedFolders->concat($trashedFiles)->sortByDesc('deleted_at');

        return $trash->values(); // reset keys
    }
    
    public function bytes(){
        $plan = Plan::whereHas('pricings', function ($query){
            $query->whereHas('subscriptions', function ($query){
                $query->where('user_id',$this->userId());
            });
        })->value('storage_limit');
        $used = FolderFile::where('user_id', $this->userId())->withoutTrashed()->sum('size');
        $deleted = FolderFile::where('user_id', $this->userId())->onlyTrashed()->sum('size');
        $free = $plan - ($used + $deleted);
        return [
            'plan' => $plan,
            'used' => $used,
            'deleted' => $deleted,
            'free' => max(0, $free),
            'used_percent'    => number_format(($used / $plan) * 100, 2),
            'deleted_percent' => number_format(($deleted / $plan) * 100, 2),
            'free_percent'    => number_format(($free / $plan) * 100, 2),
        ];
    }

    public function plan(){
        return new SubscriptionResource(Subscription::with('plan.plan')->where('user_id',$this->userId())->first());
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
        ];
    }
}
