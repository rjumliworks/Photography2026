<?php

namespace App\Http\Controllers\Executive;

use App\Services\DropdownClass;
use App\Traits\HandlesTransaction;
use App\Services\Executive\Plans\SaveClass;
use App\Services\Executive\Plans\ViewClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Executive\PlanRequest;

class PlanController extends Controller
{
    use HandlesTransaction;

    public $view,$save,$dropdown;

    public function __construct(SaveClass $save, ViewClass $view, DropdownClass $dropdown){
        $this->view = $view;
        $this->save = $save;
        $this->dropdown = $dropdown;
    }

    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->view->lists($request);
            break;
            default:
                return inertia('Executive/Plans/Index',[
                    'currencies' => $this->dropdown->currencies()
                ]);
        }
    }

    public function store(PlanRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            return $this->save->plan($request);
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }
}
