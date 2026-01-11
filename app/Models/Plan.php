<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'icon',
        'description',
        'storage_size',
        'storage_unit',
        'storage_limit',
        'folders_limit',
        'features',
        'is_trial',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array'
    ];

    public function pricings()
    {
        return $this->hasMany('App\Models\PlanPricing', 'plan_id');
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
            'storage_size',
            'storage_unit',
            'storage_limit',
            'filders_limit',
            'features'
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
