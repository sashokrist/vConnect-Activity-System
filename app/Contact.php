<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $table = 'contact_us';
    public $fillable = ['name','email','message'];

}
