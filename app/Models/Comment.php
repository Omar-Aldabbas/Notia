<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', "user_id", "content", "upvotes_count"];


    public function post()
    {
        return $this->belongsTo(Post::class);

    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function upvotes()
    {
        return $this->hasMany(CommentUpvote::class);
    }  

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
