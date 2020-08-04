<?php

namespace App\Http\Controllers;

use App\Events\UserMassageEvent;
use App\Jobs\SendEmailMassageJob;
use App\MassageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\Stripe;

class MassageUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {

        $user = auth()->user()->id;
        $massageUser = new MassageUser();
        $massageUser->user_id = $user;
        $massageUser->massage_id = $id;

        $massageUserTime = MassageUser::where('massage_id', $id)->get();
        //dd($massageUserTime);
        $tm = $request->input('time-slot');
        foreach ($massageUserTime as $item) {
            if ($user === $item->user_id){
                return redirect()->back()->with('error', 'You already booked a time slot!');
            }
            if ($tm === $item->time){
                return redirect()->back()->with('error', 'Someone already booked this time slot!');
            }
        }
        $massageUser->time = $tm;
        $massageUser->paid = 0;
        $massageUser->save();

        //event(new UserMassageEvent());

        return redirect()->route('massage')->with('success','Time slot was reserved successfully!');
    }

    public function stripe()
    {
        return view('time-slot.stripe');
    }


    public function stripePost(Request $request)
    {
        // dd($request->all());
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create ([
            'amount' => 5 * 100,
            'currency' => 'bgn',
            'source' => $request->stripeToken,
            'description' => 'Payment for massage'
        ]);
        return redirect()->route('massage')->with('success','You have paid successfully and time slot was reserved!');
    }

    public function paid(Request $request)
    {
       $id = $request->input('user_id');
       $massage_id =$request->input('massage_id');
       $user = MassageUser::where('user_id', $id)->where('massage_id', $massage_id)->first();
       $user->paid = 1;
       $user->save();
       return redirect()->back()->with('success', 'User paid for the massage!');
    }
}
