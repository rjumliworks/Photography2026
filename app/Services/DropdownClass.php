<?php

namespace App\Services;

use App\Models\User;
use App\Models\Plan;
use App\Models\ListTag;
use App\Models\ListName;
use App\Models\ListData;
use App\Models\ListRole;
use App\Models\ListStudio;
use App\Models\ListCountry;
use App\Models\ListCurrency;
use App\Models\ListDropdown;

class DropdownClass
{  
     public function datas($type){
        $data = ListData::where('type',$type)->where('is_active',1)->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name
            ];
        });
        return $data;
    }

    public function roles(){
         $data = ListRole::where('is_active',1)
        ->whereIn('type', ['Staff', 'Hr'])
        ->get()
        ->groupBy(fn($item) => $item->type === 'Staff' ? 'Regular' : 'Human Resource')
        ->map(function ($items, $label) {
            return [
                'label' => $label,
                'options' => $items->map(fn($item) => [
                    'value' => $item->id,
                    'name' => $item->name
                ])->values()
            ];
        })
        ->values();
        return $data;
    }

    public function names($type){
        $data = ListName::where('type',$type)
        ->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name
            ];
        });
        return $data;
    }

    public function countries(){
        $data = ListCountry::all()->map(function ($item) {
            return [
                'label' => $item->continent,
                'options' => [
                    'value' => $item->id,
                    'name' => $item->name
                ]
            ];
        });
        $grouped = $data->groupBy('label')->map(function ($items) {
            return [
                'label' => $items->first()['label'],
                'options' => $items->pluck('options')->values()
            ];
        })->values();

        return $grouped;
    }

    public function studios(){
        $data = ListStudio::all()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name
            ];
        });
        return $data;
    }

    public function currencies(){
        $data = ListCurrency::all()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->code.' ('.$item->name.')'
            ];
        });
        return $data;
    }

    public function plans(){
        $data = Plan::with([
            'pricings.currency' => function($q) {
                $q->select('id', 'code', 'symbol', 'name');
            }
        ])->where('is_active',1)->where('is_trial',0)->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name,
                'icon' => $item->icon,
                'description' => $item->description,
                'storage_size' => $item->storage_size,
                'storage_unit' => $item->storage_unit,
                'folders_limit' => $item->folders_limit,
                'features' => $item->features,
                'pricings' => $item->pricings
            ];
        });
        return $data;
    }

    public function tags($keyword){
        $data =  ListTag::when($keyword, function ($query) use ($keyword){
            $query->where('name', 'like', '%' . $keyword . '%');
        })
        ->limit(5)->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name
            ];
        });
        return $data;
    }

    public function users($keyword){
        $data =  User::with('profile')
        ->when($keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('profile', function ($q) use ($keyword) {
                    $q->whereRaw('concat(firstname, " ", lastname) LIKE ?', ['%' . $keyword . '%'])
                      ->orWhereRaw('concat(lastname, " ", firstname) LIKE ?', ['%' . $keyword . '%']);
                })
                ->orWhere('email', 'LIKE', "%{$keyword}%");
            });
        })
        ->where('role','!=','Administrator')
        ->where('id','!=',\Auth::user()->id)
        ->limit(5)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->profile->firstname.' '.$item->profile->lastname,
                'email' => $item->email,
                'avatar' => $item->profile->avatar
            ];
        });
        return $data;
    }

    public function dropdowns($class,$type = null){
        $data = ListDropdown::where('classification',$class)
        ->when($type, function ($query) use ($type){
            $query->where('type',$type);
        })
        ->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name,
                'others' => $item->others,
                'type' => $item->type,
                'color' => $item->color,
                'icon' => $item->icon
            ];
        });
        return $data;
    }
}
