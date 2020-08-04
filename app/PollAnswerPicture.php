<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollAnswerPicture extends Model
{
    public function answer()
    {
        return $this->belongsTo(PollAnswer::class);
    }
}
