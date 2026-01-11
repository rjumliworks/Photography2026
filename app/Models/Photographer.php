<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Photographer extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'information',
        'rating_avg',
        'rating_count',
        'experience',
        'studio_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function studio()
    {
        return $this->belongsTo('App\Models\ListStudio', 'studio_id', 'id');
    }

    public function gears()
    {
        return $this->hasMany('App\Models\PhotographerGear', 'photographer_id');
    }

    public function specializations()
    {
        return $this->hasMany('App\Models\PhotographerSpecialization', 'photographer_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\PhotographerRating', 'photographer_id');
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
            'information',
            'rating_avg',
            'rating_count',
            'experience',
            'country_id',
            'studio_id',
            'user_id'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Photographer')
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
}
