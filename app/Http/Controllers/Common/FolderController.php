<?php

namespace App\Http\Controllers\Common;

use App\Services\DropdownClass;
use App\Traits\HandlesTransaction;
use App\Services\Folders\SaveClass;
use App\Services\Folders\ViewClass;
use App\Services\Folders\UpdateClass;
use App\Services\Dashboard\PhotographerClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FolderRequest;
use App\Http\Requests\FolderUpdateRequest;

class FolderController extends Controller
{
    use HandlesTransaction;

    public $view,$save,$update,$dropdown,$photographer;

    public function __construct(SaveClass $save, ViewClass $view, UpdateClass $update, PhotographerClass $photographer, DropdownClass $dropdown){
        $this->view = $view;
        $this->save = $save;
        $this->update = $update;
        $this->photographer = $photographer;
        $this->dropdown = $dropdown;
    }

    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->view->lists($request);
            break;
            default:
                return inertia('Modules/Photographer/Folders/Index',[
                    'currencies' => $this->dropdown->currencies(),
                    'types' => $this->dropdown->names('Share'),
                    'visibilities' => $this->dropdown->dropdowns('Visibility'),
                    'counts' => $this->view->counts()
                ]);
        }
    }

    public function store(FolderRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            switch($request->option){
                case 'folder':
                    return $this->save->folder($request);
                break;
                case 'tags':
                    return $this->save->tags($request);
                break;
                case 'viewer':
                    return $this->save->viewer($request);
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

    public function update(FolderUpdateRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            switch($request->option){
                case 'folder':
                    return $this->update->folder($request);
                break;
                case 'tags':
                    return $this->update->tags($request);
                break;
                case 'share':
                    return $this->update->share($request);
                break;
                case 'password':
                    return $this->update->password($request);
                break;
                case 'visibility':
                    return $this->update->visibility($request);
                break;
                case 'softdelete':
                    return $this->update->delete($request);
                break;
                case 'restore':
                    return $this->update->restore($request);
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
        return inertia('Modules/Photographer/Folders/View/Index',[
            'folder_data' => $this->view->show($code),
            'files' => $this->view->files($code),
            'used' => $this->view->used(),
            'plan' => $this->photographer->plan(),
            'types' => $this->dropdown->names('Share'),
            'visibilities' => $this->dropdown->dropdowns('Visibility')
        ]);
    }
}
