<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentUpvoteController extends Controller
{
    public function store(Comment $comment)
    {
        if (!$comment->upvotes()->where('user_id', Auth::id())->exists()) {
            $comment->upvotes()->create(['user_id' => Auth::id()]);
        }

        return back()->with('success', 'Comment upvoted');
    }
}