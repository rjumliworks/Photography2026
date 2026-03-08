<?php

namespace App\Http\Resources\Common;

use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DownloadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $hashids = new Hashids('krad',10);
        $code = $hashids->encode($this->folder->id);

        return [
            'id' => $this->folder->id,
            'code' => $code,
            'name' => $this->folder->name,
            'description' => $this->folder->description,
            'count' => $this->count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
