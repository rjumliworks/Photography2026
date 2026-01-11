<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'start',
        'end',
        'status_id',
        'photographer_id',
        'plan_id'
    ];

    public function histories()
    {
        return $this->hasMany('App\Models\SubscriptionHistory', 'subscription_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ListStatus', 'status_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\PlanPricing', 'plan_id', 'id');
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
            'start',
            'end',
            'status_id',
            'photographer_id',
            'plan_id'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Photographer')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function getStartAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getEndAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
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
