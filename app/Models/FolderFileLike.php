<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolderFileLike extends Model
{
    protected $fillable = [
        'file_id','liker_id','liker_type'
    ];

    public function file()
    {
        return $this->belongsTo('App\Models\Folder', 'folder_id', 'id');
    }

    public function liker()
    {
        return $this->morphTo();
    }

    public function getLikerNameAttribute()
    {
        if ($this->liker instanceof \App\Models\User) {
            return $this->liker->profile?->fullname ?? 'Unknown User';
        } elseif ($this->liker instanceof \App\Models\Viewer) {
            return $this->liker->name ?? 'Unknown Viewer';
        }

        return 'Unknown';
    }
}
