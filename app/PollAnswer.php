<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    protected  $fillable = ['name', 'poll_id'];
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function result()
    {
        return $this->belongsToMany(PollResult::class, 'poll_results', 'answer_id', 'poll_id');
    }

    public function picture()
    {
        return $this->belongsTo(PollAnswerPicture::class);
    }

}
