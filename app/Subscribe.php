<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    public function user()
    {
        return $this->belongsToMany(User::class, 'subscribe_user');
    }
}
