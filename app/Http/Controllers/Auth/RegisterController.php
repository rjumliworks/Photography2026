<?php

namespace App\Http\Controllers\Auth;

use App\Mail\PassCode; 
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DropdownClass;

class RegisterController extends Controller
{
    public $dropdown;
    
    public function __construct(DropdownClass $dropdown)
    {
        $this->dropdown = $dropdown;
    }

    public function index(){
        return inertia('Auth/Register',[
            'dropdowns' => [
                'countries' => $this->dropdown->countries(),
                'sexes' => $this->dropdown->datas('Sex'),
                'suffixes' => $this->dropdown->datas('Suffix'),
            ]
        ]);
    }

    public function store(Request $request){
        $code = Str::random(10);
        $data = User::create(array_merge($request->all(), [
            'username' => Str::before($request->email, '@'),
            'is_active' => 1,
            'must_change' => 1,
            'password' => Hash::make($code)
        ]));
        $data->profile()->create($request->all());
        $data->myroles()->create([
            'role_id' => 2,
            'added_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $data->subscription()->create([
            'status_id' => 2,
            'plan_id' => 1,
            'start' => now(),
            'end' => now()->addDays(7)
        ]);
        Mail::to($data->email)->queue(new PassCode($data, $code));
        // MailJob::dispatch($data);
        return [
            'data' => $data,
            'message' => 'User creation was successful!', 
            'info' => "You've successfully created an account for the user."
        ];
    }

}
