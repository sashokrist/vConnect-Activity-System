<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserHasRegisterEvent;
use App\Events\RegisterForMassageEvent;
use App\Events\SubscribeForNewsEvent;
use App\Events\SubscribeForPollEvent;
use App\Events\SubscribeForSignupEvent;
use App\Group;
use App\Http\Controllers\Controller;
use App\Jobs\WelcomeEmailJob;
use App\Role;
use App\Subscribe;
use App\SubscribeUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'user/subscribe';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $role = Role::select('id')->where('name', 'user')->first();
        $subscribe = Subscribe::select('id')->where('title', 'News')->first();
        $group = Group::select('id')->where('title', 'Common')->first();
        $user->roles()->attach($role);
        $user->groups()->attach($group);
        $user->subscribe()->attach($subscribe);
        //event(new NewUserHasRegisterEvent($user));
      return $user;
    }
}
