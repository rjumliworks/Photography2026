<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewerFolder extends Model
{
    protected $fillable = [
        'viewer_id','folder_id'
    ];

    public function viewer()
    {
        return $this->belongsTo('App\Models\Viewer', 'viewer_id', 'id');
    }

    public function folder()
    {
        return $this->belongsTo('App\Models\Folder', 'folder_id', 'id');
    }
}
