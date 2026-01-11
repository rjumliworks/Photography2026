<?php

namespace App\Http\Resources\Photographer;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $endDate = Carbon::parse($this->end);
        $now = Carbon::now();

        if ($now->greaterThan($endDate)) {
            $remaining = [
                'days' => 0,
                'hours' => 0,
                'minutes' => 0,
            ];
        } else {
            $diff = $now->diff($endDate);
            $remaining = [
                'days' => $diff->d + ($diff->m * 30) + ($diff->y * 365), // normalize months/years
                'hours' => $diff->h,
                'minutes' => $diff->i,
            ];
        }

        return [
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'is_autorenew' => $this->is_autorenew,
            'status' => $this->status,
            'plan' => new PlanResource($this->plan),
            'remaining' => $remaining
        ];
    }
}
