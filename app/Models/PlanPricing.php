<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class PlanPricing extends Model
{
    use LogsActivity;

    protected $fillable = [
        'billing_cycle',
        'currency_id',
        'amount',
        'discount',
        'plan_id'
    ];

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan', 'plan_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\ListCurrency', 'currency_id', 'id');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Models\Subscription', 'plan_id');
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
            'billing_cycle',
            'currency_id',
            'amount',
            'discount',
            'plan_id'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Pricing')
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
