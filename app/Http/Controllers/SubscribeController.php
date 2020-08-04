<?php

namespace App\Http\Controllers;

use App\Subscribe;
use App\SubscribeUser;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubscribeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $subscribers = User::with('subscribe')->get();

        return view('subscribe.index', compact('subscribers'));

    }

    public function delete(Request $request)
    {
        $subscribe = User::where('id', $request->id)->first();
        $subscribe->subscribe()->detach();
        return redirect()->route('subscribe')->with('success','Subscriptions were deleted successfully!');
    }

    public function subscribe_delete(Request $request)
    {
        dd($request->all());
    }
}
