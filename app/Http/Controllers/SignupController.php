<?php

namespace App\Http\Controllers;

use App\Events\UserSignupEvent;
use App\Jobs\SendEmailSignupJob;
use App\Poll;
use App\Signup;
use App\SignupTitle;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class SignupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $signups = SignupTitle::with('user')->with('signup')->orderByDesc('id')->first();
        if ($signups !== null) {
            $signid = $signups->id;
            $results = Signup::where('signup_id', $signid)->get();
            $authUserName = auth()->user()->name;
            $polls = Poll::where('signup_id', $signid)->first();
            $archives = SignupTitle::all();
        } else{
            $signups = null;
            $authUserName = null;
            $archives = null;
            $polls = null;
            $results = null;
            $signid = null;
        }
        return view('signup.index', compact('signups', 'authUserName', 'signid', 'results', 'polls', 'archives'));
    }

    public function store(Request $request)
    {
        $signid = $request->signid;
        $userSign = Signup::with('user')->where('signup_id', $signid)->where('user_id', auth()->user()->id)->first();

        if ($userSign === null){
            $signup = new Signup();

            $signup->user_id = auth()->user()->id;
            $signup->name = auth()->user()->name;
            $signup->signup_id = $signid;
            $signup->save();

            //event(new UserSignupEvent());
            return redirect()->back()->with('success','You signed up successfully!');
        } else {
                    return redirect()->back()->with('error','You already signed up, please delete your signup to be able to sign up again!');
               }
    }

    public function destroy(Signup $signup)
    {
        $signup->delete();
        return redirect()->back()->with('success','Record was deleted successfully!');
    }

    public function allSignups($id)
    {
        $signup = SignupTitle::find($id);
        $results = Signup::where('signup_id', $id)->get();
        $authUserName = auth()->user()->name;
        $polls = Poll::where('signup_id', $id)->get();
        $archives = SignupTitle::all();

        return view('signup.archive', compact('signup', 'results', 'authUserName', 'polls', 'archives'));
    }

    public function storeArchive(Request $request)
    {
        $uname = $request->input('user');
        $signid = $request->signid;

        $userSign = Signup::where('signup_id', $signid)->where('name', $uname)->first();
        if (!$userSign){
            $signup = new Signup();

            $signup->user_id = auth()->user()->id;
            $signup->name = auth()->user()->name;
            $signup->signup_id = $signid;
            $signup->save();
            // Mail::to(auth()->user()->email)->send(new \App\Mail\Signup());
           /* $email = auth()->user()->email;
            $details['email'] = $email;
            dispatch(new SendEmailSignupJob($details));*/

            return redirect()->back()->with('success','You signed up successfully!');
        } else {
            return redirect()->back()->with('error','You already signed up, please delete your signup to be able to sign up again!');
        }
    }
}
