<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Support\Facades\Auth;

class PostViewController extends Controller
{
    public function store(Post $post)
    {
        if (auth()->check() && !$post->views()->where('user_id', auth()->id())->exists()) {
            $post->views()->create(['user_id' => auth()->id()]);
        }

        $post->increment('views_count');

        return back();
    }
}