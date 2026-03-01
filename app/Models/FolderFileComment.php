<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class FolderFileComment extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'file_id','comment','commenter_id','commenter_type'
    ];

    public function file()
    {
        return $this->belongsTo('App\Models\FolderFile', 'file_id', 'id');
    }

    public function commenter()
    {
        return $this->morphTo();
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly([
            'comment','user_id','file_id'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('File Comment')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
