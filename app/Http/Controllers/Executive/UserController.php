<?php

namespace App\Http\Controllers\Executive;

use App\Traits\HandlesTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DropdownClass;
use App\Services\Executive\Users\SaveClass;
use App\Services\Executive\Users\ViewClass;
use App\Services\Executive\Users\RekognitionClass;
use App\Http\Requests\Executive\UserRequest;

class UserController extends Controller
{
    use HandlesTransaction;

    protected ViewClass $view;
    protected SaveClass $save;
    protected DropdownClass $dropdown;
    protected RekognitionClass $rekognition;

    public function __construct(DropdownClass $dropdown, SaveClass $save, ViewClass $view, RekognitionClass $rekognition){
        $this->dropdown = $dropdown;
        $this->view = $view;
        $this->save = $save;
        $this->rekognition = $rekognition;
    }

    public function index(Request $request){
        switch($request->option){
            case 'list':
                return $this->view->list($request);
            break;
            case 'authentication-logs':
                return $this->view->authentications($request);
            break;
            case 'activity-logs':
                return $this->view->activities($request);
            break;
            case 'list':
                return $this->view->list($request);
            break;
            case 'files':
                return $this->rekognition->fetch($request);
            break;
            default:
            return inertia('Executive/Users/Index',[
                'dropdowns' => [
                    'roles' => $this->dropdown->roles(),
                ]
            ]); 
        }   
    }

    public function store(UserRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            switch($request->option){
                case 'user':
                    return $this->save->store($request);
                break;
                case 'file':
                    return $this->rekognition->store($request);
                break;
                case 'delete':
                    return $this->rekognition->delete($request);
                break;
            }
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function update(UserRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            switch($request->option){
                case 'user':
                    return $this->save->update($request);
                break;
                 case 'status':
                    return $this->view->status($request);
                break;
                case 'credential':
                    return $this->view->credential($request);
                break;
                case 'role':
                    return $this->view->role($request);
                break;
                case 'new':
                    return $this->view->new($request);
                break;
            }
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function show($code){
        return inertia('Executive/Users/View',[
            'user_data' => $this->view->user($code),
            'dropdowns' => [
               'roles' => $this->dropdown->roles()
            ],
        ]);
    }
}
