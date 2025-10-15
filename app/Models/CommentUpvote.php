<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentUpvote extends Model
{
    protected $fillable = ['comment_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
