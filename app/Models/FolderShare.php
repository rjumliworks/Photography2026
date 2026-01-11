<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolderShare extends Model
{
    protected $fillable = [
        'folder_id', 'user_id', 'type_id', 'status_id', 'is_limited', 'start_at', 'end_at'
    ];

    public function folder()
    {
        return $this->belongsTo('App\Models\Folder', 'folder_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ListName', 'type_id', 'id');
    }

     public function status()
    {
        return $this->belongsTo('App\Models\ListStatus', 'status_id', 'id');
    }
}
