<?php

namespace App\Services\Subscription;

use App\Models\Subscription;
use App\Models\SubscriptionHistory;

class ViewClass
{
    public function lists($request){
        $data = SubscriptionHistory::with('type')
        ->whereHas('subscription', function ($q) {
            $q->where('user_id', \Auth::id());
        })
        ->paginate(10);
        return FolderResource::collection($data);
    }
}
