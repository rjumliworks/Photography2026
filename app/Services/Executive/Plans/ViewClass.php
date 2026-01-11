<?php

namespace App\Services\Executive\Plans;

use App\Models\Plan;
use App\Http\Resources\DefaultResource;

class ViewClass
{
    public function lists($request){
        $plans = Plan::with([
            'pricings.currency' => function($q) {
                $q->select('id', 'code', 'symbol', 'name'); // pick only needed columns
            }
        ])->paginate(10);

        return DefaultResource::collection($plans);
    }
}
