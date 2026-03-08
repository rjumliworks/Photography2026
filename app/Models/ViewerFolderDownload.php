<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewerFolderDownload extends Model
{
    protected $fillable = [
        'viewer_id','folder_id','count'
    ];

    public function viewer()
    {
        return $this->belongsTo('App\Models\Viewer', 'viewer_id', 'id');
    }

    public function folder()
    {
        return $this->belongsTo('App\Models\Folder', 'folder_id', 'id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }
}
