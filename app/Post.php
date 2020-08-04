<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'slug', 'body', 'category_id', 'group_id', 'image'];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
