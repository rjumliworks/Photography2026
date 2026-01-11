<?php

namespace App\Http\Controllers\Common;

use App\Traits\HandlesTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Trash\SaveClass;
use App\Services\Trash\ViewClass;

class TrashController extends Controller
{
    use HandlesTransaction;

    public $view, $save;

    public function __construct(ViewClass $view, SaveClass $save){
        $this->view = $view;
        $this->save = $save;
    }

    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->view->lists($request);
            break;
            default:
                return inertia('Modules/Photographer/Trash/Index',[
                    'data' => $this->view->lists(),
                    'storage' => $this->view->bytes()
                ]);
        }
    }
}
