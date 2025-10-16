<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate(['reason'=>'required|string|max:500']);

        Report::create([
            'reporter_id' => Auth::id(),
            'post_id' => $post->id,
            'comment_id' => null,
            'reason' => $data['reason'],
            'status' => 'pending',
        ]);

        return back()->with('success','Post reported');
    }

    public function storeComment(Request $request, Comment $comment)
    {
        $data = $request->validate(['reason'=>'required|string|max:500']);

        Report::create([
            'reporter_id' => Auth::id(),
            'post_id' => null,
            'comment_id' => $comment->id,
            'reason' => $data['reason'],
            'status' => 'pending',
        ]);

        return back()->with('success','Comment reported');
    }
}