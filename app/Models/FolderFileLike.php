<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolderFileLike extends Model
{
    protected $fillable = [
        'file_id','user_id'
    ];

    public function file()
    {
        return $this->belongsTo('App\Models\Folder', 'folder_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
