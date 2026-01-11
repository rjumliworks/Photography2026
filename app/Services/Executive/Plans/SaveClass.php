<?php

namespace App\Services\Executive\Plans;

use App\Models\Plan;

class SaveClass
{
    public function plan($request){
      
        $data = Plan::create($request->only([
            'name',
            'icon',
            'description',
            'storage_size',
            'storage_unit',
            'storage_limit',
            'folders_limit',
            'features'
        ]));
        if($request->pricings) {
            foreach ($request->pricings as $pricing) {
                $data->pricings()->create($pricing);
            }
        }
        return [
            'data' => $data,
            'message' => 'Photographer registration was successful!',
            'info' => "You've successfully registered a new photographer."
        ];
    }
}
