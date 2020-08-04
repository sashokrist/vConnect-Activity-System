<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signupTitle()
    {
        return $this->belongsTo(SignupTitle::class);
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
