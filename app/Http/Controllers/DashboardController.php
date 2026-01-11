<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DropdownClass;
use App\Services\Dashboard\PhotographerClass;

class DashboardController extends Controller
{
    protected $dropdown, $photographer;

    public function __construct(
        DropdownClass $dropdown,
        PhotographerClass $photographer
    ){
        $this->dropdown = $dropdown;
        $this->photographer = $photographer;
    }

    public function index(Request $request){
        if(!\Auth::check()){
            return inertia('Auth/Login');
        }else{
            if(\Auth::user()->hasRole('Photographer')){
                return inertia('Modules/Photographer/Dashboard/Index',[
                    'plan' => $this->photographer->plan(),
                    'used' => $this->photographer->used(),
                    'folders' => $this->photographer->folders(),
                    'files' => $this->photographer->files()
                ]);
            }else if(\Auth::user()->role == 'Client'){

            }else{
                return inertia('Modules/Administrator/Dashboard/Index');
            }
        }
    }


    public function search(Request $request){
        $option = $request->option;
        switch($option){
            case 'tags':
                return $this->dropdown->tags($request->keyword);
            break;
            case 'users':
                return $this->dropdown->users($request->keyword);
            break;
        }
    }
}
