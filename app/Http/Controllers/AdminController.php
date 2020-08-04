<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('auth.loginAdmin');
    }

    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();
            if($user!== null && $user->hasAnyRoles(['admin'])) {
                Auth::login($user, $remember = true);
                return view('home');
            }
                return redirect()->back()->with('error', 'Yor are not ADMIN');
        }
}
