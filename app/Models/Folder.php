<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_protected',
        'type_id',
        'user_id',
        'opened_at'
    ];

    protected $appends = ['size','count'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'type_id', 'id');
    }

    public function viewers()
    {
        return $this->hasMany('App\Models\ViewerFolder', 'folder_id');
    }

    public function shares()
    {
        return $this->hasMany('App\Models\FolderShare', 'folder_id');
    }

    public function files()
    {
        return $this->hasMany('App\Models\FolderFile', 'folder_id')->orderBy('updated_at','DESC');
    }

    public function password()
    {
        return $this->hasOne('App\Models\FolderPassword', 'folder_id');
    }

    public function tags()
    {
        return $this->belongsToMany(ListTag::class, 'folder_tags', 'folder_id', 'tag_id')->withTimestamps();
    }

    public function gears()
    {
        return $this->hasMany('App\Models\FolderGear', 'folder_id');
    }

    public function getCountAttribute()
    {
        return $this->files()->count();
    }

    public function getSizeAttribute()
    {
        $bytes = $this->files()->withTrashed()->sum('size');

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = $bytes > 0 ? floor(log($bytes, 1024)) : 0;

        return round($bytes / pow(1024, $i), 2).' '.$units[$i];
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
            'description',
            'is_public',
            'is_protected',
            'user_id',
            'opened_at'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Folder')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

    public function getDeletedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }
}
