<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Massage extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = ['start', 'end', 'duration', 'price'];
    protected $casts = [
        'json' => 'array',
    ];

   // protected $dateFormat = 'Y-m-d H:i:sO';

    public static function getMassage(){
        $records = Massage::all();

        return json_decode($records);
    }
}


