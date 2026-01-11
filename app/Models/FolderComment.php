<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class FolderComment extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'folder_id','user_id','comment'
    ];

    public function file()
    {
        return $this->belongsTo('App\Models\Folder', 'folder_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly([
            'comment','user_id','folder_id'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('File Comment')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
