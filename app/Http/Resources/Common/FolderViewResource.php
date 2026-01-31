<?php

namespace App\Http\Resources\Common;

use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderViewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $hashids = new Hashids('krad',10);
        $code = $hashids->encode($this->id);

        return [
            'id' => $this->id,
            'code' => $code,
            'name' => $this->name,
            'description' => $this->description,
            'is_public' => $this->public,
            'is_protected' => $this->is_protected,
            'password' => $this->password,
            'count' => $this->count,
            'size' => $this->size,
            'type' => $this->type,
            'shares' => ShareResource::collection($this->shares),
            'owner' => new ProfileResource($this->user),
            'files' => FileResource::collection($this->files),
            'tags' => $this->tags,
            'viewers' => $this->viewers,
            'opened_at' => $this->opened_at,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
