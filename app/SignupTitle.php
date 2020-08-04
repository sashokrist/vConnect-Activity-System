<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignupTitle extends Model
{
    protected $fillable = ['title'];
    public function signup()
    {
        return $this->hasMany(Signup::class, 'signup_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public static function getSignup(){
        $signup = SignupTitle::with('signup')->get()->sortByDesc('id')->first();
        $id = $signup->id;
        $records =  Signup::where('signup_id', $id)->get();
        return $records;
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class, 'id');
    }
}
