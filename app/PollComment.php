<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollComment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(PollComment::class, 'parent_id');
    }
}
