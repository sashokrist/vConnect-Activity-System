<?php

namespace App\Http\Controllers\Admin;

use App\Events\RegisterForMassageEvent;
use App\Events\SubscribeForNewsEvent;
use App\Events\SubscribeForPollEvent;
use App\Events\SubscribeForSignupEvent;
use App\Exports\UserExport;
use App\Group;
use App\Groups;
use App\GroupUser;
use App\Mail\MailForSubscribeForMassage;
use App\Subscribe;
use App\SubscribeUser;
use App\UserGroups;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::paginate(5);
       return  view('users.manage-users')->with('users', $users);
    }

    public function manageUsers(Request $request)
    {
        $users = User::paginate(5);
        $roles = User::with('roles')->get();
        $user = auth()->user();
       // dd($roles);
       // $roles = Role::all();
        $groups = Group::all();
        return view('users.manage-users', compact('users', 'user', 'roles', 'groups'));
    }


    public function edit(User $user)
    {
           $roles = Role::all();
           $groups = Group::all();

        return view('users.edit', compact(['user', 'roles', 'groups']));
    }

    public function update(Request $request, User $user, UserStoreRequest $userStoreRequest)
    {
        $user->roles()->sync($request->roles);
        $user->groups()->sync($request->groups);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back();
    }


    public function destroy(User $user)
    {
        if($user!== null && $user->hasAnyRoles(['admin'])) {
            return redirect()->back()->with('error', 'Can not delete admin account!');
        }
        $user->roles()->detach();
        $user->groups()->detach();
        $user->delete();
        return redirect()->route('home')->with('success', 'User was deleted successfully!');
    }

    public function export(Request $request){

        if ($request->input('exportexcel') !== null ){
            return Excel::download(new UserExport, 'users.xlsx');
        }

        if ($request->input('exportcsv') !== null ){
            return Excel::download(new UserExport, 'users.csv');
        }

        return redirect()->action('PagesController@index');
    }

    public function search(Request $request)
    {
        $keyword = $request->users;
      $search = User::search($keyword)->get();

        return view('users.results', compact(['search']));
    }

    public function downloadPDF() {
        $users = User::all();
        $pdf = PDF::loadView('users.pdf', compact('users'));

        return $pdf->download('users.pdf');
    }

    public function profile()
    {

    $userSub = User::with('subscribe')->where('id', auth::user()->id)->first();
       $user = auth()->user();
     $id = $user->id;
        $email = auth()->user()->email;
        $roles = Role::all();
        $subscribers = SubscribeUser::all();
         $subscribesAll= Subscribe::all();

        return view(('users.profile'), compact('user', 'roles', 'subscribers', 'subscribesAll', 'userSub'));
    }

    public function avatar(Request $request)
    {
        if ($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.'. $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

        }
        return redirect()->back()->with('success', 'You have updated your avatar successfully!');
    }

    public function unsubscribe(Request $request)
    {
       $id = $request->input('id');
        $subscribe = SubscribeUser::where('subscribe_id', $id)->first();

        $subscribe->delete();
        return redirect()->route('user/profile')->with('success', 'User was unsubscribed successfully!');
    }

    public function subscribe()
    {

        $user = auth()->user();
        $subscribes = Subscribe::all();
        return view('subscribe.subscribe-user', compact(['subscribes', 'user']));
    }

    public function subscribeUser(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->subscribe()->sync($request->subscribe);
        if ($request->input('subscribe') !== null){
            foreach ($request->input('subscribe') as $item){
                // dd($item);
                $subsc = Subscribe::where('id', $item)->first();
                if ($subsc->title === 'Poll'){
                    //event(new SubscribeForPollEvent(auth()->user()));
                }
                if ($subsc->title === 'News'){
                   // event(new SubscribeForNewsEvent(auth()->user()));
                }
                if ($subsc->title === 'Signup'){
                   // event(new SubscribeForSignupEvent(auth()->user()));
                }
                if ($subsc->title === 'Massage'){
                   // event(new RegisterForMassageEvent(auth()->user()));
                }
            }
        }


        $user->save();
        return redirect()->route('home')->with('success', 'You were subscribed successfully!');
    }

}
