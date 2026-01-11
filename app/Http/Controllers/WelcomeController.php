<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\DropdownClass;
use App\Traits\HandlesTransaction;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WelcomeController extends Controller
{
    use HandlesTransaction;

    public $dropdown;
    
    public function __construct(DropdownClass $dropdown)
    {
        $this->dropdown = $dropdown;
    }

    public function index(){
        if (\Auth::check()) {
            return redirect()->intended(route('dashboard'));
        }

        return inertia('Welcome',[
            'dropdowns' => [
                // 'studios' => $this->dropdown->studios(),
                'countries' => $this->dropdown->countries(),
                'sexes' => $this->dropdown->datas('Sex'),
                'suffixes' => $this->dropdown->datas('Suffix'),
                'plans' => $this->dropdown->plans()
                // 'roles' => $this->dropdown->roles()
            ]
        ]);
    }

    // public function store(RegistrationRequest $request){
    //     // $result = $this->handleTransaction(function () use ($request) {
    //         $user = User::create(array_merge($request->all(),[
    //                 'password' => Hash::make(Str::random(10)),
    //                 'username' => Str::before($request->email, '@'),
    //                 'email' => $request->email,
    //                 'is_active' => 1,
    //                 'must_change' => 1
    //             ]));

    //         if($user) {
    //             $user->profile()->create([
    //                 'firstname' => $request->firstname,
    //                 'middlename' => $request->middlename,
    //                 'lastname' => $request->lastname,
    //                 'suffix_id' => $request->suffix_id,
    //                 'sex_id' => $request->sex_id,
    //                 'mobile' => $request->mobile,
    //             ]);
    //             \DB::table('user_roles')->insert([
    //                 'user_id' => $user->id,
    //                 'role_id' => 2,
    //                 'added_by' => 1,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //             // $user->photographer()->create($request->all());
    //             // $subsription = $user->subscription()->create([
    //             //     'plan_id'        => 1,
    //             //     'status_id'      => 2,
    //             //     'start'          => now(),
    //             //     'end'            => now()->addDays(7),
    //             //     'is_autorenew'   => false, 
    //             // ]);
    //             // $subsription->histories()->create([
    //             //     'status_id'      => 11,
    //             //     'start'          => now(),
    //             //     'end'            => now()->addDays(7),
    //             // ]);
    //             Auth::login($user);
    //         }

    //         // return [
    //         //     'data' => $user,
    //         //     'message' => 'User information updated successfully.',
    //         //     'info' => "All relevant fields have been refreshed with the latest data."
    //         // ];
    //     // });

    //     return redirect()->route('dashboard')->with([
    //         'data' => $user,
    //         'message' => 'User information updated successfully',
    //         'info' => "All relevant fields have been refreshed with the latest data.",
    //         'status' => true,
    //     ]);
    // }
    public function store(RegistrationRequest $request)
{
    DB::beginTransaction();

    try {
        $user = User::create([
            ...$request->validated(),
            'password'    => Hash::make(Str::random(10)),
            'username'    => Str::before($request->email, '@'),
            'email'       => $request->email,
            'is_active'   => 1,
            'must_change' => 1,
        ]);

        $user->profile()->create([
            'firstname'  => $request->firstname,
            'middlename' => $request->middlename,
            'lastname'   => $request->lastname,
            'suffix_id'  => $request->suffix_id,
            'sex_id'     => $request->sex_id,
            'mobile'     => $request->mobile,
        ]);

        DB::table('user_roles')->insert([
            'user_id'    => $user->id,
            'role_id'    => 2,
            'added_by'   => auth()->id() ?? 1,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        DB::commit();

        Auth::login($user);

        return redirect()->route('dashboard')->with([
            'user_id' => $user->id,
            'status'  => 'success',
            'message' => 'User registered successfully.',
            'info'    => 'Account has been created and activated.',
        ]);

    } catch (\Throwable $e) {
        DB::rollBack();

        report($e);

        return back()->withInput()->with([
            'status'  => 'error',
            'message' => 'Registration failed.',
            'info'    => 'Please try again. If the problem persists, contact support.',
        ]);
    }
}
}
