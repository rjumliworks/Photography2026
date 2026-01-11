<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class PhotographerSpecialization extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'remarks',
        'specialization_id',
        'photographer_id'
    ];

    public function photographer()
    {
        return $this->belongsTo('App\Models\Photographer', 'photographer_id', 'id');
    }

    public function specialization()
    {
        return $this->belongsTo('App\Models\ListName', 'specialization_id', 'id');
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
            'remarks',
            'specialization_id',
            'photographer_id'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Specialization')
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
