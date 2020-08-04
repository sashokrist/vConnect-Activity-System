<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['title'];
    public function user()
    {
        return $this->belongsToMany(User::class, 'group_users' );
    }
}
