<?php

namespace App\Services\Executive\Users;

use Hashids\Hashids;
use App\Models\User;
use App\Models\UserRole;
use App\Models\AuthenticationLog;
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\AuthenticationResource;
use App\Http\Resources\Executive\ViewResource;
use App\Http\Resources\Executive\UserResource;
use App\Http\Resources\Executive\RoleResource;

class ViewClass
{
    public function list($request){
        $data = User::with('profile:user_id,firstname,middlename,lastname,suffix_id,avatar,mobile','profile.suffix')
        ->with('myroles:role_id,id,user_id,added_by,removed_by,removed_at,created_at,is_active','myroles.role:id,name','myroles.added:id','myroles.added.profile:user_id,firstname,middlename,lastname,suffix_id','myroles.removed:id','myroles.removed.profile:user_id,firstname,middlename,lastname,suffix_id')
        ->when($request->role, function ($query) use ($request) {
            $query->whereHas('myroles', function ($q) use ($request) {
                $q->when($request->role, function ($q, $role) {
                    $q->where('role_id', $role);
                });
            });
        })->paginate($request->count);
        return UserResource::collection($data);
    }

    public function user($code){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($code);

        $data = new ViewResource(
            User::query()
            ->with('profile:user_id,firstname,middlename,lastname,suffix_id,avatar,mobile','profile.suffix')
            ->with('myroles:role_id,id,user_id,created_at,is_active','myroles.role:id,name')
            ->where('id',$id)->first()
        );
        return $data;
    }

    public function authentication($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = AuthenticationLog::with('user.profile')->where('user_id',$id)->orderBy('created_at','DESC')->paginate($request->count);
        return AuthenticationResource::collection($data);
    }

    public function activity($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = Activity::with('causer.profile')->where('causer_id',$id)->orderBy('created_at','DESC')->paginate($request->count);
        return ActivityResource::collection($data);
    }

    public function status($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = User::with('profile:user_id,firstname,middlename,lastname,suffix_id,avatar,mobile','profile.suffix')
        ->with('myroles:role_id,id,user_id','myroles.role:id,name')
        ->where('id',$id)->first();
        $data->is_active = $request->is_active;
        $data->save();

        return [
            'data' => new UserResource($data),
            'message' => 'User update was successful!', 
            'info' => "You've successfully updated the selected user."
        ];
    }

    public function credential($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code)[0];
   
        $data = User::with('profile')->find($id);
        $data->email = $request->email;
        if ($request->set) {
            $data->password = bcrypt($request->password);
            $data->must_change = 1;
        }
        if($data->save() && $data->profile){
            $data->profile->mobile = $request->mobile;
            $data->profile->save();
        }
        $data = User::with('profile:user_id,firstname,middlename,lastname,suffix_id,avatar,mobile')
        ->with('myroles:role_id,id,user_id','myroles.role:id,name')
        ->where('id',$id)->first();
        return [
            'data' => new UserResource($data),
            'message' => 'User update was successful!', 
            'info' => "You've successfully updated the selected user."
        ];
    }

    public function new($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code)[0];

        $data = new UserRole;
        $data->user_id = $id;
        $data->agency_id = $request->agency_id;
        $data->facility_id = $request->facility_id;
        $data->laboratory_id = $request->laboratory_id;
        $data->role_id = $request->role_id;
        $data->is_primary = 0;
        $data->save();

        $data = UserRole::with('role:id,name','laboratory','facility')->where('id',$data->id)->first();
        return [
            'data' => new RoleResource($data),
            'message' => 'User role remove was successful!', 
            'info' => "You've successfully updated the selected user."
        ];
    }

    public function role($request){
        if($request->type == 'remove'){
            $data = UserRole::find($request->id);
            $data->removed_by = \Auth::user()->id;
            $data->removed_at = now();
            $data->is_active = 0;
            $data->save();
            $id = $request->id;
        }else{
            $data = new UserRole;
            $data->role_id = $request->role_id;
            $data->user_id = $request->id;
            $data->added_by = \Auth::user()->id;
            $data->is_active = 1;
            $data->save();
            $id = $data->id;
        }

        $data = UserRole::with('role:id,name')->where('id',$id)->first();
        return [
            'data' => new RoleResource($data),
            'message' => 'User role remove was successful!', 
            'info' => "You've successfully updated the selected user."
        ];
    }

    public function authentications($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = AuthenticationLog::with('user.profile')->where('user_id',$id)->orderBy('created_at','DESC')->paginate($request->count);
        return AuthenticationResource::collection($data);
    }

    public function activities($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = Activity::with('causer.profile')->where('causer_id',$id)->orderBy('created_at','DESC')->paginate($request->count);
        return ActivityResource::collection($data);
    }
}
