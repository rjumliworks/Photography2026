<?php

namespace App\Http\Controllers\Common;

use App\Services\DropdownClass;
use App\Traits\HandlesTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Subscription\SaveClass;
use App\Services\Subscription\ViewClass;
use App\Services\Dashboard\PhotographerClass;

class SubscriptionController extends Controller
{
    use HandlesTransaction;

    public $view, $save, $dropdown, $photographer;

    public function __construct(ViewClass $view, SaveClass $save, DropdownClass $dropdown, PhotographerClass $photographer){
        $this->view = $view;
        $this->save = $save;
        $this->photographer = $photographer;
        $this->dropdown = $dropdown;
    }

    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->view->list($request);
            break;
            default:
                return inertia('Modules/Photographer/Subscriptions/Index',[
                    'plan' => $this->photographer->plan(),
                    'used' => $this->photographer->used(),
                    'folders' => $this->photographer->folders(),
                    'files' => $this->photographer->files()
                ]);
        }
    }
}
