<?php

namespace App\Http\Resources\Photographer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->plan->name,
            'icon' => $this->plan->icon,
            'description' => $this->plan->description,
            'storage_size' => $this->plan->storage_size,
            'storage_unit' => $this->plan->storage_unit,
            'storage_limit' => $this->plan->storage_limit,
            'folders_limit' => $this->plan->folders_limit,
            'billing_cycle' => $this->billing_cycle,
            'features' => $this->features,
            'is_trial' => $this->is_trial,
            'amount' => $this->amount,
            'discount' => $this->discount,
            'currency' => $this->currency
        ];
    }
}
