<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'intent_id',
        'charge_id',
        'amount',
        'url',
        'currency_id',
        'invoice_id',
        'status_id',
        'paid_at'
    ];

    public function status()
    {
        return $this->belongsTo('App\Models\ListStatus', 'status_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\ListCurrency', 'currency_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice', 'invoice_id', 'id');
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
            'intent_id',
            'charge_id',
            'amount',
            'url',
            'currency_id',
            'invoice_id',
            'status_id',
            'paid_at'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Payment')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function getPaidAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
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
