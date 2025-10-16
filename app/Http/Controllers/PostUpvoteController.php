<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostUpvoteController extends Controller
{
    public function store(Post $post)
    {
        // prevent duplicate upvotes per user
        if (!$post->upvotes()->where('user_id', Auth::id())->exists()) {
            $post->upvotes()->create(['user_id' => Auth::id()]);
        }

        return back()->with('success', 'Post upvoted');
    }
}