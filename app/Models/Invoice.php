<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'stripe_invoice_id',
        'code',
        'amount_due',
        'amount_paid',
        'url',
        'pdf',
        'start',
        'end',
        'status_id',
        'subscription_id',
        'issued_at',
        'paid_at'
    ];

    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ListStatus', 'status_id', 'id');
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
            'stripe_invoice_id',
            'code',
            'amount_due',
            'amount_paid',
            'url',
            'pdf',
            'start',
            'end',
            'status_id',
            'subscription_id',
            'issued_at',
            'paid_at'
        ])
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
        ->useLogName('Invoice')
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }

    public function getIssuedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
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
