<?php

namespace App\Http\Resources\Common;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShareResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'avatar' => $this->user->profile->avatar,
            'name' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'email' => $this->user->email,
            'type' => $this->type,
            'status' => $this->status
        ];
    }
}
