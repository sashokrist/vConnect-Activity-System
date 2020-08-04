<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollResult extends Model
{
    //protected $table = 'poll_results2';
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function poll_answer()
    {
        return $this->hasMany(PollAnswer::class);
    }

    public function answer()
    {
        return $this->belongsTo(PollAnswer::class, 'id');
    }

}
