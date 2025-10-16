<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'main_image', 'views_count', 'upvotes_count'];


    public function author()
    {
        return $this->belongsTo(User::class, "user_id");

    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, "post_tags");
    }

    public function upvotes()
    {
        return $this->hasMany(PostUpvote::class);
    }

    public function views()
    {
        return $this->hasMany(PostView::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class);
    }
}
