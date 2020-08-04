<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['name', 'signup_id'];

    public function poll_result()
    {
        return $this->hasMany(PollResult::class, 'id');
    }

    public function answer()
    {
        return $this->hasMany(PollAnswer::class, 'poll_id');
    }

    public function answer2()
    {
        return $this->belongsToMany(PollResult::class, 'poll_results2', 'poll_id', 'answer_id');
    }

    public static function getPolls(){
        $polls = Poll::with('answer')->get()->sortByDesc('id')->first();
        $id = $polls->id;
        $records =  PollResult::where('poll_id', $id)->get()->toArray();
       // dd($records);
        return $records;
    }

    public function pollComments()
    {
        return $this->hasMany(PollComment::class);
    }

    public function comments()
    {
        return $this->morphMany(PollComment::class, 'commentable')->whereNull('parent_id');
    }

    public function signupTitle()
    {
        return $this->belongsTo(SignupTitle::class);
    }

    public function signup()
    {
        return $this->belongsTo(Signup::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
