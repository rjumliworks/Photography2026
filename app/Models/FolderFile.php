<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FolderFile extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'path',
        'mime_type',
        'size',
        'text',
        'user_id',
        'folder_id',
        'opened_at',
        'meta',
        'kind',
        'status'
    ];

    protected $casts = ['meta' => 'array'];
    protected $dates = ['deleted_at'];

    public function folder()
    {
        return $this->belongsTo('App\Models\Folder', 'folder_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\FolderFileComment', 'file_id')->orderBy('updated_at','DESC');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\FolderFileLike', 'file_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getOpenedAtAttribute($value)
    {
        return ($value) ? date('F d, Y g:i a', strtotime($value)) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

    public function updateIfDirty(array $attributes){
        $this->fill($attributes);
        $dirtyAttributes = $this->getDirty();
        if(!empty($dirtyAttributes)) {
            $originalAttributes = array_intersect_key($this->getOriginal(), $dirtyAttributes);
            $updated = $this->update($dirtyAttributes);
            return $updated;
        }
        return false;
    }

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->logOnly([
            'name',
            'path',
            'mime_type',
            'size',
            'text',
            'user_id',
            'folder_id',
            'opened_at',
            'meta',
            'kind'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('File')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function getSizeAttribute($value)
    {
        $bytes = $value ?? $this->attributes['size'];

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = $bytes > 0 ? floor(log($bytes, 1024)) : 0;

        return round($bytes / pow(1024, $i), 2).' '.$units[$i];
    }

    public function getDeletedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }
}
