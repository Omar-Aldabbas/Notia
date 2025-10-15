<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['reporter_id', 'post_id', 'comment_id', 'reason', 'status'];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
