<?php

namespace App\Http\Controllers\Viewer;

use App\Models\Folder;
use App\Models\ViewerFolder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Common\FolderResource;

class DashboardController extends Controller
{
    public function index(){
        return inertia('Participant/Dashboard/Index',[
            'folders' => $this->folders()
        ]);
    }

    private function folders(){
        $data = Folder::whereHas('viewers', function ($q) {
            $q->where('viewer_id',\Auth::guard('viewer')->id());
        })
        ->get();
        return FolderResource::collection($data);
    }
}
